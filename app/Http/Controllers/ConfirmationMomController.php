<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\ConfirmationMom;
use App\Models\ConfirmationFeedbackForm;

class ConfirmationMomController extends Controller
{

    public function index($user_id, $id){

        $all_details= ConfirmationMom::where('id',$id)
        ->where('user_id',$user_id)
        ->first();

        $user_details= User::where('users.id',$user_id)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();

        $manager_details = ConfirmationFeedbackForm::where('confirmation_feedback_forms.user_id',$user_id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_feedback_forms.manager_id')
        ->select('confirmation_feedback_forms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();

        return view('manager-mom-form-show', compact('all_details','user_details','manager_details'));

    }


    /*save confirmation mom form data in table, start here*/
	public function store(Request $request) {

        if($request['submit']=='Save in Draft'){
            $status='1';

        } else if($request['submit']=='Publish'){

    		$request->validate([
                'minutes_of_meeting' => 'required',
                'content' => 'required',
                'confidence' => 'required',
                'communication' => 'required',
                'data_relevance' => 'required',
                'overall_growth_individual' => 'required',
            ], [
            	'minutes_of_meeting.required' => 'MOM is required.',
            	'content.required' => 'Please rate...',
                'confidence.required' => 'Please rate...',
                'communication.required' => 'Please rate...',
                'data_relevance.required' => 'Please rate...',
                'overall_growth_individual.required' => 'Please rate...',
            ]);


    		if($request->recommend_increment!='No'){
                $request->validate([
                    'how_much_increment_amount' => 'required',
                ], [
                    'how_much_increment_amount.required' => 'Please share how much increment_amount',
                ]);
            }
        
            $status='2';
        }


        $input = ConfirmationMom::insert([
            'user_id' => $request->user_id,
            'manager_id' => $request->manager_id,
            'minutes_of_meeting' => $request->minutes_of_meeting,
            'hidden_notes' => $request->hidden_notes,
            'content' => (!is_null($request->content) ? $request->content : "0"),
            'confidence' => (!is_null($request->confidence) ? $request->confidence : "0"),
            'communication' => (!is_null($request->communication) ? $request->communication : "0"),
            'data_relevance' => (!is_null($request->data_relevance) ? $request->data_relevance : "0"),
            'overall_growth_individual' => (!is_null($request->overall_growth_individual) ? $request->overall_growth_individual : "0"),
            'average_rating_entire_presentation' => $request->average_rating_entire_presentation,
            'recommend_increment' => $request->recommend_increment,
            'how_much_increment' => $request->how_much_increment,
            'how_much_increment_amount' => $request->how_much_increment_amount,
            'are_you_sure_to_confirm' => $request->are_you_sure_to_confirm,
            'status' => $status,
        ]);

        $last_id = DB::getPdo()->lastInsertId();

        if($input){
            
            if($status==1){
                
                return redirect("/manager-mom-form-edit/$request->user_id/$last_id")->with('thank_you', 'Feedback form successfully submitted.');

            } else if($status==2){

                return redirect('/manager-mom-form-show')->with('thank_you', 'Thanks, for giving your valuable time for us.');

            }
        }


        //return back()->with('thank_you', 'Feedback form successfully submitted.');
        
        


	}
	/*save confirmation mom form data in table, end here*/



	/* edit form, start here */
	public function edit($user_id, $id) {

        $mom_form_details = ConfirmationMom::where('id',$id)
        ->where('user_id',$user_id)
        ->first();

		$member_details = User::where('users.id',$user_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','departments.name as department_name','designations.name as designation_name')
        ->first();


        $manager_details = ConfirmationFeedbackForm::where('confirmation_feedback_forms.user_id',$user_id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_feedback_forms.manager_id')
        ->select('confirmation_feedback_forms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();


        if($mom_form_details['status']=='1'){

            return view('manager-mom-form-edit', compact('member_details','mom_form_details','manager_details'));

        } else if($mom_form_details['status']=='2'){

            return redirect("/manager-mom-form-show/$user_id/$id")->with('thank_you', 'Feedback form successfully updated.');

        }

        

	}
	/* edit form, end here */



	/*update confirmation mom form data in table, start here*/
	public function update(Request $request) {

        if($request['submit']=='Save in Draft'){
            $status='1';

        } else if($request['submit']=='Publish'){

    		$request->validate([
                'minutes_of_meeting' => 'required',
                'content' => 'required',
                'confidence' => 'required',
                'communication' => 'required',
                'data_relevance' => 'required',
                'overall_growth_individual' => 'required',
            ], [
            	'minutes_of_meeting.required' => 'MOM is required.',
            	'content.required' => 'Please rate...',
                'confidence.required' => 'Please rate...',
                'communication.required' => 'Please rate...',
                'data_relevance.required' => 'Please rate...',
                'overall_growth_individual.required' => 'Please rate...',
            ]);


    		if($request->recommend_increment!='No'){
                $request->validate([
                    'how_much_increment_amount' => 'required',
                ], [
                    'how_much_increment_amount.required' => 'Please share how much increment_amount',
                ]);
            }

            $status='2';
        }
        

        ConfirmationMom::where('id', $request->edit_id)
        ->update([
            'user_id' => $request->user_id,
            'manager_id' => $request->manager_id,
            'minutes_of_meeting' => $request->minutes_of_meeting,
            'hidden_notes' => $request->hidden_notes,
            'content' => (!is_null($request->content) ? $request->content : "0"),
            'confidence' => (!is_null($request->confidence) ? $request->confidence : "0"),
            'communication' => (!is_null($request->communication) ? $request->communication : "0"),
            'data_relevance' => (!is_null($request->data_relevance) ? $request->data_relevance : "0"),
            'overall_growth_individual' => (!is_null($request->overall_growth_individual) ? $request->overall_growth_individual : "0"),
            'average_rating_entire_presentation' => $request->average_rating_entire_presentation,
            'recommend_increment' => $request->recommend_increment,
            'how_much_increment' => $request->how_much_increment,
            'how_much_increment_amount' => $request->how_much_increment_amount,
            'are_you_sure_to_confirm' => $request->are_you_sure_to_confirm,
            'status' => $status,
        ]);

        
        if($status=='1'){

            return back()->with('thank_you', 'Your form save in draft');

        } else if($status=='2'){
            
            return redirect("/manager-mom-form-show/$request->user_id/$request->edit_id")->with('thank_you', 'Feedback form successfully updated.');
        }        


	}
	/*update confirmation mom form data in table, end here*/


}
