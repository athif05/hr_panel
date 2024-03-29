<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HiringSurvey;
use App\Models\{CompanyName, Designation, Department};
use App\Models\CompanyLocation;
use App\Models\JobOpeningTypes;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Auth;

class HiringSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll(){
        $manager1=Auth::user()->member_id;

        $manager_array= app('App\Http\Controllers\UserController')->multilevel_manager($manager1);
        
        //dd($manager_array);
        
        /*$all_members = User::where('users.employee_type','Probation')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->leftJoin('hiring_surveys', 'hiring_surveys.user_id', '=', 'users.id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name','designations.name as designation_name','hiring_surveys.id as surveys_form_id', 'hiring_surveys.status as hiring_surveys_status')
        ->orderBy('users.first_name','asc')->get();*/

        $all_members = User::where('users.employee_type','Probation')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name','designations.name as designation_name')
        ->orderBy('users.first_name','asc')->get();

        $hiring_survey_details=HiringSurvey::get();

        return view('hiring-survey-list', compact('all_members','hiring_survey_details'));
    }


    public function index($id)
    {
        $user_id = $id; //member id
        $manager_id = Auth::user()->id; //manager id

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

        $recruiter_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orWhere('role_id', '7')
            ->orderBy('first_name','asc')
            ->get();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $department_names = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();
        //dd($company_names);

        /*check record is exist or not*/
        $member_details = User::where('users.id', $user_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->select('users.*', 'company_locations.name as location_name')
        ->first();


        /*check record is exist or not*/
        $last_id=0;
        $hiring_survey_details = HiringSurvey::where('user_id', $user_id)
        ->where('manager_id', $manager_id)
        ->first();
        
        

        if(($hiring_survey_details === null) or (($hiring_survey_details['status'] === '0') or ($hiring_survey_details['status'] === ''))){

            return view('hiring-survey', compact('member_details','company_names','company_locations','job_opening_types','designation_names','department_names','recruiter_details'));

        } else if($hiring_survey_details['status'] === '1'){

            $last_id=$hiring_survey_details['id'];

            return redirect("/hiring-survey-edit/$user_id/$last_id");

        } else if($hiring_survey_details['status'] === '2'){

            ///return redirect('/thank-you')->with('thank_you', 'Alert, you have already submit interview survey form.');

            return view('hiring-survey-show', compact('hiring_survey_details','company_names','company_locations','job_opening_types','designation_names','department_names','recruiter_details'));
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
        $manager_id=$request->manager_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            
            $request->validate([
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'designation' => 'required|max:50',
                'department' => 'required|max:50',
                'location' => 'required',
                'company_name' => 'required',
                'recruiter_name' => 'required',
                'location_name' => 'required',
                'open_designation_name' => 'required',
                'no_of_openings' => 'required',
                'all_posoitions_closed' => 'required',
                'recruiter_helpful_recruitment_process' => 'required',
                'recruiter_response' => 'required',
                'recruiter_understanding_job_requirement' => 'required',
                'quality_of_candidates_presented' => 'required',
                'number_of_candidates_presented' => 'required',
                'rate_the_recruiter_correct_information' => 'required',
                'assessment_screening_candidates' => 'required',
                'time_taken_fill_open_position' => 'required',
                'overall_satisfied_hiring_recruiting_process' => 'required',
                'additional_feedback_recruiter' => 'required',
                'any_suggestions_improve_hiring_process' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'designation.required' => 'Designation is required',
                'department.required' => 'Department is required',
                'location.required' => 'Location is required',
                'company_name.required' => 'Company name is required',
                'recruiter_name.required' => 'Recruiter name is required',
                'location_name.required' => 'Location name is required',
                'open_designation_name.required' => 'Open designation name is required',
                'no_of_openings.required' => 'No of openings is required',
                'all_posoitions_closed.required' => 'All posoitions closed?',
                'recruiter_helpful_recruitment_process.required' => 'Please rate...',
                'recruiter_response.required' => 'Please rate...',
                'recruiter_understanding_job_requirement.required' => 'Please rate...',
                'quality_of_candidates_presented.required' => 'Please rate...',
                'number_of_candidates_presented.required' => 'Please rate...',
                'rate_the_recruiter_correct_information.required' => 'Please rate...',
                'assessment_screening_candidates.required' => 'Additional feedback for recruiter is required',
                'time_taken_fill_open_position.required' => 'Please rate...',
                'overall_satisfied_hiring_recruiting_process.required' => 'Please rate...',
                'additional_feedback_recruiter.required' => 'Additional feedback is required',
                'any_suggestions_improve_hiring_process.required' => 'Any suggestions is required',
            ]);

            $status='2';
        }

        $input = HiringSurvey::insert([
            'user_id' => $user_id,
            'manager_id' => $manager_id,
            'member_name' => $request->member_name,
            'designation' => $request->designation,
            'department' => $request->department,
            'location' => $request->location,
            'company_name' => $request->company_name,
            'recruiter_name' => (!is_null($request->recruiter_name) ? $request->recruiter_name : ""),
            'location_name_position_open' => (!is_null($request->location_name) ? $request->location_name : ""),
            'designation_name_open_position' => (!is_null($request->open_designation_name) ? $request->open_designation_name : ""),
            'no_of_openings' => (!is_null($request->no_of_openings) ? $request->no_of_openings : ""),
            'all_posoitions_closed' => (!is_null($request->all_posoitions_closed) ? $request->all_posoitions_closed : ""),
            'recruiter_helpful_recruitment_process' => $request->recruiter_helpful_recruitment_process,
            'recruiter_response' => $request->recruiter_response,
            'recruiter_understanding_job_requirement' => $request->recruiter_understanding_job_requirement,
            'quality_of_candidates_presented' => $request->quality_of_candidates_presented,
            'number_of_candidates_presented' => $request->number_of_candidates_presented,
            'rate_the_recruiter_correct_information' => $request->rate_the_recruiter_correct_information,
            'assessment_screening_candidates' => $request->assessment_screening_candidates,
            'time_taken_fill_open_position' => $request->time_taken_fill_open_position,
            'overall_satisfied_hiring_recruiting_process' => $request->overall_satisfied_hiring_recruiting_process,
            'additional_feedback_recruiter' => (!is_null($request->additional_feedback_recruiter) ? $request->additional_feedback_recruiter : ""),
            'any_suggestions_improve_hiring_process' => (!is_null($request->any_suggestions_improve_hiring_process) ? $request->any_suggestions_improve_hiring_process : ""),
            'status' => $status,
        ]);

        $last_id = DB::getPdo()->lastInsertId();

        if($input){
            
            if($status==1){
                
                //return redirect('/thank-you')->with('thank_you', 'Your form save in draft.');
                //return back()->with('thank_you', 'Your form save in draft.');
                return redirect("/hiring-survey-edit/$user_id/$last_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                //return redirect('/thank-you')->with('thank_you', 'Thanks, for giving your valuable time for us.');

                return redirect("/hiring-survey/$user_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

            }
            
            //return redirect('/thank-you');
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
    public function edit($user_id, $id)
    {

        //$id = $user_id;
        $manager_id = Auth::user()->id;

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

        $recruiter_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orWhere('role_id', '7')
            ->orderBy('first_name','asc')
            ->get();


        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $department_names = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        //dd($company_names);

        /*check record is exist or not*/
        $hiring_survey_details = HiringSurvey::where('id',$id)
        ->where('user_id',$user_id)
        ->where('manager_id',$manager_id)
        ->first();

        if($hiring_survey_details->status==1){
            
            return view('hiring-survey-edit', compact('company_names','company_locations','job_opening_types','recruiter_details','designation_names','department_names','hiring_survey_details'));

        } else if($hiring_survey_details->status==2){


            return redirect("/hiring-survey/$user_id");

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
        $status=0;

        $edit_id=$request->edit_id;
        $user_id=$request->user_id;
        $manager_id=$request->manager_id;
        
        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            
            $request->validate([
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'designation' => 'required|max:50',
                'department' => 'required|max:50',
                'location' => 'required',
                'company_name' => 'required',
                'recruiter_name' => 'required',
                'location_name' => 'required',
                'open_designation_name' => 'required',
                'no_of_openings' => 'required',
                'all_posoitions_closed' => 'required',
                'recruiter_helpful_recruitment_process' => 'required',
                'recruiter_response' => 'required',
                'recruiter_understanding_job_requirement' => 'required',
                'quality_of_candidates_presented' => 'required',
                'number_of_candidates_presented' => 'required',
                'rate_the_recruiter_correct_information' => 'required',
                'assessment_screening_candidates' => 'required',
                'time_taken_fill_open_position' => 'required',
                'overall_satisfied_hiring_recruiting_process' => 'required',
                'additional_feedback_recruiter' => 'required',
                'any_suggestions_improve_hiring_process' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'designation.required' => 'Designation is required',
                'department.required' => 'Department is required',
                'location.required' => 'Location is required',
                'company_name.required' => 'Company name is required',
                'recruiter_name.required' => 'Recruiter name is required',
                'location_name.required' => 'Location name is required',
                'open_designation_name.required' => 'Open designation name is required',
                'no_of_openings.required' => 'No of openings is required',
                'all_posoitions_closed.required' => 'All posoitions closed?',
                'recruiter_helpful_recruitment_process.required' => 'Please rate...',
                'recruiter_response.required' => 'Please rate...',
                'recruiter_understanding_job_requirement.required' => 'Please rate...',
                'quality_of_candidates_presented.required' => 'Please rate...',
                'number_of_candidates_presented.required' => 'Please rate...',
                'rate_the_recruiter_correct_information.required' => 'Please rate...',
                'assessment_screening_candidates.required' => 'Additional feedback for recruiter is required',
                'time_taken_fill_open_position.required' => 'Please rate...',
                'overall_satisfied_hiring_recruiting_process.required' => 'Please rate...',
                'additional_feedback_recruiter.required' => 'Additional feedback is required',
                'any_suggestions_improve_hiring_process.required' => 'Any suggestions is required',
            ]);

            $status='2';
        }


        HiringSurvey::where('id', $edit_id)
        ->where('user_id', $user_id)
        ->update([
            'manager_id' => $manager_id,
            'member_name' => $request->member_name,
            'designation' => $request->designation,
            'department' => $request->department,
            'location' => $request->location,
            'company_name' => $request->company_name,
            'recruiter_name' => (!is_null($request->recruiter_name) ? $request->recruiter_name : ""),
            'location_name_position_open' => (!is_null($request->location_name) ? $request->location_name : ""),
            'designation_name_open_position' => (!is_null($request->open_designation_name) ? $request->open_designation_name : ""),
            'no_of_openings' => (!is_null($request->no_of_openings) ? $request->no_of_openings : ""),
            'all_posoitions_closed' => (!is_null($request->all_posoitions_closed) ? $request->all_posoitions_closed : ""),
            'recruiter_helpful_recruitment_process' => (!is_null($request->recruiter_helpful_recruitment_process) ? $request->recruiter_helpful_recruitment_process : "0"),
            'recruiter_response' => (!is_null($request->recruiter_response) ? $request->recruiter_response : "0"),
            'recruiter_understanding_job_requirement' => (!is_null($request->recruiter_understanding_job_requirement) ? $request->recruiter_understanding_job_requirement : "0"),
            'quality_of_candidates_presented' => (!is_null($request->quality_of_candidates_presented) ? $request->quality_of_candidates_presented : "0"),
            'number_of_candidates_presented' => (!is_null($request->number_of_candidates_presented) ? $request->number_of_candidates_presented : "0"),
            'rate_the_recruiter_correct_information' => (!is_null($request->rate_the_recruiter_correct_information) ? $request->rate_the_recruiter_correct_information : "0"),
            'assessment_screening_candidates' => (!is_null($request->assessment_screening_candidates) ? $request->assessment_screening_candidates : "0"),
            'time_taken_fill_open_position' => (!is_null($request->time_taken_fill_open_position) ? $request->time_taken_fill_open_position : "0"),
            'overall_satisfied_hiring_recruiting_process' => (!is_null($request->overall_satisfied_hiring_recruiting_process) ? $request->overall_satisfied_hiring_recruiting_process : "0"),
            'additional_feedback_recruiter' => (!is_null($request->additional_feedback_recruiter) ? $request->additional_feedback_recruiter : ""),
            'any_suggestions_improve_hiring_process' => (!is_null($request->any_suggestions_improve_hiring_process) ? $request->any_suggestions_improve_hiring_process : ""),
            'status' => $status,
        ]);

        if($status=='1'){
            
            //return redirect('/thank-you')->with('thank_you', 'Your form save in draft.');
            return back()->with('thank_you', 'Your form save in draft');

        } else if($status=='2'){
            
            //return redirect('/thank-you')->with('thank_you', 'Thanks, for giving your valuable time for us.');
            return redirect("/hiring-survey/$user_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');
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
