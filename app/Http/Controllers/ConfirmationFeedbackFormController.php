<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\ConfirmationFeedbackForm;

class ConfirmationFeedbackFormController extends Controller
{

    public function index(Request $request, $user_id, $id){

        $all_details= ConfirmationFeedbackForm::where('confirmation_feedback_forms.id',$id)
        ->where('confirmation_feedback_forms.user_id',$user_id)
        ->first();

        $user_details= User::where('users.id',$user_id)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();



        $joining_date = date('Y-m-d', strtotime($user_details->joining_date));


        /*tenure calculte, start here*/
        $total_tenure=0;

        $sdate = date("y-m-d");
        $edate = $joining_date;
        $date_diff = abs(strtotime($edate) - strtotime($sdate));

        $years = floor($date_diff / (365*60*60*24));
        $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
        //$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $months=$months+($years*12);
        if($months>0){
            $total_tenure= (int)$months;
        }
        /*tenure calculte, end here*/

        return view('confirmation-feedback-form-show', compact('all_details','user_details','total_tenure'));
    }

	/*save confirmation feedback form data in table, start here*/
	public function store(Request $request) {

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){

    		$request->validate([
                'discipline' => 'required',
                'punctuality' => 'required',
                'work_ethics' => 'required',
                'team_work' => 'required',
                'response_towards_feedback' => 'required',
                'elaborate_performance' => 'required',
                'top_3_highlights_1' => 'required',
                'top_3_highlights_2' => 'required',
                'top_3_highlights_3' => 'required',
                'major_task_1' => 'required',
                'major_task_2' => 'required',
                'major_task_3' => 'required',
                'areas_of_improvement_1' => 'required',
                'areas_of_improvement_2' => 'required',
                'areas_of_improvement_3' => 'required',
                'are_you_sure_to_confirm' => 'required',
            ], [
            	'discipline.required' => 'Please rate...',
                'punctuality.required' => 'Please rate...',
                'work_ethics.required' => 'Please rate...',
                'team_work.required' => 'Please rate...',
                'response_towards_feedback.required' => 'Please rate...',
                'elaborate_performance.required' => 'Kindly elaborate is required.',
                'top_3_highlights_1.required' => 'Top 3 highlights 1 is required.',
                'top_3_highlights_2.required' => 'Top 3 highlights 2 is required.',
                'top_3_highlights_3.required' => 'Top 3 highlights 3 is required.',
                'major_task_1.required' => 'Major task 1 is required',
                'major_task_2.required' => 'Major task 2 is required.',
                'major_task_3.required' => 'Major task 3 is required.',
                'areas_of_improvement_1.required' => 'Areas of improvement 1 is required.',
                'areas_of_improvement_2.required' => 'Areas of improvement 2 is required.',
                'areas_of_improvement_3.required' => 'Areas of improvement 3 is required.',
                'are_you_sure_to_confirm.required' => 'Please select any one.',
            ]);


            if($request->add_value_in_team=='Yes'){
                $request->validate([
                    'add_value_in_team_share_instance' => 'required',
                ], [
                    'add_value_in_team_share_instance.required' => 'Please share an instance in details is required.',
                ]);
            }


            if(($request->are_you_sure_to_confirm==='No, Put under PIP') && ($request->recommend_pip_detailed_plan==null)){
                $request->validate([
                    'recommend_pip_detailed_plan' => 'required',
                ], [
                    'recommend_pip_detailed_plan.required' => 'Please share a detailed plan.',
                ]);
            }

            if($request->increment_on_confirmation=='Yes'){
                $request->validate([
                    'mention_the_amount' => 'required',
                ], [
                    'mention_the_amount.required' => 'Please mention the amount.',
                ]);
            }


            $status='2';
        }


        $input = ConfirmationFeedbackForm::insert([
            'user_id' => $request->user_id,
            'manager_id' => $request->manager_id,
            'discipline' => (!is_null($request->discipline) ? $request->discipline : "0"),
            'punctuality' => (!is_null($request->punctuality) ? $request->punctuality : "0"),
            'work_ethics' => (!is_null($request->work_ethics) ? $request->work_ethics : "0"),
            'team_work' => (!is_null($request->team_work) ? $request->team_work : "0"),
            'response_towards_feedback' => (!is_null($request->response_towards_feedback) ? $request->response_towards_feedback : "0"),
            'elaborate_performance' => $request->elaborate_performance,
            'top_3_highlights_1' => $request->top_3_highlights_1,
            'top_3_highlights_2' => $request->top_3_highlights_2,
            'top_3_highlights_3' => $request->top_3_highlights_3,
            'major_task_1' => $request->major_task_1,
            'major_task_2' => $request->major_task_2,
            'major_task_3' => $request->major_task_3,
            'add_value_in_team' => $request->add_value_in_team,
            'add_value_in_team_share_instance' => $request->add_value_in_team_share_instance,
            'areas_of_improvement_1' => $request->areas_of_improvement_1,
            'areas_of_improvement_2' => $request->areas_of_improvement_2,
            'areas_of_improvement_3' => $request->areas_of_improvement_3,
            'met_your_expectations' => $request->met_your_expectations,
            'met_your_expectations_other_specify' => $request->met_your_expectations_other_specify,
            'are_you_sure_to_confirm' => $request->are_you_sure_to_confirm,
            'recommend_pip_detailed_plan' => $request->recommend_pip_detailed_plan,
            'increment_on_confirmation' => $request->increment_on_confirmation,
            'mention_the_amount' => $request->mention_the_amount,
            'status' => $status,
        ]);

        $last_id = DB::getPdo()->lastInsertId();

        if($last_id){
            
            if($status==1){
                
                return redirect("/confirmation-feedback-form-edit/$request->user_id/$last_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                return redirect('/confirmation-feedback-form-show')->with('thank_you', 'Thanks, for giving your valuable time for us.');

            }
        }     


	}
	/*save confirmation feedback form data in table, end here*/


	/* edit form, start here */
	public function edit($user_id, $id) {

        $feedback_form_details = ConfirmationFeedbackForm::where('id',$id)
        ->where('user_id',$user_id)
        ->first();

		$member_details = User::where('users.id',$user_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name')
        ->first();


        $joining_date = date('Y-m-d', strtotime($member_details->joining_date));


        /*tenure calculte, start here*/
        $total_tenure=0;

        $sdate = date("y-m-d");
        $edate = $joining_date;
        $date_diff = abs(strtotime($edate) - strtotime($sdate));

        $years = floor($date_diff / (365*60*60*24));
        $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
        //$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $months=$months+($years*12);
        if($months>0){
            $total_tenure= (int)$months;
        }
        /*tenure calculte, end here*/


        if($feedback_form_details['status']=='1'){

            return view('confirmation-feedback-form-edit', compact('member_details','feedback_form_details','total_tenure'));

        } else if($feedback_form_details['status']=='2'){

            return redirect("/confirmation-feedback-form-show/$user_id/$id")->with('thank_you', 'Feedback form successfully updated.');

        }


	}
	/* edit form, end here */


	/*update confirmation feedback form data in table, start here*/
	public function update(Request $request) {

        $id=$request->edit_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){

    		$request->validate([
                'discipline' => 'required',
                'punctuality' => 'required',
                'work_ethics' => 'required',
                'team_work' => 'required',
                'response_towards_feedback' => 'required',
                'elaborate_performance' => 'required',
                'top_3_highlights_1' => 'required',
                'top_3_highlights_2' => 'required',
                'top_3_highlights_3' => 'required',
                'major_task_1' => 'required',
                'major_task_2' => 'required',
                'major_task_3' => 'required',
                'areas_of_improvement_1' => 'required',
                'areas_of_improvement_2' => 'required',
                'areas_of_improvement_3' => 'required',
                'are_you_sure_to_confirm' => 'required',
            ], [
            	'discipline.required' => 'Please rate...',
                'punctuality.required' => 'Please rate...',
                'work_ethics.required' => 'Please rate...',
                'team_work.required' => 'Please rate...',
                'response_towards_feedback.required' => 'Please rate...',
                'elaborate_performance.required' => 'Kindly elaborate is required.',
                'top_3_highlights_1.required' => 'Top 3 highlights 1 is required.',
                'top_3_highlights_2.required' => 'Top 3 highlights 2 is required.',
                'top_3_highlights_3.required' => 'Top 3 highlights 3 is required.',
                'major_task_1.required' => 'Major task 1 is required',
                'major_task_2.required' => 'Major task 2 is required.',
                'major_task_3.required' => 'Major task 3 is required.',
                'areas_of_improvement_1.required' => 'Areas of improvement 1 is required.',
                'areas_of_improvement_2.required' => 'Areas of improvement 2 is required.',
                'areas_of_improvement_3.required' => 'Areas of improvement 3 is required.',
                'are_you_sure_to_confirm.required' => 'Please select any one.',
            ]);


    		if($request->add_value_in_team=='Yes'){
                $request->validate([
                    'add_value_in_team_share_instance' => 'required',
                ], [
                    'add_value_in_team_share_instance.required' => 'Please share an instance in details is required.',
                ]);
            }

            if(($request->are_you_sure_to_confirm==='No, Put under PIP') && ($request->recommend_pip_detailed_plan==null)){
                $request->validate([
                    'recommend_pip_detailed_plan' => 'required',
                ], [
                    'recommend_pip_detailed_plan.required' => 'Please share a detailed plan.',
                ]);
            }

            

            if($request->increment_on_confirmation=='Yes'){
                $request->validate([
                    'mention_the_amount' => 'required',
                ], [
                    'mention_the_amount.required' => 'Please mention the amount.',
                ]);
            }
        
            $status='2';
        }

    	ConfirmationFeedbackForm::where('id', $id)
        ->update([
            'user_id' => $request->user_id,
            'manager_id' => $request->manager_id,
            'discipline' => (!is_null($request->discipline) ? $request->discipline : "0"),
            'punctuality' => (!is_null($request->punctuality) ? $request->punctuality : "0"),
            'work_ethics' => (!is_null($request->work_ethics) ? $request->work_ethics : "0"),
            'team_work' => (!is_null($request->team_work) ? $request->team_work : "0"),
            'response_towards_feedback' => (!is_null($request->response_towards_feedback) ? $request->response_towards_feedback : "0"),
            'elaborate_performance' => $request->elaborate_performance,
            'top_3_highlights_1' => $request->top_3_highlights_1,
            'top_3_highlights_2' => $request->top_3_highlights_2,
            'top_3_highlights_3' => $request->top_3_highlights_3,
            'major_task_1' => $request->major_task_1,
            'major_task_2' => $request->major_task_2,
            'major_task_3' => $request->major_task_3,
            'add_value_in_team' => $request->add_value_in_team,
            'add_value_in_team_share_instance' => $request->add_value_in_team_share_instance,
            'areas_of_improvement_1' => $request->areas_of_improvement_1,
            'areas_of_improvement_2' => $request->areas_of_improvement_2,
            'areas_of_improvement_3' => $request->areas_of_improvement_3,
            'met_your_expectations' => $request->met_your_expectations,
            'met_your_expectations_other_specify' => $request->met_your_expectations_other_specify,
            'are_you_sure_to_confirm' => $request->are_you_sure_to_confirm,
            'recommend_pip_detailed_plan' => $request->recommend_pip_detailed_plan,
            'increment_on_confirmation' => $request->increment_on_confirmation,
            'mention_the_amount' => $request->mention_the_amount,
            'status' => $status,
        ]);

        if($status=='1'){

            return back()->with('thank_you', 'Your form save in draft');

        } else if($status=='2'){
            
            return redirect("/confirmation-feedback-form-show/$request->user_id/$id")->with('thank_you', 'Feedback form successfully updated.');
        }

	}
	/*save confirmation feedback form data in table, end here*/
	

    /*this is used in start confirmation process in hr login, start here*/
    public function managerConfirmationFeedbackForm($id){
        $employee_id=$user_id = $id;

        $confirmation_feedback_details= ConfirmationFeedbackForm::where('confirmation_feedback_forms.user_id',$user_id)
        ->where('confirmation_feedback_forms.status','2')
        ->leftJoin('users','users.id','=','confirmation_feedback_forms.manager_id')
        ->select('confirmation_feedback_forms.*',DB::raw('CONCAT(first_name, " ", last_name) AS manager_full_name'))
        ->get();

        $user_details= User::where('users.id',$user_id)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();

        $joining_date = date('Y-m-d', strtotime($user_details->joining_date));


        /*tenure calculte, start here*/
        $total_tenure=0;

        $sdate = date("y-m-d");
        $edate = $joining_date;
        $date_diff = abs(strtotime($edate) - strtotime($sdate));

        $years = floor($date_diff / (365*60*60*24));
        $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
        //$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $months=$months+($years*12);
        if($months>0){
            $total_tenure= (int)$months;
        }
        /*tenure calculte, end here*/

        return view('confirmation-process.manager-confirmation-feedback-form', compact('employee_id','confirmation_feedback_details','user_details','total_tenure'));
    }
    /*this is used in start confirmation process in hr login, end here*/

}
