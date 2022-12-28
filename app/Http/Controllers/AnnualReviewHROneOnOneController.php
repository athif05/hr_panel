<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\{AnnualReviewHrOneOnOne, User, CompanyName, Designation, Department, CompanyLocation};

use Auth;

class AnnualReviewHROneOnOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($survey_from_id)
    {
        $member_id=Auth::user()->id;
        $annual_review_form_id=$survey_from_id;

        $all_members = User::where('users.id','!=',$member_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','departments.name as department_name','designations.name as designation_name')
        ->orderBy('users.first_name','asc')->get();

        $hr_one_on_one_details=AnnualReviewHrOneOnOne::get();

        return view('annual-review-hr-one-on-one-list', compact('annual_review_form_id','all_members','hr_one_on_one_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm($survey_form_id, $member_id)
    {
        $filled_by=Auth::user()->id;
        $filled_for=$member_id;

        $member_details = User::where('users.id',$filled_for)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        /*fetch all hr data*/
        $hr_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();

        $current_year=date('y');
        $next_year=$current_year+1;
        $fy=$current_year.'-'.$next_year;

        return view('annual-review-hr-one-on-one-from', compact('survey_form_id','filled_by','filled_for','member_details','designation_names','hr_details','fy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pip_start_date='';
        $pip_end_date='';
        $designation_id_promotion='';

        if($request['submit']=='Save in Draft'){
            $status='1';

        } else if($request['submit']=='Publish'){

            $request->validate([
                'put_ever_pip' => 'required',
                'hr_id_taking_this_1_1' => 'required',
                'Which_level_place_yourself' => 'required',
                'total_expected_increment_monthly_salary' => 'required',
                'hr_notes' => 'required',
                'share_your_accomplishments' => 'required',
                'share_issues_challenges_impact_work' => 'required',
                'openly_share_issues_need_closures' => 'required',
                'see_yourself_moving_ahead_next_year' => 'required',
                'any_additional_feedback_wish_to_share' => 'required',
            ], [
                'put_ever_pip.required' => 'Required',
                'hr_id_taking_this_1_1.required' => 'Name of the member HR is required',
                'Which_level_place_yourself.required' => 'Required',
                'total_expected_increment_monthly_salary.required' => 'Required',
                'hr_notes.required' => 'Required',
                'share_your_accomplishments.required' => 'Required',
                'share_issues_challenges_impact_work.required' => 'Required',
                'openly_share_issues_need_closures.required' => 'Required',
                'see_yourself_moving_ahead_next_year.required' => 'Required',
                'any_additional_feedback_wish_to_share.required' => 'Required',
            ]);

            if($request->put_ever_pip!='No'){
                $request->validate([
                    'pip_start_date' => 'required',
                    'pip_end_date' => 'required',
                ], [
                    'pip_start_date.required' => 'PIP start date is required',
                    'pip_end_date.required' => 'PIP end date is required',
                ]);
            }

            if($request->promotion_in_designation!='No'){
                $request->validate([
                    'designation_id_promotion' => 'required',
                ], [
                    'designation_id_promotion.required' => 'Required',
                ]);
            }

            $status='2';
        }
        
        if($request->put_ever_pip!='No'){
            $pip_start_date=$request->pip_start_date;
            $pip_end_date=$request->pip_end_date;
        } 

        if($request->promotion_in_designation!='No'){
            $designation_id_promotion=$request->designation_id_promotion;
        }
    
        $annual_review_form_id=$request->annual_review_form_id;
        $filled_by=$request->filled_by;
        $filled_for=$request->filled_for;

        $input = AnnualReviewHrOneOnOne::insert([
            'filled_by' => $filled_by,
            'filled_for' => $filled_for,
            'annual_review_form_id' => $annual_review_form_id,
            'put_ever_pip' => $request->put_ever_pip,
            'pip_start_date' => $pip_start_date,
            'pip_end_date' => $pip_end_date,
            'member_appraisal_cycle' => $request->member_appraisal_cycle,
            'hr_id_taking_this_1_1' => $request->hr_id_taking_this_1_1,
            'Which_level_place_yourself' => $request->Which_level_place_yourself,
            'current_monthly_salary' => $request->current_monthly_salary,
            'current_annual_salary' => $request->current_annual_salary,
            'total_expected_increment_monthly_salary' => $request->total_expected_increment_monthly_salary,
            'total_expected_increment_monthly_salary_percentage' => $request->total_expected_increment_monthly_salary_percentage,
            'total_expected_increment_monthly_salary_percentage' => $request->total_expected_increment_monthly_salary_percentage,
            'hr_notes' => $request->hr_notes,
            'promotion_in_designation' => $request->promotion_in_designation,
            'designation_id_promotion' => $designation_id_promotion,
            'share_your_accomplishments' => $request->share_your_accomplishments,
            'share_issues_challenges_impact_work' => $request->share_issues_challenges_impact_work,
            'openly_share_issues_need_closures' => $request->openly_share_issues_need_closures,
            'see_yourself_moving_ahead_next_year' => $request->see_yourself_moving_ahead_next_year,
            'any_additional_feedback_wish_to_share' => $request->any_additional_feedback_wish_to_share,
            'fy' => $request->fy,
            'status' => $status,
        ]);

        $last_id = DB::getPdo()->lastInsertId();

        if($input){
            
            if($status==1){
                
                return redirect("/annual-review-hr-one-on-one-form-edit/$annual_review_form_id/$filled_for/$last_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                //return redirect('/annual-review-manager-feedback-form-show')

                return redirect("/annual-review-hr-one-on-one-form-show/$annual_review_form_id/$filled_for/$last_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

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
    public function edit($survey_form_id, $member_id, $edit_id)
    {
        $filled_by=Auth::user()->id;
        $filled_for=$member_id;

        $member_details = User::where('users.id',$filled_for)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        /*fetch all hr data*/
        $hr_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->get();

        $hr_one_on_one_details = AnnualReviewHrOneOnOne::where('id',$edit_id)
        ->where('filled_for',$filled_for)
        ->where('annual_review_form_id',$survey_form_id)
        ->first();
        //dd($hr_one_on_one_details);

        $current_year=date('y');
        $next_year=$current_year+1;
        $fy=$current_year.'-'.$next_year;

        return view('annual-review-hr-one-on-one-form-edit', compact('edit_id','survey_form_id','filled_by','filled_for','member_details','designation_names','hr_details','hr_one_on_one_details','fy'));
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

        $pip_start_date='';
        $pip_end_date='';
        $designation_id_promotion='';

        if($request['submit']=='Save in Draft'){
            $status='1';

        } else if($request['submit']=='Publish'){

            $request->validate([
                'put_ever_pip' => 'required',
                'hr_id_taking_this_1_1' => 'required',
                'Which_level_place_yourself' => 'required',
                'total_expected_increment_monthly_salary' => 'required',
                'hr_notes' => 'required',
                'share_your_accomplishments' => 'required',
                'share_issues_challenges_impact_work' => 'required',
                'openly_share_issues_need_closures' => 'required',
                'see_yourself_moving_ahead_next_year' => 'required',
                'any_additional_feedback_wish_to_share' => 'required',
            ], [
                'put_ever_pip.required' => 'Required',
                'hr_id_taking_this_1_1.required' => 'Name of the member HR is required',
                'Which_level_place_yourself.required' => 'Required',
                'total_expected_increment_monthly_salary.required' => 'Required',
                'hr_notes.required' => 'Required',
                'share_your_accomplishments.required' => 'Required',
                'share_issues_challenges_impact_work.required' => 'Required',
                'openly_share_issues_need_closures.required' => 'Required',
                'see_yourself_moving_ahead_next_year.required' => 'Required',
                'any_additional_feedback_wish_to_share.required' => 'Required',
            ]);

            if($request->put_ever_pip!='No'){
                $request->validate([
                    'pip_start_date' => 'required',
                    'pip_end_date' => 'required',
                ], [
                    'pip_start_date.required' => 'PIP start date is required',
                    'pip_end_date.required' => 'PIP end date is required',
                ]);

            } 

            if($request->promotion_in_designation!='No'){
                $request->validate([
                    'designation_id_promotion' => 'required',
                ], [
                    'designation_id_promotion.required' => 'Required',
                ]);

            } 

            $status='2';
        }

        if($request->put_ever_pip!='No'){
            $pip_start_date=$request->pip_start_date;
            $pip_end_date=$request->pip_end_date;
        } 

        if($request->promotion_in_designation!='No'){
            $designation_id_promotion=$request->designation_id_promotion;
        }


        $edit_id=$request->edit_id;
        $annual_review_form_id=$request->annual_review_form_id;
        $filled_by=$request->filled_by;
        $filled_for=$request->filled_for;

        AnnualReviewHrOneOnOne::where('id', $edit_id)
        ->where('annual_review_form_id', $annual_review_form_id)
        ->where('filled_for', $filled_for)
        ->update([
            'filled_by' => $filled_by,
            'put_ever_pip' => $request->put_ever_pip,
            'pip_start_date' => $pip_start_date,
            'pip_end_date' => $pip_end_date,
            'member_appraisal_cycle' => $request->member_appraisal_cycle,
            'hr_id_taking_this_1_1' => $request->hr_id_taking_this_1_1,
            'Which_level_place_yourself' => $request->Which_level_place_yourself,
            'current_monthly_salary' => $request->current_monthly_salary,
            'current_annual_salary' => $request->current_annual_salary,
            'total_expected_increment_monthly_salary' => $request->total_expected_increment_monthly_salary,
            'total_expected_increment_monthly_salary_percentage' => $request->total_expected_increment_monthly_salary_percentage,
            'total_expected_increment_monthly_salary_percentage' => $request->total_expected_increment_monthly_salary_percentage,
            'hr_notes' => $request->hr_notes,
            'promotion_in_designation' => $request->promotion_in_designation,
            'designation_id_promotion' => $designation_id_promotion,
            'share_your_accomplishments' => $request->share_your_accomplishments,
            'share_issues_challenges_impact_work' => $request->share_issues_challenges_impact_work,
            'openly_share_issues_need_closures' => $request->openly_share_issues_need_closures,
            'see_yourself_moving_ahead_next_year' => $request->see_yourself_moving_ahead_next_year,
            'any_additional_feedback_wish_to_share' => $request->any_additional_feedback_wish_to_share,
            'fy' => $request->fy,
            'status' => $status,
        ]);

        
        if($status==1){
                
            return redirect("/annual-review-hr-one-on-one-form-edit/$annual_review_form_id/$filled_for/$edit_id")->with('thank_you', 'Your form save in draft.');

        } else if($status==2){

            return redirect("/annual-review-hr-one-on-one-form-show/$annual_review_form_id/$filled_for/$edit_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetails($survey_form_id, $filled_for, $id)
    {
        $filled_by=Auth::user()->id;

        $member_details = User::where('users.id',$filled_for)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();


        $hr_one_on_one_details = AnnualReviewHrOneOnOne::where('annual_review_hr_one_on_ones.id',$id)
        ->where('annual_review_hr_one_on_ones.filled_for',$filled_for)
        ->where('annual_review_hr_one_on_ones.annual_review_form_id',$survey_form_id)
        ->leftJoin('designations', 'designations.id', '=', 'annual_review_hr_one_on_ones.designation_id_promotion')
        ->leftJoin('users', 'users.id', '=', 'annual_review_hr_one_on_ones.hr_id_taking_this_1_1')
        ->select('annual_review_hr_one_on_ones.*', 'designations.name as designation_name_for_promotion', DB::raw('CONCAT(first_name, " ", last_name) AS hr_full_name'))
        ->first();
        //dd($hr_one_on_one_details);

        return view('annual-review-hr-one-on-one-form-show', compact('member_details','hr_one_on_one_details'));
    }
}
