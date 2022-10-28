<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\{UserInterviewForm, UserRecruitmentForm, TrainingSurvey, ConfirmationFeedbackForm};
use App\Models\{ConfirmationMom, StackholderFeedbackForm, Days45CheckInMember, Days45CheckInManager, FreshEyeJournal, HiringSurvey};
use Mail;

use Config; //use custom field from .env file

use Illuminate\Support\Facades\Crypt; //for encrypt String

class SurveyNotificationCron extends Controller
{
    
	/* send notification for all candidate who join before 2 days, start here */
    public function sendCron(Request $request) {
    	
    	$todat_date=date('Y-m-d');
		$last2days=date('Y-m-d', strtotime('-2 day', strtotime($todat_date)));
		$last30days=date('Y-m-d', strtotime('-30 day', strtotime($todat_date)));
		$last45days=date('Y-m-d', strtotime('-45 day', strtotime($todat_date)));
		$last70days=date('Y-m-d', strtotime('-70 day', strtotime($todat_date)));
		//dd($last45days);


    	$all_users = User::where('users.employee_type','Probation')
    	->leftJoin('designations','designations.id','=','users.designation')
    	->leftJoin('departments','departments.id','=','users.department')
    	->select('users.*','designations.name as designation_name','departments.name as department_name')
    	->get();
		$total_all_users = $all_users->count();
		//dd($total_all_users);

		$mail_from='no-reply@vcommission.com';

		$hr_email= \config('env_file_value.hr_email');
		

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

				//echo 'joining_date: '.$all_user['joining_date'].'<br>Last 2 days '.$last2days.'<br> last 30 days'.$last30days; dd();




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
				    	->first();
				    	
				    	$day_differnce=self::_day_differnce($all_user['joining_date']);
						//echo "<br>DIff: ".$day_differnce; 
				    	//dd($interview_users);

				    	$task_name="Interview Survey Form";

						$task_name_array= array('task_name'=>$task_name);
						$final_array=array_merge($data,$task_name_array);

				    	if($interview_users==null) {

				    		if($day_differnce<=5) {
				    			//echo "reminder day"; dd();

					    		Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});


					    	} else if( ($day_differnce>5) || ($day_differnce<=7) ) {

					    		Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});

					    	}

				    	} else if($interview_users) {
				    		//dd($interview_users['status']);

				    		if($interview_users['status']!=2 && $day_differnce<=5) {

					    		Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});


					    	} else if(($interview_users['status']!=2) &&  (($day_differnce>5) || ($day_differnce<=7)) ) {

					    		Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});

					    	}
				    	}



				    	$recruitment_users = UserRecruitmentForm::where('user_recruitment_forms.user_id',$all_user['id'])
				    	->first();
				    	//dd($recruitment_users);

				    	$task_name="Recruitment Survey Form";

						$task_name_array= array('task_name'=>$task_name);
						$final_array=array_merge($data,$task_name_array);

				    	if($recruitment_users==null) {
				    		//dd($recruitment_users);
				    		
				    		if($day_differnce<=5) {
				    			
				    			Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});

				    		} else if($day_differnce>5 || $day_differnce<=7) {

				    			Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});

				    		}

				    	} else if($recruitment_users) {
				    		//dd($recruitment_users['status']);

				    		if($recruitment_users['status']!=2 && $day_differnce<=5) {

					    		Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});

				    		} else if($recruitment_users['status']!=2 && ($day_differnce>5 || $day_differnce<=7)) {

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
					

				}





				if(($all_user['joining_date']<=$last30days) && ($all_user['joining_date']>$last45days)) {
					

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


						/*send notification to member, start here*/
						$training_users = TrainingSurvey::where('training_surveys.user_id',$all_user['id'])
					    	->first();
					    //dd($training_users);

					    $task_name="Training Survey";
						$task_name_array= array('task_name'=>$task_name);
						$final_array=array_merge($data,$task_name_array);

						if($training_users==null) {

							if($day_differnce<=33) {
								
								/*mail sent to member, start here*/
								Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});
								/*mail sent to member, end here*/

							} else if($day_differnce>33 || $day_differnce<=35){
								
								Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});

							}

						} else if($training_users) {

							if($training_users['status']!=2 && $day_differnce<=33) {
								
								/*mail sent to member, start here*/
								Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});
								/*mail sent to member, end here*/

							} else if($training_users['status']!=2 && ($day_differnce>33 || $day_differnce<=35)) {
								
								Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});

							}
						}
				    	/*send notification to member, end here*/



				    	/*send notification to manager, start here*/
				    	$manager_id_details = User::whereRaw("concat(first_name, ' ', last_name) like '%$manager_name%' ")
					    ->first();
					    $manager_id=$manager_id_details['id'];

					    
					    DB::enableQueryLog(); //for print sql query
					    $confirmation_feedback_managers = ConfirmationFeedbackForm::where('confirmation_feedback_forms.user_id',$all_user['id'])
							->where('confirmation_feedback_forms.manager_id',$manager_id)
					    	->first();
					    //dd($confirmation_feedback_managers);

					    /*for print sql query, start here */
				        //$quries = DB::getQueryLog();
				        //dd($quries);

					    $task_name="30-Day Feedback | ".$candidate_name." - ".$candidate_designation_name;
						$task_name_array= array('task_name'=>$task_name);
						$final_array=array_merge($data,$task_name_array);

					    if($confirmation_feedback_managers==null) {
					    	
					    	if($day_differnce<=33) {
					    		
					    		/*mail sent to member, start here*/
								Mail::send('mail-layout.cron-manager-reminder-survey-mail-template',$final_array, function($message) use ($manager_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($manager_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});
								/*mail sent to member, end here*/

					    	} else if($day_differnce>33 || $day_differnce<=35) {
					    		
					    		Mail::send('mail-layout.cron-manager-warning-survey-mail-template',$final_array, function($message) use ($manager_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($manager_email)
									->cc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});
					    	}
 
					    } else if($confirmation_feedback_managers) {
					    	
					    	if($confirmation_feedback_managers['status']!=2 && $day_differnce<=33) {
					    		
					    		Mail::send('mail-layout.cron-manager-reminder-survey-mail-template',$final_array, function($message) use ($manager_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($manager_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});

					    	} else if($confirmation_feedback_managers['status']!=2 && ($day_differnce>33 || $day_differnce<=35)) {

					    		Mail::send('mail-layout.cron-manager-warning-survey-mail-template',$final_array, function($message) use ($manager_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($manager_email)
									->cc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});
					    	}
					    }
				    	/*send notification to manager, end here*/
				    	
					}

				}


				


				if(($all_user['joining_date']<=$last45days) && ($all_user['joining_date']>$last70days)) {
					//return view('mail-layout.cron-check-in-form-member-template');
					//dd('45 days');

					if($all_user['joining_date']==$last45days) {

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

						
						/*send notification to member, start here*/
					    $check_in_member_details = DB::table('days_45_checkin_members')
					    ->where('days_45_checkin_members.user_id', $all_user['id'])
					    ->first();

					    $task_name="45 Days Member Check-In Form";
						$task_name_array= array('task_name'=>$task_name);
						$final_array=array_merge($data,$task_name_array);

					    if($check_in_member_details==null) {
					    	
					    	if($day_differnce<=48) {
					    		
					    		/*mail sent to member, start here*/
								Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});
								/*mail sent to member, end here*/

					    	} else if($day_differnce>48 || $day_differnce<=50) {
					    		
					    		Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});
					    		
					    	}

					    } else if($check_in_member_details) {
					    	
					    	if($check_in_member_details->status!=2 && $day_differnce<=48) {

					    		/*mail sent to member, start here*/
								Mail::send('mail-layout.cron-reminder-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});
								/*mail sent to member, end here*/

					    	} else if($check_in_member_details->status!=2 && ($day_differnce>48 || $day_differnce<=50)) {

					    		Mail::send('mail-layout.cron-warning-survey-mail-template',$final_array, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($candidate_email)
									->cc($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});

					    	}
					    }
					    /*send notification to member, end here*/



					    /*send notification to manager, start here*/
						$manager_id_detailss = User::whereRaw("concat(first_name, ' ', last_name) like '%$manager_name%' ")
					    ->first();
					    $manager_idd=0;
					    if($manager_id_detailss) {
					    	$manager_idd=$manager_id_detailss['id'];	
					    }
					    
					    //dd($manager_idd);					    
					    
					    $check_in_manager_details = DB::table('days_45_checkin_managers')
					    ->where('member_id', $all_user['id'])
					    ->where('manager_id', $manager_idd)
					    ->first();
					    //dd($check_in_manager_details);

						$task_name="45 Days Manager Check-In Form | ".$candidate_name." - ".$candidate_designation_name;
						$task_name_array= array('task_name'=>$task_name);
						$final_array=array_merge($data,$task_name_array);

						if($check_in_manager_details==null) {
							
							if($day_differnce<=48) {
								
								/*mail sent to member, start here*/
								Mail::send('mail-layout.cron-manager-reminder-survey-mail-template',$final_array, function($message) use ($manager_name, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($manager_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});
								/*mail sent to member, end here*/

							} else if($day_differnce>48 || $day_differnce<=50) {

								Mail::send('mail-layout.cron-manager-warning-survey-mail-template',$final_array, function($message) use ($manager_name, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});

							}

						} else if($check_in_manager_details) {
							
							if($check_in_manager_details->status!=2 && $day_differnce<=48) {
								
								/*mail sent to member, start here*/
								Mail::send('mail-layout.cron-manager-reminder-survey-mail-template',$final_array, function($message) use ($manager_name, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($manager_email)
									->cc($hr_email)
									->subject("Gentle Reminder - ".$task_name);
								});
								/*mail sent to member, end here*/

							} else if($check_in_manager_details->status!=2 && ($day_differnce>48 || $day_differnce<=50)) {

								Mail::send('mail-layout.cron-manager-warning-survey-mail-template',$final_array, function($message) use ($manager_name, $mail_from, $manager_email, $hr_email, $task_name) {
									$message->from($mail_from)
									->to($manager_email)
									->bcc($hr_email)
									->subject("Need Immediate Closure - ".$task_name);
								});

							}

						}
						/*send notification to manager, end here*/

					}

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



    public function _day_differnce($joining_date) {

    	$now_date = strtotime(date('Y-m-d')); // or your date as well
		$your_date = strtotime($joining_date);
		$datediff = $now_date - $your_date;

		$day_differnce=(round($datediff / (60 * 60 * 24)));

		return $day_differnce;

    }



    /* save energy points in member account , start here */
    public function memberEnergyCron() {


    	$all_users = User::all();

    	$q1_1=date('Y-').'04-01';
    	$q1_2=date('Y-').'06-30';

    	$q2_1=date('Y-').'07-01';
    	$q2_2=date('Y-').'09-30';

    	$q3_1=date('Y-').'10-01';
    	$q3_2=date('Y-').'12-31';

    	$q4_1=date('Y-').'01-01';
    	$q4_2=date('Y-').'03-31';


    	$current_date=date('Y-m-d');

    	/*$q1_1='04-01';
    	$q1_2='06-30';

    	$q2_1='07-01';
    	$q2_2='09-30';

    	$q3_1='10-01';
    	$q3_2='12-31';

    	$q4_1='01-01';
    	$q4_2='03-31';*/



    	//echo "Q1 ".$q1_1.' - '.$q1_2.'<br>Q2 '.$q2_1.' - '.$q2_2.'<br>Q3 '.$q3_1.' - '.$q3_2.'<br>Q4 '.$q4_1.' - '.$q4_2.'<br><br>';

    	//echo "Q1 ".$q1_1.'<br>Q2 '.$q2_1.'<br>Q3 '.$q3_1.'<br>Q4 '.$q4_1.'<br><br>';

    	//echo "<br>";
    	foreach($all_users as $all_user) {
    		//echo "<br>".date('m-d',strtotime($all_user['joining_date']));
    		$cntr=0;
    		//if($all_user['id']=='11') {

    			//$all_user['joining_date']='2021-10-26';
    			echo $joining_date=date('Y-m-d',strtotime($all_user['joining_date']));


    			/*if(($joining_date<=$q1_2)) {
    				echo "<br>Q1 ".$cntr=$cntr+5;

    				User::where('id', $all_user['id'])->increment('energy', '5');
    			}

    			if(($joining_date<=$q2_2)) {
    				echo "<br>Q2 ".$cntr=$cntr+5;

    				User::where('id', $all_user['id'])->increment('energy', '5');
    			}

    			if(($joining_date<=$q3_2)) {
    				echo "<br>Q3 ".$cntr=$cntr+5;

    				User::where('id', $all_user['id'])->increment('energy', '5');
    			}

    			if(($joining_date<=$q4_2)) {
    				echo "<br>Q4 ".$cntr=$cntr+5;

    				User::where('id', $all_user['id'])->increment('energy', '5');
    			}*/


    			/*User::where('id', $all_user['id'])
			            ->update([
			            	'energy' => '5',
			                'last_energy_update_quarter' => 'Q1',
			            ]); */

    			if(($current_date>=$q1_1) && ($current_date<=$q1_2) && ($all_user['last_energy_update_quarter']!='Q1')){
    				if(($joining_date<=$q1_2)) {
	    				echo "<br>Q1 ".$cntr=$cntr+5;

	    				User::where('id', $all_user['id'])
			            ->update([
			            	'energy' => '5',
			                'last_energy_update_quarter' => 'Q1',
			            ]);

	    				/*User::where('id', $all_user['id'])->increment('energy', '5');

	    				User::where('id', $all_user['id'])
			            ->update([
			                'last_energy_update_quarter' => 'Q1',
			            ]); */
	    			}
    			}
	    			

    			if(($current_date>=$q2_1) && ($current_date<=$q2_2) && ($all_user['last_energy_update_quarter']!='Q2')){
    				if(($joining_date<=$q2_2)) {
	    				echo "<br>Q2 ".$cntr=$cntr+5;

	    				User::where('id', $all_user['id'])->increment('energy', '5');

	    				User::where('id', $all_user['id'])
			            ->update([
			                'last_energy_update_quarter' => 'Q2',
			            ]);
	    			}
    			}
	    			

    			if(($current_date>=$q3_1) && ($current_date<=$q3_2) && ($all_user['last_energy_update_quarter']!='Q3')){
    				if(($joining_date<=$q3_2)) {
	    				echo "<br>Q3 ".$cntr=$cntr+5;

	    				User::where('id', $all_user['id'])->increment('energy', '5');

	    				User::where('id', $all_user['id'])
			            ->update([
			                'last_energy_update_quarter' => 'Q3',
			            ]);
	    			}
    			}
	    			

    			if(($current_date>=$q4_1) && ($current_date<=$q4_2) && ($all_user['last_energy_update_quarter']!='Q4')){

    				if(($joining_date<=$q4_2)) {
	    				echo "<br>Q4 ".$cntr=$cntr+5;

	    				User::where('id', $all_user['id'])->increment('energy', '5');

	    				User::where('id', $all_user['id'])
			            ->update([
			                'last_energy_update_quarter' => 'Q4',
			            ]);
	    			}
    			}

    			echo "<br>".$all_user['first_name'].' : '.$cntr."<br><br>";

    			//User::where('id', $all_user['id'])->increment('energy', '5');
    		//}


    	}

    }
    /* save energy points in member account , end here */




}
