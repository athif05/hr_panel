@extends('layouts.master-confirmation')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Fresh Eye Journal Form | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>Fresh Eye Journal <img src="{{ str_replace('public/', '', asset('resources/views/confirmation-process/img/emp-icon.png')) }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              @if($fresh_eye_journal_details)

              <h2>Q. 1 - Full Name</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->member_name }}</div>
              </li>

              <h2>Q. 2 - Member ID</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->member_id }}</div>
              </li>

              <h2>Q. 3 - Designation</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->designation_name }}</div>
              </li>

              <h2>Q. 4 - Department</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->department_name }}</div>
              </li>

              <h2>Q. 5 - Company</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->company_name_ajax }}</div>
              </li>

              <h2>Q. 6 - Location</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->company_location }}</div>
              </li>

              <h2>Q. 7 - Tenure (in months)</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->tenure_in_month }}</div>
              </li>

              <h2>Q. 8 - Name of Reporting Manager</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->reporting_manager_name_ajax }}</div>
              </li>

              <h2>Q. 9 - Name of Department Head</h2>
              <li>
              <div class="col-left">{{ $fresh_eye_journal_details->head_of_department_name_ajax }}</div>
              </li>

              <h2>Q. 10 - How has your journey been so far in {{ $fresh_eye_journal_details->company_name_ajax }}? Explain in detail</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->your_journey_so_far_in_company !!}</div>
              </li>

              <h2>Q. 11 - Top 3 things that you like about your job role</h2>
              <li>
              <div class="col-left"><strong>1. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_things_like_your_job_1 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>2. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_things_like_your_job_2 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>3. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_things_like_your_job_3 }}</span>  
              </div>
              </li>

              <h2>Q. 12 - Three things that you wish to change in your job role</h2>
              <li>
              <div class="col-left"><strong>1. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_things_wish_change_job_role_1 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>2. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_things_wish_change_job_role_2 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>3. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_things_wish_change_job_role_3 }}</span>  
              </div>
              </li>


              <h2>Q. 13 - Please share your satisfaction on the parameters mentioned below, out of 5</h2>
      
              <li>
              <div class="col-left">Satisfaction about job role
                @if($fresh_eye_journal_details->satisfaction_job_role!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->satisfaction_job_role; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">I am well equipped to perform my job 
                @if($fresh_eye_journal_details->well_equipped_perform_job!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->well_equipped_perform_job; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">I am able to maintain work-life balance
                @if($fresh_eye_journal_details->able_maintain_work_life_balance!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->able_maintain_work_life_balance; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">I feel respected by my peers
                @if($fresh_eye_journal_details->feel_respected_my_peers!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->feel_respected_my_peers; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">My suggestions are heard & implemented
                @if($fresh_eye_journal_details->suggestions_heard_implemented!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->suggestions_heard_implemented; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">I share good bond with superiors
                @if($fresh_eye_journal_details->share_good_bond_superiors!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->share_good_bond_superiors; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">I know what I am expected to do
                @if($fresh_eye_journal_details->know_what_i_expected_to_do!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->know_what_i_expected_to_do; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">I feel I will grow in the organization
                @if($fresh_eye_journal_details->i_feel_grow_in_organization!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->i_feel_grow_in_organization; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 14 - Any exemplary work or achievement that you would like to showcase?</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->any_exemplary_work_achievement_showcase !!}</div>
              </li>

              <h2>Q. 15 - Any additional trainings that you'd like?</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->any_additional_trainings !!}</div>
              </li>

              <h2>Q. 16 - What do you like about {{ $fresh_eye_journal_details->company_name_ajax }}?</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->what_do_you_like_about_company !!}</div>
              </li>

              <h2>Q. 17 - What do you dislike about {{ $fresh_eye_journal_details->company_name_ajax }}?</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->what_do_you_dislike_about_company !!}</div>
              </li>

              <h2>Q. 18 - How satisfied are you with employee benefits being offered by {{ $fresh_eye_journal_details->company_name_ajax }}? Please elaborate</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->satisfied_employee_benefits_offered_company !!}</div>
              </li>


              <h2>Q. 19 - Please share your satisfaction on the parameters mentioned below, out of 5</h2>
      
              <li>
              <div class="col-left">Work culture
                @if($fresh_eye_journal_details->work_culture!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->work_culture; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Recruitment process 
                @if($fresh_eye_journal_details->recruitment_process!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->recruitment_process; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">Induction process
                @if($fresh_eye_journal_details->induction_process!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->induction_process; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">On-job training process
                @if($fresh_eye_journal_details->on_job_training_process!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->on_job_training_process; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Clear communication about any changes in the policy
                @if($fresh_eye_journal_details->clear_communication_changes_policy!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->clear_communication_changes_policy; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Feeling of belongingness in the organization
                @if($fresh_eye_journal_details->feeling_belongingness_organization!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->feeling_belongingness_organization; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Having a best friend at work
                @if($fresh_eye_journal_details->having_best_friend_at_work!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->having_best_friend_at_work; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Work-life balance
                @if($fresh_eye_journal_details->work_life_balance!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->work_life_balance; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <h2>Q. 20 - Any detailed feedback you would like to share to support your response on the above parameters?</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->any_detailed_feedback_support_your_response !!}</div>
              </li>


              <h2>Q. 21 - Rate {{ $fresh_eye_journal_details->reporting_manager_name_ajax }} on the below-mentioned parameters out of 5</h2>
      
              <li>
              <div class="col-left">Quickness in respond to your requests/queries/concerns?
                @if($fresh_eye_journal_details->quickness_in_respond_reporting_manager!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->quickness_in_respond_reporting_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How well have you received guidance?
                @if($fresh_eye_journal_details->how_well_received_guidance_reporting_manager!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_well_received_guidance_reporting_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">How clearly are your goals set?
                @if($fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How transparent is {{ $fresh_eye_journal_details->reporting_manager_name_ajax }}
                @if($fresh_eye_journal_details->how_transparent_is_reporting_manager!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_transparent_is_reporting_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">WPRs happen every week
                @if($fresh_eye_journal_details->wprs_happen_every_week_reporting_manager!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->wprs_happen_every_week_reporting_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How well does {{ $fresh_eye_journal_details->reporting_manager_name_ajax }} adjust to changing priorities
                @if($fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">How comfortable do you feel in sharing your feedback with {{ $fresh_eye_journal_details->reporting_manager_name_ajax }}?
                @if($fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">How well are you able to learn under guidance?
                @if($fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 22 - Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail.</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->our_organization_believes_mantra !!}</div>
              </li>


              <h2>Q. 23 - Rate Reporting Manager ({{ $fresh_eye_journal_details->reporting_manager_name_ajax }}) on the below mentioned parameters out of 5 (5- highest, 1- lowest)</h2>
      
              <li>
              <div class="col-left">How quickly does {{ $fresh_eye_journal_details->reporting_manager_name_ajax }} respond to your requests/queries/concerns?
                @if($fresh_eye_journal_details->quickness_in_respond_reporting_manager_qi!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->quickness_in_respond_reporting_manager_qi; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How well have you received guidance? How well have you received guidance from {{ $fresh_eye_journal_details->reporting_manager_name_ajax }}?
                @if($fresh_eye_journal_details->how_well_received_guidance_reporting_manager_qi!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_well_received_guidance_reporting_manager_qi; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">How clearly are your goals set by {{ $fresh_eye_journal_details->reporting_manager_name_ajax }}?
                @if($fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager_qi!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager_qi; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How transparent is {{ $fresh_eye_journal_details->reporting_manager_name_ajax }}?
                @if($fresh_eye_journal_details->how_transparent_is_reporting_manager_qi!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_transparent_is_reporting_manager_qi; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How frequent does your 1:1 happen?
                @if($fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How well does {{ $fresh_eye_journal_details->reporting_manager_name_ajax }} adjust to changing priorities?
                @if($fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager_qi!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager_qi; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">How comfortable do you feel in sharing your feedback with {{ $fresh_eye_journal_details->reporting_manager_name_ajax }}?
                @if($fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager_qi!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager_qi; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <h2>Q. 24 - Share top three strengths of Reporting Manager ({{ $fresh_eye_journal_details->reporting_manager_name_ajax }})</h2>
              <li>
              <div class="col-left"><strong>1. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_strengths_reporting_manager_qi_1 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>2. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_strengths_reporting_manager_qi_2 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>3. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_strengths_reporting_manager_qi_3 }}</span>  
              </div>
              </li>

              <h2>Q. 25 - Share three areas of improvement for Reporting Manager ({{ $fresh_eye_journal_details->reporting_manager_name_ajax }})</h2>
              <li>
              <div class="col-left"><strong>1. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_areas_improvement_reporting_manager_qi_1 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>2. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_areas_improvement_reporting_manager_qi_2 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>3. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_areas_improvement_reporting_manager_qi_3 }}</span>  
              </div>
              </li>

              <h2>Q. 26 - Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail.</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->our_organization_believes_mantra_reporting_manager_qi !!}</div>
              </li>

              <h2>Q. 27 - Rate HOD ({{ $fresh_eye_journal_details->head_of_department_name_ajax }}) on the below mentioned parameters out of 5 (5- highest, 1- lowest)</h2>
      
              <li>
              <div class="col-left">How quickly does {{ $fresh_eye_journal_details->head_of_department_name_ajax }} respond to your requests/queries/concerns
                @if($fresh_eye_journal_details->quickness_in_respond_hod_qj!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->quickness_in_respond_hod_qj; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How well have you received guidance from {{ $fresh_eye_journal_details->head_of_department_name_ajax }}?
                @if($fresh_eye_journal_details->how_well_received_guidance_hod_qj!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_well_received_guidance_hod_qj; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">How clearly are your goals set by {{ $fresh_eye_journal_details->head_of_department_name_ajax }}
                @if($fresh_eye_journal_details->how_clearly_your_goals_set_hod_qj!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_clearly_your_goals_set_hod_qj; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How transparent is {{ $fresh_eye_journal_details->head_of_department_name_ajax }}?
                @if($fresh_eye_journal_details->how_transparent_is_hod_qj!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_transparent_is_hod_qj; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How frequent does your 1:1 happen
                @if($fresh_eye_journal_details->frequent_1_1_happen_hod_qj!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->frequent_1_1_happen_hod_qj; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">How well does {{ $fresh_eye_journal_details->head_of_department_name_ajax }} adjust to changing priorities?
                @if($fresh_eye_journal_details->how_well_adjust_changing_priorities_hod_qj!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_well_adjust_changing_priorities_hod_qj; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">How comfortable do you feel in sharing your feedback with {{ $fresh_eye_journal_details->head_of_department_name_ajax }}?
                @if($fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_hod_qj!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_hod_qj; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 28 - Share top three strengths HOD({{ $fresh_eye_journal_details->head_of_department_name_ajax }})</h2>
              <li>
              <div class="col-left"><strong>1. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_strengths_hod_qj_1 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>2. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_strengths_hod_qj_2 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>3. </strong>
                <span class="">{{ $fresh_eye_journal_details->top_3_strengths_hod_qj_3 }}</span>  
              </div>
              </li>

              <h2>Q. 29 - Share three areas of improvement HOD({{ $fresh_eye_journal_details->head_of_department_name_ajax }})</h2>
              <li>
              <div class="col-left"><strong>1. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_areas_improvement_hod_qj_1 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>2. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_areas_improvement_hod_qj_2 }}</span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>3. </strong>
                <span class="">{{ $fresh_eye_journal_details->three_areas_improvement_hod_qj_3 }}</span>  
              </div>
              </li>


              <h2>Q. 30 - Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail.</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->our_organization_believes_mantra_hod_qj !!}</div>
              </li>



              <h2>Q. 31 - Rate the Departments out of 5</h2>
      
              <li>
              <div class="col-left">Admin Operations
                @if($fresh_eye_journal_details->admin_operations!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->admin_operations; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Advertiser Sales
                @if($fresh_eye_journal_details->advertiser_sales!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->advertiser_sales; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">Advertisers
                @if($fresh_eye_journal_details->advertisers!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->advertisers; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Finance & Accounts
                @if($fresh_eye_journal_details->finance_accounts!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->finance_accounts; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Human Resources
                @if($fresh_eye_journal_details->human_resources!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->human_resources; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Management
                @if($fresh_eye_journal_details->management!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->management; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Network Operations
                @if($fresh_eye_journal_details->network_operations!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->network_operations; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Pocket Money
                @if($fresh_eye_journal_details->pocket_money!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->pocket_money; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Publishers
                @if($fresh_eye_journal_details->publishers!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->publishers; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Tech Operations - Development
                @if($fresh_eye_journal_details->tech_operations_development!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->tech_operations_development; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Support (EA/PA)
                @if($fresh_eye_journal_details->support_ea_pa!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->support_ea_pa; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Education
                @if($fresh_eye_journal_details->education!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->education; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">iGaming
                @if($fresh_eye_journal_details->igaming!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->igaming; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Tech Operations - Shopify
                @if($fresh_eye_journal_details->tech_operations_shopify!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->tech_operations_shopify; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Tech Operations - Creative
                @if($fresh_eye_journal_details->tech_operations_creative!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->tech_operations_creative; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Mobile
                @if($fresh_eye_journal_details->mobile!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->mobile; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">vCommission - UK
                @if($fresh_eye_journal_details->vcommission_uk!='NA')
                  @for($i=0; $i < $fresh_eye_journal_details->vcommission_uk; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 32 - Any additional feedback for any department that you would like to share?</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->any_additional_feedback_any_department !!}</div>
              </li>


              <h2>Q. 33 - Any issue or concern that you would like to talk to management about?</h2>
              <li>
              <div class="col-left text-justify">{!! $fresh_eye_journal_details->any_issue_concern_management !!}</div>
              </li>

              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
				        <a href="{{ url('/member-check-in-from/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/ppt/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection