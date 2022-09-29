<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\InitiatingPipForm;
use App\Models\ConfirmationMom;

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
    public function index($id)
    {
        $user_details = User::where('users.id',$id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*','company_locations.name as location','departments.name as department_name','designations.name as designation_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();

        if(($initiating_pip_details === null) or (($initiating_pip_details['status'] === '0') or ($initiating_pip_details['status'] === ''))){

            return view('initiating-pip-email-form', compact('user_details'));

        } else if($initiating_pip_details['status'] === '1'){

            return redirect("/initiating-pip-email-form-edit/$id");

        } else if($initiating_pip_details['status'] === '2'){

            return view('initiating-pip-email-form-show', compact('user_details','initiating_pip_details','confirmation_mom_details'));
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
        $updated_by_id=$request->updated_by_id;

        if($request['submit']=='Save in Draft'){
            $status='1';
        } else if($request['submit']=='Publish'){

            $request->validate([
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'date_initiating_pip' => 'required',
                'no_of_days' => 'required',
                'closing_date_pip' => 'required',
            ], [
                'member_name.required' => 'Member Name is required',
                'date_initiating_pip.required' => 'Date of initiating PIP is required',
                'no_of_days.required' => 'No. Of Days is required',
                'closing_date_pip.required' => 'Closing Date of PIP is required',
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
        
        $user_details = User::where('users.id',$id)
        ->select('users.*', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();


        /*check record is exist or not*/
        $initiating_pip_details = InitiatingPipForm::where('user_id', $id)
        ->first();

        return view('initiating-pip-email-form-edit', compact('user_details','initiating_pip_details'));
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
                'member_name' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'date_initiating_pip' => 'required',
                'no_of_days' => 'required',
                'closing_date_pip' => 'required',
            ], [
                'member_name.required' => 'Member Name is required',
                'date_initiating_pip.required' => 'Date of initiating PIP is required',
                'no_of_days.required' => 'No. Of Days is required',
                'closing_date_pip.required' => 'Closing Date of PIP is required',
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



    /*send pip email, start here*/
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
            ->to($candidate_email)
            ->cc($manager_email)
            ->bcc($hr_email)
            ->subject($subject_name);
        });


        //return back()->with('thank_you', 'Mail successfully sent.');
        return true;

    }
    /*send pip email, end here*/

}