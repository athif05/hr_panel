<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Days45CheckInManager;
use App\Models\{CompanyName, Designation, Department, CompanyLocation};

use Auth;

class Days45CheckInManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $member_id=$id;
        $manager_id=Auth::user()->id;
        
        $member_details= User::where('users.id',$member_id)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();


        $manager_details= User::where('users.id',$manager_id)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $department_names = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        /*check record is exist or not*/
        $check_in_manager_details = DB::table('days_45_checkin_managers')
        ->where('member_id', $member_id)
        ->where('manager_id', $manager_id)
        ->first();
        

        if(($check_in_manager_details === null) or (($check_in_manager_details->status === '0') or ($check_in_manager_details->status === ''))) {

            return view('manager-check-in-form', compact('member_details','manager_details','company_names','designation_names','department_names','company_locations'));

        } else if($check_in_manager_details->status === '1') {

            $edit_id=$check_in_manager_details->id;
            return redirect("/manager-check-in-form-edit/$member_id/$edit_id");

        } else if($check_in_manager_details->status === '2') {

            return view('manager-check-in-form-show', compact('member_details','manager_details','company_names','designation_names','department_names','company_locations','check_in_manager_details'));
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
        $member_id=$request->member_id;
        $manager_id=$request->manager_id;
        
        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            
            $request->validate([
                'departmental_processes' => 'required',
                'tod_eod_process' => 'required',
                'month_summary_process' => 'required',
                'relevant_software_tools' => 'required',
                'organization_policies_processes' => 'required',
                'which_category_like_place' => 'required',
                'integrity' => 'required',
                'win_win' => 'required',
                'synergise' => 'required',
                'closure' => 'required',
                'knowledge' => 'required',
                'kiss' => 'required',
                'innovation' => 'required',
                'celebration' => 'required',
                'major_achievements' => 'required',
                'major_fallbacks' => 'required',
                'recommend_to_change_approach' => 'required',
                'adding_value_your_team_expectations' => 'required',
                'justify_above_answer' => 'required',
                'long_term_goal' => 'required',
                'any_additional_feedback' => 'required',
            ], [
                'departmental_processes.required' => 'Please rate...',
                'tod_eod_process.required' => 'Please rate...',
                'month_summary_process.required' => 'Please rate...',
                'relevant_software_tools.required' => 'Please rate...',
                'organization_policies_processes.required' => 'Please rate...',
                'which_category_like_place.required' => 'Select any one',
                'integrity.required' => 'Select any one',
                'win_win.required' => 'Select any one',
                'synergise.required' => 'Select any one',
                'closure.required' => 'Select any one',
                'knowledge.required' => 'Select any one',
                'kiss.required' => 'Select any one',
                'innovation.required' => 'Select any one',
                'celebration.required' => 'Select any one',
                'major_achievements.required' => 'Major achievements is required',
                'major_fallbacks.required' => 'Major fallbacks is required',
                'recommend_to_change_approach.required' => 'Recommend to change is required',
                'adding_value_your_team_expectations.required' => 'Select any one',
                'justify_above_answer.required' => 'Justify above answer is required',
                'long_term_goal.required' => 'Long term goal is required',
                'any_additional_feedback.required' => 'Any additional feedback is required',
            ]);

            $status='2';
        }


        $input = DB::table('days_45_checkin_managers')->insert([
            'member_id' => $member_id,
            'manager_id' => $manager_id,
            'departmental_processes' => $request->departmental_processes,
            'tod_eod_process' => $request->tod_eod_process,
            'month_summary_process' => $request->month_summary_process,
            'relevant_software_tools' => $request->relevant_software_tools,
            'organization_policies_processes' => $request->organization_policies_processes,
            'which_category_like_place' => $request->which_category_like_place,
            'integrity' => $request->integrity,
            'win_win' => $request->win_win,
            'synergise' => $request->synergise,
            'closure' => $request->closure,
            'knowledge' => $request->knowledge,
            'kiss' => $request->kiss,
            'innovation' => $request->innovation,
            'celebration' => $request->celebration,
            'major_achievements' => $request->major_achievements,
            'major_fallbacks' => $request->major_fallbacks,
            'recommend_to_change_approach' => $request->recommend_to_change_approach,
            'adding_value_your_team_expectations' => (!is_null($request->adding_value_your_team_expectations) ? $request->adding_value_your_team_expectations : ""),
            'justify_above_answer' => $request->justify_above_answer,
            'long_term_goal' => $request->long_term_goal,
            'any_additional_feedback' => $request->any_additional_feedback,
            'status' => $status,
        ]);

        $last_id = DB::getPdo()->lastInsertId();

        if($last_id){
            
            if($status==1){
                
                return redirect("/manager-check-in-form-edit/$member_id/$last_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                return redirect("/manager-check-in-form/$member_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

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
    public function edit($member_id, $id)
    {

        $edit_id=$id;
        $member_id=$member_id;
        $manager_id=Auth::user()->id;
        //dd($member_id.'/'.$edit_id.'/'.$manager_id);
        
        $member_details= User::where('users.id',$member_id)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();


        $manager_details= User::where('users.id',$manager_id)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $department_names = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        /*check record is exist or not*/
        $check_in_manager_details = DB::table('days_45_checkin_managers')
        ->where('id', $edit_id)
        ->where('member_id', $member_id)
        ->where('manager_id', $manager_id)
        ->first();
        

        if($check_in_manager_details->status == '1'){

            return view("manager-check-in-form-edit", compact('member_details','manager_details','company_names','designation_names','department_names','company_locations','check_in_manager_details'));

        } else if($check_in_manager_details->status == '2'){

            return redirect("/manager-check-in-form/$member_id");
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
        $member_id=$request->member_id;
        $manager_id=$request->manager_id;
        
        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            
            $request->validate([
                'departmental_processes' => 'required',
                'tod_eod_process' => 'required',
                'month_summary_process' => 'required',
                'relevant_software_tools' => 'required',
                'organization_policies_processes' => 'required',
                'which_category_like_place' => 'required',
                'integrity' => 'required',
                'win_win' => 'required',
                'synergise' => 'required',
                'closure' => 'required',
                'knowledge' => 'required',
                'kiss' => 'required',
                'innovation' => 'required',
                'celebration' => 'required',
                'major_achievements' => 'required',
                'major_fallbacks' => 'required',
                'recommend_to_change_approach' => 'required',
                'adding_value_your_team_expectations' => 'required',
                'justify_above_answer' => 'required',
                'long_term_goal' => 'required',
                'any_additional_feedback' => 'required',
            ], [
                'departmental_processes.required' => 'Please rate...',
                'tod_eod_process.required' => 'Please rate...',
                'month_summary_process.required' => 'Please rate...',
                'relevant_software_tools.required' => 'Please rate...',
                'organization_policies_processes.required' => 'Please rate...',
                'which_category_like_place.required' => 'Select any one',
                'integrity.required' => 'Select any one',
                'win_win.required' => 'Select any one',
                'synergise.required' => 'Select any one',
                'closure.required' => 'Select any one',
                'knowledge.required' => 'Select any one',
                'kiss.required' => 'Select any one',
                'innovation.required' => 'Select any one',
                'celebration.required' => 'Select any one',
                'major_achievements.required' => 'Major achievements is required',
                'major_fallbacks.required' => 'Major fallbacks is required',
                'recommend_to_change_approach.required' => 'Recommend to change is required',
                'adding_value_your_team_expectations.required' => 'Select any one',
                'justify_above_answer.required' => 'Justify above answer is required',
                'long_term_goal.required' => 'Long term goal is required',
                'any_additional_feedback.required' => 'Any additional feedback is required',
            ]);

            $status='2';
        }


        DB::table('days_45_checkin_managers')->where('id', $edit_id)
        ->where('member_id', $member_id)
        ->where('manager_id', $manager_id)
        ->update([
            'departmental_processes' => $request->departmental_processes,
            'tod_eod_process' => $request->tod_eod_process,
            'month_summary_process' => $request->month_summary_process,
            'relevant_software_tools' => $request->relevant_software_tools,
            'organization_policies_processes' => $request->organization_policies_processes,
            'which_category_like_place' => $request->which_category_like_place,
            'integrity' => $request->integrity,
            'win_win' => $request->win_win,
            'synergise' => $request->synergise,
            'closure' => $request->closure,
            'knowledge' => $request->knowledge,
            'kiss' => $request->kiss,
            'innovation' => $request->innovation,
            'celebration' => $request->celebration,
            'major_achievements' => $request->major_achievements,
            'major_fallbacks' => $request->major_fallbacks,
            'recommend_to_change_approach' => $request->recommend_to_change_approach,
            'adding_value_your_team_expectations' => (!is_null($request->adding_value_your_team_expectations) ? $request->adding_value_your_team_expectations : ""),
            'justify_above_answer' => $request->justify_above_answer,
            'long_term_goal' => $request->long_term_goal,
            'any_additional_feedback' => $request->any_additional_feedback,
            'status' => $status,
        ]);


        if($status=='1'){
                
            return redirect("/manager-check-in-form-edit/$member_id/$edit_id")->with('thank_you', 'Your form save in draft.');

        } else if($status=='2'){

            return redirect("/manager-check-in-form/$member_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

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


    /* show manager check in form in confirmation process in HR role, start here */
    public function managerCheckInFrom($id) {

        $employee_id=$user_id = $id;

        $user_details= User::where('users.id',$user_id)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();


        /*check record is exist or not*/
        $check_in_manager_details = DB::table('days_45_checkin_managers')
        ->where('days_45_checkin_managers.member_id', $user_id)
        ->where('days_45_checkin_managers.status', '2')
        ->leftJoin('users','users.id','=','days_45_checkin_managers.manager_id')
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('days_45_checkin_managers.*', 'users.member_id as manager_member_id', 'users.email as manager_email','company_names.name as manager_company_name', 'departments.name as manager_departments_name','designations.name as manager_designations_name','company_locations.name as manager_location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_manager_name'))
        ->get();

        return view('manager-check-in-form-confirmation', compact('employee_id','check_in_manager_details','user_details'));
    }
    /* show manager check in form in confirmation process in HR role, end here */


}
