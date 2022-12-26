<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\{User, AnnualReviewManagerFeedback};
use App\Http\Controllers\UserController;

use Auth;

class AnnualReviewManagerFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($survey_form_id)
    {

        $manager1=Auth::user()->member_id;
        //dd($manager1);
        $manager_array= (new UserController)->multilevel_manager($manager1);

        $all_members = User::where('users.employee_type','Confirmed')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'designations.name as designation_name')
        ->orderBy('users.first_name','asc')->get();


        $confirmation_feedback_form_details = DB::table('annual_review_manager_feedbacks')
        ->where('annual_review_form_id',$survey_form_id)
        ->get();


        return view('annual-review-manager-feedback-list', compact('all_members','confirmation_feedback_form_details','survey_form_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDetails($survey_form_id, $filled_for, $id)
    {
        ///echo "showDetails";

        $all_details= DB::table('annual_review_manager_feedbacks')
        ->where('id',$id)
        ->where('annual_review_form_id',$survey_form_id)
        ->where('filled_for',$filled_for)
        ->first();
        //dd($all_details);

        $user_details= User::where('users.id',$filled_for)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();


        return view ('annual-review-manager-feedback-form-show',compact('all_details','user_details'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

        $survey_form_id=$request->survey_form_id;
        $filled_for=$request->filled_for;

        $input = DB::table('annual_review_manager_feedbacks')->insert([
            'annual_review_form_id' => $request->survey_form_id,
            'filled_by' => $request->filled_by,
            'filled_for' => $request->filled_for,
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
                
                return redirect("/annual-review-manager-feedback-form-edit/$survey_form_id/$filled_for/$last_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                //return redirect('/annual-review-manager-feedback-form-show')

                return redirect("/annual-review-manager-feedback-form-show/$survey_form_id/$filled_for/$last_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($survey_form_id, $member_id)
    {
        //echo $survey_form_id.'/'.$member_id;

        $filled_by=Auth::user()->id;
        $filled_for=$member_id;


        $member_details = User::where('users.id',$filled_for)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name')
        ->first();


        return view('annual-review-manager-feedback-form', compact('survey_form_id','filled_by','filled_for','member_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($survey_form_id, $member_id, $edit_id)
    {
        $filled_by=Auth::user()->id;
        $filled_for=$member_id;

        $feedback_form_details = DB::table('annual_review_manager_feedbacks')
        ->where('id',$edit_id)
        ->where('filled_for',$member_id)
        ->where('annual_review_form_id',$survey_form_id)
        ->first();

        $member_details = User::where('users.id',$member_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name')
        ->first();


        if($feedback_form_details->status=='1'){

            return view('annual-review-manager-feedback-form-edit', compact('survey_form_id','filled_by','filled_for','member_details','feedback_form_details'));

        } else if($feedback_form_details->status=='2'){

            return redirect("/annual-review-manager-feedback-form-show/$survey_form_id/$member_id/$edit_id");

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);

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

        $edit_id=$request->edit_id;
        $survey_form_id=$request->survey_form_id;
        $filled_by=$request->filled_by;
        $filled_for=$request->filled_for;

        DB::table('annual_review_manager_feedbacks')->where('id', $edit_id)
        ->where('annual_review_form_id', $survey_form_id)
        ->where('filled_by', $filled_by)
        ->where('filled_for', $filled_for)
        ->update([
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

            
        if($status==1){
            
            return redirect("/annual-review-manager-feedback-form-edit/$survey_form_id/$filled_for/$edit_id")->with('thank_you', 'Your form save in draft.');

        } else if($status==2){

            return redirect("/annual-review-manager-feedback-form-show/$survey_form_id/$filled_for/$edit_id");

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
