<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\{AnnualReviewStakeholder, User, CompanyName, Designation, Department, CompanyLocation};

use Auth;

class AnnualReviewStakeholderController extends Controller
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

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $department_names = Department::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $company_locations = CompanyLocation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $stackholder_feedback_details=AnnualReviewStakeholder::get();

        //dd($stackholder_feedback_details); die;

        return view('annual-review-stakeholder-list', compact('annual_review_form_id','all_members','company_names','department_names','designation_names','company_locations','stackholder_feedback_details'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function openForm($survey_form_id, $member_id)
    {

        $filled_by=Auth::user()->id;
        $filled_for=$member_id;


        $member_details= User::where('users.id',$member_id)
            ->leftJoin('company_names','company_names.id','=','users.company_id')
            ->leftJoin('departments','departments.id','=','users.department')
            ->leftJoin('designations','designations.id','=','users.designation')
            ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
            ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
            ->first();


            $manager_details= User::where('users.id',$filled_by)
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
            $stackholder_feedback_details = AnnualReviewStakeholder::where('filled_for', $filled_for)
            ->where('filled_by', $filled_by)
            ->first();
            

            if(($stackholder_feedback_details === null) or (($stackholder_feedback_details['status'] === '0') or ($stackholder_feedback_details['status'] === ''))) {

                return view('annul-review-stakeholder-feedback-form', compact('filled_by','filled_for','survey_form_id','member_details','manager_details','company_names','designation_names','department_names','company_locations'));

            } else if($stackholder_feedback_details['status'] === '1') {

                $edit_id=$stackholder_feedback_details['id'];
                return redirect("/annual-review-stakeholder-feedback-form-edit/$survey_form_id/$member_id/$edit_id");

            } else if($stackholder_feedback_details['status'] === '2') {

                return view('annual-review-stakeholder-feedback-show', compact('member_details','manager_details','company_names','designation_names','department_names','company_locations','stackholder_feedback_details'));
            }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filled_for=$request->filled_for;
        $filled_by=$request->filled_by;
        $annual_review_form_id=$request->annual_review_form_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            
            $request->validate([
                'quality_of_the_work' => 'required',
                'tat_adherence' => 'required',
                'ability_to_understand_project_requirements' => 'required',
                'ability_to_absorb_feedback' => 'required',
                'responsiveness_on_all_platforms' => 'required',
                'how_happy_you_with_performance' => 'required',
                'three_qualities_1' => 'required',
                'three_qualities_2' => 'required',
                'three_qualities_3' => 'required',
                'three_areas_of_improvement_1' => 'required',
                'three_areas_of_improvement_2' => 'required',
                'three_areas_of_improvement_3' => 'required',
                'any_additional_feedback' => 'required',
            ], [
                'quality_of_the_work.required' => 'Please rate...',
                'tat_adherence.required' => 'Please rate...',
                'ability_to_understand_project_requirements.required' => 'Please rate...',
                'ability_to_absorb_feedback.required' => 'Please rate...',
                'responsiveness_on_all_platforms.required' => 'Please rate...',
                'how_happy_you_with_performance.required' => 'Please rate...',
                'three_qualities_1.required' => 'Qualities 1 is required',
                'three_qualities_2.required' => 'Qualities 2 is required',
                'three_qualities_3.required' => 'Qualities 3 is required',
                'three_areas_of_improvement_1.required' => 'Areas of improvement 1 is required',
                'three_areas_of_improvement_2.required' => 'Areas of improvement 2 is required',
                'three_areas_of_improvement_3.required' => 'Areas of improvement 3 is required',
                'any_additional_feedback.required' => 'Any additional feedback is required',
            ]);

            $status='2';
        }


        $input = AnnualReviewStakeholder::insert([
            'filled_by' => $filled_by,
            'filled_for' => $filled_for,
            'annual_review_form_id' => $annual_review_form_id,
            'quality_of_the_work' => (!is_null($request->quality_of_the_work) ? $request->quality_of_the_work : ""),
            'tat_adherence' => (!is_null($request->tat_adherence) ? $request->tat_adherence : ""),
            'ability_to_understand_project_requirements' => (!is_null($request->ability_to_understand_project_requirements) ? $request->ability_to_understand_project_requirements : ""),
            'ability_to_absorb_feedback' => (!is_null($request->ability_to_absorb_feedback) ? $request->ability_to_absorb_feedback : ""),
            'responsiveness_on_all_platforms' => (!is_null($request->responsiveness_on_all_platforms) ? $request->responsiveness_on_all_platforms : ""),
            'how_happy_you_with_performance' => (!is_null($request->how_happy_you_with_performance) ? $request->how_happy_you_with_performance : ""),
            'three_qualities_1' => $request->three_qualities_1,
            'three_qualities_2' => $request->three_qualities_2,
            'three_qualities_3' => $request->three_qualities_3,
            'three_areas_of_improvement_1' => $request->three_areas_of_improvement_1,
            'three_areas_of_improvement_2' => $request->three_areas_of_improvement_2,
            'three_areas_of_improvement_3' => $request->three_areas_of_improvement_3,
            'any_additional_feedback' => $request->any_additional_feedback,
            'status' => $status,
        ]);

        $last_id = DB::getPdo()->lastInsertId();

        if($last_id){
            
            if($status==1){
                
                //return redirect("/stake-holder-feedback-form-edit/$member_id/$last_id")->with('thank_you', 'Your form save in draft.');
                return redirect("/annual-review-stakeholder-feedback-form-edit/$annual_review_form_id/$filled_for/$last_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                return redirect("/annual-review-stakeholder-feedback-show/$annual_review_form_id/$filled_for")->with('thank_you', 'Thanks, for giving your valuable time for us.');

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($survey_form_id, $member_id)
    {

        $own_id=Auth::user()->id;


        if($member_id!=$own_id) {

            $member_details= User::where('users.id',$member_id)
            ->leftJoin('company_names','company_names.id','=','users.company_id')
            ->leftJoin('departments','departments.id','=','users.department')
            ->leftJoin('designations','designations.id','=','users.designation')
            ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
            ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
            ->first();


            $manager_details= User::where('users.id',$own_id)
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
            $stackholder_feedback_details = AnnualReviewStakeholder::where('filled_for', $member_id)
            ->where('filled_by', $own_id)
            ->first();
            
            return view('annual-review-stakeholder-feedback-show', compact('member_details','manager_details','company_names','designation_names','department_names','company_locations','stackholder_feedback_details'));
            

        } else {
            return view('no-access-page');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($form_id, $member_id, $edit_id)
    {
        $filled_for=$member_id;
        $filled_by=Auth::user()->id;
        $survey_form_id=$form_id;
        $edit_id=$edit_id;

        $member_details= User::where('users.id',$filled_for)
        ->leftJoin('company_names','company_names.id','=','users.company_id')
        ->leftJoin('departments','departments.id','=','users.department')
        ->leftJoin('designations','designations.id','=','users.designation')
        ->leftJoin('company_locations','company_locations.id','=','users.company_location_id')
        ->select('users.*', 'company_names.name as company_name', 'departments.name as department_name', 'designations.name as designation_name', 'company_locations.name as location_name', DB::raw('CONCAT(first_name, " ", last_name) AS full_name'))
        ->first();


        $manager_details= User::where('users.id',$filled_by)
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
        $stackholder_feedback_details = AnnualReviewStakeholder::where('id', $edit_id)
        ->where('filled_for', $filled_for)
        ->where('filled_by', $filled_by)
        ->first();

        if($stackholder_feedback_details['status'] === '1') {

            return view("annual-review-stakeholder-feedback-form-edit", compact('filled_by','filled_for','survey_form_id','member_details','manager_details','company_names','designation_names','department_names','company_locations','stackholder_feedback_details'));

        } else if($stackholder_feedback_details['status'] === '2') {

            return redirect("/annual-review-stakeholder-feedback-show/$annual_review_form_id/$filled_for")->with('thank_you', 'Thanks, for giving your valuable time for us.');
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
        //dd($request);

        $edit_id=$request->edit_id;
        $filled_for=$request->filled_for;
        $filled_by=$request->filled_by;
        $annual_review_form_id=$request->annual_review_form_id;

        if($request['submit']=='Save in Draft') {
            $status='1';
        } else if($request['submit']=='Publish') {
            
            $request->validate([
                'quality_of_the_work' => 'required',
                'tat_adherence' => 'required',
                'ability_to_understand_project_requirements' => 'required',
                'ability_to_absorb_feedback' => 'required',
                'responsiveness_on_all_platforms' => 'required',
                'how_happy_you_with_performance' => 'required',
                'three_qualities_1' => 'required',
                'three_qualities_2' => 'required',
                'three_qualities_3' => 'required',
                'three_areas_of_improvement_1' => 'required',
                'three_areas_of_improvement_2' => 'required',
                'three_areas_of_improvement_3' => 'required',
                'any_additional_feedback' => 'required',
            ], [
                'quality_of_the_work.required' => 'Please rate...',
                'tat_adherence.required' => 'Please rate...',
                'ability_to_understand_project_requirements.required' => 'Please rate...',
                'ability_to_absorb_feedback.required' => 'Please rate...',
                'responsiveness_on_all_platforms.required' => 'Please rate...',
                'how_happy_you_with_performance.required' => 'Please rate...',
                'three_qualities_1.required' => 'Qualities 1 is required',
                'three_qualities_2.required' => 'Qualities 2 is required',
                'three_qualities_3.required' => 'Qualities 3 is required',
                'three_areas_of_improvement_1.required' => 'Areas of improvement 1 is required',
                'three_areas_of_improvement_2.required' => 'Areas of improvement 2 is required',
                'three_areas_of_improvement_3.required' => 'Areas of improvement 3 is required',
                'any_additional_feedback.required' => 'Any additional feedback is required',
            ]);

            $status='2';
        }


        $input = AnnualReviewStakeholder::where('id', $edit_id)
        ->where('filled_by', $filled_by)
        ->where('filled_for', $filled_for)
        ->update([
            'annual_review_form_id' => $annual_review_form_id,
            'quality_of_the_work' => (!is_null($request->quality_of_the_work) ? $request->quality_of_the_work : ""),
            'tat_adherence' => (!is_null($request->tat_adherence) ? $request->tat_adherence : ""),
            'ability_to_understand_project_requirements' => (!is_null($request->ability_to_understand_project_requirements) ? $request->ability_to_understand_project_requirements : ""),
            'ability_to_absorb_feedback' => (!is_null($request->ability_to_absorb_feedback) ? $request->ability_to_absorb_feedback : ""),
            'responsiveness_on_all_platforms' => (!is_null($request->responsiveness_on_all_platforms) ? $request->responsiveness_on_all_platforms : ""),
            'how_happy_you_with_performance' => (!is_null($request->how_happy_you_with_performance) ? $request->how_happy_you_with_performance : ""),
            'three_qualities_1' => $request->three_qualities_1,
            'three_qualities_2' => $request->three_qualities_2,
            'three_qualities_3' => $request->three_qualities_3,
            'three_areas_of_improvement_1' => $request->three_areas_of_improvement_1,
            'three_areas_of_improvement_2' => $request->three_areas_of_improvement_2,
            'three_areas_of_improvement_3' => $request->three_areas_of_improvement_3,
            'any_additional_feedback' => $request->any_additional_feedback,
            'status' => $status,
        ]);


        if($status==1){
                
            return redirect("/annual-review-stakeholder-feedback-form-edit/$annual_review_form_id/$filled_for/$edit_id")->with('thank_you', 'Your form save in draft.');

        } else if($status==2){

            return redirect("/annual-review-stakeholder-feedback-show/$annual_review_form_id/$filled_for")->with('thank_you', 'Thanks, for giving your valuable time for us.');

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
