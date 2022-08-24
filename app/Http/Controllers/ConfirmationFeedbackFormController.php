<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\ConfirmationFeedbackForm;

class ConfirmationFeedbackFormController extends Controller
{


	/*save confirmation feedback form data in table, start here*/
	public function store(Request $request) {

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

        //dd($request->recommend_pip_detailed_plan);
        if(($request->are_you_sure_to_confirm==='No, Put under PIP') && ($request->recommend_pip_detailed_plan==null)){
            $request->validate([
                'recommend_pip_detailed_plan' => 'required',
            ], [
                'recommend_pip_detailed_plan.required' => 'Please share a detailed plan.',
            ]);
        }

        //dd($request->recommend_pip_detailed_plan);

        if($request->increment_on_confirmation=='Yes'){
            $request->validate([
                'mention_the_amount' => 'required',
            ], [
                'mention_the_amount.required' => 'Please mention the amount.',
            ]);
        }
        

        
        $input = ConfirmationFeedbackForm::insert([
            'user_id' => $request->user_id,
            'manager_id' => $request->manager_id,
            'discipline' => $request->discipline,
            'punctuality' => $request->punctuality,
            'work_ethics' => $request->work_ethics,
            'team_work' => $request->team_work,
            'response_towards_feedback' => $request->response_towards_feedback,
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
        ]);

        return back()->with('thank_you', 'Feedback form successfully submitted.');


	}
	/*save confirmation feedback form data in table, end here*/
	


}
