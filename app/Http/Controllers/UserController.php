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
use App\Models\ConfirmationGenerateEmail;
use App\Models\{CompanyName, Designation, Department, CompanyLocation, JobOpeningTypes};

use Auth;

class UserController extends Controller
{

    /*confirmation review initiation email view, start here*/
    public function confirmationReviewInitiationEmailView($id) {
        
        $user_dtl = User::where('id',$id)
        ->first();

        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();

        $review_meeting_date = ConfirmationMom::where('user_id',$id)
        ->first();

        //dd($confirmation_mom_details);

        return view('confirmation-review-initiation-email-view', compact('user_dtl','confirmation_mom_details','review_meeting_date'));
    }
    /*confirmation review initiation email view, end here*/



    /*mom email view, start here*/
    public function momEmailView($id) {
        
        $user_dtl = User::where('id',$id)
        ->first();

        $confirmation_mom_details = ConfirmationMom::where('confirmation_moms.user_id',$id)
        ->leftJoin('users', 'users.id', '=', 'confirmation_moms.manager_id')
        ->select('confirmation_moms.*', 'users.first_name as f_name', 'users.last_name as l_name')
        ->get();

        $review_meeting_date = ConfirmationMom::where('user_id',$id)
        ->first();

        //dd($confirmation_mom_details);

        return view('mom-email-view', compact('user_dtl','confirmation_mom_details','review_meeting_date'));
    }
    /*mom email view, end here*/


    public function multilevel_manager($manager_id){

        $manager_array=array();
        $manager2=0;
        $manager3=0;
        $manager4=0;
        $manager5=0;

        $manager1=$manager_id;

        array_push($manager_array,$manager1);

        //dd($manager1);
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
dd("1. ".$manager2." / 2. ".$manager2." / 3. ".$manager3);

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

        $designation_names = Designation::where('status', '1')
            ->where('is_deleted', '0')
            ->orderBy('name','asc')
            ->get();

        $member_details = User::where('users.id',$id)
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','departments.name as department_name','designations.name as designation_name')
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
            return view('manager-mom-form', compact('member_details','manager_details','designation_names'));
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


        $joining_date = date('Y-m-d', strtotime($member_details->joining_date));


        /*tenure calculte, start here*/
        $total_tenure=0;

        $sdate = date("y-m-d");
        $edate = $joining_date;
        $date_diff = abs(strtotime($edate) - strtotime($sdate));

        $years = floor($date_diff / (365*60*60*24));
        $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
        //$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $months=$months+($years*12);
        if($months>0){
            $total_tenure= (int)$months;
        }
        /*tenure calculte, end here*/
        

        $manager_id=Auth::user()->id;
        
        $feedback_form_details = ConfirmationFeedbackForm::where('user_id',$id)
        ->where('manager_id',$manager_id)
        ->first();

        if($feedback_form_details){
            
            $edit_id=$feedback_form_details['id'];
            return redirect("/confirmation-feedback-form-edit/$id/$edit_id");
        } else {
            return view('confirmation-feedback-form', compact('member_details','total_tenure'));
        }

        
    }
    /*confirmation-feedback-form, end here*/



    /*show all probation member list to hr mom, start here*/
    public function hrMom() {

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


        $all_members = User::where('users.employee_type','Probation')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','departments.name as department_name','designations.name as designation_name')
        ->orderBy('users.first_name','asc')->get();


        $manager_hr_id=Auth::user()->id;
        
        $mom_form_details = ConfirmationMom::where('manager_id',$manager_hr_id)
        ->get();


        return view('hr-mom', compact('all_members','mom_form_details','manager_hr_id','company_names','company_locations','designation_names','department_names'));
    }
    /*show all probation member list to hr mom, end here*/


    /*filter probation member list to hr mom, start here*/
    public function hrMomFilter(Request $request){

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


        $manager_hr_id=Auth::user()->id;
        
        $mom_form_details = ConfirmationMom::where('manager_id',$manager_hr_id)
        ->get();

        $query = User::where('users.employee_type','Probation')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','departments.name as department_name','designations.name as designation_name')
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


        return view('hr-mom', compact('all_members','mom_form_details','manager_hr_id','company_names','company_locations','designation_names','department_names'));
    }
    /*filter probation member list to hr mom, end here*/



    /*show all probation member list to hr generate email, start here*/
    public function hrGenerateEmails() {

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

        $all_members = User::where('users.employee_type','Probation')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','departments.name as department_name','designations.name as designation_name')
        ->orderBy('users.first_name','asc')->get();

        $generate_email_details = ConfirmationGenerateEmail::get();

        return view('hr-generate-emails', compact('all_members','generate_email_details','company_names','company_locations','designation_names','department_names'));
    }
    /*show all probation member list to hr generate email, end here*/



    /*filter probation member list to hr generate email, end here*/
    public function hrGenerateEmailsFilter(Request $request){

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


        $generate_email_details = ConfirmationGenerateEmail::get();

        $query = User::where('users.employee_type','Probation')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('company_names', 'company_names.id', '=', 'users.company_id')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','departments.name as department_name','designations.name as designation_name')
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



        return view('hr-generate-emails', compact('all_members','generate_email_details','company_names','company_locations','designation_names','department_names'));

    }
    /*filter probation member list to hr generate email, end here*/



    /*show all probation member list which is report to manager Confirmation Feedback Form, start here*/
    public function showProbationMemberForManagerConfirmationFeedback() {

        $manager1=Auth::user()->member_id;

        $manager_array= self::multilevel_manager($manager1);


        $all_members = User::where('users.employee_type','Probation')
        ->whereIn('users.reporting_to_id',$manager_array)
        ->leftJoin('confirmation_feedback_forms', 'confirmation_feedback_forms.user_id', '=', 'users.id')
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'confirmation_feedback_forms.id as feedback_id', 'confirmation_feedback_forms.status as confirmation_feedback_forms_status','designations.name as designation_name')
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
        ->leftJoin('company_locations', 'company_locations.id', '=', 'users.company_location_id')
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'designations.name as designation_name')
        ->orderBy('users.first_name','asc')->get();

        $manager_hr_id=Auth::user()->id;
        
        $mom_form_details = ConfirmationMom::where('manager_id',$manager_hr_id)
        ->get();

        return view('probation-member-list-to-manager-mom', compact('all_members','mom_form_details'));
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
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name','designations.name as designation_name')
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


        $all_candidates = User::where('users.employee_type','Probation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'departments.name as department_name')
        ->orderBy('users.first_name','asc')
        ->get();

        return view('confirmation-process-mom-email', compact('all_candidates','company_names','company_locations','designation_names','department_names'));
    }


    /*filter confirmation process mom email page, start here*/
    public function confirmationProcessMomEmailFilter(Request $request) {

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


        $query = User::where('users.employee_type','Probation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'departments.name as department_name')
        ->orderBy('users.first_name','asc');
        

        if($request->company_id_filter){
            $query->where('users.company_id', '=', $request->company_id_filter);
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

        $all_candidates = $query->get();

        return view('confirmation-process-mom-email', compact('all_candidates','company_names','company_locations','designation_names','department_names'));
        
    }
    /*filter confirmation process mom email page, start here*/


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
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->leftJoin('departments', 'departments.id', '=', 'users.department')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name','departments.name as department_name')
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

        $user_id=Auth::user()->id;

        $ppt_details = User::where('id',$user_id)->first();

        return view('ppt-upload', compact('ppt_details'));
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
        ->leftJoin('designations', 'designations.id', '=', 'users.designation')
        ->select('users.*', 'company_locations.name as location_name', 'company_names.name as company_name','designations.name as designation_name')
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
