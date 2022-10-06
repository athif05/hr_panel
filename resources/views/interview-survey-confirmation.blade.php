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
            <h2>Interview Survey
              <img src="{{ str_replace('public/', '', asset('resources/views/confirmation-process/img/emp-icon.png')) }}" alt="icon" />
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
              <div class="col-left">{{ $inteview_details['designation_name'] }}</div>
              </li>

              <h2>Q. 5 - Which location did you apply for?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['location_name'] }}</div>
              </li>

              <h2>Q. 6 - How did you learn about the job opening with us?</h2>
              <li>
              <div class="col-left">@if($inteview_details['job_opening_types_name']){{ $inteview_details['job_opening_types_name'] }} @else Others @endif</div>
              </li>

              <h2>Q. 7 - Name the Referral Source?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['referral_source_name'] }}</div>
              </li>

              <h2>Q. 8 - Name the HR from the company, who coordinated with you for the interview?</h2>
              <li>
              <div class="col-left">{{ $inteview_details['hr_name_ajax'] }}</div>
              </li>


              <h2>Q. 9 - Rate {{ $inteview_details['hr_name_ajax'] }} on the following parameters, out of 5.</h2>
              

              <!-- <div class="month_overview feedback_overview">
                <div class="score_col_row">
                  <div class="score_col">
                    <p>Approachable</p>
                    <span>{{ $inteview_details['approachable'] }} <span class="float_right_div">{{ $inteview_details['approachable'] }} @for($i=0; $i < $inteview_details['approachable']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                @endfor</span></span> 
                  </div>

                  <div class="score_col">
                    <p>Respectful</p>
                    <span> <span class="float_right_div">{{ $inteview_details['approachable'] }} @for($i=0; $i < $inteview_details['approachable']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                @endfor</span></span> 
                  </div>
              </div> -->


              <li>
              <div class="col-left">
                Prompt in responding to my queries 

                @if($inteview_details['prompt_responding_my_queries']!='NA')
                  @for($i=0; $i < $inteview_details['prompt_responding_my_queries']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <!-- <h2>Q. 9 -Approachable</h2> -->
              <li>
              <div class="col-left">
                Approachable 

                @if($inteview_details['approachable']!='NA')
                  @for($i=0; $i < $inteview_details['approachable']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 10 - Respectful</h2> -->
              <li>
              <div class="col-left">
                Respectful 
                @if($inteview_details['respectful']!='NA')
                  @for($i=0; $i < $inteview_details['respectful']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 11 - Could explain the job role well</h2> -->
              <li>
              <div class="col-left">
                Could explain the job role well 
                @if($inteview_details['explain_job_role']!='NA')
                  @for($i=0; $i < $inteview_details['explain_job_role']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 12 - Could explain the company background well</h2> -->
              <li>
              <div class="col-left">
                Could explain the company background well 
                @if($inteview_details['explain_company_background']!='NA')
                  @for($i=0; $i < $inteview_details['explain_company_background']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                    @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 13 - Shared proper information about interview process</h2> -->
              <li>
              <div class="col-left">
                Shared proper information about interview process 
                @if($inteview_details['shared_proper_interview_information']!='NA')
                  @for($i=0; $i < $inteview_details['shared_proper_interview_information']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 14 - Discussed about my profile in detail to check my fitment with the role</h2> -->
              <li>
              <div class="col-left">
                Discussed about my profile in detail to check my fitment with the role 
                @if($inteview_details['discussed_my_profile']!='NA')
                  @for($i=0; $i < $inteview_details['discussed_my_profile']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 15 - Shared my interview feedback quickly after the interview</h2> -->
              <li>
              <div class="col-left">
                Shared my interview feedback quickly after the interview 
                @if($inteview_details['shared_interview_feedback_quickly']!='NA')
                  @for($i=0; $i < $inteview_details['shared_interview_feedback_quickly']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <h2>Q. 10 - Any additional feedback for the recruiter?</h2>
              <li>
              <div class="col-left">{!! $inteview_details['additional_feedback_recruiter'] !!}</div>
              </li>

              <h2>Q. 11 - How much will you rate {{ $inteview_details['hr_name_ajax'] }}'s overall conduct? (out of 5)</h2>
              <li>
              <div class="col-left"> 
                @if($inteview_details['rate_overall_conduct']!='NA')
                  @for($i=0; $i < $inteview_details['rate_overall_conduct']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <h2>Q. 12 - Rate the interviewers on the following parameters (Out of 5)</h2>
              <!-- <h2>Q. 18 - Professionalism</h2> -->
              <li>
              <div class="col-left">Professionalism 
                @if($inteview_details['professionalism']!='NA')
                  @for($i=0; $i < $inteview_details['professionalism']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 19 - Friendliness</h2> -->
              <li>
              <div class="col-left">Friendliness
                @if($inteview_details['friendliness']!='NA')
                  @for($i=0; $i < $inteview_details['friendliness']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 20 - Hepful</h2> -->
              <li>
              <div class="col-left">Hepful 
                @if($inteview_details['heplful']!='NA')
                  @for($i=0; $i < $inteview_details['heplful']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 21 - Approachable</h2> -->
              <li>
              <div class="col-left">Approachable 
                @if($inteview_details['approachable_interviewers']!='NA')
                  @for($i=0; $i < $inteview_details['approachable_interviewers']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 22 - Respectable</h2> -->
              <li>
              <div class="col-left">Respectable 
                @if($inteview_details['respectable']!='NA')
                  @for($i=0; $i < $inteview_details['respectable']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 23 - Knowledgeable</h2> -->
              <li>
              <div class="col-left">Knowledgeable 
                @if($inteview_details['knowledgeable']!='NA')
                  @for($i=0; $i < $inteview_details['knowledgeable']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 24 - Clear communication about company</h2> -->
              <li>
              <div class="col-left">Clear communication about company 
                @if($inteview_details['clear_communication_about_company']!='NA')
                  @for($i=0; $i < $inteview_details['clear_communication_about_company']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 25 - Clear communication about job role</h2> -->
              <li>
              <div class="col-left">Clear communication about job role
                @if($inteview_details['clear_communication_job_role']!='NA') 
                  @for($i=0; $i < $inteview_details['clear_communication_job_role']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 13 - Rate the interview process on the following parameters (out of 5)</h2>
              <!-- <h2>Q. 26 - The process started on time</h2> -->
              <li>
              <div class="col-left">The process started on time 
                @if($inteview_details['process_started_on_time']!='NA') 
                  @for($i=0; $i < $inteview_details['process_started_on_time']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 27 - The process was fair & apt</h2> -->
              <li>
              <div class="col-left">The process was fair & apt 
                @if($inteview_details['process_fair_apt']!='NA') 
                  @for($i=0; $i < $inteview_details['process_fair_apt']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 28 - The seating arrangement was comfortable</h2> -->
              <li>
              <div class="col-left">The seating arrangement was comfortable 
                @if($inteview_details['seating_arrangement_comfortable']!='NA') 
                  @for($i=0; $i < $inteview_details['seating_arrangement_comfortable']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 29 - Staff was helpful & supportive</h2> -->
              <li>
              <div class="col-left">Staff was helpful & supportive
                @if($inteview_details['staff_helpful_supportive']!='NA')  
                  @for($i=0; $i < $inteview_details['staff_helpful_supportive']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <!-- <h2>Q. 30 - Received my interview feedback on time</h2> -->
              <li>
              <div class="col-left">Received my interview feedback on time 
                @if($inteview_details['received_interview_feedback']!='NA') 
                  @for($i=0; $i < $inteview_details['received_interview_feedback']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 14 - How will you define the overall Interview Process?</h2>
              <li>
              <div class="col-left">
                @if($inteview_details['define_overall_interview_process']!='Others')
                  {{ $inteview_details['define_overall_interview_process'] }} 
                @else 
                  {{ $inteview_details['define_overall_interview_process_others'] }} 
                @endif
              </div>
              </li>


              <h2>Q. 15 - Rate the overall interview process. (out of 5)</h2>
              <li>
              <div class="col-left"><!-- <strong>{{ $inteview_details['rate_overall_interview_process'] }}</strong>  -->
                @if($inteview_details['rate_overall_interview_process']!='NA') 
                  @for($i=0; $i < $inteview_details['rate_overall_interview_process']; $i++)
                      <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 16 - If you have any comments, suggestions, or feedback, please enter it below:</h2>
              <li>
              <div class="col-left">{!! $inteview_details['comments_suggestions_feedback'] !!}</div>
              </li>

              @else 

              <h2>No record found...</h2>

              @endif
             

            </ul>
          </div>



          <div class="btn-group">
            
            <a href="{{ url('/recruitment-survey/'.$employee_id) }}" class="btn btn-default">previous</a>

            <a href="{{ url('/training-survey/'.$employee_id) }}" class="btn btn-default btn-active">next</a>

          </div>


        </div>


      </div>
    </div>
  </div>
@endsection