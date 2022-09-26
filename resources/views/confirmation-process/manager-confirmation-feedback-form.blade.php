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
  
              @if(count($confirmation_feedback_details)>0)

              <h2>Q. 1 - What is your name?</h2>
              <li>
              <div class="col-left">{{ $user_details['full_name'] }}</div>
              </li>

              <h2>Q. 2 - What is your Member ID?</h2>
              <li>
              <div class="col-left">{{ $user_details['member_id'] }}</div>
              </li>

              <h2>Q. 3 - What is your designation in {{ $user_details['company_name'] }}?</h2>
              <li>
              <div class="col-left">{{ $user_details['designation_name'] }}</div>
              </li>

              <h2>Q. 4 - What is your department in {{ $user_details['company_name'] }}?</h2>
              <li>
              <div class="col-left">{{ $user_details['department_name'] }}</div>
              </li>

              <h2>Q. 5 - Location</h2>
              <li>
              <div class="col-left">{{ $user_details['location_name'] }}</div>
              </li>

              <h2>Q. 6 - Tenure (in months)</h2>
              <li>
              <div class="col-left">{{ $total_tenure }}</div>
              </li>



              @foreach($confirmation_feedback_details as $confirmation_feedback_detail)

                  <h2 style="margin-bottom: -20px;"><strong>Confirmation feedback by {{ $confirmation_feedback_detail['manager_full_name'] }}</strong></h2>
                  <h2>Q. 7 - Rate {{ $user_details['full_name'] }} in the following out of 5 where "1" stands for Poor and "5" stands for excellent.</h2>
          
                  <li>
                  <div class="col-left">Discipline
                    @if($confirmation_feedback_detail->discipline!='NA')
                      @for($i=0; $i < $confirmation_feedback_detail->discipline; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>
                  
                  <li>
                  <div class="col-left">Punctuality  
                    @if($confirmation_feedback_detail->punctuality!='NA')
                      @for($i=0; $i < $confirmation_feedback_detail->punctuality; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>

                  <li>
                  <div class="col-left">Work-Ethics 
                    @if($confirmation_feedback_detail->work_ethics!='NA')
                      @for($i=0; $i < $confirmation_feedback_detail->work_ethics; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>

                  <li>
                  <div class="col-left">Team-Work
                    @if($confirmation_feedback_detail->team_work!='NA')
                      @for($i=0; $i < $confirmation_feedback_detail->team_work; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>

                  <li>
                  <div class="col-left">Response towards Feedback
                    @if($confirmation_feedback_detail->response_towards_feedback!='NA')
                      @for($i=0; $i < $confirmation_feedback_detail->response_towards_feedback; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>


                  <h2>Q. 8 - Kindly elaborate on {{ $user_details['full_name'] }} performance of the last 3 months?</h2>
                  <li>
                  <div class="col-left text-justify">{!! $confirmation_feedback_detail['elaborate_performance'] !!}</div>
                  </li>

                  <h2>Q. 9 - Mention top 3 highlights of {{ $user_details['full_name'] }}?</h2>
                  <li>
                  <div class="col-left"><strong>1. </strong>
                    <span class="">{{ $confirmation_feedback_detail->top_3_highlights_1 }}</span>  
                  </div>
                  </li>
                  <li>
                  <div class="col-left"><strong>2. </strong>
                    <span class="">{{ $confirmation_feedback_detail->top_3_highlights_2 }}</span>  
                  </div>
                  </li>
                  <li>
                  <div class="col-left"><strong>3. </strong>
                    <span class="">{{ $confirmation_feedback_detail->top_3_highlights_3 }}</span>  
                  </div>
                  </li>

                  <h2>Q. 10 - Mention the major task that have been accomplished by {{ $user_details['full_name'] }}?</h2>
                  <li>
                  <div class="col-left"><strong>1. </strong>
                    <span class="">{{ $confirmation_feedback_detail->major_task_1 }}</span>  
                  </div>
                  </li>
                  <li>
                  <div class="col-left"><strong>2. </strong>
                    <span class="">{{ $confirmation_feedback_detail->major_task_2 }}</span>  
                  </div>
                  </li>
                  <li>
                  <div class="col-left"><strong>3. </strong>
                    <span class="">{{ $confirmation_feedback_detail->major_task_3 }}</span>  
                  </div>
                  </li>

                  <h2>Q. 11 - Mention 3 areas of improvement?</h2>
                  <li>
                  <div class="col-left"><strong>1. </strong>
                    <span class="">{{ $confirmation_feedback_detail->areas_of_improvement_1 }}</span>  
                  </div>
                  </li>
                  <li>
                  <div class="col-left"><strong>2. </strong>
                    <span class="">{{ $confirmation_feedback_detail->areas_of_improvement_2 }}</span>  
                  </div>
                  </li>
                  <li>
                  <div class="col-left"><strong>3. </strong>
                    <span class="">{{ $confirmation_feedback_detail->areas_of_improvement_3 }}</span>  
                  </div>
                  </li>


                  <h2>Q. 12 - Has {{ $user_details['full_name'] }} been able to add value in your team?</h2>
                  <li>
                  <div class="col-left">{{ $confirmation_feedback_detail->add_value_in_team }}</div>
                  </li>

                  <h2>If Yes, Please share an instance in details.</h2>
                  <li>
                  <div class="col-left">{!! $confirmation_feedback_detail->add_value_in_team_share_instance !!}</div>
                  </li>

                  <h2>Q. 13 - Has {{ $user_details['full_name'] }} met your expectations in the last 3 months</h2>
                  <li>
                  <div class="col-left">{{ $confirmation_feedback_detail->met_your_expectations }}</div>
                  </li>

                  <h2>Other (please specify)</h2>
                  <li>
                  <div class="col-left">{!! $confirmation_feedback_detail->met_your_expectations_other_specify !!}</div>
                  </li>

                  <h2>Q. 14 - Are you sure to confirm {{ $user_details['full_name'] }} in the Organization?</h2>
                  <li>
                  <div class="col-left">{{ $confirmation_feedback_detail->are_you_sure_to_confirm }}</div>
                  </li>

                  @if($confirmation_feedback_detail->are_you_sure_to_confirm=='No, Put under PIP')
                  <h2>If you want to recommend PIP, Pls share a detailed plan.</h2>
                  <li>
                  <div class="col-left">{{ $confirmation_feedback_detail->recommend_pip_detailed_plan }}</div>
                  </li>
                  @endif

                  <h2>Q. 15 - Has {{ $user_details['full_name'] }} been committed an increment on confirmation, at the time of joining?</h2>
                  <li>
                  <div class="col-left">{{ $confirmation_feedback_detail->increment_on_confirmation }}</div>
                  </li>

                  @if($confirmation_feedback_detail->increment_on_confirmation=='Yes')
                  <h2>If yes, then mention the amount.</h2>
                  <li>
                  <div class="col-left">{{ $confirmation_feedback_detail->mention_the_amount }}</div>
                  </li>
                  @endif

              @endforeach



              

              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
				        <a href="{{ url('/manager-check-in-from/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/thankyou/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection