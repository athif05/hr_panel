@extends('layouts.master-confirmation')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Manager Check-In From | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('partials.sidebar-confirmation')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>45 Days Check-In Form (Manager's Feedback) <img src="{{ str_replace('public/', '', asset('assests/confirmation-process/img/emp-icon.png')) }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              @if(count($check_in_manager_details)>0)

              <h2><strong>Member Details</strong></h2>
              
              <h2>Q. 1 - Member Name</h2>
              <li>
              <div class="col-left">
                {{ $user_details['full_name'] }}
              </div>
              </li>
              

              <h2>Q. 2 - Member Code</h2>
              <li>
              <div class="col-left">
                {{ $user_details['member_id'] }}
              </div>
              </li>

              <h2>Q. 3 - Designation</h2>
              <li>
              <div class="col-left">
                {{ $user_details['designation_name'] }}
              </div>
              </li>

              <h2>Q. 4 - Department</h2>
              <li>
              <div class="col-left">
                {{ $user_details['department_name'] }}
              </div>
              </li>

              <h2>Q. 5 - Email</h2>
              <li>
              <div class="col-left">
                {{ $user_details['email'] }}
              </div>
              </li>

              @foreach($check_in_manager_details as $check_in_manager_detail)
              <h2><strong>Manager Details</strong></h2>

              <h2>Q. Your Name</h2>
              <li>
              <div class="col-left">{{ $check_in_manager_detail->full_manager_name }}</div>
              </li>

              <h2>Q. Your Member Code</h2>
              <li>
              <div class="col-left">{{ $check_in_manager_detail->manager_member_id }}</div>
              </li>

              <h2>Q. Company</h2>
              <li>
              <div class="col-left">{{ $check_in_manager_detail->manager_company_name }}</div>
              </li>

              <h2>Q. Designation</h2>
              <li>
              <div class="col-left">{{ $check_in_manager_detail->manager_designations_name }}</div>
              </li>

              <h2>Q. Department</h2>
              <li>
              <div class="col-left">{{ $check_in_manager_detail->manager_departments_name }}</div>
              </li>

              <h2>Q. Email</h2>
              <li>
              <div class="col-left">{{ $check_in_manager_detail->manager_email }}</div>
              </li>

              <h2>Q. Location</h2>
              <li>
              <div class="col-left">{{ $check_in_manager_detail->manager_location_name }}</div>
              </li>


              <h2>Q. Rate {{ $user_details['full_name'] }}'s level of understanding on the following parameters</h2>
      
              <li>
              <div class="col-left">Departmental Processes
                @if($check_in_manager_detail->departmental_processes!='NA')
                  @for($i=0; $i < $check_in_manager_detail->departmental_processes; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">TOD/EOD Process 
                @if($check_in_manager_detail->tod_eod_process!='NA')
                  @for($i=0; $i < $check_in_manager_detail->tod_eod_process; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">Month Summary Process
                @if($check_in_manager_detail->month_summary_process!='NA')
                  @for($i=0; $i < $check_in_manager_detail->month_summary_process; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Relevant software/tools
                @if($check_in_manager_detail->relevant_software_tools!='NA')
                  @for($i=0; $i < $check_in_manager_detail->relevant_software_tools; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Organization's Policies & Processes
                @if($check_in_manager_detail->organization_policies_processes!='NA')
                  @for($i=0; $i < $check_in_manager_detail->organization_policies_processes; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. Which category would  you like to place {{ $user_details['full_name'] }} in?</h2>
              <li>
              <div class="col-left">
                {{ $check_in_manager_detail->which_category_like_place }}
              </div>
              </li>


              <h2>Q. Rate Organization's Policies & Processes on core values of the organization:</h2>
      
              <li>
              <div class="col-left">Integrity
                <span class="float_right_div"> {{ $check_in_manager_detail->integrity }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Win-Win
                <span class="float_right_div"> {{ $check_in_manager_detail->win_win }}</span>
              </div>
              </li>

            
              <li>
              <div class="col-left">Synergise
                <span class="float_right_div"> {{ $check_in_manager_detail->synergise }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Closure
                <span class="float_right_div"> {{ $check_in_manager_detail->closure }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Knowledge
                <span class="float_right_div"> {{ $check_in_manager_detail->knowledge }}</span>
              </div>
              </li>

              <li>
              <div class="col-left">KISS
                <span class="float_right_div"> {{ $check_in_manager_detail->kiss }}</span>
              </div>
              </li>

              <li>
              <div class="col-left">Innovation
                <span class="float_right_div"> {{ $check_in_manager_detail->innovation }}</span>
              </div>
              </li>

              <li>
              <div class="col-left">Celebration
                <span class="float_right_div"> {{ $check_in_manager_detail->celebration }}</span>
              </div>
              </li>

              <h2>Q. What have been {{ $user_details['full_name'] }}'s major achievements?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_manager_detail->major_achievements !!}</div>
              </li>

              <h2>Q. What have been {{ $user_details['full_name'] }}'s major fallbacks?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_manager_detail->major_fallbacks !!}</div>
              </li>

              <h2>Q. What would you recommend to change about {{ $user_details['full_name'] }}'s approach towards the work/otherwise?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_manager_detail->recommend_to_change_approach !!}</div>
              </li>


              <h2>Q. Do you see {{ $user_details['full_name'] }} adding value to your team & meeting your expectations?</h2>
              <li>
              <div class="col-left">
                {{ $check_in_manager_detail->adding_value_your_team_expectations }}
              </div>
              </li>


              <h2>Q. Pleasse justify above answer with examples.</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_manager_detail->justify_above_answer !!}</div>
              </li>

              <h2>Q. What kind of long-term goal do you foresee for {{ $user_details['full_name'] }}?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_manager_detail->long_term_goal !!}</div>
              </li>


              <h2>Q. Any Additional feedback for {{ $user_details['full_name'] }}?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_manager_detail->any_additional_feedback !!}</div>
              </li>
              @endforeach


              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
				        <a href="{{ url('/ppt/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/manager-confirmation-feedback-form/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection