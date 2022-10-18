@extends('layouts.master-confirmation')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Stakeholder’s Feedback | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>Stakeholder’s Feedback <img src="{{ str_replace('public/', '', asset('assests/confirmation-process/img/emp-icon.png')) }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              @if(count($stakeholder_feedback_form_details)>0)

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

              <h2><strong>Stakeholder Details</strong></h2>

              @foreach($stakeholder_feedback_form_details as $stakeholder_feedback_form_detail)
              

              <h2><strong>Stakeholder {{ $stakeholder_feedback_form_detail->full_manager_name }}</strong></h2>

              <h2>Q. Your Name</h2>
              <li>
              <div class="col-left">{{ $stakeholder_feedback_form_detail->full_manager_name }}</div>
              </li>

              <h2>Q. Your Member Code</h2>
              <li>
              <div class="col-left">{{ $stakeholder_feedback_form_detail->manager_member_id }}</div>
              </li>

              <h2>Q. Company</h2>
              <li>
              <div class="col-left">{{ $stakeholder_feedback_form_detail->manager_company_name }}</div>
              </li>

              <h2>Q. Designation</h2>
              <li>
              <div class="col-left">{{ $stakeholder_feedback_form_detail->manager_designations_name }}</div>
              </li>

              <h2>Q. Department</h2>
              <li>
              <div class="col-left">{{ $stakeholder_feedback_form_detail->manager_departments_name }}</div>
              </li>

              <h2>Q. Email</h2>
              <li>
              <div class="col-left">{{ $stakeholder_feedback_form_detail->manager_email }}</div>
              </li>

              <h2>Q. Location</h2>
              <li>
              <div class="col-left">{{ $stakeholder_feedback_form_detail->manager_location_name }}</div>
              </li>


              <h2>Q. Rate {{ $user_details['full_name'] }} on the following parameters</h2>
      
              <li>
              <div class="col-left">Quality of the work
                @if($stakeholder_feedback_form_detail->quality_of_the_work!='NA')
                  @for($i=0; $i < $stakeholder_feedback_form_detail->quality_of_the_work; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">TAT Adherence
                @if($stakeholder_feedback_form_detail->tat_adherence!='NA')
                  @for($i=0; $i < $stakeholder_feedback_form_detail->tat_adherence; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">Ability to understand project requirements 
                @if($stakeholder_feedback_form_detail->ability_to_understand_project_requirements!='NA')
                  @for($i=0; $i < $stakeholder_feedback_form_detail->ability_to_understand_project_requirements; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Ability to absorb feedback
                @if($stakeholder_feedback_form_detail->ability_to_absorb_feedback!='NA')
                  @for($i=0; $i < $stakeholder_feedback_form_detail->ability_to_absorb_feedback; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Responsiveness on all platforms
                @if($stakeholder_feedback_form_detail->responsiveness_on_all_platforms!='NA')
                  @for($i=0; $i < $stakeholder_feedback_form_detail->responsiveness_on_all_platforms; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">How happy are you with {{ $user_details['full_name'] }} performance?
                @if($stakeholder_feedback_form_detail->how_happy_you_with_performance!='NA')
                  @for($i=0; $i < $stakeholder_feedback_form_detail->how_happy_you_with_performance; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. Share three qualities of {{ $user_details['full_name'] }} </h2>
              <li>
              <div class="col-left"><strong>1. </strong>
                <span class="">{{ $stakeholder_feedback_form_detail->three_qualities_1 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>2. </strong>
                <span class="">{{ $stakeholder_feedback_form_detail->three_qualities_2 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>3. </strong>
                <span class="">{{ $stakeholder_feedback_form_detail->three_qualities_3 }}</span>  
              </div>
              </li>


              <h2>Q. Share three areas of improvement for {{ $user_details['full_name'] }} </h2>
              <li>
              <div class="col-left"><strong>1. </strong>
                <span class="">{{ $stakeholder_feedback_form_detail->three_areas_of_improvement_1 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>2. </strong>
                <span class="">{{ $stakeholder_feedback_form_detail->three_areas_of_improvement_2 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>3. </strong>
                <span class="">{{ $stakeholder_feedback_form_detail->three_areas_of_improvement_3 }}</span>  
              </div>
              </li>

              <h2>Q. Any additional feedback that you would like to share about {{ $user_details['full_name'] }} </h2>
              <li>
              <div class="col-left text-justify">{!! $stakeholder_feedback_form_detail->any_additional_feedback !!}</div>
              </li>
              @endforeach


              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
              <a href="{{ url('/manager-confirmation-feedback-form/'.$employee_id) }}" class="btn btn-default">previous</a>
              <a href="{{ url('/mom-form/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
            </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection