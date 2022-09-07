<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile; //for image upload
use Illuminate\Support\Facades\Hash; //for password hashing
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\UserInterviewForm;
use App\Models\ConfirmationFeedbackForm;
use App\Models\ConfirmationMom;

use Auth;

class UserController extends Controller
{

    public function multilevel_manager($manager_id){

        $manager_array=array();
        $manager2=0;
        $manager3=0;
        $manager4=0;
        $manager5=0;

        $manager1=$manager_id;

        array_push($manager_array,$manager1);


        $manager2_dtl = User::where('reporting_to_id',$manager1)
        ->where('role_id','3')
        ->first();
        if($manager2_dtl){
            $manager2=$manager2_dtl['member_id'];
            array_push($manager_array,$manager2);   
        }
        

        

        if($manager2!=0){

            $manager3_dtl = User::where('reporting_to_id',$manager2)
            ->where('role_id','3')
            ->first();

            if($manager3_dtl){
                $manager3=$manager3_dtl['member_id'];
                array_push($manager_array,$manager3);   
            }
               
        }


        if($manager3!=0){

            $manager4_dtl = User::where('reporting_to_id',$manager3)
            ->where('role_id','3')
            ->first();

            if($manager4_dtl){
                $manager4=$manager4_dtl['member_id'];
                array_push($manager_array,$manager4);   
            }
               
        }


        if($manager4!=0){

            $manager5_dtl = User::where('reporting_to_id',$manager4)
            ->where('role_id','3')
            ->first();

            if($manager5_dtl){
                $manager5=$manager5_dtl['member_id'];
                array_push($manager_array,$manager5);   
            }
               
        }


        return $manager_array;

    }

    
    /*confirmation-feedback-form, start here*/
    public function managerMOMForm($id) {

        $member_details = User::where('users.id',$id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name')
        ->first();

        $manager_id=Auth::user()->id;


        $manager_details = ConfirmationFeedbackForm::where('confirmation_feedback_forms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_feedback_forms.manager_id')
        ->select('confirmation_feedback_forms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();

        
        $mom_form_details = ConfirmationMom::where('user_id',$id)
        ->where('manager_id',$manager_id)
        ->first();
        //dd($mom_form_details);
        if($mom_form_details){
            
            $edit_id=$mom_form_details['id'];
            return redirect("/manager-mom-form-edit/$id/$edit_id");
        } else {
            return view('manager-mom-form', compact('member_details','manager_details'));
        }

    }
    /*confirmation-feedback-form, end here*/



    /*confirmation-feedback-form, start here*/
    public function confirmationFeedbackForm($id) {


        $member_details = User::where('users.id',$id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name')
        ->first();


        $manager_id=Auth::user()->id;
        
        $feedback_form_details = ConfirmationFeedbackForm::where('user_id',$id)
        ->where('manager_id',$manager_id)
        ->first();

        if($feedback_form_details){
            
            $edit_id=$feedback_form_details['id'];
            return redirect("/confirmation-feedback-form-edit/$id/$edit_id");
        } else {
            return view('confirmation-feedback-form', compact('member_details'));
        }

        
    }
    /*confirmation-feedback-form, end here*/



    /*show all probation member list to hr mom, start here*/
    public function hrMom() {


        $all_members = User::where('users.employee_type','Probation')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name')
        ->orderBy('users.first_name','asc')->get();

        return view('hr-mom', compact('all_members'));
    }
    /*show all probation member list to hr mom, end here*/



    /*show all probation member list to hr generate email, start here*/
    public function hrGenerateEmails() {


        $all_members = User::where('users.employee_type','Probation')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name')
        ->orderBy('users.first_name','asc')->get();

        return view('hr-generate-emails', compact('all_members'));
    }
    /*show all probation member list to hr generate email, end here*/



    /*show all probation member list which is report to manager Confirmation Feedback Form, start here*/
    public function showProbationMemberForManagerConfirmationFeedback() {

        $manager1=Auth::user()->member_id;

        $manager_array= self::multilevel_manager($manager1);


        $all_members = User::where('users.employee_type','Probation')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->leftJoin('confirmation_feedback_forms', 'confirmation_feedback_forms.user_id', '=', 'users.id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->select('users.*', 'company_locations.name as location_name', 'confirmation_feedback_forms.id as feedback_id')
        ->orderBy('users.first_name','asc')->get();

        return view('probation-member-list-to-manager-confirmation-feedback', compact('all_members'));
    }
    /*show all probation member list which is report to manager Confirmation Feedback Form, end here*/


    /*show all probation member list which is report to manager, start here*/
    public function showProbationMemberForManagerMOM() {

        $manager1=Auth::user()->member_id;

        $manager_array= self::multilevel_manager($manager1);

        $all_members = User::where('users.employee_type','Probation')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->leftJoin('confirmation_moms', 'confirmation_moms.user_id', '=', 'users.id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->select('users.*', 'company_locations.name as location_name', 'confirmation_moms.id as mom_id')
        ->orderBy('users.first_name','asc')->get();

        return view('probation-member-list-to-manager-mom', compact('all_members'));
    }
    /*show all member list which is report to manager, end here*/


    /*show all probation member list which is report to manager Check In Form, start here*/
    public function showProbationMemberForManagerCheckIn() {

        $manager1=Auth::user()->member_id;

        $manager_array= self::multilevel_manager($manager1);
        
        //dd($manager_array);
        
        $all_members = User::where('users.employee_type','Probation')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->select('users.*', 'company_locations.name as location_name')
        ->orderBy('users.first_name','asc')->get();

        return view('probation-member-list-to-manager-check-in', compact('all_members'));
    }
    /*show all probation member list which is report to manager Check In Form, end here*/



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

            return back()->with('success_msg', 'Your profile image is updated.');

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
