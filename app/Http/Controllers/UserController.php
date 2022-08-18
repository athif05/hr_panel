<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\UserInterviewForm;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $all_candidates = User::where('employee_type','Probation')->orderBy('first_name','asc')->get();

        return view('confirmation-process-mom-email', compact('all_candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function startConfirmationEmployeeDetails($id)
    {
        

        $employee_details = User::where('id',$id)->first();

        /*tenure calculte, start here*/
        $total_tenure='';

        $sdate = date("y-m-d");
        $edate = $employee_details['joining_date'];
        $date_diff = abs(strtotime($edate) - strtotime($sdate));

        $years = floor($date_diff / (365*60*60*24));
        $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        if($years>0){
            $total_tenure.= $years.' Years, ';
        }

        if($months>0){
            $total_tenure.= $months.' Months, ';
        }

        if($days>0){
            $total_tenure.= $days.' Days';
        }
        /*tenure calculte, end here*/

        $employee_id=$employee_details['id'];


        return view('confirmation-process.index',  compact('employee_details','total_tenure', 'employee_id'));
    }


    public function scoreCard($id) {

        $employee_id=$id;
        return view('confirmation-process.score-card', compact('employee_id'));
    }


    public function survey($id) {

        $employee_id=$id;
        return view('confirmation-process.survey', compact('employee_id'));
    }


    public function ppt($id) {

        $employee_id=$id;
        return view('confirmation-process.ppt', compact('employee_id'));
    }


    public function evaluation($id) {

        $employee_id=$id;
        return view('confirmation-process.evaluation', compact('employee_id'));
    }

    public function feedback($id) {

        $employee_id=$id;
        return view('confirmation-process.feedback', compact('employee_id'));
    }

    public function thankyou($id) {

        $employee_id=$id;
        return view('confirmation-process.thankyou', compact('employee_id'));
    }


    public function pptUpload(Request $request) {

        return view('ppt-upload');
    }


    public function savePpt(Request $request) {

        //$base_url=url('');
        $base_url=$_SERVER['DOCUMENT_ROOT'];

        $user_id=$request->user_id;
        
        $request->validate([
            'image' => 'required',
        ], [
            'image.required' => 'Please choose PPT.',
        ]);


        //echo $request->image;

        $ppt_details = User::where('id', $user_id)->first();

        $unlink_url=$base_url.''.$ppt_details['confirmation_ppt'];
        //echo $unlink_url;


        if($ppt_details['confirmation_ppt']){
            
            //unlink($unlink_url);

        }

        echo $request->file('image');

        $profile_filePath = $request->file('image')->store('all-ppt');

        $profile_pic_file_path = '/storage/app/' . $profile_filePath;

        dd($profile_pic_file_path);

        if(User::where('id', $user_id)->update(['confirmation_ppt' => $profile_pic_file_path])){

            return back()->with('success_msg', 'Your PPT saved.');

        } else {

            return back()->with('error_msg', 'Something is wrong.');

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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
