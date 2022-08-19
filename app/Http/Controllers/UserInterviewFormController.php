<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\CompanyName;
use App\Models\CompanyLocation;
use App\Models\JobOpeningTypes;
use App\Models\UserInterviewForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Auth;

class UserInterviewFormController extends Controller
{

    /*this function is used for show interview survey details in confirmation process and mom email steps*/
    public function interviewSurvey($id) {

        $employee_id=$id;

        $inteview_details = UserInterviewForm::where('user_interview_forms.user_id', $id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'user_interview_forms.location_name')
        ->leftJoin('company_names', 'company_names.id', '=', 'user_interview_forms.company_name')
        ->leftJoin('job_opening_types', 'job_opening_types.id', '=', 'user_interview_forms.learn_about_job_opening')
        ->select('user_interview_forms.*', 'company_locations.name as location_name', 'company_names.name as company_name', 'job_opening_types.name as job_opening_types_name')
        ->first();
        return view('confirmation-process.interview-survey', compact('employee_id','inteview_details'));
    }


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

        //dd($company_names);

        /*check record is exist or not*/
        $find = UserInterviewForm::where('user_id', $user_id)->first();
        

        if(($find === null) or (($find['status'] === '0') or ($find['status'] === ''))){

            return view('interview-survey', compact('company_names','company_locations','job_opening_types'));

        } else if($find['status'] === '1'){

            return redirect("/interview-survey-edit/$find->user_id")->with('thank_you', 'Your form save in draft.');

        } else if($find['status'] === '2'){

            ///return redirect('/thank-you')->with('thank_you', 'Alert, you have already submit interview survey form.');

            return view('interview-survey-form-data', compact('company_names','company_locations','job_opening_types', 'find'));
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

        //dd($request['submit']);

        $request->validate([
            'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
            'official_email' => 'required|max:50|email',
            'company_name' => 'required',
            'job_position_name' => 'required',
            'location_name' => 'required',
            'learn_about_job_opening' => 'required',
            'referral_source_name' => 'required|max:100',
            'company_hr_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
            'approachable' => 'required',
            'respectful' => 'required',
            'explain_job_role' => 'required',
            'explain_company_background' => 'required',
            'shared_proper_interview_information' => 'required',
            'discussed_my_profile' => 'required',
            'shared_interview_feedback_quickly' => 'required',
            'additional_feedback_recruiter' => 'required',
            'rate_overall_conduct' => 'required',
            'professionalism' => 'required',
            'friendliness' => 'required',
            'heplful' => 'required',
            'approachable_interviewers' => 'required',
            'respectable' => 'required',
            'knowledgeable' => 'required',
            'clear_communication_about_company' => 'required',
            'clear_communication_job_role' => 'required',
            'process_started_on_time' => 'required',
            'process_fair_apt' => 'required',
            'seating_arrangement_comfortable' => 'required',
            'staff_helpful_supportive' => 'required',
            'received_interview_feedback' => 'required',
            'define_overall_interview_process' => 'required',
            'rate_overall_interview_process' => 'required',
            'comments_suggestions_feedback' => 'required',
        ], [
            'member_name.required' => 'Name is required',
            'official_email.required' => 'Official email is required',
            'company_name.required' => 'Company name is required',
            'job_position_name.required' => 'Job position name is required',
            'location_name.required' => 'Location name is required',
            'learn_about_job_opening.required' => 'Learn about job opening is required',
            'referral_source_name.required' => 'Referral source name is required',
            'company_hr_name.required' => 'Company HR name is required',
            'approachable.required' => 'Please rate...',
            'respectful.required' => 'Please rate...',
            'explain_job_role.required' => 'Please rate...',
            'explain_company_background.required' => 'Please rate...',
            'shared_proper_interview_information.required' => 'Please rate...',
            'discussed_my_profile.required' => 'Please rate...',
            'shared_interview_feedback_quickly.required' => 'Please rate...',
            'additional_feedback_recruiter.required' => 'Additional feedback for recruiter is required',
            'rate_overall_conduct.required' => 'Please rate...',
            'professionalism.required' => 'Please rate...',
            'friendliness.required' => 'Please rate...',
            'heplful.required' => 'Please rate...',
            'approachable_interviewers.required' => 'Please rate...',
            'respectable.required' => 'Please rate...',
            'knowledgeable.required' => 'Please rate...',
            'clear_communication_about_company.required' => 'Please rate...',
            'clear_communication_job_role.required' => 'Please rate...',
            'process_started_on_time.required' => 'Please rate...',
            'process_fair_apt.required' => 'Please rate...',
            'seating_arrangement_comfortable.required' => 'Please rate...',
            'staff_helpful_supportive.required' => 'Please rate...',
            'received_interview_feedback.required' => 'Please rate...',
            'define_overall_interview_process.required' => 'Define overall interview process is required',
            'rate_overall_interview_process.required' => 'Please rate...',
            'comments_suggestions_feedback.required' => 'Comments, suggestions or feedback is required',
        ]);


        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            $status='2';
        }

        $input = UserInterviewForm::insert([
            'user_id' => $request->user_id,
            'member_name' => $request->member_name,
            'official_email' => $request->official_email,
            'company_name' => $request->company_name,
            'job_position_name' => $request->job_position_name,
            'location_name' => $request->location_name,
            'learn_about_job_opening' => $request->learn_about_job_opening,
            'referral_source_name' => $request->referral_source_name,
            'company_hr_name' => $request->company_hr_name,
            'approachable' => $request->approachable,
            'respectful' => $request->respectful,
            'explain_job_role' => $request->explain_job_role,
            'explain_company_background' => $request->explain_company_background,
            'shared_proper_interview_information' => $request->shared_proper_interview_information,
            'discussed_my_profile' => $request->discussed_my_profile,
            'shared_interview_feedback_quickly' => $request->shared_interview_feedback_quickly,
            'additional_feedback_recruiter' => $request->additional_feedback_recruiter,
            'rate_overall_conduct' => $request->rate_overall_conduct,
            'professionalism' => $request->professionalism,
            'friendliness' => $request->friendliness,
            'heplful' => $request->heplful,
            'approachable_interviewers' => $request->approachable_interviewers,
            'respectable' => $request->respectable,
            'knowledgeable' => $request->knowledgeable,
            'clear_communication_about_company' => $request->clear_communication_about_company,
            'clear_communication_job_role' => $request->clear_communication_job_role,
            'process_started_on_time' => $request->process_started_on_time,
            'process_fair_apt' => $request->process_fair_apt,
            'seating_arrangement_comfortable' => $request->seating_arrangement_comfortable,
            'staff_helpful_supportive' => $request->staff_helpful_supportive,
            'received_interview_feedback' => $request->received_interview_feedback,
            'define_overall_interview_process' => $request->define_overall_interview_process,
            'rate_overall_interview_process' => $request->rate_overall_interview_process,
            'comments_suggestions_feedback' => $request->comments_suggestions_feedback,
            'status' => $status,
        ]);

        if($input){

            User::where('id', $request->user_id)
            ->update([
                'designation' => $request->job_position_name,
            ]);
        
            
            if($status==1){
                
                //return redirect('/thank-you')->with('thank_you', 'Your form save in draft.');
                return back()->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                //return redirect('/thank-you')->with('thank_you', 'Thanks, for giving your valuable time for us.');

                return redirect('/interview-survey')->with('thank_you', 'Thanks, for giving your valuable time for us.');

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
    public function edit($id)
    {
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

        //dd($company_names);

        /*check record is exist or not*/
        $form_details = UserInterviewForm::where('user_id', $id)->first();
        
        return view('interview-survey-edit', compact('company_names','company_locations','job_opening_types','form_details'));
        
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

        $request->validate([
            'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
            'official_email' => 'required|max:50|email',
            'company_name' => 'required',
            'job_position_name' => 'required',
            'location_name' => 'required',
            'learn_about_job_opening' => 'required',
            'referral_source_name' => 'required|max:100',
            'company_hr_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
            'approachable' => 'required',
            'respectful' => 'required',
            'explain_job_role' => 'required',
            'explain_company_background' => 'required',
            'shared_proper_interview_information' => 'required',
            'discussed_my_profile' => 'required',
            'shared_interview_feedback_quickly' => 'required',
            'additional_feedback_recruiter' => 'required',
            'rate_overall_conduct' => 'required',
            'professionalism' => 'required',
            'friendliness' => 'required',
            'heplful' => 'required',
            'approachable_interviewers' => 'required',
            'respectable' => 'required',
            'knowledgeable' => 'required',
            'clear_communication_about_company' => 'required',
            'clear_communication_job_role' => 'required',
            'process_started_on_time' => 'required',
            'process_fair_apt' => 'required',
            'seating_arrangement_comfortable' => 'required',
            'staff_helpful_supportive' => 'required',
            'received_interview_feedback' => 'required',
            'define_overall_interview_process' => 'required',
            'rate_overall_interview_process' => 'required',
            'comments_suggestions_feedback' => 'required',
        ], [
            'member_name.required' => 'Name is required',
            'official_email.required' => 'Official email is required',
            'company_name.required' => 'Company name is required',
            'job_position_name.required' => 'Job position name is required',
            'location_name.required' => 'Location name is required',
            'learn_about_job_opening.required' => 'Learn about job opening is required',
            'referral_source_name.required' => 'Referral source name is required',
            'company_hr_name.required' => 'Company HR name is required',
            'approachable.required' => 'Please rate...',
            'respectful.required' => 'Please rate...',
            'explain_job_role.required' => 'Please rate...',
            'explain_company_background.required' => 'Please rate...',
            'shared_proper_interview_information.required' => 'Please rate...',
            'discussed_my_profile.required' => 'Please rate...',
            'shared_interview_feedback_quickly.required' => 'Please rate...',
            'additional_feedback_recruiter.required' => 'Additional feedback for recruiter is required',
            'rate_overall_conduct.required' => 'Please rate...',
            'professionalism.required' => 'Please rate...',
            'friendliness.required' => 'Please rate...',
            'heplful.required' => 'Please rate...',
            'approachable_interviewers.required' => 'Please rate...',
            'respectable.required' => 'Please rate...',
            'knowledgeable.required' => 'Please rate...',
            'clear_communication_about_company.required' => 'Please rate...',
            'clear_communication_job_role.required' => 'Please rate...',
            'process_started_on_time.required' => 'Please rate...',
            'process_fair_apt.required' => 'Please rate...',
            'seating_arrangement_comfortable.required' => 'Please rate...',
            'staff_helpful_supportive.required' => 'Please rate...',
            'received_interview_feedback.required' => 'Please rate...',
            'define_overall_interview_process.required' => 'Define overall interview process is required',
            'rate_overall_interview_process.required' => 'Please rate...',
            'comments_suggestions_feedback.required' => 'Comments, suggestions or feedback is required',
        ]);


        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){
            $status='2';
        }
        //dd($status);

        DB::enableQueryLog(); //for print sql query

        UserInterviewForm::where('user_id', $request->user_id)
        ->update([
            'member_name' => $request->member_name,
            'official_email' => $request->official_email,
            'company_name' => $request->company_name,
            'job_position_name' => $request->job_position_name,
            'location_name' => $request->location_name,
            'learn_about_job_opening' => $request->learn_about_job_opening,
            'referral_source_name' => $request->referral_source_name,
            'company_hr_name' => $request->company_hr_name,
            'approachable' => $request->approachable,
            'respectful' => $request->respectful,
            'explain_job_role' => $request->explain_job_role,
            'explain_company_background' => $request->explain_company_background,
            'shared_proper_interview_information' => $request->shared_proper_interview_information,
            'discussed_my_profile' => $request->discussed_my_profile,
            'shared_interview_feedback_quickly' => $request->shared_interview_feedback_quickly,
            'additional_feedback_recruiter' => $request->additional_feedback_recruiter,
            'rate_overall_conduct' => $request->rate_overall_conduct,
            'professionalism' => $request->professionalism,
            'friendliness' => $request->friendliness,
            'heplful' => $request->heplful,
            'approachable_interviewers' => $request->approachable_interviewers,
            'respectable' => $request->respectable,
            'knowledgeable' => $request->knowledgeable,
            'clear_communication_about_company' => $request->clear_communication_about_company,
            'clear_communication_job_role' => $request->clear_communication_job_role,
            'process_started_on_time' => $request->process_started_on_time,
            'process_fair_apt' => $request->process_fair_apt,
            'seating_arrangement_comfortable' => $request->seating_arrangement_comfortable,
            'staff_helpful_supportive' => $request->staff_helpful_supportive,
            'received_interview_feedback' => $request->received_interview_feedback,
            'define_overall_interview_process' => $request->define_overall_interview_process,
            'rate_overall_interview_process' => $request->rate_overall_interview_process,
            'comments_suggestions_feedback' => $request->comments_suggestions_feedback,
            'status' => $status
        ]);

        User::where('id', $request->user_id)
        ->update([
            'designation' => $request->job_position_name,
        ]);

        /*for print sql query, start here */
        //$quries = DB::getQueryLog();
        //dd($quries);

        if($status=='1'){
            
            //return redirect('/thank-you')->with('thank_you', 'Your form save in draft.');
            return back()->with('thank_you', 'Your form save in draft');

        } else if($status=='2'){
            
            //return redirect('/thank-you')->with('thank_you', 'Thanks, for giving your valuable time for us.');
            return redirect('/interview-survey')->with('thank_you', 'Thanks, for giving your valuable time for us.');
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
