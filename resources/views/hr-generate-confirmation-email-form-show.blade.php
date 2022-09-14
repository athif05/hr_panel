@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Hiring Survey | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
    	.form-check-input[type=radio] {
		  margin-left: 30px;
		  border-radius: 50%;
		}

    .text-danger{
      font-size: 13px!important;
    }

    .rate-star-color{
    	color: #f7cd13;
    }
    </style>
@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- <h5 class="card-title">Generate Email Details</h5> -->
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              <center>
		          <table  cellpadding="0" cellspacing="0" align="center" width="700" border="0" style="font-family: Calibri, sans-serif; color: #666;">
		            <tbody>
		              <tr>
		                <td bgcolor="#595959" align="center" style="font-family: Calibri, sans-serif;  height: 70px; font-size: 40px; color: #fff; text-transform: uppercase;font-weight: bold;"> Confirmation Letter {{ date('Y') }} </td>
		              </tr>
		              <tr>
		                <td style="line-height: 10px;"><img src="https://vcim.net/evaluation/assets/mailers/grey_1/Border_1.jpg" alt="img" width="700" height="16" /></td>
		              </tr>
		              <tr>
		                <td style="line-height: 10px;"><img src="https://vcim.net/evaluation/assets/mailers/grey_1/Emp_Details.jpg" alt="img" width="700" height="64" /></td>
		              </tr>
		              <tr>
		                <td align="center"  bgcolor="#fcdc00" style="font-size:18px; color: #131313;line-height: 34px;">


		                    <table width="640" border="0" cellspacing="0" cellpadding="0" >
		                    <tbody>
		                      <tr>
		                        <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
		                            <tbody>
		                              <tr>
		                                <td  height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;"><strong>Name:</strong></td>
		                                <td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">{{ $user_details['full_name'] }}</td>
		                              </tr>
		                              <tr>
		                                <td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;"><strong>Designation:</strong></td>
		                                <td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">{{ $user_details['designation_name'] }} </td>
		                              </tr>
		                              <tr>
		                                <td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;"><strong>Department:</strong></td>
		                                <td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">{{ $user_details['department_name'] }} </td>
		                              </tr>
		                            </tbody>
		                          </table></td>

		                          <?php $avg_score=0;  $score_card=0; $counter=0;?>
		                          @foreach($confirmation_mom_details as $confirmation_mom_detail)

		                          	<?php 
		                          		$score_card=($score_card+$confirmation_mom_detail['average_rating_entire_presentation']);

		                          		$avg_score=$avg_score+($confirmation_mom_detail['content']+$confirmation_mom_detail['confidence']+$confirmation_mom_detail['communication']+$confirmation_mom_detail['data_relevance']+$confirmation_mom_detail['overall_growth_individual']);
		                          		
				                      $counter++;


				                    ?>

		                          @endforeach

		                          <?php if($score_card>0) { $score_card=$score_card/$counter; }?>

		                        <td style="border-left: 1px solid #ae9322;padding-left: 44px;padding-right: 25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		                            <tbody>
		                              <tr>
		                                <td  height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;"><strong>Score Card:</strong></td>
		                                <td  height="30">{{ $score_card }}</td>
		                              </tr>
		                              <tr>
		                                <td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;"><strong>Avg. Evaluation Score:</strong></td>
		                                <td  height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">{{ $avg_score }}</td>
		                              </tr>
		                              <tr>
		                                <td   height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;"><strong>Appraisal Cycle:</strong></td>
		                                <td  height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">{{ $user_details['appraisal_cycle'] }}</td>
		                              </tr>
		                            </tbody>
		                          </table></td>

		                        	<td align="center"   style="border-left: 1px solid #ae9322;">
		                        		<img src="{{ asset('').$user_details['profile_image'] }}" alt="img" width="84" height="87" style="border: solid 4px #f9d94a" />
		                        	</td>
		                      </tr>
		                        <tr><td height="20"></td></tr>
		                    </tbody>
		                  </table></td>
		              </tr>
		              <tr>
		                <td style="line-height: 10px;" ><img src="https://vcim.net/evaluation/assets/mailers/grey_1/Border_2.jpg" alt="img" width="700" height="16" /></td>
		              </tr>
		              <tr><td height="20"></td></tr>


		                <tr><td align="center">


		                    <table width="640" border="0" cellspacing="0" cellpadding="0" >
		                    <tbody>
		                      <tr>
		                <td bgcolor="#fff" align="left" style="font-family: Calibri, sans-serif; font-size: 20px;color: #10131e;"><strong>Hi {{ $user_details['full_name'] }},</strong>
		                 </td>
		              </tr>
		                <tr><td height="20"></td></tr>
		               <tr><td bgcolor="#fff" align="left" style="font-family: Calibri, sans-serif; font-size: 18px;color: #10131e; text-align: justify; line-height: 22px;">

		            This is to bring to your notice that consequent to the review of your performance during your probation, we have the pleasure in informing you that, your services are being confirmed as <strong>{{ $user_details['designation_name'] }}, {{ $user_details['department_name'] }}</strong> with effect from <strong></strong>.
		            <br/><br/>
		            As discussed, your total annual compensation package remains the same and you will now enjoy all the benefits of a confirmed employee of the company. All the other terms and conditions as detailed in your appointment letter or employment agreement remain unchanged.
		            <br/><br/>
		            You may go through <a href="https://vcim.net/evaluation/assets/Confirmation Handbook_2020.pptx">confirmation handbook</a> for your information and also book your calendar  for a quick session by me on the same. Please see the details below.

		            <br/><br/>
		            <strong>Agenda: Session on Benefits after Confirmation</strong> <br/>
		            POC: {{ $generate_email_details['full_poc_name'] }}<br/>
		            Date: {{ $generate_email_details['session_date'] }}<br/>
		            Location: {{ $generate_email_details['location'] }}<br/>
		            Duration: ½ an hour<br/>
		            Time: {{ date('h:iA',strtotime($generate_email_details['session_time'])) }}<br/>
		            <br/>
		            We look forward to your valuable contributions and wish you all the very best for a rewarding career with the organization.
		            <br/><br/>
		            Please accept our congratulations on your confirmation.


		        </td></tr>
		                    </tbody>
		                  </table>
		                    </td></tr>

		              <tr>
		                <td bgcolor="#fff" align="center" ><table width="640" border="0" cellspacing="0" cellpadding="0" >
		                    <tbody>

		                        <tr>
		                <td height="10"></td>
		              </tr>

		                        <tr>
		                <td height="10"></td>
		              </tr>

		                      <tr>
		                <td height="10"></td>
		              </tr></tbody>
		                  </table></td>
		              </tr>
		              <tr>
		                <td align="center">

		                </td>
		              </tr>

		                <tr><td height="30"></td></tr>
		              <tr>
		                <td style="line-height: 0px;"><img src="https://vcim.net/evaluation/assets/mailers/grey_1/Border_3.jpg" alt="img" width="700" height="17" /></td>
		              </tr><tr>
		                <td style="line-height: 10px;"><img src="https://vcim.net/evaluation/assets/mailers/grey_1/NotefromCEO.jpg" alt="img" width="700" height="60" /></td>
		              </tr>
		            <td bgcolor="#fcdc00" align="center" >



		                <table width="640" border="0" cellspacing="0" cellpadding="0" >
		                    <tbody>


		                        <tr><td height="10"></td></tr>

		                        <tr>
		                <td  align="left" style="font-family: Calibri, sans-serif; font-size: 18px;color: #10131e; text-align: justify; line-height: 22px;">
		                  I want to extend heartiest congratulations to you! Your performance, hard work & dedication has brought us to this decision & I’m sure you will continue to give your best. I hope company expectations & demands of your job role are clear, if not, please consult your manager or me. Keep up the good work!

		                </td>
		              </tr>

		        <tr><td height="30"></td></tr>
		                    </tbody>
		                  </table></td>
		            <tr>
		              <td style="line-height: 10px;"><img src="https://vcim.net/evaluation/assets/mailers/grey_1/Border_4.jpg" alt="img" width="700" height="17" /></td>
		            </tr>
		            <tr bgcolor="#595959" align="center">
		              <td><table width="640" border="0" cellspacing="0" cellpadding="0"  >
		                  <tbody>
		                    <tr bgcolor="#595959" align="left">
		                      <td  height="60" style="font-family: Calibri, sans-serif; font-size: 18px; color: #fff;"></td>
		                      <td  height="60" style="font-family: Calibri, sans-serif; font-size: 18px; color: #fff;"><img src="https://vcim.net/mailer/appraisal-html/footer-logo.png"/></td>
		                      <td align="right" style="font-family: Calibri, sans-serif; font-size: 18px; color: #fff;"></td>
		                    </tr>
		                  </tbody>
		                </table></td>
		            </tr>
		            </tbody>

		          </table>
		        </center>

              
		        <div style="display: flex;margin: auto;justify-content: center;margin-top: 2%;margin-bottom: 2%;">
					<a href="?send=1" class="btn-default" style="text-decoration: none">Send Email</a>
				</div>


            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
@endsection