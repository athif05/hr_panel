<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\CompanyName;
use App\Models\JobOpeningTypes;
use App\Models\UserRecruitmentForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Auth;

class UserRecruitmentFormController extends Controller
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


        $job_opening_types = JobOpeningTypes::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        //dd($company_names);

        /*check record is exist or not*/
        $find = UserRecruitmentForm::where('user_id', $user_id)->first();
        

        if(($find === null) or (($find['status'] === '0') or ($find['status'] === ''))){

            return view('recruitment-survey', compact('company_names', 'job_opening_types'));

        } else if($find['status'] === '1'){

            //dd($find['status']);

            return redirect("/recruitment-survey-edit/$find->user_id")->with('thank_you', 'Your form save in draft.');

        } else if($find['status'] === '2'){

            ///return redirect('/thank-you')->with('thank_you', 'Alert, you have already submit interview survey form.');

            return view('recruitment-survey-form-data', compact('company_names','job_opening_types', 'find'));
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
        $request->validate([
            'your_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
            'member_id' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'company_name' => 'required',
            'date_of_joining' => 'required',
            'how_come_for_job_opening' => 'required',
            'name_of_your_recruiter' => 'required|max:100',
            'professionalism' => 'required',
            'friendliness' => 'required',
            'length_time_spent_talking' => 'required',
            'company_knowledge' => 'required',
            'specific_knowledge_job_profile' => 'required',
            'timely_response_email_phone' => 'required',
            'company_policies_procedures' => 'required',
            'manager_expectation_setting' => 'required',
            'job_duties_responsibilities' => 'required',
            'job_title_properly_named' => 'required',
            'mission_for_first_year' => 'required',
            'aim_in_second_year' => 'required',
            'aim_third_year_tenure' => 'required',
            'rate_overall_recruitment_process' => 'required',
            'additional_feedback_recruitment_process' => 'required',
            'rate_hr_induction' => 'required',
            'additional_feedback_hr_induction' => 'required',
        ], [
            'your_name.required' => 'Name is required',
            'member_id.required' => 'Member ID is required',
            'designation.required' => 'Designation is required',
            'department.required' => 'Department name is required',
            'company_name.required' => 'Company name is required',
            'date_of_joining.required' => 'Date of joining is required',
            'how_come_for_job_opening.required' => 'Learn about job opening is required',
            'name_of_your_recruiter.required' => 'Name of your recruiter is required',
            'professionalism.required' => 'Please rate...',
            'friendliness.required' => 'Please rate...',
            'length_time_spent_talking.required' => 'Please rate...',
            'company_knowledge.required' => 'Please rate...',
            'specific_knowledge_job_profile.required' => 'Please rate...',
            'timely_response_email_phone.required' => 'Please rate...',
            'company_policies_procedures.required' => 'Yes or No...',
            'manager_expectation_setting.required' => 'Yes or No',
            'job_duties_responsibilities.required' => 'Yes or No',
            'job_title_properly_named.required' => 'Yes or No',
            'mission_for_first_year.required' => 'Mission for first year is required',
            'aim_in_second_year.required' => 'AIM in second year is required',
            'aim_third_year_tenure.required' => 'AIM third year tenure is required',
            'rate_overall_recruitment_process.required' => 'Please rate...',
            'additional_feedback_recruitment_process.required' => 'Additional feedback recruitment process is required',
            'rate_hr_induction.required' => 'Please rate...',
            'additional_feedback_hr_induction.required' => 'Additional feedback for HR induction is required',
        ]);



        if($request->how_come_for_job_opening=='1'){
            $request->validate([
                'internal_employee_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'internal_employee_designation' => 'required|max:100',
                'internal_employee_department' => 'required|max:100',
            ], [
                'internal_employee_name.required' => 'Employee name is required',
                'internal_employee_designation.required' => 'Eployee designation is required',
                'internal_employee_department.required' => 'Employee department is required',
            ]);
        }


        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            $status='2';
        }

        $input = UserRecruitmentForm::insert([
            'user_id' => $request->user_id,
            'your_name' => $request->your_name,
            'member_id' => $request->member_id,
            'designation' => $request->designation,
            'department' => $request->department,
            'company_name' => $request->company_name,
            'date_of_joining' => $request->date_of_joining,
            'how_come_for_job_opening' => $request->how_come_for_job_opening,
            'internal_employee_name' => $request->internal_employee_name,
            'internal_employee_designation' => $request->internal_employee_designation,
            'internal_employee_department' => $request->internal_employee_department,
            'name_of_your_recruiter' => $request->name_of_your_recruiter,
            'professionalism' => $request->professionalism,
            'friendliness' => $request->friendliness,
            'length_time_spent_talking' => $request->length_time_spent_talking,
            'company_knowledge' => $request->company_knowledge,
            'specific_knowledge_job_profile' => $request->specific_knowledge_job_profile,
            'timely_response_email_phone' => $request->timely_response_email_phone,
            'company_policies_procedures' => $request->company_policies_procedures,
            'manager_expectation_setting' => $request->manager_expectation_setting,
            'job_duties_responsibilities' => $request->job_duties_responsibilities,
            'job_title_properly_named' => $request->job_title_properly_named,
            'mission_for_first_year' => $request->mission_for_first_year,
            'aim_in_second_year' => $request->aim_in_second_year,
            'aim_third_year_tenure' => $request->aim_third_year_tenure,
            'rate_overall_recruitment_process' => $request->rate_overall_recruitment_process,
            'additional_feedback_recruitment_process' => $request->additional_feedback_recruitment_process,
            'rate_hr_induction' => $request->rate_hr_induction,
            'additional_feedback_hr_induction' => $request->additional_feedback_hr_induction,
            'status' => $status,
        ]);

        if($input){

            User::where('id', $request->user_id)
            ->update([
                'department' => $request->department,
            ]);
        
            
            if($status==1){

                //return redirect('/thank-you')->with('thank_you', 'Your form save in draft.');
                return back()->with('thank_you', 'Your form save in draft.');

            } else if($status==2){
                //return redirect('/thank-you')->with('thank_you', 'Thanks, for giving your valuable time for us.');

                return redirect('/recruitment-survey')->with('thank_you', 'Thanks, for giving your valuable time for us.');
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

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $job_opening_types = JobOpeningTypes::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        //dd($company_names);

        /*check record is exist or not*/
        $form_details = UserRecruitmentForm::where('user_id', $id)->first();
        
        return view('recruitment-survey-edit', compact('company_names','job_opening_types','form_details'));
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
        $request->validate([
            'your_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
            'member_id' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'company_name' => 'required',
            'date_of_joining' => 'required',
            'how_come_for_job_opening' => 'required',
            'name_of_your_recruiter' => 'required|max:100',
            'professionalism' => 'required',
            'friendliness' => 'required',
            'length_time_spent_talking' => 'required',
            'company_knowledge' => 'required',
            'specific_knowledge_job_profile' => 'required',
            'timely_response_email_phone' => 'required',
            'company_policies_procedures' => 'required',
            'manager_expectation_setting' => 'required',
            'job_duties_responsibilities' => 'required',
            'job_title_properly_named' => 'required',
            'mission_for_first_year' => 'required',
            'aim_in_second_year' => 'required',
            'aim_third_year_tenure' => 'required',
            'rate_overall_recruitment_process' => 'required',
            'additional_feedback_recruitment_process' => 'required',
            'rate_hr_induction' => 'required',
            'additional_feedback_hr_induction' => 'required',
        ], [
            'your_name.required' => 'Name is required',
            'member_id.required' => 'Member ID is required',
            'designation.required' => 'Designation is required',
            'department.required' => 'Department name is required',
            'company_name.required' => 'Company name is required',
            'date_of_joining.required' => 'Date of joining is required',
            'how_come_for_job_opening.required' => 'Learn about job opening is required',
            'name_of_your_recruiter.required' => 'Name of your recruiter is required',
            'professionalism.required' => 'Please rate...',
            'friendliness.required' => 'Please rate...',
            'length_time_spent_talking.required' => 'Please rate...',
            'company_knowledge.required' => 'Please rate...',
            'specific_knowledge_job_profile.required' => 'Please rate...',
            'timely_response_email_phone.required' => 'Please rate...',
            'company_policies_procedures.required' => 'Yes or No...',
            'manager_expectation_setting.required' => 'Yes or No',
            'job_duties_responsibilities.required' => 'Yes or No',
            'job_title_properly_named.required' => 'Yes or No',
            'mission_for_first_year.required' => 'Mission for first year is required',
            'aim_in_second_year.required' => 'AIM in second year is required',
            'aim_third_year_tenure.required' => 'AIM third year tenure is required',
            'rate_overall_recruitment_process.required' => 'Please rate...',
            'additional_feedback_recruitment_process.required' => 'Additional feedback recruitment process is required',
            'rate_hr_induction.required' => 'Please rate...',
            'additional_feedback_hr_induction.required' => 'Additional feedback for HR induction is required',
        ]);



        if($request->how_come_for_job_opening=='1'){
            $request->validate([
                'internal_employee_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'internal_employee_designation' => 'required|max:100',
                'internal_employee_department' => 'required|max:100',
            ], [
                'internal_employee_name.required' => 'Employee name is required',
                'internal_employee_designation.required' => 'Eployee designation is required',
                'internal_employee_department.required' => 'Employee department is required',
            ]);
        }

        if($request->how_come_for_job_opening=='1'){
            $internal_employee_name=$request->internal_employee_name;
            $internal_employee_designation=$request->internal_employee_designation;
            $internal_employee_department=$request->internal_employee_department;
        } else {
            $internal_employee_name='';
            $internal_employee_designation='';
            $internal_employee_department='';
        }


        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            $status='2';
        }

        UserRecruitmentForm::where('user_id', $request->user_id)
        ->update([
            'your_name' => $request->your_name,
            'member_id' => $request->member_id,
            'designation' => $request->designation,
            'department' => $request->department,
            'company_name' => $request->company_name,
            'date_of_joining' => $request->date_of_joining,
            'how_come_for_job_opening' => $request->how_come_for_job_opening,
            'internal_employee_name' => $internal_employee_name,
            'internal_employee_designation' => $internal_employee_designation,
            'internal_employee_department' => $internal_employee_department,
            'name_of_your_recruiter' => $request->name_of_your_recruiter,
            'professionalism' => $request->professionalism,
            'friendliness' => $request->friendliness,
            'length_time_spent_talking' => $request->length_time_spent_talking,
            'company_knowledge' => $request->company_knowledge,
            'specific_knowledge_job_profile' => $request->specific_knowledge_job_profile,
            'timely_response_email_phone' => $request->timely_response_email_phone,
            'company_policies_procedures' => $request->company_policies_procedures,
            'manager_expectation_setting' => $request->manager_expectation_setting,
            'job_duties_responsibilities' => $request->job_duties_responsibilities,
            'job_title_properly_named' => $request->job_title_properly_named,
            'mission_for_first_year' => $request->mission_for_first_year,
            'aim_in_second_year' => $request->aim_in_second_year,
            'aim_third_year_tenure' => $request->aim_third_year_tenure,
            'rate_overall_recruitment_process' => $request->rate_overall_recruitment_process,
            'additional_feedback_recruitment_process' => $request->additional_feedback_recruitment_process,
            'rate_hr_induction' => $request->rate_hr_induction,
            'additional_feedback_hr_induction' => $request->additional_feedback_hr_induction,
            'status' => $status,
        ]);


        User::where('id', $request->user_id)
        ->update([
            'department' => $request->department,
        ]);
    

        if($status==1){

            return back()->with('thank_you', 'Your form save in draft');

        } else if($status==2){

            return redirect('/recruitment-survey')->with('thank_you', 'Thanks, for giving your valuable time for us.');
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
