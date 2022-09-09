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

        $reporting_manager_name_ajax_default = Auth::user()->manager_name;

        $company_id_ajax_default = Auth::user()->company_id;
        $company_name_ajax_default = CompanyName::where('id', $company_id_ajax_default)->first();


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

        /*check record is exist or not*/
        $fresh_eye_journal_details = FreshEyeJournal::where('fresh_eye_journals.user_id', $user_id)->first();
        

        if(($fresh_eye_journal_details === null) or (($fresh_eye_journal_details['status'] === '0') or ($fresh_eye_journal_details['status'] === ''))){

            return view('fresh-eye-journal-form', compact('total_tenure','designation_details','department_details','company_names','company_locations','manager_details','hod_details','reporting_manager_name_ajax_default','company_name_ajax_default'));

        } else if($fresh_eye_journal_details['status'] === '1'){

            return redirect("/fresh-eye-journal-form-edit/$user_id");

        } else if($fresh_eye_journal_details['status'] === '2'){

            return view('fresh-eye-journal-form-show', compact('fresh_eye_journal_details','designation_details','department_details','company_names','company_locations'));
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
        $user_id=$request->user_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            
            $request->validate([
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'member_id' => 'required',
                'designation' => 'required',
                'department' => 'required',
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
                'our_organization_believes_mantra' => 'required',
                'quickness_in_respond_reporting_manager_qi' => 'required',
                'how_well_received_guidance_reporting_manager_qi' => 'required',
                'how_clearly_your_goals_set_reporting_manager_qi' => 'required',
                'how_transparent_is_reporting_manager_qi' => 'required',
                'frequent_1_1_happen_reporting_manager_qi' => 'required',
                'how_well_adjust_changing_priorities_reporting_manager_qi' => 'required',
                'how_comfortable_feel_sharing_feedback_reporting_manager_qi' => 'required',
                'top_3_strengths_reporting_manager_qi_1' => 'required',
                'top_3_strengths_reporting_manager_qi_2' => 'required',
                'top_3_strengths_reporting_manager_qi_3' => 'required',
                'three_areas_improvement_reporting_manager_qi_1' => 'required',
                'three_areas_improvement_reporting_manager_qi_2' => 'required',
                'three_areas_improvement_reporting_manager_qi_3' => 'required',
                'our_organization_believes_mantra_reporting_manager_qi' => 'required',
                'quickness_in_respond_hod_qj' => 'required',
                'how_well_received_guidance_hod_qj' => 'required',
                'how_clearly_your_goals_set_hod_qj' => 'required',
                'how_transparent_is_hod_qj' => 'required',
                'frequent_1_1_happen_hod_qj' => 'required',
                'how_well_adjust_changing_priorities_hod_qj' => 'required',
                'how_comfortable_feel_sharing_feedback_hod_qj' => 'required',
                'top_3_strengths_hod_qj_1' => 'required',
                'top_3_strengths_hod_qj_2' => 'required',
                'top_3_strengths_hod_qj_3' => 'required',
                'three_areas_improvement_hod_qj_1' => 'required',
                'three_areas_improvement_hod_qj_2' => 'required',
                'three_areas_improvement_hod_qj_3' => 'required',
                'our_organization_believes_mantra_hod_qj' => 'required',
                'admin_operations' => 'required',
                'human_resources' => 'required',
                'management' => 'required',
                'any_additional_feedback_any_department' => 'required',
                'any_issue_concern_management' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'member_id' => 'Member ID is required',
                'designation.required' => 'Designation is required',
                'department.required' => 'Department is required',
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
                'our_organization_believes_mantra' => 'Required',
                'quickness_in_respond_reporting_manager_qi.required' => 'Please rate...',
                'how_well_received_guidance_reporting_manager_qi.required' => 'Please rate...',
                'how_clearly_your_goals_set_reporting_manager_qi.required' => 'Please rate...',
                'how_transparent_is_reporting_manager_qi.required' => 'Please rate...',
                'frequent_1_1_happen_reporting_manager_qi.required' => 'Please rate...',
                'how_well_adjust_changing_priorities_reporting_manager_qi.required' => 'Please rate...',
                'how_comfortable_feel_sharing_feedback_reporting_manager_qi.required' => 'Please rate...',
                'top_3_strengths_reporting_manager_qi_1.required' => 'Required',
                'top_3_strengths_reporting_manager_qi_2.required' => 'Required',
                'top_3_strengths_reporting_manager_qi_3.required' => 'Required',
                'three_areas_improvement_reporting_manager_qi_1.required' => 'Required',
                'three_areas_improvement_reporting_manager_qi_2.required' => 'Required',
                'three_areas_improvement_reporting_manager_qi_3.required' => 'Required',
                'our_organization_believes_mantra_reporting_manager_qi.required' => 'Required',
                'quickness_in_respond_hod_qj.required' => 'Please rate...',
                'how_well_received_guidance_hod_qj.required' => 'Please rate...',
                'how_clearly_your_goals_set_hod_qj.required' => 'Please rate...',
                'how_transparent_is_hod_qj.required' => 'Please rate...',
                'frequent_1_1_happen_hod_qj.required' => 'Please rate...',
                'how_well_adjust_changing_priorities_hod_qj.required' => 'Please rate...',
                'how_comfortable_feel_sharing_feedback_hod_qj.required' => 'Please rate...',
                'top_3_strengths_hod_qj_1.required' => 'Required',
                'top_3_strengths_hod_qj_2.required' => 'Required',
                'top_3_strengths_hod_qj_3.required' => 'Required',
                'three_areas_improvement_hod_qj_1.required' => 'Required',
                'three_areas_improvement_hod_qj_2.required' => 'Required',
                'three_areas_improvement_hod_qj_3.required' => 'Required',
                'our_organization_believes_mantra_hod_qj.required' => 'Required',
                'admin_operations.required' => 'Please rate...',
                'human_resources.required' => 'Please rate...',
                'management.required' => 'Please rate...',
                'frequent_1_1_happen_hod_qj.required' => 'Please rate...',
                'any_additional_feedback_any_department.required' => 'Any additional feedback for any department that you would like to share?',
                'any_issue_concern_management.required' => 'Any issue or concern that you would like to talk to management about?',
            ]);

            $status='2';
        }

        $input = FreshEyeJournal::insert([
            'user_id' => $user_id,
            'member_name' => $request->member_name,
            'member_id' => $request->member_id,
            'designation' => $request->designation,
            'department' => $request->department,
            'company_name_ajax' => $request->company_name_ajax,
            'company_name_fresh' => $request->company_name_fresh,
            'location_name' => $request->location_name,
            'tenure_in_month' => $request->tenure_in_month,
            'reporting_manager_name_ajax' => $request->reporting_manager_name_ajax,
            'reporting_manager_fresh' => $request->reporting_manager_fresh,
            'head_of_department_name_ajax' => $request->head_of_department_name_ajax,
            'head_of_department' => $request->head_of_department,
            'your_journey_so_far_in_company' => $request->your_journey_so_far_in_company,
            'top_3_things_like_your_job_1' => $request->top_3_things_like_your_job_1,
            'top_3_things_like_your_job_2' => $request->top_3_things_like_your_job_2,
            'top_3_things_like_your_job_3' => $request->top_3_things_like_your_job_3,
            'three_things_wish_change_job_role_1' => $request->three_things_wish_change_job_role_1,
            'three_things_wish_change_job_role_2' => $request->three_things_wish_change_job_role_2,
            'three_things_wish_change_job_role_3' => $request->three_things_wish_change_job_role_3,
            'satisfaction_job_role' => (!is_null($request->satisfaction_job_role) ? $request->satisfaction_job_role : ""),
            'well_equipped_perform_job' => (!is_null($request->well_equipped_perform_job) ? $request->well_equipped_perform_job : ""),
            'able_maintain_work_life_balance' => (!is_null($request->able_maintain_work_life_balance) ? $request->able_maintain_work_life_balance : ""),
            'feel_respected_my_peers' => (!is_null($request->feel_respected_my_peers) ? $request->feel_respected_my_peers : ""),
            'suggestions_heard_implemented' => (!is_null($request->suggestions_heard_implemented) ? $request->suggestions_heard_implemented : ""),
            'share_good_bond_superiors' => (!is_null($request->share_good_bond_superiors) ? $request->share_good_bond_superiors : ""),
            'know_what_i_expected_to_do' => (!is_null($request->know_what_i_expected_to_do) ? $request->know_what_i_expected_to_do : ""),
            'i_feel_grow_in_organization' => (!is_null($request->i_feel_grow_in_organization) ? $request->i_feel_grow_in_organization : ""),
            'any_exemplary_work_achievement_showcase' => $request->any_exemplary_work_achievement_showcase,
            'any_additional_trainings' => $request->any_additional_trainings,
            'what_do_you_like_about_company' => $request->what_do_you_like_about_company,
            'what_do_you_dislike_about_company' => $request->what_do_you_dislike_about_company,
            'satisfied_employee_benefits_offered_company' => $request->satisfied_employee_benefits_offered_company,
            'work_culture' => (!is_null($request->work_culture) ? $request->work_culture : ""),
            'recruitment_process' => (!is_null($request->recruitment_process) ? $request->recruitment_process : ""),
            'induction_process' => (!is_null($request->induction_process) ? $request->induction_process : ""),
            'on_job_training_process' => (!is_null($request->on_job_training_process) ? $request->on_job_training_process : ""),
            'clear_communication_changes_policy' => (!is_null($request->clear_communication_changes_policy) ? $request->clear_communication_changes_policy : ""),
            'feeling_belongingness_organization' => (!is_null($request->feeling_belongingness_organization) ? $request->feeling_belongingness_organization : ""),
            'having_best_friend_at_work' => (!is_null($request->having_best_friend_at_work) ? $request->having_best_friend_at_work : ""),
            'work_life_balance' => (!is_null($request->work_life_balance) ? $request->work_life_balance : ""),
            'any_detailed_feedback_support_your_response' => $request->any_detailed_feedback_support_your_response,
            'quickness_in_respond_reporting_manager' => (!is_null($request->quickness_in_respond_reporting_manager) ? $request->quickness_in_respond_reporting_manager : ""),
            'how_well_received_guidance_reporting_manager' => (!is_null($request->how_well_received_guidance_reporting_manager) ? $request->how_well_received_guidance_reporting_manager : ""),
            'how_clearly_your_goals_set_reporting_manager' => (!is_null($request->how_clearly_your_goals_set_reporting_manager) ? $request->how_clearly_your_goals_set_reporting_manager : ""),
            'how_transparent_is_reporting_manager' => (!is_null($request->how_transparent_is_reporting_manager) ? $request->how_transparent_is_reporting_manager : ""),
            'wprs_happen_every_week_reporting_manager' => (!is_null($request->wprs_happen_every_week_reporting_manager) ? $request->wprs_happen_every_week_reporting_manager : ""),
            'how_well_adjust_changing_priorities_reporting_manager' => (!is_null($request->how_well_adjust_changing_priorities_reporting_manager) ? $request->how_well_adjust_changing_priorities_reporting_manager : ""),
            'how_comfortable_feel_sharing_feedback_reporting_manager' => (!is_null($request->how_comfortable_feel_sharing_feedback_reporting_manager) ? $request->how_comfortable_feel_sharing_feedback_reporting_manager : ""),
            'how_well_able_learn_under_guidance_reporting_manager' => (!is_null($request->how_well_able_learn_under_guidance_reporting_manager) ? $request->how_well_able_learn_under_guidance_reporting_manager : ""),
            'our_organization_believes_mantra' => $request->our_organization_believes_mantra,
            'quickness_in_respond_reporting_manager_qi' => (!is_null($request->quickness_in_respond_reporting_manager_qi) ? $request->quickness_in_respond_reporting_manager_qi : ""),
            'how_well_received_guidance_reporting_manager_qi' => (!is_null($request->how_well_received_guidance_reporting_manager_qi) ? $request->how_well_received_guidance_reporting_manager_qi : ""),
            'how_clearly_your_goals_set_reporting_manager_qi' => (!is_null($request->how_clearly_your_goals_set_reporting_manager_qi) ? $request->how_clearly_your_goals_set_reporting_manager_qi : ""),
            'how_transparent_is_reporting_manager_qi' => (!is_null($request->how_transparent_is_reporting_manager_qi) ? $request->how_transparent_is_reporting_manager_qi : ""),
            'frequent_1_1_happen_reporting_manager_qi' => (!is_null($request->frequent_1_1_happen_reporting_manager_qi) ? $request->frequent_1_1_happen_reporting_manager_qi : ""),
            'how_well_adjust_changing_priorities_reporting_manager_qi' => (!is_null($request->how_well_adjust_changing_priorities_reporting_manager_qi) ? $request->how_well_adjust_changing_priorities_reporting_manager_qi : ""),

            'how_comfortable_feel_sharing_feedback_reporting_manager_qi' => (!is_null($request->how_comfortable_feel_sharing_feedback_reporting_manager_qi) ? $request->how_comfortable_feel_sharing_feedback_reporting_manager_qi : ""),
            'top_3_strengths_reporting_manager_qi_1' => $request->top_3_strengths_reporting_manager_qi_1,
            'top_3_strengths_reporting_manager_qi_2' => $request->top_3_strengths_reporting_manager_qi_2,
            'top_3_strengths_reporting_manager_qi_3' => $request->top_3_strengths_reporting_manager_qi_3,
            'three_areas_improvement_reporting_manager_qi_1' => $request->three_areas_improvement_reporting_manager_qi_1,
            'three_areas_improvement_reporting_manager_qi_2' => $request->three_areas_improvement_reporting_manager_qi_2,
            'three_areas_improvement_reporting_manager_qi_3' => $request->three_areas_improvement_reporting_manager_qi_3,
            'our_organization_believes_mantra_reporting_manager_qi' => $request->our_organization_believes_mantra_reporting_manager_qi,
            'quickness_in_respond_hod_qj' => (!is_null($request->quickness_in_respond_hod_qj) ? $request->quickness_in_respond_hod_qj : ""),
            'how_well_received_guidance_hod_qj' => (!is_null($request->how_well_received_guidance_hod_qj) ? $request->how_well_received_guidance_hod_qj : ""),
            'how_clearly_your_goals_set_hod_qj' => (!is_null($request->how_clearly_your_goals_set_hod_qj) ? $request->how_clearly_your_goals_set_hod_qj : ""),
            'how_transparent_is_hod_qj' => (!is_null($request->how_transparent_is_hod_qj) ? $request->how_transparent_is_hod_qj : ""),
            'frequent_1_1_happen_hod_qj' => (!is_null($request->frequent_1_1_happen_hod_qj) ? $request->frequent_1_1_happen_hod_qj : ""),
            'how_well_adjust_changing_priorities_hod_qj' => (!is_null($request->how_well_adjust_changing_priorities_hod_qj) ? $request->how_well_adjust_changing_priorities_hod_qj : ""),
            'how_comfortable_feel_sharing_feedback_hod_qj' => (!is_null($request->how_comfortable_feel_sharing_feedback_hod_qj) ? $request->how_comfortable_feel_sharing_feedback_hod_qj : ""),
            'top_3_strengths_hod_qj_1' => $request->top_3_strengths_hod_qj_1,
            'top_3_strengths_hod_qj_2' => $request->top_3_strengths_hod_qj_2,
            'top_3_strengths_hod_qj_3' => $request->top_3_strengths_hod_qj_3,
            'three_areas_improvement_hod_qj_1' => $request->three_areas_improvement_hod_qj_1,
            'three_areas_improvement_hod_qj_2' => $request->three_areas_improvement_hod_qj_2,
            'three_areas_improvement_hod_qj_3' => $request->three_areas_improvement_hod_qj_3,
            'our_organization_believes_mantra_hod_qj' => $request->our_organization_believes_mantra_hod_qj,
            'admin_operations' => (!is_null($request->admin_operations) ? $request->admin_operations : ""),
            'advertiser_sales' => (!is_null($request->advertiser_sales) ? $request->advertiser_sales : ""),
            'advertisers' => (!is_null($request->advertisers) ? $request->advertisers : ""),
            'finance_accounts' => (!is_null($request->finance_accounts) ? $request->finance_accounts : ""),
            'human_resources' => (!is_null($request->human_resources) ? $request->human_resources : ""),
            'management' => (!is_null($request->management) ? $request->management : ""),
            'network_operations' => (!is_null($request->network_operations) ? $request->network_operations : ""),
            'pocket_money' => (!is_null($request->pocket_money) ? $request->pocket_money : ""),
            'publishers' => (!is_null($request->publishers) ? $request->publishers : ""),
            'tech_operations_development' => (!is_null($request->tech_operations_development) ? $request->tech_operations_development : ""),
            'support_ea_pa' => (!is_null($request->support_ea_pa) ? $request->support_ea_pa : ""),
            'education' => (!is_null($request->education) ? $request->education : ""),
            'igaming' => (!is_null($request->igaming) ? $request->igaming : ""),
            'tech_operations_shopify' => (!is_null($request->tech_operations_shopify) ? $request->tech_operations_shopify : ""),
            'tech_operations_creative' => (!is_null($request->tech_operations_creative) ? $request->tech_operations_creative : ""),
            'mobile' => (!is_null($request->mobile) ? $request->mobile : ""),
            'vcommission_uk' => (!is_null($request->vcommission_uk) ? $request->vcommission_uk : ""),
            'any_additional_feedback_any_department' => $request->any_additional_feedback_any_department,
            'any_issue_concern_management' => $request->any_issue_concern_management,
            'status' => $status,
        ]);


        if($input){
            
            if($status==1){
                
                return redirect("/fresh-eye-journal-form-edit/$user_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                return redirect('/fresh-eye-journal-form')->with('thank_you', 'Thanks, for giving your valuable time for us.');

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
        $user_id = $id;

        $reporting_manager_name_ajax_default = Auth::user()->manager_name;

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


        /*check record is exist or not*/
        $fresh_eye_journal_details = FreshEyeJournal::where('user_id', $user_id)->first();

        if($fresh_eye_journal_details) {

            if($fresh_eye_journal_details->head_of_department){
                $hod_id_ajax_default = $fresh_eye_journal_details->head_of_department;
                $head_of_department_name_ajax_default = User::where('id', $hod_id_ajax_default)->first();
                $head_of_department_name_ajax_default=$head_of_department_name_ajax_default['first_name'].' '.$head_of_department_name_ajax_default['last_name'];
            } else {
                $head_of_department_name_ajax_default='';
            } 
        }
        
        

        if($fresh_eye_journal_details['status']==1){
            
            return view('fresh-eye-journal-form-edit', compact('designation_details','department_details','company_names','company_locations','manager_details','hod_details','fresh_eye_journal_details','reporting_manager_name_ajax_default','head_of_department_name_ajax_default'));

        } else if($fresh_eye_journal_details['status']==2){


            return redirect('/fresh-eye-journal-form');

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
        $edit_id=$request->edit_id;
        $user_id=$request->user_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
           
            $request->validate([
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'member_id' => 'required',
                'designation' => 'required',
                'department' => 'required',
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
                'our_organization_believes_mantra' => 'required',
                'quickness_in_respond_reporting_manager_qi' => 'required',
                'how_well_received_guidance_reporting_manager_qi' => 'required',
                'how_clearly_your_goals_set_reporting_manager_qi' => 'required',
                'how_transparent_is_reporting_manager_qi' => 'required',
                'frequent_1_1_happen_reporting_manager_qi' => 'required',
                'how_well_adjust_changing_priorities_reporting_manager_qi' => 'required',
                'how_comfortable_feel_sharing_feedback_reporting_manager_qi' => 'required',
                'top_3_strengths_reporting_manager_qi_1' => 'required',
                'top_3_strengths_reporting_manager_qi_2' => 'required',
                'top_3_strengths_reporting_manager_qi_3' => 'required',
                'three_areas_improvement_reporting_manager_qi_1' => 'required',
                'three_areas_improvement_reporting_manager_qi_2' => 'required',
                'three_areas_improvement_reporting_manager_qi_3' => 'required',
                'our_organization_believes_mantra_reporting_manager_qi' => 'required',
                'quickness_in_respond_hod_qj' => 'required',
                'how_well_received_guidance_hod_qj' => 'required',
                'how_clearly_your_goals_set_hod_qj' => 'required',
                'how_transparent_is_hod_qj' => 'required',
                'frequent_1_1_happen_hod_qj' => 'required',
                'how_well_adjust_changing_priorities_hod_qj' => 'required',
                'how_comfortable_feel_sharing_feedback_hod_qj' => 'required',
                'top_3_strengths_hod_qj_1' => 'required',
                'top_3_strengths_hod_qj_2' => 'required',
                'top_3_strengths_hod_qj_3' => 'required',
                'three_areas_improvement_hod_qj_1' => 'required',
                'three_areas_improvement_hod_qj_2' => 'required',
                'three_areas_improvement_hod_qj_3' => 'required',
                'our_organization_believes_mantra_hod_qj' => 'required',
                'admin_operations' => 'required',
                'human_resources' => 'required',
                'management' => 'required',
                'any_additional_feedback_any_department' => 'required',
                'any_issue_concern_management' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'member_id' => 'Member ID is required',
                'designation.required' => 'Designation is required',
                'department.required' => 'Department is required',
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
                'our_organization_believes_mantra' => 'Required',
                'quickness_in_respond_reporting_manager_qi.required' => 'Please rate...',
                'how_well_received_guidance_reporting_manager_qi.required' => 'Please rate...',
                'how_clearly_your_goals_set_reporting_manager_qi.required' => 'Please rate...',
                'how_transparent_is_reporting_manager_qi.required' => 'Please rate...',
                'frequent_1_1_happen_reporting_manager_qi.required' => 'Please rate...',
                'how_well_adjust_changing_priorities_reporting_manager_qi.required' => 'Please rate...',
                'how_comfortable_feel_sharing_feedback_reporting_manager_qi.required' => 'Please rate...',
                'top_3_strengths_reporting_manager_qi_1.required' => 'Required',
                'top_3_strengths_reporting_manager_qi_2.required' => 'Required',
                'top_3_strengths_reporting_manager_qi_3.required' => 'Required',
                'three_areas_improvement_reporting_manager_qi_1.required' => 'Required',
                'three_areas_improvement_reporting_manager_qi_2.required' => 'Required',
                'three_areas_improvement_reporting_manager_qi_3.required' => 'Required',
                'our_organization_believes_mantra_reporting_manager_qi.required' => 'Required',
                'quickness_in_respond_hod_qj.required' => 'Please rate...',
                'how_well_received_guidance_hod_qj.required' => 'Please rate...',
                'how_clearly_your_goals_set_hod_qj.required' => 'Please rate...',
                'how_transparent_is_hod_qj.required' => 'Please rate...',
                'frequent_1_1_happen_hod_qj.required' => 'Please rate...',
                'how_well_adjust_changing_priorities_hod_qj.required' => 'Please rate...',
                'how_comfortable_feel_sharing_feedback_hod_qj.required' => 'Please rate...',
                'top_3_strengths_hod_qj_1.required' => 'Required',
                'top_3_strengths_hod_qj_2.required' => 'Required',
                'top_3_strengths_hod_qj_3.required' => 'Required',
                'three_areas_improvement_hod_qj_1.required' => 'Required',
                'three_areas_improvement_hod_qj_2.required' => 'Required',
                'three_areas_improvement_hod_qj_3.required' => 'Required',
                'our_organization_believes_mantra_hod_qj.required' => 'Required',
                'admin_operations.required' => 'Please rate...',
                'human_resources.required' => 'Please rate...',
                'management.required' => 'Please rate...',
                'frequent_1_1_happen_hod_qj.required' => 'Please rate...',
                'any_additional_feedback_any_department.required' => 'Any additional feedback for any department that you would like to share?',
                'any_issue_concern_management.required' => 'Any issue or concern that you would like to talk to management about?',
            ]);
            
             $status='2';
        }

        
        FreshEyeJournal::where('user_id', $user_id)
        ->update([
            'member_name' => $request->member_name,
            'member_id' => $request->member_id,
            'designation' => $request->designation,
            'department' => $request->department,
            'company_name_ajax' => $request->company_name_ajax,
            'company_name_fresh' => $request->company_name_fresh,
            'location_name' => $request->location_name,
            'tenure_in_month' => $request->tenure_in_month,
            'reporting_manager_name_ajax' => $request->reporting_manager_name_ajax,
            'reporting_manager_fresh' => $request->reporting_manager_fresh,
            'head_of_department_name_ajax' => $request->head_of_department_name_ajax,
            'head_of_department' => $request->head_of_department,
            'your_journey_so_far_in_company' => $request->your_journey_so_far_in_company,
            'top_3_things_like_your_job_1' => $request->top_3_things_like_your_job_1,
            'top_3_things_like_your_job_2' => $request->top_3_things_like_your_job_2,
            'top_3_things_like_your_job_3' => $request->top_3_things_like_your_job_3,
            'three_things_wish_change_job_role_1' => $request->three_things_wish_change_job_role_1,
            'three_things_wish_change_job_role_2' => $request->three_things_wish_change_job_role_2,
            'three_things_wish_change_job_role_3' => $request->three_things_wish_change_job_role_3,
            'satisfaction_job_role' => (!is_null($request->satisfaction_job_role) ? $request->satisfaction_job_role : ""),
            'well_equipped_perform_job' => (!is_null($request->well_equipped_perform_job) ? $request->well_equipped_perform_job : ""),
            'able_maintain_work_life_balance' => (!is_null($request->able_maintain_work_life_balance) ? $request->able_maintain_work_life_balance : ""),
            'feel_respected_my_peers' => (!is_null($request->feel_respected_my_peers) ? $request->feel_respected_my_peers : ""),
            'suggestions_heard_implemented' => (!is_null($request->suggestions_heard_implemented) ? $request->suggestions_heard_implemented : ""),
            'share_good_bond_superiors' => (!is_null($request->share_good_bond_superiors) ? $request->share_good_bond_superiors : ""),
            'know_what_i_expected_to_do' => (!is_null($request->know_what_i_expected_to_do) ? $request->know_what_i_expected_to_do : ""),
            'i_feel_grow_in_organization' => (!is_null($request->i_feel_grow_in_organization) ? $request->i_feel_grow_in_organization : ""),
            'any_exemplary_work_achievement_showcase' => $request->any_exemplary_work_achievement_showcase,
            'any_additional_trainings' => $request->any_additional_trainings,
            'what_do_you_like_about_company' => $request->what_do_you_like_about_company,
            'what_do_you_dislike_about_company' => $request->what_do_you_dislike_about_company,
            'satisfied_employee_benefits_offered_company' => $request->satisfied_employee_benefits_offered_company,
            'work_culture' => (!is_null($request->work_culture) ? $request->work_culture : ""),
            'recruitment_process' => (!is_null($request->recruitment_process) ? $request->recruitment_process : ""),
            'induction_process' => (!is_null($request->induction_process) ? $request->induction_process : ""),
            'on_job_training_process' => (!is_null($request->on_job_training_process) ? $request->on_job_training_process : ""),
            'clear_communication_changes_policy' => (!is_null($request->clear_communication_changes_policy) ? $request->clear_communication_changes_policy : ""),
            'feeling_belongingness_organization' => (!is_null($request->feeling_belongingness_organization) ? $request->feeling_belongingness_organization : ""),
            'having_best_friend_at_work' => (!is_null($request->having_best_friend_at_work) ? $request->having_best_friend_at_work : ""),
            'work_life_balance' => (!is_null($request->work_life_balance) ? $request->work_life_balance : ""),
            'any_detailed_feedback_support_your_response' => $request->any_detailed_feedback_support_your_response,
            'quickness_in_respond_reporting_manager' => (!is_null($request->quickness_in_respond_reporting_manager) ? $request->quickness_in_respond_reporting_manager : ""),
            'how_well_received_guidance_reporting_manager' => (!is_null($request->how_well_received_guidance_reporting_manager) ? $request->how_well_received_guidance_reporting_manager : ""),
            'how_clearly_your_goals_set_reporting_manager' => (!is_null($request->how_clearly_your_goals_set_reporting_manager) ? $request->how_clearly_your_goals_set_reporting_manager : ""),
            'how_transparent_is_reporting_manager' => (!is_null($request->how_transparent_is_reporting_manager) ? $request->how_transparent_is_reporting_manager : ""),
            'wprs_happen_every_week_reporting_manager' => (!is_null($request->wprs_happen_every_week_reporting_manager) ? $request->wprs_happen_every_week_reporting_manager : ""),
            'how_well_adjust_changing_priorities_reporting_manager' => (!is_null($request->how_well_adjust_changing_priorities_reporting_manager) ? $request->how_well_adjust_changing_priorities_reporting_manager : ""),
            'how_comfortable_feel_sharing_feedback_reporting_manager' => (!is_null($request->how_comfortable_feel_sharing_feedback_reporting_manager) ? $request->how_comfortable_feel_sharing_feedback_reporting_manager : ""),
            'how_well_able_learn_under_guidance_reporting_manager' => (!is_null($request->how_well_able_learn_under_guidance_reporting_manager) ? $request->how_well_able_learn_under_guidance_reporting_manager : ""),
            'our_organization_believes_mantra' => $request->our_organization_believes_mantra,
            'quickness_in_respond_reporting_manager_qi' => (!is_null($request->quickness_in_respond_reporting_manager_qi) ? $request->quickness_in_respond_reporting_manager_qi : ""),
            'how_well_received_guidance_reporting_manager_qi' => (!is_null($request->how_well_received_guidance_reporting_manager_qi) ? $request->how_well_received_guidance_reporting_manager_qi : ""),
            'how_clearly_your_goals_set_reporting_manager_qi' => (!is_null($request->how_clearly_your_goals_set_reporting_manager_qi) ? $request->how_clearly_your_goals_set_reporting_manager_qi : ""),
            'how_transparent_is_reporting_manager_qi' => (!is_null($request->how_transparent_is_reporting_manager_qi) ? $request->how_transparent_is_reporting_manager_qi : ""),
            'frequent_1_1_happen_reporting_manager_qi' => (!is_null($request->frequent_1_1_happen_reporting_manager_qi) ? $request->frequent_1_1_happen_reporting_manager_qi : ""),
            'how_well_adjust_changing_priorities_reporting_manager_qi' => (!is_null($request->how_well_adjust_changing_priorities_reporting_manager_qi) ? $request->how_well_adjust_changing_priorities_reporting_manager_qi : ""),

            'how_comfortable_feel_sharing_feedback_reporting_manager_qi' => (!is_null($request->how_comfortable_feel_sharing_feedback_reporting_manager_qi) ? $request->how_comfortable_feel_sharing_feedback_reporting_manager_qi : ""),
            'top_3_strengths_reporting_manager_qi_1' => $request->top_3_strengths_reporting_manager_qi_1,
            'top_3_strengths_reporting_manager_qi_2' => $request->top_3_strengths_reporting_manager_qi_2,
            'top_3_strengths_reporting_manager_qi_3' => $request->top_3_strengths_reporting_manager_qi_3,
            'three_areas_improvement_reporting_manager_qi_1' => $request->three_areas_improvement_reporting_manager_qi_1,
            'three_areas_improvement_reporting_manager_qi_2' => $request->three_areas_improvement_reporting_manager_qi_2,
            'three_areas_improvement_reporting_manager_qi_3' => $request->three_areas_improvement_reporting_manager_qi_3,
            'our_organization_believes_mantra_reporting_manager_qi' => $request->our_organization_believes_mantra_reporting_manager_qi,
            'quickness_in_respond_hod_qj' => (!is_null($request->quickness_in_respond_hod_qj) ? $request->quickness_in_respond_hod_qj : ""),
            'how_well_received_guidance_hod_qj' => (!is_null($request->how_well_received_guidance_hod_qj) ? $request->how_well_received_guidance_hod_qj : ""),
            'how_clearly_your_goals_set_hod_qj' => (!is_null($request->how_clearly_your_goals_set_hod_qj) ? $request->how_clearly_your_goals_set_hod_qj : ""),
            'how_transparent_is_hod_qj' => (!is_null($request->how_transparent_is_hod_qj) ? $request->how_transparent_is_hod_qj : ""),
            'frequent_1_1_happen_hod_qj' => (!is_null($request->frequent_1_1_happen_hod_qj) ? $request->frequent_1_1_happen_hod_qj : ""),
            'how_well_adjust_changing_priorities_hod_qj' => (!is_null($request->how_well_adjust_changing_priorities_hod_qj) ? $request->how_well_adjust_changing_priorities_hod_qj : ""),
            'how_comfortable_feel_sharing_feedback_hod_qj' => (!is_null($request->how_comfortable_feel_sharing_feedback_hod_qj) ? $request->how_comfortable_feel_sharing_feedback_hod_qj : ""),
            'top_3_strengths_hod_qj_1' => $request->top_3_strengths_hod_qj_1,
            'top_3_strengths_hod_qj_2' => $request->top_3_strengths_hod_qj_2,
            'top_3_strengths_hod_qj_3' => $request->top_3_strengths_hod_qj_3,
            'three_areas_improvement_hod_qj_1' => $request->three_areas_improvement_hod_qj_1,
            'three_areas_improvement_hod_qj_2' => $request->three_areas_improvement_hod_qj_2,
            'three_areas_improvement_hod_qj_3' => $request->three_areas_improvement_hod_qj_3,
            'our_organization_believes_mantra_hod_qj' => $request->our_organization_believes_mantra_hod_qj,
            'admin_operations' => (!is_null($request->admin_operations) ? $request->admin_operations : ""),
            'advertiser_sales' => (!is_null($request->advertiser_sales) ? $request->advertiser_sales : ""),
            'advertisers' => (!is_null($request->advertisers) ? $request->advertisers : ""),
            'finance_accounts' => (!is_null($request->finance_accounts) ? $request->finance_accounts : ""),
            'human_resources' => (!is_null($request->human_resources) ? $request->human_resources : ""),
            'management' => (!is_null($request->management) ? $request->management : ""),
            'network_operations' => (!is_null($request->network_operations) ? $request->network_operations : ""),
            'pocket_money' => (!is_null($request->pocket_money) ? $request->pocket_money : ""),
            'publishers' => (!is_null($request->publishers) ? $request->publishers : ""),
            'tech_operations_development' => (!is_null($request->tech_operations_development) ? $request->tech_operations_development : ""),
            'support_ea_pa' => (!is_null($request->support_ea_pa) ? $request->support_ea_pa : ""),
            'education' => (!is_null($request->education) ? $request->education : ""),
            'igaming' => (!is_null($request->igaming) ? $request->igaming : ""),
            'tech_operations_shopify' => (!is_null($request->tech_operations_shopify) ? $request->tech_operations_shopify : ""),
            'tech_operations_creative' => (!is_null($request->tech_operations_creative) ? $request->tech_operations_creative : ""),
            'mobile' => (!is_null($request->mobile) ? $request->mobile : ""),
            'vcommission_uk' => (!is_null($request->vcommission_uk) ? $request->vcommission_uk : ""),
            'any_additional_feedback_any_department' => $request->any_additional_feedback_any_department,
            'any_issue_concern_management' => $request->any_issue_concern_management,
            'status' => $status,
        ]);


        if($status=='1'){

            return back()->with('thank_you', 'Your form save in draft');

        } else if($status=='2'){
            
            return redirect('/fresh-eye-journal-form')->with('thank_you', 'Thanks, for giving your valuable time for us.');
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
