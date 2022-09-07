<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\TrainingSurvey;
use App\Models\CompanyName;
use App\Models\CompanyLocation;
use App\Models\JobOpeningTypes;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


use Auth;

class TrainingSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $job_opening_types = JobOpeningTypes::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        /*fetch all hr data*/
        $recruiter_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();


        $department_details = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $designation_details = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();
        //dd($company_names);

        /*check record is exist or not*/
        $member_details = User::where('users.id', $user_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->select('users.*', 'company_locations.name as location_name')
        ->first();

        $trainer_role_id=array('1','2','3','4','5','6');
        /*fetch all user as trainer*/
        $trainer_details = User::where('status', '1')
        ->where('is_deleted', '0')
        ->where('employee_type', '=', 'Confirmed')
        ->whereIn('role_id', $trainer_role_id)
        ->orderBy('first_name','asc')
        ->get();


        /*check record is exist or not*/
        $training_survey_details = TrainingSurvey::where('user_id', $user_id)->first();
        

        if(($training_survey_details === null) or (($training_survey_details['status'] === '0') or ($training_survey_details['status'] === ''))){

            return view('training-survey', compact('member_details','company_names','company_locations','job_opening_types','recruiter_details','department_details','designation_details','trainer_details'));

        } else if($training_survey_details['status'] === '1'){

            return redirect("/training-survey-edit/$user_id");

        } else if($training_survey_details['status'] === '2'){

            ///return redirect('/thank-you')->with('thank_you', 'Alert, you have already submit interview survey form.');

            return view('training-survey-show', compact('training_survey_details','company_names','company_locations','job_opening_types','recruiter_details','department_details','designation_details','trainer_details'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        
        $user_id=$request->user_id;
        
        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            

            $request->validate([
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'member_id' => 'required',
                'designation' => 'required',
                'department' => 'required',
                'email' => 'required',
                'company_name' => 'required',
                'location_name' => 'required',
                'training_first_week_joining' => 'required',
                'training_sessions_went_as_planned' => 'required',
                'training_topics_were_covered_in_detail' => 'required',
                'training_was_effective_helping' => 'required',
                'clearly_understood_all_modules' => 'required',
                'self_study_material_useful' => 'required',
                'is_there_any_topic' => 'required',
                'interesting_part_elaborate' => 'required',
                'any_suggestions_feedback' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'member_id' => 'Member ID is required',
                'designation.required' => 'Designation is required',
                'department.required' => 'Department is required',
                'email.required' => 'Email is required',
                'company_name.required' => 'Company name is required',
                'location_name.required' => 'Location name is required',
                'training_first_week_joining.required' => 'Please rate...',
                'training_sessions_went_as_planned.required' => 'Please rate...',
                'training_topics_were_covered_in_detail.required' => 'Please rate...',
                'training_was_effective_helping.required' => 'Please rate...',
                'clearly_understood_all_modules.required' => 'Please rate...',
                'self_study_material_useful.required' => 'Please rate...',
                'is_there_any_topic.required' => 'Is there any topic that you still need training on.',
                'interesting_part_elaborate.required' => 'Which part of the training was the most interesting? Please elaborate.',
                'any_suggestions_feedback.required' => 'Any suggestion/feedback you would like to give in helping us to improve our training sessions?',
            ]);

            $status='2';
        }

        $input = TrainingSurvey::insert([
            'user_id' => $user_id,
            'member_name' => $request->member_name,
            'member_id' => $request->member_id,
            'designation' => $request->designation,
            'department' => $request->department,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'location_name' => $request->location_name,
            'training_first_week_joining' => (!is_null($request->training_first_week_joining) ? $request->training_first_week_joining : "0"),
            'training_sessions_went_as_planned' => (!is_null($request->training_sessions_went_as_planned) ? $request->training_sessions_went_as_planned : "0"),
            'training_topics_were_covered_in_detail' => (!is_null($request->training_topics_were_covered_in_detail) ? $request->training_topics_were_covered_in_detail : "0"),
            'training_was_effective_helping' => (!is_null($request->training_was_effective_helping) ? $request->training_was_effective_helping : "0"),
            'clearly_understood_all_modules' => (!is_null($request->clearly_understood_all_modules) ? $request->clearly_understood_all_modules : "0"),
            'self_study_material_useful' => (!is_null($request->self_study_material_useful) ? $request->self_study_material_useful : "0"),
            'is_there_any_topic' => (!is_null($request->is_there_any_topic) ? $request->is_there_any_topic : ""),
            'interesting_part_elaborate' => (!is_null($request->interesting_part_elaborate) ? $request->interesting_part_elaborate : ""),
            'any_suggestions_feedback' => (!is_null($request->any_suggestions_feedback) ? $request->any_suggestions_feedback : ""),

            'trainer_1_name' => $request->trainer_1_name,
            'trainer_1_id' => $request->trainer_1_id,
            'expertise_on_subject_matter_1' => (!is_null($request->expertise_on_subject_matter_1) ? $request->expertise_on_subject_matter_1 : "0"),
            'clear_effective_communication_skills_1' => (!is_null($request->clear_effective_communication_skills_1) ? $request->clear_effective_communication_skills_1 : "0"),
            'effective_delivery_content_1' => (!is_null($request->effective_delivery_content_1) ? $request->effective_delivery_content_1 : "0"),
            'timely_response_queries_1' => (!is_null($request->timely_response_queries_1) ? $request->timely_response_queries_1 : "0"),
            'comfortability_sharing_concerns_doubts_1' => (!is_null($request->comfortability_sharing_concerns_doubts_1) ? $request->comfortability_sharing_concerns_doubts_1 : "0"),
            'additional_feedback_trainer_1' => (!is_null($request->additional_feedback_trainer_1) ? $request->additional_feedback_trainer_1 : ""),

            'trainer_2_name' => $request->trainer_2_name,
            'trainer_2_id' => $request->trainer_2_id,
            'expertise_on_subject_matter_2' => (!is_null($request->expertise_on_subject_matter_2) ? $request->expertise_on_subject_matter_2 : "0"),
            'clear_effective_communication_skills_2' => (!is_null($request->clear_effective_communication_skills_2) ? $request->clear_effective_communication_skills_2 : "0"),
            'effective_delivery_content_2' => (!is_null($request->effective_delivery_content_2) ? $request->effective_delivery_content_2 : "0"),
            'timely_response_queries_2' => (!is_null($request->timely_response_queries_2) ? $request->timely_response_queries_2 : "0"),
            'comfortability_sharing_concerns_doubts_2' => (!is_null($request->comfortability_sharing_concerns_doubts_2) ? $request->comfortability_sharing_concerns_doubts_2 : "0"),
            'additional_feedback_trainer_2' => (!is_null($request->additional_feedback_trainer_2) ? $request->additional_feedback_trainer_2 : ""),
            'trainer_3_name' => $request->trainer_3_name,
            'trainer_3_id' => $request->trainer_3_id,
            'expertise_on_subject_matter_3' => (!is_null($request->expertise_on_subject_matter_3) ? $request->expertise_on_subject_matter_3 : "0"),
            'clear_effective_communication_skills_3' => (!is_null($request->clear_effective_communication_skills_3) ? $request->clear_effective_communication_skills_3 : "0"),
            'effective_delivery_content_3' => (!is_null($request->effective_delivery_content_3) ? $request->effective_delivery_content_3 : "0"),
            'timely_response_queries_3' => (!is_null($request->timely_response_queries_3) ? $request->timely_response_queries_3 : "0"),
            'comfortability_sharing_concerns_doubts_3' => (!is_null($request->comfortability_sharing_concerns_doubts_3) ? $request->comfortability_sharing_concerns_doubts_3 : "0"),
            'additional_feedback_trainer_3' => (!is_null($request->additional_feedback_trainer_3) ? $request->additional_feedback_trainer_3 : ""),

            'trainer_4_name' => $request->trainer_4_name,
            'trainer_4_id' => $request->trainer_4_id,
            'expertise_on_subject_matter_4' => (!is_null($request->expertise_on_subject_matter_4) ? $request->expertise_on_subject_matter_4 : "0"),
            'clear_effective_communication_skills_4' => (!is_null($request->clear_effective_communication_skills_4) ? $request->clear_effective_communication_skills_4 : "0"),
            'effective_delivery_content_4' => (!is_null($request->effective_delivery_content_4) ? $request->effective_delivery_content_4 : "0"),
            'timely_response_queries_4' => (!is_null($request->timely_response_queries_4) ? $request->timely_response_queries_4 : "0"),
            'comfortability_sharing_concerns_doubts_4' => (!is_null($request->comfortability_sharing_concerns_doubts_4) ? $request->comfortability_sharing_concerns_doubts_4 : "0"),
            'additional_feedback_trainer_4' => (!is_null($request->additional_feedback_trainer_4) ? $request->additional_feedback_trainer_4 : ""),

            'trainer_5_name' => $request->trainer_5_name,
            'trainer_5_id' => $request->trainer_5_id,
            'expertise_on_subject_matter_5' => (!is_null($request->expertise_on_subject_matter_5) ? $request->expertise_on_subject_matter_5 : "0"),
            'clear_effective_communication_skills_5' => (!is_null($request->clear_effective_communication_skills_5) ? $request->clear_effective_communication_skills_5 : "0"),
            'effective_delivery_content_5' => (!is_null($request->effective_delivery_content_5) ? $request->effective_delivery_content_5 : "0"),
            'timely_response_queries_5' => (!is_null($request->timely_response_queries_5) ? $request->timely_response_queries_5 : "0"),
            'comfortability_sharing_concerns_doubts_5' => (!is_null($request->comfortability_sharing_concerns_doubts_5) ? $request->comfortability_sharing_concerns_doubts_5 : "0"),
            'additional_feedback_trainer_5' => (!is_null($request->additional_feedback_trainer_5) ? $request->additional_feedback_trainer_5 : ""),

            'status' => $status,
        ]);

        if($input){
            
            if($status==1){
                
                return redirect("/training-survey-edit/$user_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                return redirect('/training-survey')->with('thank_you', 'Thanks, for giving your valuable time for us.');

            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $job_opening_types = JobOpeningTypes::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        /*fetch all hr data*/
        $recruiter_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();


        $department_details = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $designation_details = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();
        //dd($company_names);

        /*check record is exist or not*/
        $member_details = User::where('users.id', $user_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->select('users.*', 'company_locations.name as location_name')
        ->first();

        $trainer_role_id=array('1','2','3','4','5','6');
        /*fetch all user as trainer*/
        $trainer_details = User::where('status', '1')
        ->where('is_deleted', '0')
        ->where('employee_type', '=', 'Confirmed')
        ->whereIn('role_id', $trainer_role_id)
        ->orderBy('first_name','asc')
        ->get();



        /*check record is exist or not*/
        $training_survey_details = TrainingSurvey::where('user_id', $user_id)->first();
        
        if($training_survey_details->status==1){
            
            return view('training-survey-edit', compact('company_names','company_locations','job_opening_types','recruiter_details','training_survey_details','department_details','designation_details','trainer_details'));

        } else if($training_survey_details->status==2){


            return redirect('/training-survey');

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
        
        $user_id=$request->user_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            

            $request->validate([
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'member_id' => 'required',
                'designation' => 'required',
                'department' => 'required',
                'email' => 'required',
                'company_name' => 'required',
                'location_name' => 'required',
                'training_first_week_joining' => 'required',
                'training_sessions_went_as_planned' => 'required',
                'training_topics_were_covered_in_detail' => 'required',
                'training_was_effective_helping' => 'required',
                'clearly_understood_all_modules' => 'required',
                'self_study_material_useful' => 'required',
                'is_there_any_topic' => 'required',
                'interesting_part_elaborate' => 'required',
                'any_suggestions_feedback' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'member_id' => 'Member ID is required',
                'designation.required' => 'Designation is required',
                'department.required' => 'Department is required',
                'email.required' => 'Email is required',
                'company_name.required' => 'Company name is required',
                'location_name.required' => 'Location name is required',
                'training_first_week_joining.required' => 'Please rate...',
                'training_sessions_went_as_planned.required' => 'Please rate...',
                'training_topics_were_covered_in_detail.required' => 'Please rate...',
                'training_was_effective_helping.required' => 'Please rate...',
                'clearly_understood_all_modules.required' => 'Please rate...',
                'self_study_material_useful.required' => 'Please rate...',
                'is_there_any_topic.required' => 'Is there any topic that you still need training on.',
                'interesting_part_elaborate.required' => 'Which part of the training was the most interesting? Please elaborate.',
                'any_suggestions_feedback.required' => 'Any suggestion/feedback you would like to give in helping us to improve our training sessions?',
            ]);

            $status='2';
        }


        TrainingSurvey::where('user_id', $user_id)
        ->update([
            'member_name' => $request->member_name,
            'member_id' => $request->member_id,
            'designation' => $request->designation,
            'department' => $request->department,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'location_name' => $request->location_name,
            'training_first_week_joining' => (!is_null($request->training_first_week_joining) ? $request->training_first_week_joining : "0"),
            'training_sessions_went_as_planned' => (!is_null($request->training_sessions_went_as_planned) ? $request->training_sessions_went_as_planned : "0"),
            'training_topics_were_covered_in_detail' => (!is_null($request->training_topics_were_covered_in_detail) ? $request->training_topics_were_covered_in_detail : "0"),
            'training_was_effective_helping' => (!is_null($request->training_was_effective_helping) ? $request->training_was_effective_helping : "0"),
            'clearly_understood_all_modules' => (!is_null($request->clearly_understood_all_modules) ? $request->clearly_understood_all_modules : "0"),
            'self_study_material_useful' => (!is_null($request->self_study_material_useful) ? $request->self_study_material_useful : "0"),
            'is_there_any_topic' => (!is_null($request->is_there_any_topic) ? $request->is_there_any_topic : ""),
            'interesting_part_elaborate' => (!is_null($request->interesting_part_elaborate) ? $request->interesting_part_elaborate : ""),
            'any_suggestions_feedback' => (!is_null($request->any_suggestions_feedback) ? $request->any_suggestions_feedback : ""),

            'trainer_1_name' => $request->trainer_1_name,
            'trainer_1_id' => $request->trainer_1_id,
            'expertise_on_subject_matter_1' => (!is_null($request->expertise_on_subject_matter_1) ? $request->expertise_on_subject_matter_1 : "0"),
            'clear_effective_communication_skills_1' => (!is_null($request->clear_effective_communication_skills_1) ? $request->clear_effective_communication_skills_1 : "0"),
            'effective_delivery_content_1' => (!is_null($request->effective_delivery_content_1) ? $request->effective_delivery_content_1 : "0"),
            'timely_response_queries_1' => (!is_null($request->timely_response_queries_1) ? $request->timely_response_queries_1 : "0"),
            'comfortability_sharing_concerns_doubts_1' => (!is_null($request->comfortability_sharing_concerns_doubts_1) ? $request->comfortability_sharing_concerns_doubts_1 : "0"),
            'additional_feedback_trainer_1' => (!is_null($request->additional_feedback_trainer_1) ? $request->additional_feedback_trainer_1 : ""),

            'trainer_2_name' => $request->trainer_2_name,
            'trainer_2_id' => $request->trainer_2_id,
            'expertise_on_subject_matter_2' => (!is_null($request->expertise_on_subject_matter_2) ? $request->expertise_on_subject_matter_2 : "0"),
            'clear_effective_communication_skills_2' => (!is_null($request->clear_effective_communication_skills_2) ? $request->clear_effective_communication_skills_2 : "0"),
            'effective_delivery_content_2' => (!is_null($request->effective_delivery_content_2) ? $request->effective_delivery_content_2 : "0"),
            'timely_response_queries_2' => (!is_null($request->timely_response_queries_2) ? $request->timely_response_queries_2 : "0"),
            'comfortability_sharing_concerns_doubts_2' => (!is_null($request->comfortability_sharing_concerns_doubts_2) ? $request->comfortability_sharing_concerns_doubts_2 : "0"),
            'additional_feedback_trainer_2' => (!is_null($request->additional_feedback_trainer_2) ? $request->additional_feedback_trainer_2 : ""),
            'trainer_3_name' => $request->trainer_3_name,
            'trainer_3_id' => $request->trainer_3_id,
            'expertise_on_subject_matter_3' => (!is_null($request->expertise_on_subject_matter_3) ? $request->expertise_on_subject_matter_3 : "0"),
            'clear_effective_communication_skills_3' => (!is_null($request->clear_effective_communication_skills_3) ? $request->clear_effective_communication_skills_3 : "0"),
            'effective_delivery_content_3' => (!is_null($request->effective_delivery_content_3) ? $request->effective_delivery_content_3 : "0"),
            'timely_response_queries_3' => (!is_null($request->timely_response_queries_3) ? $request->timely_response_queries_3 : "0"),
            'comfortability_sharing_concerns_doubts_3' => (!is_null($request->comfortability_sharing_concerns_doubts_3) ? $request->comfortability_sharing_concerns_doubts_3 : "0"),
            'additional_feedback_trainer_3' => (!is_null($request->additional_feedback_trainer_3) ? $request->additional_feedback_trainer_3 : ""),

            'trainer_4_name' => $request->trainer_4_name,
            'trainer_4_id' => $request->trainer_4_id,
            'expertise_on_subject_matter_4' => (!is_null($request->expertise_on_subject_matter_4) ? $request->expertise_on_subject_matter_4 : "0"),
            'clear_effective_communication_skills_4' => (!is_null($request->clear_effective_communication_skills_4) ? $request->clear_effective_communication_skills_4 : "0"),
            'effective_delivery_content_4' => (!is_null($request->effective_delivery_content_4) ? $request->effective_delivery_content_4 : "0"),
            'timely_response_queries_4' => (!is_null($request->timely_response_queries_4) ? $request->timely_response_queries_4 : "0"),
            'comfortability_sharing_concerns_doubts_4' => (!is_null($request->comfortability_sharing_concerns_doubts_4) ? $request->comfortability_sharing_concerns_doubts_4 : "0"),
            'additional_feedback_trainer_4' => (!is_null($request->additional_feedback_trainer_4) ? $request->additional_feedback_trainer_4 : ""),

            'trainer_5_name' => $request->trainer_5_name,
            'trainer_5_id' => $request->trainer_5_id,
            'expertise_on_subject_matter_5' => (!is_null($request->expertise_on_subject_matter_5) ? $request->expertise_on_subject_matter_5 : "0"),
            'clear_effective_communication_skills_5' => (!is_null($request->clear_effective_communication_skills_5) ? $request->clear_effective_communication_skills_5 : "0"),
            'effective_delivery_content_5' => (!is_null($request->effective_delivery_content_5) ? $request->effective_delivery_content_5 : "0"),
            'timely_response_queries_5' => (!is_null($request->timely_response_queries_5) ? $request->timely_response_queries_5 : "0"),
            'comfortability_sharing_concerns_doubts_5' => (!is_null($request->comfortability_sharing_concerns_doubts_5) ? $request->comfortability_sharing_concerns_doubts_5 : "0"),
            'additional_feedback_trainer_5' => (!is_null($request->additional_feedback_trainer_5) ? $request->additional_feedback_trainer_5 : ""),

            'status' => $status,
        ]);


        if($status=='1'){

            return back()->with('thank_you', 'Your form save in draft');

        } else if($status=='2'){
            
            return redirect('/training-survey')->with('thank_you', 'Thanks, for giving your valuable time for us.');
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



    public function getTrainerAjax(Request $request){

        //$data='Ajax start here';

        $data=$request->all_ids;
        $data=explode(',',$data);

        //DB::enableQueryLog(); //for print sql query

        /*fetch all user as trainer*/
        $trainer_details = User::where('status', '1')
        ->where('is_deleted', '0')
        ->where('employee_type', '=', 'Confirmed')
        ->whereIn('id', $data)
        ->orderBy('first_name','asc')
        ->get();

        /*for print sql query, start here */
        //$quries = DB::getQueryLog();
        //dd($quries);

        $returnHTML = view('trainer-list-ajax', compact('trainer_details'))->render();

        return response()->json($returnHTML);
        //return "ajax";
    }


}
