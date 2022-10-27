@extends('layouts.master-confirmation')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Training Survey | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('partials.sidebar-confirmation')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>Training Survey <img src="{{ str_replace('public/', '', asset('assests/confirmation-process/img/emp-icon.png')) }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              @if($training_details)

              <h2>Q. 1 - Your Name</h2>
              <li>
              <div class="col-left">{{ $training_details['member_name'] }}</div>
              </li>

              <h2>Q. 2 - Member ID</h2>
              <li>
              <div class="col-left">{{ $training_details['member_id'] }}</div>
              </li>

              <h2>Q. 3 - Email</h2>
              <li>
              <div class="col-left">{{ $training_details['email'] }}</div>
              </li>

              <h2>Q. 4 - Designation</h2>
              <li>
              <div class="col-left">{{ $training_details['designation_name'] }}</div>
              </li>

              <h2>Q. 5 - Department</h2>
              <li>
              <div class="col-left">{{ $training_details['department_name'] }}</div>
              </li>

              <h2>Q. 6 - Please choose the name of your company</h2>
              <li>
              <div class="col-left">{{ $training_details['company_name'] }}</div>
              </li>

              <h2>Q. 7 - Please choose your work-location</h2>
              <li>
              <div class="col-left">{{ $training_details['location_name'] }}</div>
              </li>

              <h2>Q. 8 - Please list down the name of your trainers who took your on-job training</h2>
              <li>
              <div class="col-left">
                @if($training_details['trainer_1_name'])
                1. {{ $training_details['trainer_1_name'] }}
                @endif

                @if($training_details['trainer_2_name'])
                <br>2. {{ $training_details['trainer_2_name'] }}
                @endif

                @if($training_details['trainer_3_name'])
                <br>3. {{ $training_details['trainer_3_name'] }}
                @endif

                @if($training_details['trainer_4_name'])
                <br>4. {{ $training_details['trainer_4_name'] }}
                @endif

                @if($training_details['trainer_5_name'])
                <br>5. {{ $training_details['trainer_5_name'] }}
                @endif
              </div>
              </li>

              
              @if($training_details['trainer_1_name'])
              <h2>Please rate {{ $training_details['trainer_1_name'] }} on the following parameters</h2>      
              
              <li>
              <div class="col-left">Expertise on the subject-matter
                @if($training_details['expertise_on_subject_matter_1']!='NA')
                  @for($i=0; $i < $training_details['expertise_on_subject_matter_1']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Clear and effective communication skills 
                @if($training_details['clear_effective_communication_skills_1']!='NA')
                  @for($i=0; $i < $training_details['clear_effective_communication_skills_1']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Effective delivery of content 
                @if($training_details['effective_delivery_content_1']!='NA')
                  @for($i=0; $i < $training_details['effective_delivery_content_1']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Timely response to your queries 
                @if($training_details['timely_response_queries_1']!='NA')
                  @for($i=0; $i < $training_details['timely_response_queries_1']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Comfortability in sharing your concerns & doubts 
                @if($training_details['comfortability_sharing_concerns_doubts_1']!='NA')
                  @for($i=0; $i < $training_details['comfortability_sharing_concerns_doubts_1']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Any additional comments for {{ $training_details['trainer_1_name'] }}</h2>
              <li>
              <div class="col-left text-justify">{!! $training_details['additional_feedback_trainer_1'] !!}</div>
              </li>
              @endif


              @if($training_details['trainer_2_name'])
              <h2>Please rate {{ $training_details['trainer_2_name'] }} on the following parameters</h2>      
              
              <li>
              <div class="col-left">Expertise on the subject-matter
                @if($training_details['expertise_on_subject_matter_2']!='NA')
                  @for($i=0; $i < $training_details['expertise_on_subject_matter_2']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Clear and effective communication skills 
                @if($training_details['clear_effective_communication_skills_2']!='NA')
                  @for($i=0; $i < $training_details['clear_effective_communication_skills_2']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Effective delivery of content 
                @if($training_details['effective_delivery_content_2']!='NA')
                  @for($i=0; $i < $training_details['effective_delivery_content_2']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Timely response to your queries 
                @if($training_details['timely_response_queries_2']!='NA')
                  @for($i=0; $i < $training_details['timely_response_queries_2']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Comfortability in sharing your concerns & doubts 
                @if($training_details['comfortability_sharing_concerns_doubts_2']!='NA')
                  @for($i=0; $i < $training_details['comfortability_sharing_concerns_doubts_2']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Any additional comments for {{ $training_details['trainer_2_name'] }}</h2>
              <li>
              <div class="col-left text-justify">{!! $training_details['additional_feedback_trainer_2'] !!}</div>
              </li>
              @endif


              @if($training_details['trainer_3_name'])
              <h2>Please rate {{ $training_details['trainer_3_name'] }} on the following parameters</h2>      
              
              <li>
              <div class="col-left">Expertise on the subject-matter
                @if($training_details['expertise_on_subject_matter_3']!='NA')
                  @for($i=0; $i < $training_details['expertise_on_subject_matter_3']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Clear and effective communication skills 
                @if($training_details['clear_effective_communication_skills_3']!='NA')
                  @for($i=0; $i < $training_details['clear_effective_communication_skills_3']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Effective delivery of content 
                @if($training_details['effective_delivery_content_3']!='NA')
                  @for($i=0; $i < $training_details['effective_delivery_content_3']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Timely response to your queries 
                @if($training_details['timely_response_queries_3']!='NA')
                  @for($i=0; $i < $training_details['timely_response_queries_3']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Comfortability in sharing your concerns & doubts 
                @if($training_details['comfortability_sharing_concerns_doubts_3']!='NA')
                  @for($i=0; $i < $training_details['comfortability_sharing_concerns_doubts_3']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Any additional comments for {{ $training_details['trainer_3_name'] }}</h2>
              <li>
              <div class="col-left text-justify">{!! $training_details['additional_feedback_trainer_3'] !!}</div>
              </li>
              @endif


              @if($training_details['trainer_4_name'])
              <h2>Please rate {{ $training_details['trainer_4_name'] }} on the following parameters</h2>      
              
              <li>
              <div class="col-left">Expertise on the subject-matter
                @if($training_details['expertise_on_subject_matter_4']!='NA')
                  @for($i=0; $i < $training_details['expertise_on_subject_matter_4']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Clear and effective communication skills 
                @if($training_details['clear_effective_communication_skills_4']!='NA')
                  @for($i=0; $i < $training_details['clear_effective_communication_skills_4']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Effective delivery of content 
                @if($training_details['effective_delivery_content_4']!='NA')
                  @for($i=0; $i < $training_details['effective_delivery_content_4']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Timely response to your queries 
                @if($training_details['timely_response_queries_4']!='NA')
                  @for($i=0; $i < $training_details['timely_response_queries_4']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Comfortability in sharing your concerns & doubts 
                @if($training_details['comfortability_sharing_concerns_doubts_4']!='NA')
                  @for($i=0; $i < $training_details['comfortability_sharing_concerns_doubts_4']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Any additional comments for {{ $training_details['trainer_4_name'] }}</h2>
              <li>
              <div class="col-left text-justify">{!! $training_details['additional_feedback_trainer_4'] !!}</div>
              </li>
              @endif


              @if($training_details['trainer_5_name'])
              <h2>Please rate {{ $training_details['trainer_5_name'] }} on the following parameters</h2>      
              
              <li>
              <div class="col-left">Expertise on the subject-matter
                @if($training_details['expertise_on_subject_matter_5']!='NA')
                  @for($i=0; $i < $training_details['expertise_on_subject_matter_5']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Clear and effective communication skills 
                @if($training_details['clear_effective_communication_skills_5']!='NA')
                  @for($i=0; $i < $training_details['clear_effective_communication_skills_5']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Effective delivery of content 
                @if($training_details['effective_delivery_content_5']!='NA')
                  @for($i=0; $i < $training_details['effective_delivery_content_5']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Timely response to your queries 
                @if($training_details['timely_response_queries_5']!='NA')
                  @for($i=0; $i < $training_details['timely_response_queries_5']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Comfortability in sharing your concerns & doubts 
                @if($training_details['comfortability_sharing_concerns_doubts_5']!='NA')
                  @for($i=0; $i < $training_details['comfortability_sharing_concerns_doubts_5']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Any additional comments for {{ $training_details['trainer_5_name'] }}</h2>
              <li>
              <div class="col-left text-justify">{!! $training_details['additional_feedback_trainer_5'] !!}</div>
              </li>
              @endif



              <h2>Q. 9 - Please share your experience with the following</h2>      
              
              <li>
              <div class="col-left">Training plan was shared with me within the first week of joining
                @if($training_details['training_first_week_joining']!='NA')
                  @for($i=0; $i < $training_details['training_first_week_joining']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">The training sessions went as planned
                @if($training_details['training_sessions_went_as_planned']!='NA')
                  @for($i=0; $i < $training_details['training_sessions_went_as_planned']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Training topics were covered in detail
                @if($training_details['training_topics_were_covered_in_detail']!='NA')
                  @for($i=0; $i < $training_details['training_topics_were_covered_in_detail']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Training was effective & is helping me do my job well
                @if($training_details['training_was_effective_helping']!='NA')
                  @for($i=0; $i < $training_details['training_was_effective_helping']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">I have clearly understood all the modules
                @if($training_details['clearly_understood_all_modules']!='NA')
                  @for($i=0; $i < $training_details['clearly_understood_all_modules']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Self-study material has been very useful for me
                @if($training_details['self_study_material_useful']!='NA')
                  @for($i=0; $i < $training_details['self_study_material_useful']; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <h2>Q. 10 - Is there any topic that you still need training on?</h2>
              <li>
              <div class="col-left text-justify">{!! $training_details['is_there_any_topic'] !!}</div>
              </li>


              <h2>Q. 11 - Which part of the training was the most interesting? Please elaborate</h2>
              <li>
              <div class="col-left text-justify">{!! $training_details['interesting_part_elaborate'] !!}</div>
              </li>


              <h2>Q. 12 - Any suggestion/feedback you would like to give in helping us to improve our training sessions?</h2>
              <li>
              <div class="col-left text-justify">{!! $training_details['any_suggestions_feedback'] !!}</div>
              </li>

              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
				<a href="{{ url('/interview-survey/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/member-check-in-from/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection