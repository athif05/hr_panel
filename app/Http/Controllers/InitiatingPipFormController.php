<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\InitiatingPipForm;
use App\Models\ConfirmationMom;
use App\Models\{CompanyName, Designation, Department, CompanyLocation, JobOpeningTypes};

use Carbon\Carbon; //for get current time
use Mail; //for send mail
use Config; //use custom field from .env file
use Auth;

class InitiatingPipFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*show single member pip details to hr, start here*/
    public function hrPipView($id){

        $user_details = User::where('users.id',$id)
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_names.name as company_name','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();


        return view('hr-pip-view', compact('user_details','initiating_pip_details','confirmation_mom_details'));

    }
    /*show single member pip details to hr, end here*/


    /*show all pip member to hr, start here*/
    public function hrPip(){

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_locations = CompanyLocation::where('status', '1')
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


        $all_members = User::where('initiating_pip_forms.status','2')
        ->leftJoin('initiating_pip_forms', 'initiating_pip_forms.user_id','=','users.id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->select('users.*', 'company_locations.name as location_name','designations.name as designation_name','departments.name as department_name','company_names.name as company_name')
        ->orderBy('users.first_name','asc')->get();
        //dd($all_members);

        return view('hr-pip', compact('all_members','company_names','company_locations','designation_names','department_names'));

    }
    /*show all pip member to hr, end here*/


    /*filter all pip member to hr, start here*/
    public function hrPipFilter(Request $request){

        $company_names = CompanyName::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();


        $company_locations = CompanyLocation::where('status', '1')
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

        $query = User::where('initiating_pip_forms.status','2')
        ->leftJoin('initiating_pip_forms', 'initiating_pip_forms.user_id','=','users.id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->select('users.*', 'company_locations.name as location_name','designations.name as designation_name','departments.name as department_name','company_names.name as company_name')
        ->orderBy('users.first_name','asc');


        if($request->company_id_filter){
            $query->where('users.company_id', 'like', '%'.$request->company_id_filter.'%');
        }

        if($request->department_id_filter){
            $query->where('users.department', '=', $request->department_id_filter);
        }
        if($request->designation_id_filter){
            $query->where('users.designation', '=', $request->designation_id_filter);
        }
        if($request->location_id_filter){
            $query->where('users.company_location_id', '=', $request->location_id_filter);
        }

        $all_members = $query->get();

        return view('hr-pip', compact('all_members','company_names','company_locations','designation_names','department_names'));
    }
    /*filter all pip member to hr, end here*/


    /*show all member come under pip to manager, start here*/
    public function showAllPipMember(){
        
        $manager1=Auth::user()->member_id;

        $manager_array= app('App\Http\Controllers\UserController')->multilevel_manager($manager1);
        
        //dd($manager_array);
        
        $all_members = User::where('users.employee_type','Probation')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->where('confirmation_generate_emails.letter_type','4')
        ->leftJoin('confirmation_generate_emails','confirmation_generate_emails.user_id','=','users.id')
        ->leftJoin('initiating_pip_forms', 'initiating_pip_forms.user_id', '=', 'users.id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name','designations.name as designation_name','initiating_pip_forms.id as initiating_pip_forms_id')
        ->orderBy('users.first_name','asc')->get();
        //dd($all_members);

        return view('pip-member-list', compact('all_members'));

    }
    /*show all member come under pip to manager, end here*/


    /*manage closure pip form by manager, start here*/
    public function closurePIPIndex($id){

        $updated_by_id=Auth::user()->id;

        $user_details = User::where('users.id',$id)
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_names.name as company_name','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();


        if(($initiating_pip_details === null) or (($initiating_pip_details['closure_status'] === '0') or ($initiating_pip_details['closure_status'] === ''))){

            //return view('initiating-pip-email-form', compact('user_details'));

            return view('pip-closure-form', compact('user_details','updated_by_id','initiating_pip_details'));

        } else if($initiating_pip_details['closure_status'] === '1'){

            return redirect("/pip-closure-form-edit/$id");

        } else if($initiating_pip_details['closure_status'] === '2'){

            //return view('pip-closure-form-show', compact('user_details','initiating_pip_details'));
            return view('pip-closure-form-email-show', compact('user_details','initiating_pip_details','confirmation_mom_details'));
        }
    }
    /*manage closure pip form by manager, end here*/


    /*update closure pip form by manager, start here*/
    public function updateClosure(Request $request)
    {
        $edit_id=$request->edit_id;
        $user_id=$request->user_id;
        $updated_by_id=$request->updated_by_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){

            $request->validate([
                'final_pip_review' => 'required',
                'seen_considerable_improvemnet_performance' => 'required',
            ], [
                'final_pip_review.required' => 'Final PIP review is required',
                'seen_considerable_improvemnet_performance.required' => 'Improvemnet performance is required',
            ]);

            $status='2';
        }

        
        //DB::enableQueryLog();

        InitiatingPipForm::where('id', $edit_id)
        ->where('user_id', $user_id)
        ->update([
            'final_pip_review' => $request->final_pip_review,
            'seen_considerable_improvemnet_performance' => $request->seen_considerable_improvemnet_performance,
            'closure_status' => $status,
        ]);

        //$quries = DB::getQueryLog();
        //dd($quries);

        
            
        if($status==1){

            return redirect("/pip-closure-form-edit/$user_id")->with('thank_you', 'Your form save in draft.');

        } else if($status==2){

            return redirect("/closure-pip-email-form/$user_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

        }
        
    }
    /*update closure pip form by manager, end here*/


    
    /*edit closure pip form by manager, start here*/
    public function editClosure($id)
    {

        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();

        $user_details = User::where('users.id',$id)
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_names.name as company_name','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();

        //return view('initiating-pip-email-form-edit', compact('user_details','initiating_pip_details'));
        return view('pip-closure-form-edit', compact('user_details','initiating_pip_details'));
    }
    /*edit closure pip form by manager, end here*/



    /*manage initiation pip form by manager, start here*/
    public function index($id)
    {
        $updated_by_id=Auth::user()->id;

        $user_details = User::where('users.id',$id)
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_names.name as company_name','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();

        if(($initiating_pip_details === null) or (($initiating_pip_details['status'] === '0') or ($initiating_pip_details['status'] === ''))){

            //return view('initiating-pip-email-form', compact('user_details'));

            return view('pip-initiation-form', compact('user_details','updated_by_id'));

        } else if($initiating_pip_details['status'] === '1'){

            return redirect("/initiating-pip-email-form-edit/$id");

        } else if($initiating_pip_details['status'] === '2'){

            return view('initiating-pip-email-form-show', compact('user_details','initiating_pip_details','confirmation_mom_details'));
        }

    }
    /*manage initiation pip form by manager, end here*/

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
        $updated_by_id=$request->updated_by_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){

            $request->validate([
                'no_of_days' => 'required',
                'date_initiating_pip' => 'required',
                'closing_date_pip' => 'required',
                'issue_description_performance_behaviour' => 'required',
                'description_expected_performance' => 'required',
                'plan_of_action_to_improve' => 'required',
            ], [
                'no_of_days.required' => 'No. Of Days is required',
                'date_initiating_pip.required' => 'Date of initiating PIP is required',
                'closing_date_pip.required' => 'Closing Date of PIP is required',
                'issue_description_performance_behaviour.required' => 'Description is required',
                'description_expected_performance.required' => 'Expected performance is required',
                'plan_of_action_to_improve.required' => 'Plan of action is required',
            ]);

            $status='2';
        }

        if($request->date_initiating_pip){
            $date_initiating_pip=$request->date_initiating_pip;
        } else {
            $date_initiating_pip=null;
        }

        if($request->closing_date_pip){
            $closing_date_pip=$request->closing_date_pip;
        } else {
            $closing_date_pip=null;
        }

        //dd($pip_month);

        //DB::enableQueryLog();

        $input = InitiatingPipForm::insert([
            'user_id' => $user_id,
            'updated_by_id' => $updated_by_id,
            'member_name' => $request->member_name,
            'date_initiating_pip' => $date_initiating_pip,
            'no_of_days' => $request->no_of_days,
            'closing_date_pip' => $closing_date_pip,
            'issue_description_performance_behaviour' => $request->issue_description_performance_behaviour,
            'description_expected_performance' => $request->description_expected_performance,
            'plan_of_action_to_improve' => $request->plan_of_action_to_improve,
            'status' => $status,
        ]);

        //$quries = DB::getQueryLog();
        //dd($quries);

        if($input){
            
            if($status==1){

                return redirect("/initiating-pip-email-form-edit/$user_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                return redirect("/initiating-pip-email-form/$user_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');

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

        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();

        $user_details = User::where('users.id',$id)
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_names.name as company_name','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();


   


        //return view('initiating-pip-email-form-edit', compact('user_details','initiating_pip_details'));
        return view('pip-initiation-form-edit', compact('user_details','initiating_pip_details'));
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
        $updated_by_id=$request->updated_by_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){

            $request->validate([
                'no_of_days' => 'required',
                'date_initiating_pip' => 'required',
                'closing_date_pip' => 'required',
                'issue_description_performance_behaviour' => 'required',
                'description_expected_performance' => 'required',
                'plan_of_action_to_improve' => 'required',
            ], [
                'no_of_days.required' => 'No. Of Days is required',
                'date_initiating_pip.required' => 'Date of initiating PIP is required',
                'closing_date_pip.required' => 'Closing Date of PIP is required',
                'issue_description_performance_behaviour.required' => 'Description is required',
                'description_expected_performance.required' => 'Expected performance is required',
                'plan_of_action_to_improve.required' => 'Plan of action is required',
            ]);

            $status='2';
        }

        if($request->date_initiating_pip){
            $date_initiating_pip=$request->date_initiating_pip;
        } else {
            $date_initiating_pip=null;
        }

        if($request->closing_date_pip){
            $closing_date_pip=$request->closing_date_pip;
        } else {
            $closing_date_pip=null;
        }

        //dd($request);

        //DB::enableQueryLog();

        InitiatingPipForm::where('id', $edit_id)
        ->where('user_id', $user_id)
        ->update([
            'member_name' => $request->member_name,
            'date_initiating_pip' => $date_initiating_pip,
            'no_of_days' => $request->no_of_days,
            'closing_date_pip' => $closing_date_pip,
            'issue_description_performance_behaviour' => $request->issue_description_performance_behaviour,
            'description_expected_performance' => $request->description_expected_performance,
            'plan_of_action_to_improve' => $request->plan_of_action_to_improve,
            'status' => $status,
        ]);

        //$quries = DB::getQueryLog();
        //dd($quries);

        if($status=='1'){

            return back()->with('thank_you', 'Your form save in draft');

        } else if($status=='2'){
            
            //return redirect('/thank-you')->with('thank_you', 'Thanks, for giving your valuable time for us.');
            return redirect("/initiating-pip-email-form/$user_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');
        }

    }



    public function showPIPFormDataToMember(){

        $user_id=Auth::user()->id;

        $user_details = User::where('users.id',$user_id)
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_names.name as company_name','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$user_id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $user_id)
        ->first();

        
        return view('initiating-pip-data-show-to-member', compact('user_details','initiating_pip_details','confirmation_mom_details'));
        

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



    /*send Initiating pip email, start here*/
    public function sendInitiatingPIPEmail(Request $request){

        //dd($request);

        $id = $request->id;
        $user_id = $request->user_id;

        $user_details = User::where('users.id',$user_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$user_id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $user_id)
        ->first();



        $avg_score=0;  
        $score_card=0; 
        $counter=0;

        foreach($confirmation_mom_details as $confirmation_mom_detail) {

            $score_card=($score_card+(int)$confirmation_mom_detail['average_rating_entire_presentation']);

            $avg_score=$avg_score+((int)$confirmation_mom_detail['content']+(int)$confirmation_mom_detail['confidence']+(int)$confirmation_mom_detail['communication']+(int)$confirmation_mom_detail['data_relevance']+(int)$confirmation_mom_detail['overall_growth_individual']);

            $counter++;
        }

        if($score_card>0) { $score_card=$score_card/$counter; }



        $data=array('user_details'=>$user_details, 'initiating_pip_details'=>$initiating_pip_details, 'confirmation_mom_details'=>$confirmation_mom_details,'score_card'=>$score_card,'avg_score'=>$avg_score);

        $mail_from=\config('env_file_value.no_reply');
        $hr_email= \config('env_file_value.hr_email');
        $manager_email=$user_details['manager_email'];
        $candidate_email=$user_details['email'];

        
        $subject_name='Initiating PIP - '.$user_details['full_name'].' (Member ID - '.$user_details['member_id'].')';
    
        Mail::send('mail-layout.send-initiating-pip-email',$data, function($message) use ($user_details, $initiating_pip_details, $confirmation_mom_details, $mail_from, $manager_email, $hr_email, $candidate_email, $subject_name) {
            $message->from($mail_from)
            ->to($hr_email)
            ->cc($manager_email)
            ->subject($subject_name);
        });


        //return back()->with('thank_you', 'Mail successfully sent.');
        return true;

    }
    /*send Initiating pip email, end here*/




    /*send Closure pip email, start here*/
    public function sendClosurePIPEmail(Request $request){

        //$id = $request->id;
        $id = $request->user_id;

        $user_details = User::where('users.id',$id)
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_names.name as company_name','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();

  
        $data=array('user_details'=>$user_details, 'initiating_pip_details'=>$initiating_pip_details);

        $mail_from=\config('env_file_value.no_reply');
        $hr_email= \config('env_file_value.hr_email');
        $manager_email=$user_details['manager_email'];
        $candidate_email=$user_details['email'];

        
        $subject_name='Closure PIP - '.$user_details['full_name'].' (Member ID - '.$user_details['member_id'].')';
    
        Mail::send('mail-layout.send-closure-pip-email',$data, function($message) use ($user_details, $initiating_pip_details, $confirmation_mom_details, $mail_from, $manager_email, $hr_email, $candidate_email, $subject_name) {
            $message->from($mail_from)
            ->to($hr_email)
            ->cc($manager_email)
            ->subject($subject_name);
        });


        //return back()->with('thank_you', 'Mail successfully sent.');
        return true;

    }
    /*send Closure pip email, end here*/


    public function sendClosurePIPEmailTest($id){

        $user_details = User::where('users.id',$id)
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_names.name as company_name','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();

        return view('mail-layout.send-closure-pip-email', compact('user_details','initiating_pip_details'));
    }


}
