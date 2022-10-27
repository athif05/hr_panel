@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Fresh Eye Journal Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Fresh Eye Journal Form Details</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              <!-- Bordered Table -->
              <table class="table table-striped table-bordered">
                
                <tbody>
                  
                  <tr>
                    <td>Full Name</td>
                    <td>{{ $fresh_eye_journal_details['member_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Member ID</td>
                    <td>{{ $fresh_eye_journal_details['member_id'] }}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>
                    	@foreach($designation_details as $designation_detail)

                    		@if($designation_detail['id']==$fresh_eye_journal_details['designation'])
                    			{{ $designation_detail['name'] }}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>
                    	@foreach($department_details as $department_detail)

                    		@if($department_detail['id']==$fresh_eye_journal_details['department'])
                    			{{ $department_detail['name'] }}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Company Name</td>
                    <td>{{ $fresh_eye_journal_details['company_name_ajax'] }}</td>
                  </tr>

                  <tr>
                    <td>Location</td>
                    <td>
                    	@foreach($company_locations as $company_location)

                    		@if($company_location['id']==$fresh_eye_journal_details['location_name'])
                    			{{ $company_location['name'] }}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Tenure in {{$fresh_eye_journal_details['company_name_ajax']}} (in months)</td>
                    <td>{{ $fresh_eye_journal_details['tenure_in_month'] }}</td>
                  </tr>

                  <tr>
                    <td>Name of Reporting Manager</td>
                    <td>{{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}</td>
                  </tr>


                  <tr>
                    <td>Name of Department Head</td>
                    <td>{{ $fresh_eye_journal_details['head_of_department_name_ajax'] }}</td>
                  </tr>


                  <tr class="txt_justify">
                    <td colspan="2"><strong>How has your journey been so far in {{ $fresh_eye_journal_details['company_name_ajax'] }}? Explain in detail</strong> {!! $fresh_eye_journal_details['your_journey_so_far_in_company'] !!}</td>
                  </tr>

                  
                  <tr>
                    <td colspan="2"><strong>Top 3 things that you like about your job role</strong></td>
                  </tr>
                  <tr class="txt_justify">
                    <td colspan="2">
                    	<strong>1.</strong> {{ $fresh_eye_journal_details['top_3_things_like_your_job_1'] }}<br>
                    	<strong>2.</strong> {{ $fresh_eye_journal_details['top_3_things_like_your_job_2'] }}<br>
                    	<strong>3.</strong> {{ $fresh_eye_journal_details['top_3_things_like_your_job_3'] }}
                    </td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Three things that you wish to chnage in your job role</strong></td>
                  </tr>
                  <tr class="txt_justify">
                    <td colspan="2">
                    	<strong>1.</strong> {{ $fresh_eye_journal_details['three_things_wish_change_job_role_1'] }}<br>
                    	<strong>2.</strong> {{ $fresh_eye_journal_details['three_things_wish_change_job_role_2'] }}<br>
                    	<strong>3.</strong> {{ $fresh_eye_journal_details['three_things_wish_change_job_role_3'] }}
                    </td>
                  </tr>                 

                  <tr>
                    <td colspan="2"><strong>Please share your satisfaction on the parameters mentioned below, out of 5</strong></td>
                  </tr>

                  <tr>
                    <td>Satisfaction about job role</td>
                    <td>
                      @if($fresh_eye_journal_details['satisfaction_job_role']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['satisfaction_job_role']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I am well equipped to perform my job</td>
                    <td>
                      @if($fresh_eye_journal_details['well_equipped_perform_job']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['well_equipped_perform_job']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I am able to maintain work-life balance</td>
                    <td>
                      @if($fresh_eye_journal_details['able_maintain_work_life_balance']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['able_maintain_work_life_balance']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I feel respected by my peers</td>
                    <td>
                      @if($fresh_eye_journal_details['feel_respected_my_peers']!='NA')
                        @for($i=0; $i < $fresh_eye_journal_details['feel_respected_my_peers']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>My suggestions are heard & implemented</td>
                    <td>
                      @if($fresh_eye_journal_details['suggestions_heard_implemented']!='NA')
                        @for($i=0; $i < $fresh_eye_journal_details['suggestions_heard_implemented']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I share good bond with superiors</td>
                    <td>
                      @if($fresh_eye_journal_details['share_good_bond_superiors']!='NA')
                        @for($i=0; $i < $fresh_eye_journal_details['share_good_bond_superiors']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I know what I am expected to do</td>
                    <td>
                      @if($fresh_eye_journal_details['know_what_i_expected_to_do']!='NA')
                        @for($i=0; $i < $fresh_eye_journal_details['know_what_i_expected_to_do']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I fee I will grow in the organization</td>
                    <td>
                      @if($fresh_eye_journal_details['i_feel_grow_in_organization']!='NA')
                        @for($i=0; $i < $fresh_eye_journal_details['i_feel_grow_in_organization']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any exemplary work or achievement that you would like to showcase?</strong> {!! $fresh_eye_journal_details['any_exemplary_work_achievement_showcase'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional trainings that you'd like?</strong> {!! $fresh_eye_journal_details['any_additional_trainings'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>What do you like about {{ $fresh_eye_journal_details['company_name_ajax'] }}?</strong> {!! $fresh_eye_journal_details['what_do_you_like_about_company'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>What do you dislike about {{ $fresh_eye_journal_details['company_name_ajax'] }}?</strong> {!! $fresh_eye_journal_details['what_do_you_dislike_about_company'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>How satisfied are you with employee benefits being offered by {{ $fresh_eye_journal_details['company_name_ajax'] }}? Please elaborate</strong> {!! $fresh_eye_journal_details['satisfied_employee_benefits_offered_company'] !!}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Please share your satisfaction on the parameters mentioned below, out of 5</strong></td>
                  </tr>

                  <tr>
                    <td>Work culture</td>
                    <td>
                      @if($fresh_eye_journal_details['work_culture']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['work_culture']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Recruitment process</td>
                    <td>
                      @if($fresh_eye_journal_details['recruitment_process']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['recruitment_process']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Induction process</td>
                    <td>
                      @if($fresh_eye_journal_details['induction_process']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['induction_process']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>On-job training process</td>
                    <td>
                      @if($fresh_eye_journal_details['on_job_training_process']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['on_job_training_process']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Clear communication about any changes in the policy</td>
                    <td>
                      @if($fresh_eye_journal_details['clear_communication_changes_policy']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['clear_communication_changes_policy']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Feeling of belongingness in the organization</td>
                    <td>
                      @if($fresh_eye_journal_details['feeling_belongingness_organization']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['feeling_belongingness_organization']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Having a best friend at work</td>
                    <td>
                      @if($fresh_eye_journal_details['having_best_friend_at_work']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['having_best_friend_at_work']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Work-life balance</td>
                    <td>
                      @if($fresh_eye_journal_details['work_life_balance']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['work_life_balance']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any detailed feedback you would like to share to support your response on the above parameters?</strong> {!! $fresh_eye_journal_details['any_detailed_feedback_support_your_response'] !!}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Rate {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }} on the below-mentioned parameters out of 5</strong></td>
                  </tr>

                  <tr>
                    <td>Quickness in respond to your requests/queries/concerns?</td>
                    <td>
                      @if($fresh_eye_journal_details['quickness_in_respond_reporting_manager']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['quickness_in_respond_reporting_manager']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How well have you received guidance?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_well_received_guidance_reporting_manager']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_well_received_guidance_reporting_manager']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How clearly are your goals set?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_clearly_your_goals_set_reporting_manager']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_clearly_your_goals_set_reporting_manager']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How transparent is {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}</td>
                    <td>
                      @if($fresh_eye_journal_details['how_transparent_is_reporting_manager']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_transparent_is_reporting_manager']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>WPRs happen every week</td>
                    <td>
                      @if($fresh_eye_journal_details['wprs_happen_every_week_reporting_manager']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['wprs_happen_every_week_reporting_manager']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How well does he/she adjust to changing priorities</td>
                    <td>
                      @if($fresh_eye_journal_details['how_well_adjust_changing_priorities_reporting_manager']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_well_adjust_changing_priorities_reporting_manager']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }} on the below-mentioned parameters out of 5 (5- highest, 1- lowest)</strong></td>
                  </tr>

                  <tr>
                    <td>How comfortable do you feel in sharing your feedback with {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_comfortable_feel_sharing_feedback_reporting_manager']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_comfortable_feel_sharing_feedback_reporting_manager']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How well are you able to learn under {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}'s guidance?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_well_able_learn_under_guidance_reporting_manager']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_well_able_learn_under_guidance_reporting_manager']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}'s actions/way of work? Explain in detail</strong> {!! $fresh_eye_journal_details['our_organization_believes_mantra'] !!}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Rate {{ $fresh_eye_journal_details->reporting_manager_name_ajax }} on the below mentioned parameters out of 5 (5- highest, 1- lowest)</strong></td>
                  </tr>

                  <tr>
                    <td>How quickly does {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }} respond to your requests/queries/concerns?</td>
                    <td>
                      @if($fresh_eye_journal_details['quickness_in_respond_reporting_manager_qi']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['quickness_in_respond_reporting_manager_qi']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How well have you received guidance from {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_well_received_guidance_reporting_manager_qi']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_well_received_guidance_reporting_manager_qi']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How clearly are your goals set by {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_clearly_your_goals_set_reporting_manager_qi']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_clearly_your_goals_set_reporting_manager_qi']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How transparent is {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_transparent_is_reporting_manager_qi']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_transparent_is_reporting_manager_qi']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How frequent does your 1:1 happen?</td>
                    <td>
                      @if($fresh_eye_journal_details['frequent_1_1_happen_reporting_manager_qi']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['frequent_1_1_happen_reporting_manager_qi']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How well does {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }} adjust to changing priorities?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_well_adjust_changing_priorities_reporting_manager_qi']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_well_adjust_changing_priorities_reporting_manager_qi']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How comfortable do you feel in sharing your feedback with {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_comfortable_feel_sharing_feedback_reporting_manager_qi']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_comfortable_feel_sharing_feedback_reporting_manager_qi']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Share top three strengths of {{ $fresh_eye_journal_details->reporting_manager_name_ajax }}</strong></td>
                  </tr>
                  <tr class="txt_justify">
                    <td colspan="2">
                    	<strong>1.</strong> {{ $fresh_eye_journal_details['top_3_strengths_reporting_manager_qi_1'] }}<br>
                    	<strong>2.</strong> {{ $fresh_eye_journal_details['top_3_strengths_reporting_manager_qi_2'] }}<br>
                    	<strong>3.</strong> {{ $fresh_eye_journal_details['top_3_strengths_reporting_manager_qi_3'] }}
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Share three areas of improvement for {{ $fresh_eye_journal_details->reporting_manager_name_ajax }}</strong></td>
                  </tr>
                  <tr class="txt_justify">
                    <td colspan="2">
                    	<strong>1.</strong> {{ $fresh_eye_journal_details['three_areas_improvement_reporting_manager_qi_1'] }}<br>
                    	<strong>2.</strong> {{ $fresh_eye_journal_details['three_areas_improvement_reporting_manager_qi_2'] }}<br>
                    	<strong>3.</strong> {{ $fresh_eye_journal_details['three_areas_improvement_reporting_manager_qi_3'] }}
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by {{ $fresh_eye_journal_details['reporting_manager_name_ajax'] }}'s actions/way of work? Explain in detail</strong> {!! $fresh_eye_journal_details['our_organization_believes_mantra_reporting_manager_qi'] !!}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Rate {{ $fresh_eye_journal_details['head_of_department_name_ajax'] }} on the below mentioned parameters out of 5 (5- highest, 1- lowest)</strong></td>
                  </tr>

                  <tr>
                    <td>How quickly does {{ $fresh_eye_journal_details['head_of_department_name_ajax'] }} respond to your requests/queries/concerns?</td>
                    <td>
                      @if($fresh_eye_journal_details['quickness_in_respond_hod_qj']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['quickness_in_respond_hod_qj']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How well have you received guidance from {{ $fresh_eye_journal_details['head_of_department_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_well_received_guidance_hod_qj']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_well_received_guidance_hod_qj']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How clearly are your goals set by {{ $fresh_eye_journal_details['head_of_department_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_clearly_your_goals_set_hod_qj']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_clearly_your_goals_set_hod_qj']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How transparent is {{ $fresh_eye_journal_details['head_of_department_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_transparent_is_hod_qj']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_transparent_is_hod_qj']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How frequent does your 1:1 happen?</td>
                    <td>
                      @if($fresh_eye_journal_details['frequent_1_1_happen_hod_qj']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['frequent_1_1_happen_hod_qj']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How well does {{ $fresh_eye_journal_details['head_of_department_name_ajax'] }} adjust to changing priorities?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_well_adjust_changing_priorities_hod_qj']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_well_adjust_changing_priorities_hod_qj']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How comfortable do you feel in sharing your feedback with {{ $fresh_eye_journal_details['head_of_department_name_ajax'] }}?</td>
                    <td>
                      @if($fresh_eye_journal_details['how_comfortable_feel_sharing_feedback_hod_qj']!='NA')
                    	  @for($i=0; $i < $fresh_eye_journal_details['how_comfortable_feel_sharing_feedback_hod_qj']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Share top three strengths of {{ $fresh_eye_journal_details->head_of_department_name_ajax }}</strong></td>
                  </tr>
                  <tr class="txt_justify">
                    <td colspan="2">
                    	<strong>1.</strong> {{ $fresh_eye_journal_details['top_3_strengths_hod_qj_1'] }}<br>
                    	<strong>2.</strong> {{ $fresh_eye_journal_details['top_3_strengths_hod_qj_2'] }}<br>
                    	<strong>3.</strong> {{ $fresh_eye_journal_details['top_3_strengths_hod_qj_3'] }}
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Share three areas of improvement for {{ $fresh_eye_journal_details->head_of_department_name_ajax }}</strong></td>
                  </tr>
                  <tr class="txt_justify">
                    <td colspan="2">
                    	<strong>1.</strong> {{ $fresh_eye_journal_details['three_areas_improvement_hod_qj_1'] }}<br>
                    	<strong>2.</strong> {{ $fresh_eye_journal_details['three_areas_improvement_hod_qj_2'] }}<br>
                    	<strong>3.</strong> {{ $fresh_eye_journal_details['three_areas_improvement_hod_qj_3'] }}
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by {{ $fresh_eye_journal_details['head_of_department_name_ajax'] }}'s actions/way of work? Explain in detail</strong> {!! $fresh_eye_journal_details['our_organization_believes_mantra_hod_qj'] !!}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Rate the Departments out of 5</strong></td>
                  </tr>

                  <tr>
                    <td>Admin Operations</td>
                    <td>

                      @if($fresh_eye_journal_details['admin_operations']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['admin_operations']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                      	NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Advertiser Sales</td>
                    <td>
                      @if($fresh_eye_journal_details['advertiser_sales']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['advertiser_sales']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Advertiser</td>
                    <td>
                      @if($fresh_eye_journal_details['advertisers']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['advertisers']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Finance & Accounts</td>
                    <td>
                      @if($fresh_eye_journal_details['finance_accounts']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['finance_accounts']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Human Resources</td>
                    <td>
                      @if($fresh_eye_journal_details['human_resources']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['human_resources']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Management</td>
                    <td>
                      @if($fresh_eye_journal_details['management']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['management']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Network Operations</td>
                    <td>
                      @if($fresh_eye_journal_details['network_operations']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['network_operations']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Pocket Money</td>
                    <td>
                      @if($fresh_eye_journal_details['pocket_money']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['pocket_money']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Publishers</td>
                    <td>
                      @if($fresh_eye_journal_details['publishers']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['publishers']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Tech Operations - Development</td>
                    <td>
                      @if($fresh_eye_journal_details['tech_operations_development']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['tech_operations_development']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Support (EA/PA)</td>
                    <td>
                      @if($fresh_eye_journal_details['support_ea_pa']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['support_ea_pa']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Education</td>
                    <td>
                      @if($fresh_eye_journal_details['education']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['education']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>iGaming</td>
                    <td>
                      @if($fresh_eye_journal_details['igaming']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['igaming']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Tech Operations - Shopify</td>
                    <td>
                      @if($fresh_eye_journal_details['tech_operations_shopify']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['tech_operations_shopify']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Tech Operations - Creative</td>
                    <td>
                      @if($fresh_eye_journal_details['tech_operations_creative']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['tech_operations_creative']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>Mobile</td>
                    <td>
                      @if($fresh_eye_journal_details['mobile']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['mobile']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                   <tr>
                    <td>vCommission - UK</td>
                    <td>
                      @if($fresh_eye_journal_details['vcommission_uk']!='NA')
                      		@for($i=0; $i < $fresh_eye_journal_details['vcommission_uk']; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                      @else
                        NA
                      @endif
                  	</td>
                   </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional feedback for any department that you would like to share?</strong> {!! $fresh_eye_journal_details['any_additional_feedback_any_department'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any issue or concern that you would like to talk to management about?</strong> {!! $fresh_eye_journal_details['any_issue_concern_management'] !!}</td>
                  </tr>

                </tbody>
              </table>
              <!-- End Bordered Table -->

              
            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
@endsection