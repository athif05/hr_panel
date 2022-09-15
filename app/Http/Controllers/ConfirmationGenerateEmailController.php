<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\LetterType;
use App\Models\ConfirmationGenerateEmail;
use App\Models\ConfirmationMom;

use Carbon\Carbon;

use Auth;

class ConfirmationGenerateEmailController extends Controller
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

        $lettre_types = LetterType::where('status','1')
        ->where('is_deleted','0')
        ->orderBy('name', 'ASC')
        ->get();

        /*fetch all hr data*/
        $poc_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->select('id',DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
            ->get();


        /*check record is exist or not*/
        $generate_email_details = ConfirmationGenerateEmail::where('user_id', $id)
        ->leftJoin('users','users.id','=','confirmation_generate_emails.poc_name')
        ->leftJoin('letter_types','letter_types.id','=','confirmation_generate_emails.letter_type')
        ->select('confirmation_generate_emails.*','letter_types.name as letter_type_name', DB::raw("CONCAT(first_name, ' ', last_name) as full_poc_name"))
        ->first();

        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();

        //dd($generate_email_details);

        if(($generate_email_details === null) or (($generate_email_details['status'] === '0') or ($generate_email_details['status'] === ''))){

            return view('hr-generate-confirmation-email-form', compact('user_details','lettre_types','poc_details'));

        } else if($generate_email_details['status'] === '1'){

            return redirect("/generate-email-form-edit/$id");

        } else if($generate_email_details['status'] === '2'){

            return view('hr-generate-confirmation-email-form-show', compact('user_details','lettre_types','poc_details','generate_email_details','confirmation_mom_details'));
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
                'letter_type' => 'required',
                'appraisal_cycle' => 'required',
                'session_date' => 'required',
                'session_time' => 'required',
                'poc_name' => 'required',
                'location' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'letter_type.required' => 'Letter type is required',
                'appraisal_cycle.required' => 'Appraisal cycle is required',
                'session_date.required' => 'Session date is required',
                'session_time.required' => 'Session time is required',
                'poc_name.required' => 'POC name is required',
                'location.required' => 'Location is required',
            ]);

            $status='2';
        }


        /*current time*/
        $mytime = Carbon::now();
        $my_hour=$mytime->hour;
        $my_minute=$mytime->minute;
        $current_time=$my_hour.':'.$my_minute.":00";
        //$current_time=$mytime->totimeString();

        $input = ConfirmationGenerateEmail::insert([
            'user_id' => $user_id,
            'updated_by_id' => $updated_by_id,
            'member_name' => $request->member_name,
            'letter_type' => $request->letter_type,
            'increment_amount' => $request->increment_amount,
            'promotion' => $request->promotion,
            'appraisal_cycle' => $request->appraisal_cycle,
            'session_date' => (!is_null($request->session_date) ? $request->session_date : "null"),
            'session_time' => (!is_null($request->session_time) ? $request->session_time : $current_time),
            'poc_name' => (!is_null($request->poc_name) ? $request->poc_name : ""),
            'location' => (!is_null($request->location) ? $request->location : ""),
            'status' => $status,
        ]);

        if($input){
            
            if($status==1){

                return redirect("/generate-email-form-edit/$user_id")->with('thank_you', 'Your form save in draft.');

            } else if($status==2){

                return redirect('/generate-email-form-show')->with('thank_you', 'Thanks, for giving your valuable time for us.');

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
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_id')
        ->select('users.*','company_locations.name as location', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
        ->first();

        $lettre_types = LetterType::where('status','1')
        ->where('is_deleted','0')
        ->orderBy('name', 'ASC')
        ->get();

        /*fetch all hr data*/
        $poc_details = User::where('status', '1')
            ->where('is_deleted', '0')
            ->where('role_id', '5')
            ->orWhere('role_id', '6')
            ->orderBy('first_name','asc')
            ->select('id',DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))
            ->get();


        $confirmation_generate_email_details = ConfirmationGenerateEmail::where('user_id',$id)->first();

        return view('hr-generate-confirmation-email-form-edit', compact('user_details','lettre_types','poc_details','confirmation_generate_email_details'));
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
                'letter_type' => 'required',
                'appraisal_cycle' => 'required',
                'session_date' => 'required',
                'session_time' => 'required',
                'poc_name' => 'required',
                'location' => 'required',
            ], [
                'member_name.required' => 'Name is required',
                'letter_type.required' => 'Letter type is required',
                'appraisal_cycle.required' => 'Appraisal cycle is required',
                'session_date.required' => 'Session date is required',
                'session_time.required' => 'Session time is required',
                'poc_name.required' => 'POC name is required',
                'location.required' => 'Location is required',
            ]);

            $status='2';
        }

        /*current time*/
        $mytime = Carbon::now();
        $my_hour=$mytime->hour;
        $my_minute=$mytime->minute;
        $current_time=$my_hour.':'.$my_minute.":00";

        ConfirmationGenerateEmail::where('id', $edit_id)
        ->where('user_id', $user_id)
        ->update([
            'user_id' => $user_id,
            'updated_by_id' => $updated_by_id,
            'member_name' => $request->member_name,
            'letter_type' => $request->letter_type,
            'increment_amount' => $request->increment_amount,
            'promotion' => $request->promotion,
            'appraisal_cycle' => $request->appraisal_cycle,
            'session_date' => (!is_null($request->session_date) ? $request->session_date : "null"),
            'session_time' => (!is_null($request->session_time) ? $request->session_time : $current_time),
            'poc_name' => (!is_null($request->poc_name) ? $request->poc_name : ""),
            'location' => (!is_null($request->location) ? $request->location : ""),
            'status' => $status,
        ]);


        if($status=='1'){

            return back()->with('thank_you', 'Your form save in draft');

        } else if($status=='2'){
            
            //return redirect('/thank-you')->with('thank_you', 'Thanks, for giving your valuable time for us.');
            return redirect("/generate-email-form/$user_id")->with('thank_you', 'Thanks, for giving your valuable time for us.');
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
