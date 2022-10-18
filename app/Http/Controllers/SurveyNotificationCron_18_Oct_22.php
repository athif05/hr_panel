<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\{UserInterviewForm, UserRecruitmentForm, ConfirmationMom, ConfirmationFeedbackForm, StackholderFeedbackForm, Days45CheckInMember, Days45CheckInManager, FreshEyeJournal, TrainingSurvey, HiringSurvey};

use Mail;

use Config; //use custom field from .env file

use Illuminate\Support\Facades\Crypt; //for encrypt String

class SurveyNotificationCron extends Controller
{
    
	/* send notification for all candidate who join before 2 days, start here */
    public function sendCron(Request $request){
    	
    	$todat_date=date('Y-m-d');
		$last2days=date('Y-m-d', strtotime('-2 day', strtotime($todat_date)));
		$last30days=date('Y-m-d', strtotime('-30 day', strtotime($todat_date)));
		$last45days=date('Y-m-d', strtotime('-45 day', strtotime($todat_date)));
		$last70days=date('Y-m-d', strtotime('-70 day', strtotime($todat_date)));
		//dd($last30days);


    	/*$all_users = User::where('users.employee_type','Probation')
    	->where('users.joining_date',$last2days)
    	->orWhere('users.joining_date',$last30days)
    	->orWhere('users.joining_date',$last45days)
    	->orWhere('users.joining_date',$last70days)
    	->leftJoin('designations','designations.id','=','users.designation')
    	->leftJoin('departments','departments.id','=','users.department')
    	->select('users.*','designations.name as designation_name','departments.name as department_name')
    	->get();*/

    	$all_users = User::where('users.employee_type','Probation')
    	->leftJoin('designations','designations.id','=','users.designation')
    	->leftJoin('departments','departments.id','=','users.department')
    	->select('users.*','designations.name as designation_name','departments.name as department_name')
    	->get();
		$total_all_users = $all_users->count();
		//dd($total_all_users);

		$mail_from='no-reply@vcommission.com';

		$hr_email= \config('env_file_value.hr_email');
		//dd($hr_email);
		
		/*echo $id=98;
		$idd=Crypt::encryptString($id);
		echo $idd."<br>";

		$iddd=Crypt::decryptString($idd);

		echo $iddd;*/

		if($total_all_users>0){

			foreach ($all_users as $all_user) {

				
				$candidate_id=$all_user['id'];
				$candidate_name=$all_user['first_name'].' '.$all_user['last_name'];
				$candidate_email=$all_user['email'];
				$candidate_designation_name=$all_user['designation_name'];
				$candidate_department_name=$all_user['department_name'];
				$joining_date=$all_user['joining_date'];
				$manager_name=$all_user['manager_name'];
				$manager_email=$all_user['manager_email'];
				$hod_name=$all_user['hod_name'];
				$hod_email=$all_user['hod_email'];

				$encryp_candidate_id=Crypt::encryptString($candidate_id);

				$data=array('candidate_id'=>$candidate_id, 'candidate_name'=>$candidate_name, 'candidate_email'=>$candidate_email, 'candidate_designation_name'=>$candidate_designation_name, 'manager_name'=>$manager_name, 'manager_email'=>$manager_email, 'encryp_candidate_id'=>$encryp_candidate_id, 'joining_date'=>$joining_date,'candidate_department_name'=>$candidate_department_name, 'hod_name'=>$hod_name, 'hod_email'=>$hod_email);

				//echo 'joining_date: '.$all_user['joining_date'].'<br>Last 2 days '.$last2days.'<br> last 30 days'.$last30days;




				if(($all_user['joining_date']<=$last2days) && ($all_user['joining_date']>$last30days)) {
					
					//return view('mail-layout.cron-survey-mail-template');
					//dd('2 aa');

					if($all_user['joining_date']==$last2days) {

						Mail::send('mail-layout.cron-survey-mail-template',$data, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email) {
							$message->from($mail_from)
							->to($candidate_email)
							->cc($manager_email)
							->bcc($hr_email)
							->subject("Fill Interview Survey");
						});

					} else {

						
						$interview_users = UserInterviewForm::where('user_interview_forms.user_id',$all_user['id'])
						->where('user_interview_forms.status','!=','2')
				    	->first();
				    	
				    	$day_differnce=self::_day_differnce($all_user['joining_date']);
						//echo "<br>DIff: ".$day_differnce; 

				    	if(($interview_users==null && $day_differnce<=5) || ($interview_users && $day_differnce<=5) ) {
				    		//echo "reminder day"; dd();
				    		//return view('mail-layout.cron-reminder-survey-mail-template'); dd();

				    		$task_name="Interview Survey Form";

							$task_name_array= array('task_name'=>$task_name);
							$final_array=array_merge($data,$task_name_array);

				    		Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
								$message->from($mail_from)
								->to($candidate_email)
								->cc($hr_email)
								->subject("Gentle Reminder - ".$task_name);
							});


				    	} else if( ($interview_users==null && (($day_differnce>5) && ($day_differnce<7))) || ($interview_users && (($day_differnce>5) && ($day_differnce<7))) ) {
				    		//echo "warning day"; dd();

				    		$task_name="Interview Survey Form";

							$task_name_array= array('task_name'=>$task_name);
							$final_array=array_merge($data,$task_name_array);

				    		Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
								$message->from($mail_from)
								->to($candidate_email)
								->cc($manager_email)
								->bcc($hr_email)
								->subject("Need Immediate Closure - ".$task_name);
							});

				    	}
				    	


				    	$recruitment_users = UserRecruitmentForm::where('user_recruitment_forms.user_id',$all_user['id'])
						->where('user_recruitment_forms.status','!=','2')
				    	->first();

				    	if( ($recruitment_users==null && $day_differnce<=5) || ($recruitment_users && $day_differnce<=5) ) {
				    		//echo "reminder day"; dd();
				    		//return view('mail-layout.cron-reminder-survey-mail-template'); dd();

				    		$task_name="Recruitment Survey Form";

							$task_name_array= array('task_name'=>$task_name);
							$final_array=array_merge($data,$task_name_array);

				    		Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
								$message->from($mail_from)
								->to($candidate_email)
								->cc($hr_email)
								->subject("Gentle Reminder - ".$task_name);
							});

				    	} else if( ($recruitment_users==null && (($day_differnce>5) && ($day_differnce<7))) || ($recruitment_users && (($day_differnce>5) && ($day_differnce<7))) ) {
				    		//echo "warning day"; dd();

				    		$task_name="Recruitment Survey Form";

							$task_name_array= array('task_name'=>$task_name);
							$final_array=array_merge($data,$task_name_array);

				    		Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
								$message->from($mail_from)
								->to($candidate_email)
								->cc($manager_email)
								->bcc($hr_email)
								->subject("Need Immediate Closure - ".$task_name);
							});

				    	}


				    	
					}
					

				}





				if(($all_user['joining_date']<=$last30days) && ($all_user['joining_date']>$last45days)) {
				//if($all_user['joining_date']==$last30days){
					

					if($all_user['joining_date']==$last30days) {
						//dd('mail');

						/*mail sent to member, start here*/
						Mail::send('mail-layout.cron-training-survey-mail-template',$data, function($message) use ($candidate_name, $candidate_email, $candidate_designation_name, $mail_from, $manager_email, $hr_email) {
							$message->from($mail_from)
							->to($candidate_email)
							->cc($hr_email)
							->subject("Congrats! You are a month old today");
						});
						/*mail sent to member, end here*/

						
						/*mail sent to manager, start here*/
						Mail::send('mail-layout.manager-feedback-form-30-days',$data, function($message) use ($manager_name, $candidate_name, $mail_from, $manager_email, $hr_email, $joining_date, $candidate_designation_name, $candidate_department_name) {
							$message->from($mail_from)
							->to($manager_email)
							->cc($hr_email)
							->subject("30-Day Feedback | ".$candidate_name." - ".$candidate_designation_name.", ".$candidate_department_name);
						});
						/*mail sent to manager, end here*/


						/*mail sent to head, start here*/
						if($hod_name && $hod_email){

							Mail::send('mail-layout.hod-feedback-form-30-days',$data, function($message) use ($hod_name, $candidate_name, $mail_from, $hod_email, $hr_email, $joining_date, $candidate_designation_name, $candidate_department_name) {
								$message->from($mail_from)
								->to($hod_email)
								->cc($hr_email)
								->subject("30-Day Feedback | ".$candidate_name." - ".$candidate_designation_name.", ".$candidate_department_name);
							});
						}
						/*mail sent to head, end here*/


					} else {
						//dd('reminer 30 days');
					
				    	$day_differnce=self::_day_differnce($all_user['joining_date']);
						//echo "<br>DIff: ".$day_differnce; dd(' 30 days');

						$training_users = TrainingSurvey::where('training_surveys.user_id',$all_user['id'])
							->where('training_surveys.status','!=','2')
					    	->first();

				    	if(($training_users==null && $day_differnce<=33) || ($training_users && $day_differnce<=33) ) {
				    		//echo "reminder day"; dd();
				    		//return view('mail-layout.cron-reminder-survey-mail-template'); dd();

				    		$task_name="Training Survey";

							$task_name_array= array('task_name'=>$task_name);
							$final_array=array_merge($data,$task_name_array);

							/*mail sent to member, start here*/
							Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
								$message->from($mail_from)
								->to($candidate_email)
								->cc($hr_email)
								->subject("Gentle Reminder - ".$task_name);
							});
							/*mail sent to member, end here*/


				    	} else if( ($training_users==null && (($day_differnce>33) && ($day_differnce<35))) || ($training_users && (($day_differnce>33) && ($day_differnce<35))) ){
				    		//echo "warning day"; dd();

				    		$task_name="Training Survey";

							$task_name_array= array('task_name'=>$task_name);
							$final_array=array_merge($data,$task_name_array);

				    		Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
								$message->from($mail_from)
								->to($candidate_email)
								->cc($manager_email)
								->bcc($hr_email)
								->subject("Need Immediate Closure - ".$task_name);
							});

				    	}

				    	
					}

					
					//echo "hod sent 30 days"; dd();

				}



				if(($all_user['joining_date']<=$last45days) && ($all_user['joining_date']>$last70days)) {
				//if($all_user['joining_date']==$last45days){
					
					//echo "<br> 45 days ";
					//return view('mail-layout.cron-check-in-form-member-template');
					//dd('45 days');

					if($all_user['joining_date']==$last45days) {
						//dd('mail');
						/*mail send to member, start here*/
						Mail::send('mail-layout.cron-45-days-check-in-form-member-template',$data, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email) {
							$message->from($mail_from)
							->to($candidate_email)
							->cc($hr_email)
							->subject("Hurray! You’re Halfway Through");
						});
						/*mail send to member, end here*/


						/*mail send to manager and head, start here*/
						Mail::send('mail-layout.cron-45-days-check-in-form-manager-template',$data, function($message) use ($manager_name, $candidate_name, $encryp_candidate_id, $mail_from, $manager_email, $hr_email, $candidate_designation_name) {
							$message->from($mail_from)
							->to($manager_email)
							->cc($hr_email)
							->subject("45 Day Check-In | Feedback for ".$candidate_name." - ".$candidate_designation_name);
						});
						/*mail send to manager and head, end here*/


						/*mail sent to head, start here*/
						if($hod_name && $hod_email){

							Mail::send('mail-layout.cron-45-days-check-in-form-hod-template',$data, function($message) use ($hod_name, $candidate_name, $encryp_candidate_id, $mail_from, $hod_email, $hr_email, $candidate_designation_name) {
								$message->from($mail_from)
								->to($hod_email)
								->cc($hr_email)
								->subject("45 Day Check-In | Feedback for ".$candidate_name." - ".$candidate_designation_name);
							});
						}
						/*mail sent to head, end here*/

					} else {
						//dd('reminder');

						$day_differnce=self::_day_differnce($all_user['joining_date']);
						//echo "<br>DIff: ".$day_differnce; dd(' 45 days');

					    $check_in_member_details = DB::table('days_45_checkin_members')->where('days_45_checkin_members.user_id', $all_user['id'])->where('days_45_checkin_members.status','!=','2')->first();

					    //dd($check_in_member_details);

				    	if( ($check_in_member_details==null && $day_differnce<=48) || ($check_in_member_details && $day_differnce<=48) ) {
				    		//echo "reminder day"; dd();
				    		//return view('mail-layout.cron-reminder-survey-mail-template'); dd();

				    		$task_name="45 Days Member Check-In Form";

							$task_name_array= array('task_name'=>$task_name);
							$final_array=array_merge($data,$task_name_array);

							/*mail sent to member, start here*/
							Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
								$message->from($mail_from)
								->to($candidate_email)
								->cc($hr_email)
								->subject("Gentle Reminder - ".$task_name);
							});
							/*mail sent to member, end here*/


				    	} else if( ($check_in_member_details==null && (($day_differnce>48) && ($day_differnce<50))) || ($check_in_member_details && (($day_differnce>48) && ($day_differnce<50))) ){
				    		//echo "warning day"; dd();

				    		$task_name="45 Days Member Check-In Form";

							$task_name_array= array('task_name'=>$task_name);
							$final_array=array_merge($data,$task_name_array);

				    		Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
								$message->from($mail_from)
								->to($candidate_email)
								->cc($manager_email)
								->bcc($hr_email)
								->subject("Need Immediate Closure - ".$task_name);
							});

				    	}
					}

					//echo "sent 45 days manager"; dd();

				}






				if($all_user['joining_date']==$last70days) {
					
					//echo "<br> 70 days ";
					//return view('mail-layout.cron-confirmation-process-initation-70-days-automate-mail');
					//dd('mail');

					Mail::send('mail-layout.cron-confirmation-process-initation-70-days-automate-mail',$data, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email) {
						$message->from($mail_from)
						->to($candidate_email)
						->cc($manager_email)
						->bcc($hr_email)
						->subject("Confirmation Review Initiation");
					});


					/*Mail::send('mail-layout.cron-confirmation-process-initation-member-template',$data, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email) {
						$message->from($mail_from)
						->to($candidate_email)
						->cc($manager_email)
						->bcc($hr_email)
						->subject("Confirmation Process Member");
					});


					//return view('mail-layout.cron-confirmation-process-initation-manager-template');

					Mail::send('mail-layout.cron-confirmation-process-initation-manager-template',$data, function($message) use ($manager_name, $encryp_candidate_id, $mail_from, $manager_email, $hr_email) {
						$message->from($mail_from)
						->to($manager_email)
						->cc($hr_email)
						->subject("Confirmation Process Manager");
					});*/
				}
 

			}

			echo "sent all mails";

		} else {
			echo "no record...";
		}

			
    }
    /* send notification for all candidate who join before 2 days, start here */



    public function _day_differnce($joining_date){

    	$now_date = strtotime(date('Y-m-d')); // or your date as well
		$your_date = strtotime($joining_date);
		$datediff = $now_date - $your_date;

		$day_differnce=(round($datediff / (60 * 60 * 24)));

		return $day_differnce;

    }


}
