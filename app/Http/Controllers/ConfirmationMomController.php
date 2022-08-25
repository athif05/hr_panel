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
    /*save confirmation mom form data in table, start here*/
	public function store(Request $request) {

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
        

        $input = ConfirmationMom::insert([
            'user_id' => $request->user_id,
            'manager_id' => $request->manager_id,
            'minutes_of_meeting' => $request->minutes_of_meeting,
            'hidden_notes' => $request->hidden_notes,
            'content' => $request->content,
            'confidence' => $request->confidence,
            'communication' => $request->communication,
            'data_relevance' => $request->data_relevance,
            'overall_growth_individual' => $request->overall_growth_individual,
            'average_rating_entire_presentation' => $request->average_rating_entire_presentation,
            'recommend_increment' => $request->recommend_increment,
            'how_much_increment' => $request->how_much_increment,
            'how_much_increment_amount' => $request->how_much_increment_amount,
            'are_you_sure_to_confirm' => $request->are_you_sure_to_confirm,
        ]);

        $last_id = DB::getPdo()->lastInsertId();

        //return back()->with('thank_you', 'Feedback form successfully submitted.');
        return redirect("/manager-mom-form-edit/$request->user_id/$last_id")->with('thank_you', 'Feedback form successfully submitted.');
        


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
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name')
        ->first();


        $manager_details = ConfirmationFeedbackForm::where('confirmation_feedback_forms.user_id',$user_id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_feedback_forms.manager_id')
        ->select('confirmation_feedback_forms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();

        
        return view('manager-mom-form-edit', compact('member_details','mom_form_details','manager_details'));

	}
	/* edit form, end here */



	/*update confirmation mom form data in table, start here*/
	public function update(Request $request) {

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
        

        ConfirmationMom::where('id', $request->edit_id)
        ->update([
            'user_id' => $request->user_id,
            'manager_id' => $request->manager_id,
            'minutes_of_meeting' => $request->minutes_of_meeting,
            'hidden_notes' => $request->hidden_notes,
            'content' => $request->content,
            'confidence' => $request->confidence,
            'communication' => $request->communication,
            'data_relevance' => $request->data_relevance,
            'overall_growth_individual' => $request->overall_growth_individual,
            'average_rating_entire_presentation' => $request->average_rating_entire_presentation,
            'recommend_increment' => $request->recommend_increment,
            'how_much_increment' => $request->how_much_increment,
            'how_much_increment_amount' => $request->how_much_increment_amount,
            'are_you_sure_to_confirm' => $request->are_you_sure_to_confirm,
        ]);

        

        return back()->with('thank_you', 'MOM successfully updated.');
        


	}
	/*update confirmation mom form data in table, end here*/


}
