@extends('confirmation-process.layouts.master')


@section("title")
  <meta content="" name="description">
  <meta content="" name="keywords">

  <title>Interview Survey | {{ env('MY_SITE_NAME') }}</title>
@endsection


@section('content')
  <div class="survey_sec">
    <div class="survey_container">
      <div class="imployee_data">

        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
          <div class="top_heading">
            <h2>let’s talk about you! 
              <img src="{{ asset('resources/views/confirmation-process/img/emp-icon.png') }}" alt="icon" />
            </h2>
          </div>
          <div class="imployee_detail mCustomScrollbar">
            <ul>

                    
              @if($inteview_details)

              <h2>Q. 1 - Member's Name</h2>
              <li>
              <div class="col-left">{{ $inteview_details['member_name'] }}</div>
              </li>

              <h2>Q. 2 - Official Email</h2>
              <li>
              <div class="col-left">{{ $inteview_details['official_email'] }}</div>
              </li>

              <h2>Q. 3 - Which company did you apply for?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['company_name'] }}</div>
              </li>

              <h2>Q. 4 - What position were you interviewed for?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['job_position_name'] }}</div>
              </li>

              <h2>Q. 5 - Which location did you apply for?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['location_name'] }}</div>
              </li>

              <h2>Q. 6 - How did you learn about the job opening with us?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['job_opening_types_name'] }}</div>
              </li>

              <h2>Q. 7 - Name the Referral Source?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['referral_source_name'] }}</div>
              </li>

              <h2>Q. 8 - Name the HR from the company, who coordinated with you for the interview?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['company_hr_name'] }}</div>
              </li>


              <h2>Q. 9 - "Rate ${Q-H} on the following parameters, out of 5."</h2>
              

              <!-- <div class="month_overview feedback_overview">
                <div class="score_col_row">
                  <div class="score_col">
                    <p>Approachable</p>
                    <span>{{ $inteview_details['approachable'] }} <span class="float_right_div">{{ $inteview_details['approachable'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></span> 
                  </div>

                  <div class="score_col">
                    <p>Respectful</p>
                    <span> <span class="float_right_div">{{ $inteview_details['approachable'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></span> 
                  </div>
              </div> -->



              <!-- <h2>Q. 9 -Approachable</h2> -->
              <li>
              <div class="col-left">Approachable <span class="float_right_div">{{ $inteview_details['approachable'] }} &nbsp; <i class="fa fa-star rating_star"></i></span>  </div>
              </li>

              <!-- <h2>Q. 10 - Respectful</h2> -->
              <li>
              <div class="col-left">Respectful <span class="float_right_div">{{ $inteview_details['respectful'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 11 - Could explain the job role well</h2> -->
              <li>
              <div class="col-left">Could explain the job role well <span class="float_right_div">{{ $inteview_details['explain_job_role'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 12 - Could explain the company background well</h2> -->
              <li>
              <div class="col-left">Could explain the company background well <span class="float_right_div">{{ $inteview_details['explain_company_background'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 13 - Shared proper information about interview process</h2> -->
              <li>
              <div class="col-left">Shared proper information about interview process <span class="float_right_div">{{ $inteview_details['shared_proper_interview_information'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 14 - Discussed about my profile in detail to check my fitment with the role</h2> -->
              <li>
              <div class="col-left">Discussed about my profile in detail to check my fitment with the role <span class="float_right_div">{{ $inteview_details['discussed_my_profile'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 15 - Shared my interview feedback quickly after the interview</h2> -->
              <li>
              <div class="col-left">Shared my interview feedback quickly after the interview <span class="float_right_div">{{ $inteview_details['shared_interview_feedback_quickly'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <h2>Q. 10 - Any additional feedback for the recruiter?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['additional_feedback_recruiter'] }}</div>
              </li>

              <h2>Q. 11 - How much will you rate ${Q-H}'s overall conduct? (out of 5)</h2>
              <li>
              <div class="col-left"><strong>{{ $inteview_details['rate_overall_conduct'] }}</strong> <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <h2>Q. 12 - Rate the interviewers on the following parameters (Out of 5)</h2>
              <!-- <h2>Q. 18 - Professionalism</h2> -->
              <li>
              <div class="col-left">Professionalism <span class="float_right_div">{{ $inteview_details['professionalism'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 19 - Friendliness</h2> -->
              <li>
              <div class="col-left">Friendliness <span class="float_right_div">{{ $inteview_details['friendliness'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 20 - Hepful</h2> -->
              <li>
              <div class="col-left">Hepful <span class="float_right_div">{{ $inteview_details['heplful'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 21 - Approachable</h2> -->
              <li>
              <div class="col-left">Approachable <span class="float_right_div">{{ $inteview_details['approachable_interviewers'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 22 - Respectable</h2> -->
              <li>
              <div class="col-left">Respectable <span class="float_right_div">{{ $inteview_details['respectable'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 23 - Knowledgeable</h2> -->
              <li>
              <div class="col-left">Knowledgeable <span class="float_right_div">{{ $inteview_details['knowledgeable'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 24 - Clear communication about company</h2> -->
              <li>
              <div class="col-left">Clear communication about company <span class="float_right_div">{{ $inteview_details['clear_communication_about_company'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 25 - Clear communication about job role</h2> -->
              <li>
              <div class="col-left">Clear communication about job role <span class="float_right_div">{{ $inteview_details['clear_communication_job_role'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>


              <h2>Q. 13 - Rate the interview process on the following parameters (out of 5)</h2>
              <!-- <h2>Q. 26 - The process started on time</h2> -->
              <li>
              <div class="col-left">The process started on time <span class="float_right_div">{{ $inteview_details['process_started_on_time'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 27 - The process was fair & apt</h2> -->
              <li>
              <div class="col-left">The process was fair & apt <span class="float_right_div">{{ $inteview_details['process_fair_apt'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 28 - The seating arrangement was comfortable</h2> -->
              <li>
              <div class="col-left">The seating arrangement was comfortable <span class="float_right_div">{{ $inteview_details['seating_arrangement_comfortable'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 29 - Staff was helpful & supportive</h2> -->
              <li>
              <div class="col-left">Staff was helpful & supportive <span class="float_right_div">{{ $inteview_details['staff_helpful_supportive'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              <!-- <h2>Q. 30 - Received my interview feedback on time</h2> -->
              <li>
              <div class="col-left">Received my interview feedback on time <span class="float_right_div">{{ $inteview_details['received_interview_feedback'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>


              <h2>Q. 14 - How will you define the overall Interview Process?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['define_overall_interview_process'] }}</div>
              </li>


              <h2>Q. 15 - Rate the overall interview process. (out of 5)</h2>
              <li>
              <div class="col-left"><strong>{{ $inteview_details['rate_overall_interview_process'] }}</strong> <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span></div>
              </li>


              <h2>Q. 16 - If you have any comments, suggestions, or feedback, please enter it below:</h2>
              <li>
              <div class="col-left">{{ $inteview_details['comments_suggestions_feedback'] }}</div>
              </li>

              @else 

              <h2>No record found...</h2>

              @endif
             

            </ul>
          </div>



          <div class="btn-group">
            
            <a href="{{ url('/start-confirmation-process/'.$employee_id) }}" class="btn btn-default">previous</a>

            <a href="{{ url('/recruitment-survey/'.$employee_id) }}" class="btn btn-default btn-active">next</a>

          </div>


        </div>


      </div>
    </div>
  </div>
@endsection