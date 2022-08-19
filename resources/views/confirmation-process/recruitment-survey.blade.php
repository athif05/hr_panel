@extends('confirmation-process.layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Survey | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>let’s talk about you! <img src="{{ asset('resources/views/confirmation-process/img/emp-icon.png') }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              <h2>Q. 1 - Your Name</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['your_name'] }}</div>
              </li>

              <h2>Q. 2 - Member ID</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['member_id'] }}</div>
              </li>

              <h2>Q. 3 - Designation</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['designation'] }}</div>
              </li>

              <h2>Q. 4 - Department</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['department'] }}</div>
              </li>

              <h2>Q. 5 - Please choose the name of your company</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['company_name'] }}</div>
              </li>

              <h2>Q. 6 - Date of Joining</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['date_of_joining'] ? date('d-M-Y', strtotime($recruitment_details['date_of_joining'])) : ''}}</div>
              </li>

              <h2>Q. 7 - How did you come across this job opening?</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['job_opening_types_name'] }}</div>
              </li>

              @if($recruitment_details['how_come_for_job_opening']=='1')
              <li>
              <div class="col-left"><strong>Internal Employee Name</strong>
                <span class="float_right_div">{{ $recruitment_details['internal_employee_name'] }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>Internal Employee Designation</strong>
                <span class="float_right_div">{{ $recruitment_details['internal_employee_designation'] }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>Internal Employee Department</strong>
                <span class="float_right_div">{{ $recruitment_details['internal_employee_department'] }}</span>  
              </div>
              </li>
              @endif

              <h2>Q. 8 - What's the name of your recruiter?</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['name_of_your_recruiter'] }}</div>
              </li>


              <h2>Q. 9 - Rate your recruiter in the following parameters out of 5:</h2>
      
              <li>
              <div class="col-left">Professionalism <span class="float_right_div">{{ $recruitment_details['professionalism'] }} &nbsp; <i class="fa fa-star rating_star"></i></span>  </div>
              </li>

              
              <li>
              <div class="col-left">Friendliness <span class="float_right_div">{{ $recruitment_details['friendliness'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

            
              <li>
              <div class="col-left">Length of the time spent talking to you <span class="float_right_div">{{ $recruitment_details['length_time_spent_talking'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              
              <li>
              <div class="col-left">Company knowledge <span class="float_right_div">{{ $recruitment_details['company_knowledge'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              
              <li>
              <div class="col-left">Specific knowledge about the job profile <span class="float_right_div">{{ $recruitment_details['specific_knowledge_job_profile'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>

              
              <li>
              <div class="col-left">Timely response to your communications - email or phone <span class="float_right_div">{{ $recruitment_details['timely_response_email_phone'] }} &nbsp; <i class="fa fa-star rating_star"></i></span></div>
              </li>


              <h2>Q. 10 - Yes/No Questions</h2>
              <li>
              <div class="col-left">Do you completely understand our company policies and procedures as outlined in the handbook? <span class="float_right_div">{{ $recruitment_details['company_policies_procedures'] }}</span></div>
              </li>

              <li>
              <div class="col-left">Do you completely understand departmental processes as explained in 'Manager's Expectation Setting' session? <span class="float_right_div">{{ $recruitment_details['manager_expectation_setting'] }}</span></div>
              </li>

              
              <li>
              <div class="col-left">Do you completely understand your job duties and responsibilities? <span class="float_right_div">{{ $recruitment_details['job_duties_responsibilities'] }}</span></div>
              </li>

              
              <li>
              <div class="col-left">Do you feel that your job title is properly named? <span class="float_right_div">{{ $recruitment_details['job_title_properly_named'] }}</span></div>
              </li>


              <h2>Q. 11 - What will be your mission for the first year?</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['mission_for_first_year'] }}</div>
              </li>

              <h2>Q. 12 - What do you aim in the second year?</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['aim_in_second_year'] }}</div>
              </li>

              <h2>Q. 13 - What will be your aim in the third year of your tenure with us?</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['aim_third_year_tenure'] }}</div>
              </li>


              <h2>Q. 14 - Rate the overall recruitment process of our company! (Rating out of 5)</h2>
              <li>
              <div class="col-left"><strong>{{ $recruitment_details['rate_overall_recruitment_process'] }}</strong> <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span></div>
              </li>


              <h2>Q. 15 - Any additional feedback for the recruitment process?</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['additional_feedback_recruitment_process'] }}</div>
              </li>

              <h2>Q. 16 - Rate your HR induction session! (out of 5)</h2>
              <li>
              <div class="col-left"><strong>{{ $recruitment_details['rate_hr_induction'] }}</strong> <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span></div>
              </li>


              <h2>Q. 17 - Any additional feedback for HR induction session?</h2>
              <li>
              <div class="col-left">{{ $recruitment_details['additional_feedback_hr_induction'] }}</div>
              </li>

            </ul>
          </div>
            
            
            
            <div class="btn-group">
				        <a href="{{ url('/interview-survey/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/ppt/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection