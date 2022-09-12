@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Member Check-In Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Member Check-In Form Details</h5>
              
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
                    <td>{{$check_in_member_details->member_name}}</td>
                  </tr>

                  <tr>
                    <td>Member Code</td>
                    <td>{{$check_in_member_details->member_id}}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>
                      @foreach($designation_details as $designation_detail)

                        @if($designation_detail['id']==$check_in_member_details->designation)
                        {{$designation_detail['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>
                      @foreach($department_details as $department_detail)

                        @if($department_detail['id']==$check_in_member_details->department)
                        {{$department_detail['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Email</td>
                    <td>{{$check_in_member_details->official_email}}</td>
                  </tr>

                  <tr>
                   <td>Company</td>
                    <td>
                    	@foreach($company_names as $company_name)

                    		@if($company_name['id']==$check_in_member_details->company_name)
                    		{{$company_name['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Location</td>
                    <td>
                    	@foreach($company_locations as $company_location)

                    		@if($company_location['id']==$check_in_member_details->location_name)
                    			{{$company_location['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Your Reporting Manager</td>
                    <td>{{$check_in_member_details->reporting_manager_name}}</td>
                  </tr>

                  <tr>
                    <td>Head of Department</td>
                    <td>
                    	@foreach($hod_details as $hod_detail)

                    		@if($hod_detail['id']==$check_in_member_details->head_of_department)
                    			{{$hod_detail['first_name']}} {{$hod_detail['last_name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Your Date of Joining</td>
                    <td>{{ $check_in_member_details->joining_date }}</td>
                  </tr>

                  <tr>
                    <td>Name of the HR taking this session</td>
                    <td>
                    	@foreach($hr_details as $hr_detail)

                    		@if($hr_detail['id']==$check_in_member_details->hr_name_taking_session)
                    			{{$hr_detail['first_name']}} {{$hr_detail['last_name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Which category would you like to place yourself in?</td>
                    <td>
                    	@foreach($yourself_category_details as $yourself_category_detail)

                    		@if($yourself_category_detail['id']==$check_in_member_details->location_name)
                    			{{$yourself_category_detail['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Please rate yourself on the following parameters.</strong></td>
                  </tr>

                  <tr>
                    <td>Target</td>
                    <td> 
                    	@if($check_in_member_details->target!='NA')
                    	 @for($i=0; $i < $check_in_member_details->target; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                    	@else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Response</td>
                    <td>
                      @if($check_in_member_details->response!='NA')
                        @for($i=0; $i < $check_in_member_details->response; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>JD</td>
                    <td>
                      @if($check_in_member_details->jd!='NA')
                        @for($i=0; $i < $check_in_member_details->jd; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Reliability</td>
                    <td>
                      @if($check_in_member_details->reliability!='NA')
                        @for($i=0; $i < $check_in_member_details->reliability; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Team Spirit</td>
                    <td>
                      @if($check_in_member_details->team_spirit!='NA')
                        @for($i=0; $i < $check_in_member_details->team_spirit; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Attendance</td>
                    <td>
                      @if($check_in_member_details->attendance!='NA')
                        @for($i=0; $i < $check_in_member_details->attendance; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Attitude</td>
                    <td>
                      @if($check_in_member_details->attitude!='NA')
                        @for($i=0; $i < $check_in_member_details->attitude; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Rules</td>
                    <td>
                      @if($check_in_member_details->rules!='NA')
                        @for($i=0; $i < $check_in_member_details->rules; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Peers</td>
                    <td>
                      @if($check_in_member_details->peers!='NA')
                        @for($i=0; $i < $check_in_member_details->peers; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>How well do you see yourself aligned with the company's core values? Please rate yourself, basis on your everyday conduct at work.</strong></td>
                  </tr>

                  <tr>
                    <td>Integrity: Honesty & respect (ईमानंदारी)</td>
                    <td>{{$check_in_member_details->integrity}}</td>
                  </tr>

                  <tr>
                    <td>Win-Win : You win-I win (सब की जीत)</td>
                    <td>{{$check_in_member_details->win_win}}</td>
                  </tr>

                  <tr>
                    <td>Synergize: Together is better (ताल-मेल)</td>
                    <td>{{$check_in_member_details->synergize}}</td>
                  </tr>

                  <tr>
                    <td>Closure : Do it to close it (समापन)</td>
                    <td>{{$check_in_member_details->closure}}</td>
                  </tr>

                  <tr>
                    <td>Knowledge: Ace of trade (ज्ञान)</td>
                    <td>{{$check_in_member_details->knowledge}}</td>
                  </tr>

                  <tr>
                    <td>KISS: Keep it simple, stupid (सरल)</td>
                    <td>{{$check_in_member_details->kiss}}</td>
                  </tr>

                  <tr>
                    <td>Innovation: New method or idea (नवीनता)</td>
                    <td>{{$check_in_member_details->innovation}}</td>
                  </tr>

                  <tr>
                    <td>Celebration: Work hard, party harder (उत्सव)</td>
                    <td>{{$check_in_member_details->celebration}}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Let's talk about your work-related experience</strong></td>
                  </tr>

                  <tr>
                    <td>The work culture in the company is encouraging</td>
                    <td>
                      @if($check_in_member_details->company_work_culture!='NA')
                        @for($i=0; $i < $check_in_member_details->company_work_culture; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>The processes & policies are well defined & well explained.</td>
                    <td>
                      @if($check_in_member_details->processes_policies_well_defined!='NA')
                        @for($i=0; $i < $check_in_member_details->processes_policies_well_defined; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I enjoy the work-life balance</td>
                    <td>
                      @if($check_in_member_details->enjoy_work_life_balance!='NA')
                        @for($i=0; $i < $check_in_member_details->enjoy_work_life_balance; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I am happy with how I am treated in the company by managers & peers</td>
                    <td>
                      @if($check_in_member_details->happy_with_treated_in_company!='NA')
                        @for($i=0; $i < $check_in_member_details->happy_with_treated_in_company; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>My job title & KRAs are apt for me</td>
                    <td>
                      @if($check_in_member_details->job_title_kras!='NA')
                        @for($i=0; $i < $check_in_member_details->job_title_kras; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I have necessary resources available, to perform my job</td>
                    <td>
                      @if($check_in_member_details->necessary_resources_available!='NA')
                        @for($i=0; $i < $check_in_member_details->necessary_resources_available; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I feel I will grow in the organization</td>
                    <td>
                      @if($check_in_member_details->feel_grow_in_organization!='NA')
                        @for($i=0; $i < $check_in_member_details->feel_grow_in_organization; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I have complete clarity of my role & what's expected out of me</td>
                    <td>
                      @if($check_in_member_details->complete_clarity_my_role!='NA')
                        @for($i=0; $i < $check_in_member_details->complete_clarity_my_role; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Overall I am happy with my job role</td>
                    <td>
                      @if($check_in_member_details->overall_happy_with_job_role!='NA')
                        @for($i=0; $i < $check_in_member_details->overall_happy_with_job_role; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Let's talk about your training experience</strong></td>
                  </tr>

                  <tr>
                    <td>Training was elaborative & well explained.</td>
                    <td>
                      @if($check_in_member_details->training_elaborative_well_explained!='NA')
                        @for($i=0; $i < $check_in_member_details->training_elaborative_well_explained; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Duration of training was apt.</td>
                    <td>
                      @if($check_in_member_details->training_duration_apt!='NA')
                        @for($i=0; $i < $check_in_member_details->training_duration_apt; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Proper modules are defined for each topic</td>
                    <td>
                      @if($check_in_member_details->proper_modules_defined_topic!='NA')
                        @for($i=0; $i < $check_in_member_details->proper_modules_defined_topic; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Adequate supporting material is provided to help learn faster & better</td>
                    <td>
                      @if($check_in_member_details->adequate_supporting_material!='NA')
                        @for($i=0; $i < $check_in_member_details->adequate_supporting_material; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>The clarity given on topics during training was apt</td>
                    <td>
                      @if($check_in_member_details->clarity_on_topics_during_training!='NA')
                        @for($i=0; $i < $check_in_member_details->clarity_on_topics_during_training; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Let's talk about your experience with your reporting manager</strong></td>
                  </tr>

                  <tr>
                    <td>I have great relationship with {{ $check_in_member_details->reporting_manager_name }}</td>
                    <td>
                      @if($check_in_member_details->great_relationship_with_manager!='NA')
                        @for($i=0; $i < $check_in_member_details->great_relationship_with_manager; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>My work is reviewed properly & feedback is shared timely</td>
                    <td>
                      @if($check_in_member_details->reviewed_properly_feedback_shared_timely!='NA')
                        @for($i=0; $i < $check_in_member_details->reviewed_properly_feedback_shared_timely; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I can openly share opinions & feedback with {{ $check_in_member_details->reporting_manager_name }}</td>
                    <td>
                      @if($check_in_member_details->openly_share_opinions!='NA')
                        @for($i=0; $i < $check_in_member_details->openly_share_opinions; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I receive adequate guidance from {{ $check_in_member_details->reporting_manager_name }}</td>
                    <td>
                      @if($check_in_member_details->receive_adequate_guidance!='NA')
                        @for($i=0; $i < $check_in_member_details->receive_adequate_guidance; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I receive adequate & timely feedback from {{ $check_in_member_details->reporting_manager_name }}</td>
                    <td>
                      @if($check_in_member_details->receive_adequate_timely_feedback!='NA')
                        @for($i=0; $i < $check_in_member_details->receive_adequate_timely_feedback; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>I get quick resolution to issues from {{ $check_in_member_details->reporting_manager_name }}</td>
                    <td>
                      @if($check_in_member_details->get_quick_resolution_issue!='NA')
                        @for($i=0; $i < $check_in_member_details->get_quick_resolution_issue; $i++)
                            <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                 <tr class="txt_justify">
                    <td colspan="2"><strong>How frequently do you want to receive feedback from your manager about your performance?</strong> : {{$check_in_member_details->frequently_receive_feedback_manager}}</td>
                  </tr>


                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional feedback for {{ $check_in_member_details->reporting_manager_name }}</strong> : {!! ($check_in_member_details->any_additional_feedback_manager) !!}</td>
                  </tr>



                  <tr>
                    <td colspan="2"><strong>Has the following happened for you yet? </strong></td>
                  </tr>

                  <tr>
                    <td>Did you receive a proper Job Description/KRA sheet from your manager at the time of joining?</td>
                    <td>{{$check_in_member_details->receive_proper_job_kra}}</td>
                  </tr>

                  <tr>
                    <td>Did you receive a proper training plan from your reporting manager at the time of our joining?</td>
                    <td>{{$check_in_member_details->proper_training_plan}}</td>
                  </tr>

                  <tr>
                    <td>Was the training executed as planned?</td>
                    <td>{{$check_in_member_details->training_executed_planned}}</td>
                  </tr>

                  <tr>
                    <td>Are you marked regularly on your EODs?</td>
                    <td>{{$check_in_member_details->marked_regularly_your_eod}}</td>
                  </tr>

                  <tr>
                    <td>Do your WPRs happen atleast once a week?</td>
                    <td>{{$check_in_member_details->wpr_happen_atleast_once_week}}</td>
                  </tr>

                  <tr>
                    <td>Has your 1:1 interaction happened with {{ $check_in_member_details->reporting_manager_name }} atleast twice?</td>
                    <td>{{$check_in_member_details->one_to_one_interaction}}</td>
                  </tr>
                  
                  <tr class="txt_justify">
                    <td colspan="2"><strong>What’s the best experience you have had during your tenure till date?</strong> : {!! $check_in_member_details->best_experience_tenure !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>What do you like the most working here?</strong> : {!! $check_in_member_details->like_most_working !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>What would you like to change/add in the organization?</strong> : {!! $check_in_member_details->like_to_change_add !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>What/Who has inspired you in this organization, based on your experiences so far?</strong> : {!! $check_in_member_details->who_inspired_you_organization !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Mention your achievement(s) in terms of your work till date.</strong> : {!! $check_in_member_details->mention_achievement !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any challenges that you are facing right now?</strong> : {!! $check_in_member_details->facing_any_challenges !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Do you need any additional training or support?</strong> : {!! $check_in_member_details->need_additional_training !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional feedback that you wish to share?</strong> : {!! $check_in_member_details->any_additional_feedback_share !!}</td>
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