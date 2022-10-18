<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Days45CheckInMember;
use App\Models\{CompanyName, Department, Designation};
use App\Models\CompanyLocation;
use App\Models\PlaceYourselfCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Auth;

class Days45CheckInMemberController extends Controller
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

        $hr_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();

        $yourself_category_details = PlaceYourselfCategory::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $department_details = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $designation_details = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        
        /*check record is exist or not*/
        $check_in_member_details = DB::table('days_45_checkin_members')->where('user_id', $user_id)->first();
        

        if(($check_in_member_details === null) or (($check_in_member_details->status === '0') or ($check_in_member_details->status === ''))){

            return view('member-check-in-form', compact('company_names','company_locations','manager_details','hod_details','hr_details','yourself_category_details','department_details','designation_details','reporting_manager_name_ajax_default'));

        } else if($check_in_member_details->status === '1'){

            return redirect("/member-check-in-form-edit/$user_id");

        } else if($check_in_member_details->status === '2'){

            ///return redirect('/thank-you')->with('thank_you', 'Alert, you have already submit interview survey form.');

            return view('member-check-in-form-show', compact('company_names','company_locations','manager_details','hod_details','hr_details','yourself_category_details','check_in_member_details','department_details','designation_details','reporting_manager_name_ajax_default'));
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
                'official_email' => 'required',
                'company_name' => 'required',
                'location_name' => 'required',
                'reporting_manager' => 'required',
                'head_of_department' => 'required',
                'joining_date' => 'required',
                'hr_name_taking_session' => 'required',
                'place_yourself_category' => 'required',
                'target' => 'required',
                'response' => 'required',
                'jd' => 'required',
                'reliability' => 'required',
                'team_spirit' => 'required',
                'attendance' => 'required',
                'attitude' => 'required',
                'rules' => 'required',
                'peers' => 'required',
                'integrity' => 'required',
                'win_win' => 'required',
                'synergize' => 'required',
                'closure' => 'required',
                'knowledge' => 'required',
                'kiss' => 'required',
                'innovation' => 'required',
                'celebration' => 'required',
                'company_work_culture' => 'required',
                'processes_policies_well_defined' => 'required',
                'enjoy_work_life_balance' => 'required',
                'happy_with_treated_in_company' => 'required',
                'job_title_kras' => 'required',
                'necessary_resources_available' => 'required',
                'feel_grow_in_organization' => 'required',
                'complete_clarity_my_role' => 'required',
                'overall_happy_with_job_role' => 'required',
                'training_elaborative_well_explained' => 'required',
                'training_duration_apt' => 'required',
                'proper_modules_defined_topic' => 'required',
                'adequate_supporting_material' => 'required',
                'clarity_on_topics_during_training' => 'required',
                'great_relationship_with_manager' => 'required',
                'reviewed_properly_feedback_shared_timely' => 'required',
                'openly_share_opinions' => 'required',
                'receive_adequate_guidance' => 'required',
                'receive_adequate_timely_feedback' => 'required',
                'get_quick_resolution_issue' => 'required',
                'frequently_receive_feedback_manager' => 'required',
                'any_additional_feedback_manager' => 'required',
                'receive_proper_job_kra' => 'required',
                'proper_training_plan' => 'required',
                'training_executed_planned' => 'required',
                'marked_regularly_your_eod' => 'required',
                'wpr_happen_atleast_once_week' => 'required',
                'one_to_one_interaction' => 'required',
                'best_experience_tenure' => 'required',
                'like_most_working' => 'required',
                'like_to_change_add' => 'required',
                'who_inspired_you_organization' => 'required',
                'mention_achievement' => 'required',
                'facing_any_challenges' => 'required',
                'need_additional_training' => 'required',
                'any_additional_feedback_share' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'member_id' => 'Member ID is required',
                'designation.required' => 'Designation is required',
                'department.required' => 'Department is required',
                'official_email.required' => 'Email is required',
                'company_name.required' => 'Company name is required',
                'location_name.required' => 'Location name is required',
                'reporting_manager.required' => 'Reporting manager name is required',
                'head_of_department.required' => 'HOD name is required',
                'joining_date.required' => 'Date of Joining is required',
                'hr_name_taking_session.required' => 'HR name is required',
                'place_yourself_category.required' => 'Category name is required',
                'target.required' => 'Please rate...',
                'response.required' => 'Please rate...',
                'jd.required' => 'Please rate...',
                'reliability.required' => 'Please rate...',
                'team_spirit.required' => 'Please rate...',
                'attendance.required' => 'Please rate...',
                'attitude.required' => 'Please rate...',
                'rules.required' => 'Please rate...',
                'peers.required' => 'Please rate...',
                'integrity.required' => 'Please rate...',
                'win_win.required' => 'Please rate...',
                'synergize.required' => 'Please rate...',
                'closure.required' => 'Please rate...',
                'knowledge.required' => 'Please rate...',
                'kiss.required' => 'Please rate...',
                'innovation.required' => 'Please rate...',
                'celebration.required' => 'Please rate...',
                'company_work_culture.required' => 'Please rate...',
                'processes_policies_well_defined.required' => 'Please rate...',
                'enjoy_work_life_balance.required' => 'Please rate...',
                'happy_with_treated_in_company.required' => 'Please rate...',
                'job_title_kras.required' => 'Please rate...',
                'necessary_resources_available.required' => 'Please rate...',
                'feel_grow_in_organization.required' => 'Please rate...',
                'complete_clarity_my_role.required' => 'Please rate...',
                'overall_happy_with_job_role.required' => 'Please rate...',
                'training_elaborative_well_explained.required' => 'Please rate...',
                'training_duration_apt.required' => 'Please rate...',
                'proper_modules_defined_topic.required' => 'Please rate...',
                'adequate_supporting_material.required' => 'Please rate...',
                'clarity_on_topics_during_training.required' => 'Please rate...',
                'great_relationship_with_manager.required' => 'Please rate...',
                'reviewed_properly_feedback_shared_timely.required' => 'Please rate...',
                'openly_share_opinions.required' => 'Please rate...',
                'receive_adequate_guidance.required' => 'Please rate...',
                'receive_adequate_timely_feedback.required' => 'Please rate...',
                'get_quick_resolution_issue.required' => 'Please rate...',
                'frequently_receive_feedback_manager.required' => 'How frequently do you want to receive feedback from your manager about your performance?',
                'any_additional_feedback_manager.required' => 'Any additional feedback for reporting manager',
                'receive_proper_job_kra.required' => 'Please rate...',
                'proper_training_plan.required' => 'Please rate...',
                'training_executed_planned.required' => 'Please rate...',
                'marked_regularly_your_eod.required' => 'Please rate...',
                'wpr_happen_atleast_once_week.required' => 'Please rate...',
                'one_to_one_interaction.required' => 'Please rate...',
                'best_experience_tenure.required' => 'Required.',
                'like_most_working.required' => 'Required',
                'like_to_change_add.required' => 'Required',
                'who_inspired_you_organization.required' => 'Required',
                'mention_achievement.required' => 'Required',
                'facing_any_challenges.required' => 'Required',
                'need_additional_training.required' => 'Required',
                'any_additional_feedback_share.required' => 'Required',
            ]);

            $status='2';
        }


        $input = DB::table('days_45_checkin_members')->insert([
            'user_id' => $user_id,
            'member_name' => $request->member_name,
            'member_id' => $request->member_id,
            'designation' => $request->designation,
            'department' => $request->department,
            'official_email' => $request->official_email,
            'company_name' => $request->company_name,
            'location_name' => $request->location_name,
            'reporting_manager' => $request->reporting_manager,
            'reporting_manager_name' => $request->reporting_manager_name_ajax,
            'head_of_department' => $request->head_of_department,
            'joining_date' => $request->joining_date,
            'hr_name_taking_session' => $request->hr_name_taking_session,
            'place_yourself_category' => $request->place_yourself_category,
            'target' => (!is_null($request->target) ? $request->target : ""),
            'response' => (!is_null($request->response) ? $request->response : ""),
            'jd' => (!is_null($request->jd) ? $request->jd : ""),
            'reliability' => (!is_null($request->reliability) ? $request->reliability : ""),
            'team_spirit' => (!is_null($request->team_spirit) ? $request->team_spirit : ""),
            'attendance' => (!is_null($request->attendance) ? $request->attendance : ""),
            'attitude' => (!is_null($request->attitude) ? $request->attitude : ""),
            'rules' => (!is_null($request->rules) ? $request->rules : ""),
            'peers' => (!is_null($request->peers) ? $request->peers : ""),
            'integrity' => $request->integrity,
            'win_win' => $request->win_win,
            'synergize' => $request->synergize,
            'closure' => $request->closure,
            'knowledge' => $request->knowledge,
            'kiss' => $request->kiss,
            'innovation' => $request->innovation,
            'celebration' => $request->celebration,
            'company_work_culture' => (!is_null($request->company_work_culture) ? $request->company_work_culture : ""),
            'processes_policies_well_defined' => (!is_null($request->processes_policies_well_defined) ? $request->processes_policies_well_defined : ""),
            'enjoy_work_life_balance' => (!is_null($request->enjoy_work_life_balance) ? $request->enjoy_work_life_balance : ""),
            'happy_with_treated_in_company' => (!is_null($request->happy_with_treated_in_company) ? $request->happy_with_treated_in_company : ""),
            'job_title_kras' => (!is_null($request->job_title_kras) ? $request->job_title_kras : ""),
            'necessary_resources_available' => (!is_null($request->necessary_resources_available) ? $request->necessary_resources_available : ""),
            'feel_grow_in_organization' => (!is_null($request->feel_grow_in_organization) ? $request->feel_grow_in_organization : ""),
            'complete_clarity_my_role' => (!is_null($request->complete_clarity_my_role) ? $request->complete_clarity_my_role : ""),
            'overall_happy_with_job_role' => (!is_null($request->overall_happy_with_job_role) ? $request->overall_happy_with_job_role : ""),
            'training_elaborative_well_explained' => (!is_null($request->training_elaborative_well_explained) ? $request->training_elaborative_well_explained : ""),
            'training_duration_apt' => (!is_null($request->training_duration_apt) ? $request->training_duration_apt : ""),
            'proper_modules_defined_topic' => (!is_null($request->proper_modules_defined_topic) ? $request->proper_modules_defined_topic : ""),
            'adequate_supporting_material' => (!is_null($request->adequate_supporting_material) ? $request->adequate_supporting_material : ""),
            'clarity_on_topics_during_training' => (!is_null($request->clarity_on_topics_during_training) ? $request->clarity_on_topics_during_training : ""),
            'great_relationship_with_manager' => (!is_null($request->great_relationship_with_manager) ? $request->great_relationship_with_manager : ""),
            'reviewed_properly_feedback_shared_timely' => (!is_null($request->reviewed_properly_feedback_shared_timely) ? $request->reviewed_properly_feedback_shared_timely : ""),
            'openly_share_opinions' => (!is_null($request->openly_share_opinions) ? $request->openly_share_opinions : ""),
            'receive_adequate_guidance' => (!is_null($request->receive_adequate_guidance) ? $request->receive_adequate_guidance : ""),
            'receive_adequate_timely_feedback' => (!is_null($request->receive_adequate_timely_feedback) ? $request->receive_adequate_timely_feedback : ""),
            'get_quick_resolution_issue' => (!is_null($request->get_quick_resolution_issue) ? $request->get_quick_resolution_issue : ""),
            'frequently_receive_feedback_manager' => $request->frequently_receive_feedback_manager,
            'any_additional_feedback_manager' => $request->any_additional_feedback_manager,
            'receive_proper_job_kra' => (!is_null($request->receive_proper_job_kra) ? $request->receive_proper_job_kra : ""),
            'proper_training_plan' => (!is_null($request->proper_training_plan) ? $request->proper_training_plan : ""),
            'training_executed_planned' => (!is_null($request->training_executed_planned) ? $request->training_executed_planned : ""),
            'marked_regularly_your_eod' => (!is_null($request->marked_regularly_your_eod) ? $request->marked_regularly_your_eod : ""),
            'wpr_happen_atleast_once_week' => (!is_null($request->wpr_happen_atleast_once_week) ? $request->wpr_happen_atleast_once_week : ""),
            'one_to_one_interaction' => (!is_null($request->one_to_one_interaction) ? $request->one_to_one_interaction : ""),
            'best_experience_tenure' => $request->best_experience_tenure,
            'like_most_working' => $request->like_most_working,
            'like_to_change_add' => $request->like_to_change_add,
            'who_inspired_you_organization' => $request->who_inspired_you_organization,
            'mention_achievement' => $request->mention_achievement,
            'facing_any_challenges' => $request->facing_any_challenges,
            'need_additional_training' => $request->need_additional_training,
            'any_additional_feedback_share' => $request->any_additional_feedback_share,
            'status' => $status,
        ]);


        if($input){
            
            if($status==1){
                
                return redirect("/member-check-in-form-edit/$user_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                return redirect('/member-check-in-form')->with('thank_you', 'Thanks, for giving your valuable time for us.');

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

        $reporting_manager_name_ajax_default = Auth::user()->manager_name;

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

        $hr_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();

        $yourself_category_details = PlaceYourselfCategory::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $department_details = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $designation_details = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        
        /*check record is exist or not*/
        $check_in_member_details = DB::table('days_45_checkin_members')->where('user_id', $user_id)->first();
        

        if($check_in_member_details->status == '1'){

            return view('member-check-in-form-edit', compact('company_names','company_locations','manager_details','hod_details','hr_details','yourself_category_details','check_in_member_details','department_details','designation_details','reporting_manager_name_ajax_default'));

        } else if($check_in_member_details->status == '2'){

            return redirect('/member-check-in-form');
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
        //dd($request->reporting_manager);
        $user_id=$request->user_id;
        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            
            $request->validate([
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'member_id' => 'required',
                'designation' => 'required',
                'department' => 'required',
                'official_email' => 'required',
                'company_name' => 'required',
                'location_name' => 'required',
                'reporting_manager' => 'required',
                'head_of_department' => 'required',
                'joining_date' => 'required',
                'hr_name_taking_session' => 'required',
                'place_yourself_category' => 'required',
                'target' => 'required',
                'response' => 'required',
                'jd' => 'required',
                'reliability' => 'required',
                'team_spirit' => 'required',
                'attendance' => 'required',
                'attitude' => 'required',
                'rules' => 'required',
                'peers' => 'required',
                'integrity' => 'required',
                'win_win' => 'required',
                'synergize' => 'required',
                'closure' => 'required',
                'knowledge' => 'required',
                'kiss' => 'required',
                'innovation' => 'required',
                'celebration' => 'required',
                'company_work_culture' => 'required',
                'processes_policies_well_defined' => 'required',
                'enjoy_work_life_balance' => 'required',
                'happy_with_treated_in_company' => 'required',
                'job_title_kras' => 'required',
                'necessary_resources_available' => 'required',
                'feel_grow_in_organization' => 'required',
                'complete_clarity_my_role' => 'required',
                'overall_happy_with_job_role' => 'required',
                'training_elaborative_well_explained' => 'required',
                'training_duration_apt' => 'required',
                'proper_modules_defined_topic' => 'required',
                'adequate_supporting_material' => 'required',
                'clarity_on_topics_during_training' => 'required',
                'great_relationship_with_manager' => 'required',
                'reviewed_properly_feedback_shared_timely' => 'required',
                'openly_share_opinions' => 'required',
                'receive_adequate_guidance' => 'required',
                'receive_adequate_timely_feedback' => 'required',
                'get_quick_resolution_issue' => 'required',
                'frequently_receive_feedback_manager' => 'required',
                'any_additional_feedback_manager' => 'required',
                'receive_proper_job_kra' => 'required',
                'proper_training_plan' => 'required',
                'training_executed_planned' => 'required',
                'marked_regularly_your_eod' => 'required',
                'wpr_happen_atleast_once_week' => 'required',
                'one_to_one_interaction' => 'required',
                'best_experience_tenure' => 'required',
                'like_most_working' => 'required',
                'like_to_change_add' => 'required',
                'who_inspired_you_organization' => 'required',
                'mention_achievement' => 'required',
                'facing_any_challenges' => 'required',
                'need_additional_training' => 'required',
                'any_additional_feedback_share' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'member_id' => 'Member ID is required',
                'designation.required' => 'Designation is required',
                'department.required' => 'Department is required',
                'official_email.required' => 'Email is required',
                'company_name.required' => 'Company name is required',
                'location_name.required' => 'Location name is required',
                'reporting_manager.required' => 'Reporting manager name is required',
                'head_of_department.required' => 'HOD name is required',
                'joining_date.required' => 'Date of Joining is required',
                'hr_name_taking_session.required' => 'HR name is required',
                'place_yourself_category.required' => 'Category name is required',
                'target.required' => 'Please rate...',
                'response.required' => 'Please rate...',
                'jd.required' => 'Please rate...',
                'reliability.required' => 'Please rate...',
                'team_spirit.required' => 'Please rate...',
                'attendance.required' => 'Please rate...',
                'attitude.required' => 'Please rate...',
                'rules.required' => 'Please rate...',
                'peers.required' => 'Please rate...',
                'integrity.required' => 'Please rate...',
                'win_win.required' => 'Please rate...',
                'synergize.required' => 'Please rate...',
                'closure.required' => 'Please rate...',
                'knowledge.required' => 'Please rate...',
                'kiss.required' => 'Please rate...',
                'innovation.required' => 'Please rate...',
                'celebration.required' => 'Please rate...',
                'company_work_culture.required' => 'Please rate...',
                'processes_policies_well_defined.required' => 'Please rate...',
                'enjoy_work_life_balance.required' => 'Please rate...',
                'happy_with_treated_in_company.required' => 'Please rate...',
                'job_title_kras.required' => 'Please rate...',
                'necessary_resources_available.required' => 'Please rate...',
                'feel_grow_in_organization.required' => 'Please rate...',
                'complete_clarity_my_role.required' => 'Please rate...',
                'overall_happy_with_job_role.required' => 'Please rate...',
                'training_elaborative_well_explained.required' => 'Please rate...',
                'training_duration_apt.required' => 'Please rate...',
                'proper_modules_defined_topic.required' => 'Please rate...',
                'adequate_supporting_material.required' => 'Please rate...',
                'clarity_on_topics_during_training.required' => 'Please rate...',
                'great_relationship_with_manager.required' => 'Please rate...',
                'reviewed_properly_feedback_shared_timely.required' => 'Please rate...',
                'openly_share_opinions.required' => 'Please rate...',
                'receive_adequate_guidance.required' => 'Please rate...',
                'receive_adequate_timely_feedback.required' => 'Please rate...',
                'get_quick_resolution_issue.required' => 'Please rate...',
                'frequently_receive_feedback_manager.required' => 'How frequently do you want to receive feedback from your manager about your performance?',
                'any_additional_feedback_manager.required' => 'Any additional feedback for reporting manager',
                'receive_proper_job_kra.required' => 'Please rate...',
                'proper_training_plan.required' => 'Please rate...',
                'training_executed_planned.required' => 'Please rate...',
                'marked_regularly_your_eod.required' => 'Please rate...',
                'wpr_happen_atleast_once_week.required' => 'Please rate...',
                'one_to_one_interaction.required' => 'Please rate...',
                'best_experience_tenure.required' => 'Required.',
                'like_most_working.required' => 'Required',
                'like_to_change_add.required' => 'Required',
                'who_inspired_you_organization.required' => 'Required',
                'mention_achievement.required' => 'Required',
                'facing_any_challenges.required' => 'Required',
                'need_additional_training.required' => 'Required',
                'any_additional_feedback_share.required' => 'Required',
            ]);

            $status='2';
        }
        

        DB::table('days_45_checkin_members')->where('user_id', $user_id)
        ->update([
            'user_id' => $user_id,
            'member_name' => $request->member_name,
            'member_id' => $request->member_id,
            'designation' => $request->designation,
            'department' => $request->department,
            'official_email' => $request->official_email,
            'company_name' => $request->company_name,
            'location_name' => $request->location_name,
            'reporting_manager' => $request->reporting_manager,
            'reporting_manager_name' => $request->reporting_manager_name_ajax,
            'head_of_department' => $request->head_of_department,
            'joining_date' => $request->joining_date,
            'hr_name_taking_session' => $request->hr_name_taking_session,
            'place_yourself_category' => $request->place_yourself_category,
            'target' => (!is_null($request->target) ? $request->target : ""),
            'response' => (!is_null($request->response) ? $request->response : ""),
            'jd' => (!is_null($request->jd) ? $request->jd : ""),
            'reliability' => (!is_null($request->reliability) ? $request->reliability : ""),
            'team_spirit' => (!is_null($request->team_spirit) ? $request->team_spirit : ""),
            'attendance' => (!is_null($request->attendance) ? $request->attendance : ""),
            'attitude' => (!is_null($request->attitude) ? $request->attitude : ""),
            'rules' => (!is_null($request->rules) ? $request->rules : ""),
            'peers' => (!is_null($request->peers) ? $request->peers : ""),
            'integrity' => $request->integrity,
            'win_win' => $request->win_win,
            'synergize' => $request->synergize,
            'closure' => $request->closure,
            'knowledge' => $request->knowledge,
            'kiss' => $request->kiss,
            'innovation' => $request->innovation,
            'celebration' => $request->celebration,
            'company_work_culture' => (!is_null($request->company_work_culture) ? $request->company_work_culture : ""),
            'processes_policies_well_defined' => (!is_null($request->processes_policies_well_defined) ? $request->processes_policies_well_defined : ""),
            'enjoy_work_life_balance' => (!is_null($request->enjoy_work_life_balance) ? $request->enjoy_work_life_balance : ""),
            'happy_with_treated_in_company' => (!is_null($request->happy_with_treated_in_company) ? $request->happy_with_treated_in_company : ""),
            'job_title_kras' => (!is_null($request->job_title_kras) ? $request->job_title_kras : ""),
            'necessary_resources_available' => (!is_null($request->necessary_resources_available) ? $request->necessary_resources_available : ""),
            'feel_grow_in_organization' => (!is_null($request->feel_grow_in_organization) ? $request->feel_grow_in_organization : ""),
            'complete_clarity_my_role' => (!is_null($request->complete_clarity_my_role) ? $request->complete_clarity_my_role : ""),
            'overall_happy_with_job_role' => (!is_null($request->overall_happy_with_job_role) ? $request->overall_happy_with_job_role : ""),
            'training_elaborative_well_explained' => (!is_null($request->training_elaborative_well_explained) ? $request->training_elaborative_well_explained : ""),
            'training_duration_apt' => (!is_null($request->training_duration_apt) ? $request->training_duration_apt : ""),
            'proper_modules_defined_topic' => (!is_null($request->proper_modules_defined_topic) ? $request->proper_modules_defined_topic : ""),
            'adequate_supporting_material' => (!is_null($request->adequate_supporting_material) ? $request->adequate_supporting_material : ""),
            'clarity_on_topics_during_training' => (!is_null($request->clarity_on_topics_during_training) ? $request->clarity_on_topics_during_training : ""),
            'great_relationship_with_manager' => (!is_null($request->great_relationship_with_manager) ? $request->great_relationship_with_manager : ""),
            'reviewed_properly_feedback_shared_timely' => (!is_null($request->reviewed_properly_feedback_shared_timely) ? $request->reviewed_properly_feedback_shared_timely : ""),
            'openly_share_opinions' => (!is_null($request->openly_share_opinions) ? $request->openly_share_opinions : ""),
            'receive_adequate_guidance' => (!is_null($request->receive_adequate_guidance) ? $request->receive_adequate_guidance : ""),
            'receive_adequate_timely_feedback' => (!is_null($request->receive_adequate_timely_feedback) ? $request->receive_adequate_timely_feedback : ""),
            'get_quick_resolution_issue' => (!is_null($request->get_quick_resolution_issue) ? $request->get_quick_resolution_issue : ""),
            'frequently_receive_feedback_manager' => $request->frequently_receive_feedback_manager,
            'any_additional_feedback_manager' => $request->any_additional_feedback_manager,
            'receive_proper_job_kra' => (!is_null($request->receive_proper_job_kra) ? $request->receive_proper_job_kra : ""),
            'proper_training_plan' => (!is_null($request->proper_training_plan) ? $request->proper_training_plan : ""),
            'training_executed_planned' => (!is_null($request->training_executed_planned) ? $request->training_executed_planned : ""),
            'marked_regularly_your_eod' => (!is_null($request->marked_regularly_your_eod) ? $request->marked_regularly_your_eod : ""),
            'wpr_happen_atleast_once_week' => (!is_null($request->wpr_happen_atleast_once_week) ? $request->wpr_happen_atleast_once_week : ""),
            'one_to_one_interaction' => (!is_null($request->one_to_one_interaction) ? $request->one_to_one_interaction : ""),
            'best_experience_tenure' => $request->best_experience_tenure,
            'like_most_working' => $request->like_most_working,
            'like_to_change_add' => $request->like_to_change_add,
            'who_inspired_you_organization' => $request->who_inspired_you_organization,
            'mention_achievement' => $request->mention_achievement,
            'facing_any_challenges' => $request->facing_any_challenges,
            'need_additional_training' => $request->need_additional_training,
            'any_additional_feedback_share' => $request->any_additional_feedback_share,
            'status' => $status,
        ]);


        if($status==1){
                
            return redirect("/member-check-in-form-edit/$user_id")->with('thank_you', 'Your form save in draft.');

        } else if($status==2){

            return redirect('/member-check-in-form')->with('thank_you', 'Thanks, for giving your valuable time for us.');

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



    public function getReportingManagerNameAjax(Request $request){
        
        $data=$request->reporting_manager_id;

        $trainer_details = User::where('id', $data)
        ->first();

        $name = $trainer_details->first_name.' '.$trainer_details->last_name;

        return response()->json($name);
    }


    /*this is used in start confirmation process in hr login, start here*/
    public function memberCheckIn($id){

        $employee_id=$user_id = $id; 

        $hod_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '4')
            ->orderBy('first_name','asc')
            ->get();

        $hr_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();

        $yourself_category_details = PlaceYourselfCategory::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        
        /*check record is exist or not*/
        $check_in_member_details = DB::table('days_45_checkin_members')->where('user_id', $user_id)
        ->where('days_45_checkin_members.status','2')
        ->leftJoin('designations','designations.id','=','days_45_checkin_members.designation')
        ->leftJoin('departments','departments.id','=','days_45_checkin_members.department')
        ->leftJoin('company_names','company_names.id','=','days_45_checkin_members.company_name')
        ->leftJoin('company_locations','company_locations.id','=','days_45_checkin_members.location_name')
        ->select('days_45_checkin_members.*','designations.name as designation_name','departments.name as department_name','company_names.name as company_name','company_locations.name as company_location')
        ->first();
        

        
        //return view('confirmation-process.member-check-in-from', compact('employee_id','hod_details','hr_details','yourself_category_details','check_in_member_details'));

        return view('member-check-in-from-confirmation', compact('employee_id','hod_details','hr_details','yourself_category_details','check_in_member_details'));

    }
    /*this is used in start confirmation process in hr login, end here*/
}
