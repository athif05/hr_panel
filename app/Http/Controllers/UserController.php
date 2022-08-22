<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile; //for image upload
use Illuminate\Support\Facades\Hash; //for password hashing

use App\Models\User;
use App\Models\UserInterviewForm;

use Auth;

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
        

        $employee_details = User::where('users.id',$id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name')
        ->first();

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


    public function ppt($id) {

        $employee_details = User::where('id',$id)->first();
        $employee_id=$id;

        return view('confirmation-process.ppt', compact('employee_details','employee_id'));
    }

    public function thankyou($id) {

        $employee_id=$id;
        return view('confirmation-process.thankyou', compact('employee_id'));
    }


    public function pptUpload(Request $request) {

        return view('ppt-upload');
    }


    public function savePpt(Request $request) {

        //$base_url=url()->full();
        //$base_url=url('');
        $base_url=$_SERVER['DOCUMENT_ROOT'];

        $user_id=$request->user_id;
        
        $request->validate([
            'image' => 'required',
        ], [
            'image.required' => 'Please choose PPT.',
        ]);


        $ppt_details = User::where('id', $user_id)->first();

        $unlink_url=$base_url.''.$ppt_details['confirmation_ppt'];


        if($ppt_details['confirmation_ppt']){
            
            unlink($unlink_url);

        }


        $profile_filePath = $request->file('image')->store('all-ppt');

        $profile_pic_file_path = '/storage/app/' . $profile_filePath;


        if(User::where('id', $user_id)->update(['confirmation_ppt' => $profile_pic_file_path])){

            return back()->with('success_msg', 'Your PPT saved.');

        } else {

            return back()->with('error_msg', 'Something is wrong.');

        }

    }

    /*my profile view*/
    public function myProfile() {

        $user_id=Auth::user()->id;

        $user_details = User::where('users.id',$user_id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name')
        ->first();

        return view('my-profile', compact('user_details'));
    }


    /*upload profile image, start here*/
    public function uploadProfileImage(Request $request) {


        $base_url=$_SERVER['DOCUMENT_ROOT'];

        $user_id=$request->user_id;
        
        $request->validate([
            'image' => 'required',
        ], [
            'image.required' => 'Please choose image.',
        ]);


        $image_details = User::where('id', $user_id)->first();

        $unlink_url=$base_url.''.$image_details['profile_image'];


        if($image_details['profile_image']){
            
            unlink($unlink_url);

        }


        $profile_filePath = $request->file('image')->store('all-profile-images');

        $profile_pic_file_path = '/storage/app/' . $profile_filePath;


        if(User::where('id', $user_id)->update(['profile_image' => $profile_pic_file_path])){

            return back()->with('success_msg', 'Your profile image saved.');

        } else {

            return back()->with('error_msg', 'Something is wrong.');

        }

    }
    /*upload profile image, end here*/



    /*change password view*/
    public function changePassword() {
        
        return view('change-password');
    }


    /*update password*/
    public function updatePassword(Request $request) {
        
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:5',
            'confirmPassword' => 'required|same:newPassword',
        ], [
            'currentPassword.required' => 'Current password is required.',
            'newPassword.required' => 'New password is required.',
            'confirmPassword.required' => 'Confirm password not match',
        ]);

        $newPassword=Hash::make($request->newPassword);

        $user_details = User::where('id', $request->user_id)->first();

        if($user_details['id']){
            
            if(Hash::check($request->currentPassword,$user_details['password'])) {
                
                $usres = User::where('id',$request->user_id)
                ->update([
                    'password' => $newPassword,
                ]);


                if($usres=='0') {
                    return back()->with('error_msg', 'Something is wrong, please try again...');
                } else {
                    return back()->with('success_msg', 'Password successfully updated.');
                }

            } else {
                return back()->with('error_msg', 'Something is wrong, please try again...');
            }

        }  //end if
        
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
