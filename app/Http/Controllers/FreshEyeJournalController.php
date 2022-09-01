<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\FreshEyeJournal;
use App\Models\CompanyName;
use App\Models\CompanyLocation;
use App\Models\Designation;
use App\Models\Department;
use App\Models\PlaceYourselfCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Auth;

class FreshEyeJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $user_details = User::where('id', $user_id)
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


        $department_details = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $designation_details = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $manager_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '2')
            ->orWhere('role_id', '3')
            ->orWhere('role_id', '4')
            ->orderBy('first_name','asc')
            ->get();

        $hod_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '4')
            ->orderBy('first_name','asc')
            ->get();


        return view('fresh-eye-journal-form', compact('total_tenure','designation_details','department_details','company_names','company_locations','manager_details','hod_details'));

        /*check record is exist or not*/
        /*$fresh_eye_journal_details = FreshEyeJournal::where('user_id', $user_id)->first();
        

        if(($fresh_eye_journal_details === null) or (($fresh_eye_journal_details['status'] === '0') or ($fresh_eye_journal_details['status'] === ''))){

            return view('fresh-eye-journal-form', compact('total_tenure','designation_details','department_details','company_names','company_locations','manager_details','hod_details'));

        } else if($fresh_eye_journal_details['status'] === '1'){

            return redirect("/fresh-eye-journal-form-edit/$user_id");

        } else if($fresh_eye_journal_details['status'] === '2'){

            return view('fresh-eye-journal-form-show', compact('company_names','company_locations','manager_details','hod_details','fresh_eye_journal_details'));
        }*/
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
        $user_id=$request->user_id;

        $request->validate([
            'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
            'member_id' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'email' => 'required',
            'company_name_fresh' => 'required',
            'location_name' => 'required',
            'tenure_in_month' => 'required',
            'reporting_manager_fresh' => 'required',
            'head_of_department' => 'required',
            'your_journey_so_far_in_company' => 'required',
            'top_3_things_like_your_job_1' => 'required',
            'top_3_things_like_your_job_2' => 'required',
            'top_3_things_like_your_job_3' => 'required',
            'three_things_wish_change_job_role_1' => 'required',
            'three_things_wish_change_job_role_2' => 'required',
            'three_things_wish_change_job_role_3' => 'required',
            'satisfaction_job_role' => 'required',
            'well_equipped_perform_job' => 'required',
            'able_maintain_work_life_balance' => 'required',
            'feel_respected_my_peers' => 'required',
            'suggestions_heard_implemented' => 'required',
            'share_good_bond_superiors' => 'required',
            'know_what_i_expected_to_do' => 'required',
            'i_feel_grow_in_organization' => 'required',
            'any_exemplary_work_achievement_showcase' => 'required',
            'any_additional_trainings' => 'required',
            'what_do_you_like_about_company' => 'required',
            'what_do_you_dislike_about_company' => 'required',
            'satisfied_employee_benefits_offered_company' => 'required',
            'work_culture' => 'required',
            'recruitment_process' => 'required',
            'induction_process' => 'required',
            'on_job_training_process' => 'required',
            'clear_communication_changes_policy' => 'required',
            'feeling_belongingness_organization' => 'required',
            'having_best_friend_at_work' => 'required',
            'work_life_balance' => 'required',
            'any_detailed_feedback_support_your_response' => 'required',
            'quickness_in_respond_reporting_manager' => 'required',
            'how_well_received_guidance_reporting_manager' => 'required',
            'how_clearly_your_goals_set_reporting_manager' => 'required',
            'how_transparent_is_reporting_manager' => 'required',
            'wprs_happen_every_week_reporting_manager' => 'required',
            'how_well_adjust_changing_priorities_reporting_manager' => 'required',
            'how_comfortable_feel_sharing_feedback_reporting_manager' => 'required',
            'how_well_able_learn_under_guidance_reporting_manager' => 'required',
            'any_additional_feedback_any_department' => 'required',
            'any_issue_concern_management' => 'required',
        ], [
            'member_name.required' => 'Name is required',
            'member_id' => 'Member ID is required',
            'designation.required' => 'Designation is required',
            'department.required' => 'Department is required',
            'email.required' => 'Email is required',
            'company_name_fresh.required' => 'Company name is required',
            'location_name.required' => 'Location name is required',
            'tenure_in_month.required' => 'Tenure in month is required',
            'reporting_manager_fresh.required' => 'Reporting manager name is required',
            'head_of_department.required' => 'Head of department name is required',
            'your_journey_so_far_in_company.required' => 'How has your journey been so far is required',
            'top_3_things_like_your_job_1.required' => 'Required',
            'top_3_things_like_your_job_2.required' => 'Required',
            'top_3_things_like_your_job_3.required' => 'Required',
            'three_things_wish_change_job_role_1.required' => 'Required',
            'three_things_wish_change_job_role_2.required' => 'Required',
            'three_things_wish_change_job_role_3.required' => 'Required',
            'satisfaction_job_role.required' => 'Please rate...',
            'well_equipped_perform_job.required' => 'Please rate...',
            'able_maintain_work_life_balance.required' => 'Please rate...',
            'feel_respected_my_peers.required' => 'Please rate...',
            'suggestions_heard_implemented.required' => 'Please rate...',
            'share_good_bond_superiors.required' => 'Please rate...',
            'know_what_i_expected_to_do.required' => 'Please rate...',
            'i_feel_grow_in_organization.required' => 'Please rate...',
            'any_exemplary_work_achievement_showcase.required' => 'Required',
            'any_additional_trainings.required' => 'Required',
            'what_do_you_like_about_company.required' => 'Required',
            'what_do_you_dislike_about_company.required' => 'Required',
            'satisfied_employee_benefits_offered_company.required' => 'Required',
            'work_culture.required' => 'Please rate...',
            'recruitment_process.required' => 'Please rate...',
            'induction_process.required' => 'Please rate...',
            'on_job_training_process.required' => 'Please rate...',
            'clear_communication_changes_policy.required' => 'Please rate...',
            'feeling_belongingness_organization.required' => 'Please rate...',
            'having_best_friend_at_work.required' => 'Please rate...',
            'work_life_balance.required' => 'Please rate...',
            'any_detailed_feedback_support_your_response.required' => 'Required',
            'quickness_in_respond_reporting_manager.required' => 'Please rate...',
            'how_well_received_guidance_reporting_manager.required' => 'Please rate...',
            'how_clearly_your_goals_set_reporting_manager.required' => 'Please rate...',
            'how_transparent_is_reporting_manager.required' => 'Please rate...',
            'wprs_happen_every_week_reporting_manager.required' => 'Please rate...',
            'how_well_adjust_changing_priorities_reporting_manager.required' => 'Please rate...',
            'how_comfortable_feel_sharing_feedback_reporting_manager.required' => 'Please rate...',
            'how_well_able_learn_under_guidance_reporting_manager.required' => 'Please rate...',
            'any_additional_feedback_any_department.required' => 'Any additional feedback for any department that you would like to share?',
            'any_issue_concern_management.required' => 'Any issue or concern that you would like to talk to management about?',
        ]);


        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
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
            'training_first_week_joining' => $request->training_first_week_joining,
            'training_sessions_went_as_planned' => $request->training_sessions_went_as_planned,
            'training_topics_were_covered_in_detail' => $request->training_topics_were_covered_in_detail,
            'training_was_effective_helping' => $request->training_was_effective_helping,
            'clearly_understood_all_modules' => $request->clearly_understood_all_modules,
            'self_study_material_useful' => $request->self_study_material_useful,
            'is_there_any_topic' => $request->is_there_any_topic,
            'interesting_part_elaborate' => $request->interesting_part_elaborate,
            'any_suggestions_feedback' => $request->any_suggestions_feedback,

            'trainer_1_name' => $request->trainer_1_name,
            'trainer_1_id' => $request->trainer_1_id,
            'expertise_on_subject_matter_1' => $expertise_on_subject_matter_1,
            'clear_effective_communication_skills_1' => $clear_effective_communication_skills_1,
            'effective_delivery_content_1' => $effective_delivery_content_1,
            'timely_response_queries_1' => $timely_response_queries_1,
            'comfortability_sharing_concerns_doubts_1' => $comfortability_sharing_concerns_doubts_1,
            'additional_feedback_trainer_1' => $additional_feedback_trainer_1,

            'trainer_2_name' => $request->trainer_2_name,
            'trainer_2_id' => $request->trainer_2_id,
            'expertise_on_subject_matter_2' => $expertise_on_subject_matter_2,
            'clear_effective_communication_skills_2' => $clear_effective_communication_skills_2,
            'effective_delivery_content_2' => $effective_delivery_content_2,
            'timely_response_queries_2' => $timely_response_queries_2,
            'comfortability_sharing_concerns_doubts_2' => $comfortability_sharing_concerns_doubts_2,
            'additional_feedback_trainer_2' => $additional_feedback_trainer_2,

            'trainer_3_name' => $request->trainer_3_name,
            'trainer_3_id' => $request->trainer_3_id,
            'expertise_on_subject_matter_3' => $expertise_on_subject_matter_3,
            'clear_effective_communication_skills_3' => $clear_effective_communication_skills_3,
            'effective_delivery_content_3' => $effective_delivery_content_3,
            'timely_response_queries_3' => $timely_response_queries_3,
            'comfortability_sharing_concerns_doubts_3' => $comfortability_sharing_concerns_doubts_3,
            'additional_feedback_trainer_3' => $additional_feedback_trainer_3,

            'trainer_4_name' => $request->trainer_4_name,
            'trainer_4_id' => $request->trainer_4_id,
            'expertise_on_subject_matter_4' => $expertise_on_subject_matter_4,
            'clear_effective_communication_skills_4' => $clear_effective_communication_skills_4,
            'effective_delivery_content_4' => $effective_delivery_content_4,
            'timely_response_queries_4' => $timely_response_queries_4,
            'comfortability_sharing_concerns_doubts_4' => $comfortability_sharing_concerns_doubts_4,
            'additional_feedback_trainer_4' => $additional_feedback_trainer_4,

            'trainer_5_name' => $request->trainer_5_name,
            'trainer_5_id' => $request->trainer_5_id,
            'expertise_on_subject_matter_5' => $expertise_on_subject_matter_5,
            'clear_effective_communication_skills_5' => $clear_effective_communication_skills_5,
            'effective_delivery_content_5' => $effective_delivery_content_5,
            'timely_response_queries_5' => $timely_response_queries_5,
            'comfortability_sharing_concerns_doubts_5' => $comfortability_sharing_concerns_doubts_5,
            'additional_feedback_trainer_5' => $additional_feedback_trainer_5,

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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



    public function getCompanyNameAjax(Request $request){

        $company_name_id=$request->company_name_id;

        /*fetch all user as trainer*/
        $company_details = CompanyName::where('id', $company_name_id)
        ->first();

        $company_name=$company_details['name'];

        return response()->json($company_name);

    }


    public function getHODNameAjax(Request $request){

        $hod_id=$request->hod_id;

        /*fetch all user as trainer*/
        $hod_details = User::where('id', $hod_id)
        ->first();

        $hod_name=$hod_details['first_name'].' '.$hod_details['last_name'];

        return response()->json($hod_name);

    }


}
