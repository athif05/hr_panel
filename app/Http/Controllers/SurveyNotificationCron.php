<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Mail;

use Config; //use custom field from .env file

use Illuminate\Support\Facades\Crypt; //for encrypt String

class SurveyNotificationCron extends Controller
{
    
	/* send notification for all candidate who join before 2 days, start here */
    public function sendCron(Request $request){
    	
    	$todat_date=date('Y-m-d');
		$last2days=date('Y-m-d', strtotime('-2 day', strtotime($todat_date)));
		$last45days=date('Y-m-d', strtotime('-45 day', strtotime($todat_date)));
		$last70days=date('Y-m-d', strtotime('-70 day', strtotime($todat_date)));



    	$all_users = User::where('joining_date',$last2days)
    	->orWhere('joining_date',$last45days)
    	->orWhere('joining_date',$last70days)
    	->get();
		$total_all_users = $all_users->count();
		//dd($all_users);

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
				$candidate_name=$all_user['name'];
				$candidate_email=$all_user['email'];
				$manager_name=$all_user['manager_name'];
				$manager_email=$all_user['manager_email'];

				$encryp_candidate_id=Crypt::encryptString($candidate_id);

				$data=array('candidate_id'=>$candidate_id, 'candidate_name'=>$candidate_name, 'candidate_email'=>$candidate_email, 'manager_name'=>$manager_name, 'manager_email'=>$manager_email, 'encryp_candidate_id'=>$encryp_candidate_id);


				if($all_user['joining_date']==$last2days){
					
					//return view('mail-layout.cron-survey-mail-template');
					//dd('aa');

					Mail::send('mail-layout.cron-survey-mail-template',$data, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email) {
						$message->from($mail_from)
						->to($candidate_email)
						->cc($manager_email)
						->bcc($hr_email)
						->subject("Fill Interview Survey");
					});

					//echo "sent";

				} else if($all_user['joining_date']==$last45days){
					
					//echo "<br> 45 days ";
					//return view('mail-layout.cron-check-in-form-member-template');

					Mail::send('mail-layout.cron-check-in-form-member-template',$data, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email) {
						$message->from($mail_from)
						->to($candidate_email)
						->cc($manager_email)
						->bcc($hr_email)
						->subject("Fill Check-In Form Member");
					});



					//return view('mail-layout.cron-check-in-form-manager-template');

					Mail::send('mail-layout.cron-check-in-form-manager-template',$data, function($message) use ($manager_name, $encryp_candidate_id, $mail_from, $manager_email, $hr_email) {
						$message->from($mail_from)
						->to($manager_email)
						->cc($hr_email)
						->subject("Fill Check-In Form Manager");
					});

				} else if($all_user['joining_date']==$last70days){
					
					//echo "<br> 70 days ";
					//return view('mail-layout.cron-confirmation-process-initation-member-template');

					Mail::send('mail-layout.cron-confirmation-process-initation-member-template',$data, function($message) use ($candidate_name, $candidate_email, $mail_from, $manager_email, $hr_email) {
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
					});
				}
			} 

			echo "sent all mails";

		} else {
			echo "no record...";
		}

			
    }
    /* send notification for all candidate who join before 2 days, start here */

}
