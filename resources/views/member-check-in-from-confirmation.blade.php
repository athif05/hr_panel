@extends('layouts.master-confirmation')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Member Check-In From | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>45 Days Member Check-In Form <img src="{{ str_replace('public/', '', asset('resources/views/confirmation-process/img/emp-icon.png')) }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              @if($check_in_member_details)

              <h2>Q. 1 - Full Name</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->member_name }}</div>
              </li>

              <h2>Q. 2 - Member Code</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->member_id }}</div>
              </li>

              <h2>Q. 3 - Designation</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->designation_name }}</div>
              </li>

              <h2>Q. 4 - Department</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->department_name }}</div>
              </li>

              <h2>Q. 5 - Email</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->official_email }}</div>
              </li>

              <h2>Q. 6 - Company</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->company_name }}</div>
              </li>

              <h2>Q. 7 - Location</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->company_location }}</div>
              </li>

              <h2>Q. 8 - Your Reporting Manager</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->reporting_manager_name }}</div>
              </li>

              <h2>Q. 9 - Head of Department</h2>
              <li>
              <div class="col-left">
                @foreach($hod_details as $hod_detail)
                  @if(($check_in_member_details->head_of_department)==$hod_detail['id']) 
                    {{$hod_detail['first_name']}} {{$hod_detail['last_name']}}
                  @endif
                @endforeach
              </div>
              </li>


              <!-- <li>
              <div class="col-left"><strong>Internal Member Department</strong>
                <span class="float_right_div">
                 
                </span>  
              </div>
              </li> -->
              

              <h2>Q. 10 - Your Date of Joining</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->joining_date }}</div>
              </li>

              <h2>Q. 11 - Name of the HR taking this session</h2>
              <li>
              <div class="col-left">
                @foreach($hr_details as $hr_detail)
                  @if(old('hr_name_taking_session',$check_in_member_details->hr_name_taking_session)==$hr_detail['id'])
                    {{$hr_detail['first_name']}} {{$hr_detail['last_name']}}
                  @endif
                @endforeach
              </div>
              </li>

              <h2>Q. 12 - Which category would you like to place yourself in?</h2>
              <li>
              <div class="col-left">
                @if($check_in_member_details->place_yourself_category!='Others')
                  @foreach($yourself_category_details as $yourself_category_detail)
                    @if($check_in_member_details->place_yourself_category==$yourself_category_detail['id'])
                      {{$yourself_category_detail['name']}}
                    @endif
                  @endforeach
                @else
                  Others
                @endif
              </div>
              </li>


              <h2>Q. 13 - Please rate yourself on the following parameters.</h2>
      
              <li>
              <div class="col-left">Target
                @if($check_in_member_details->target!='NA')
                  @for($i=0; $i < $check_in_member_details->target; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Response  
                @if($check_in_member_details->response!='NA')
                  @for($i=0; $i < $check_in_member_details->response; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">JD
                @if($check_in_member_details->jd!='NA')
                  @for($i=0; $i < $check_in_member_details->jd; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Reliability 
                @if($check_in_member_details->reliability!='NA')
                  @for($i=0; $i < $check_in_member_details->reliability; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Team Spirit 
                @if($check_in_member_details->team_spirit!='NA')
                  @for($i=0; $i < $check_in_member_details->team_spirit; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Attendance 
                @if($check_in_member_details->attendance!='NA')
                  @for($i=0; $i < $check_in_member_details->attendance; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Attitude  
                @if($check_in_member_details->attitude!='NA')
                  @for($i=0; $i < $check_in_member_details->attitude; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Rules  
                @if($check_in_member_details->rules!='NA')
                  @for($i=0; $i < $check_in_member_details->rules; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Peers  
                @if($check_in_member_details->peers!='NA')
                  @for($i=0; $i < $check_in_member_details->peers; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 14 - How well do you see yourself aligned with the company's core values? Please rate yourself, basis on your everyday conduct at work.</h2>
              <span style="color: red; font-size: 13px;">"HINT: +/+ (follow always) , +/- (follow sometimes) , -/- (never follow)"</span>
      
              <li>
              <div class="col-left">Integrity: Honesty & respect (ईमानंदारी)
                <span class="float_right_div">{{ $check_in_member_details->integrity }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Win-Win : You win-I win (सब की जीत)  
                <span class="float_right_div">{{ $check_in_member_details->win_win }}</span>
              </div>
              </li>

            
              <li>
              <div class="col-left">Synergize: Together is better (ताल-मेल)
                <span class="float_right_div">{{ $check_in_member_details->synergize }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Closure : Do it to close it (समापन) 
                <span class="float_right_div">{{ $check_in_member_details->closure }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Knowledge: Ace of trade (ज्ञान)
                <span class="float_right_div">{{ $check_in_member_details->knowledge }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">KISS: Keep it simple, stupid (सरल) 
                <span class="float_right_div">{{ $check_in_member_details->kiss }}</span>
              </div>
              </li>

              <li>
              <div class="col-left">Innovation: New method or idea (नवीनता)  
                <span class="float_right_div">{{ $check_in_member_details->innovation }}</span>
              </div>
              </li>

              <li>
              <div class="col-left">Celebration: Work hard, party harder (उत्सव)  
                <span class="float_right_div">{{ $check_in_member_details->celebration }}</span>
              </div>
              </li>


              <h2>Q. 15 - Let's talk about your work-related experience</h2>
      
              <li>
              <div class="col-left">The work culture in the company is encouraging
                @if($check_in_member_details->company_work_culture!='NA')
                  @for($i=0; $i < $check_in_member_details->company_work_culture; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">The processes & policies are well defined & well explained
                @if($check_in_member_details->processes_policies_well_defined!='NA')
                  @for($i=0; $i < $check_in_member_details->processes_policies_well_defined; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">I enjoy the work-life balance
                @if($check_in_member_details->enjoy_work_life_balance!='NA')
                  @for($i=0; $i < $check_in_member_details->enjoy_work_life_balance; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">I am happy with how I am treated in the company by managers & peers
                @if($check_in_member_details->happy_with_treated_in_company!='NA')
                  @for($i=0; $i < $check_in_member_details->happy_with_treated_in_company; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">My job title & KRAs are apt for me
                @if($check_in_member_details->job_title_kras!='NA')
                  @for($i=0; $i < $check_in_member_details->job_title_kras; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">I have necessary resources available, to perform my job 
                @if($check_in_member_details->necessary_resources_available!='NA')
                  @for($i=0; $i < $check_in_member_details->necessary_resources_available; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">I feel I will grow in the organization
                @if($check_in_member_details->feel_grow_in_organization!='NA')
                  @for($i=0; $i < $check_in_member_details->feel_grow_in_organization; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">I have complete clarity of my role & what's expected out of me 
                @if($check_in_member_details->complete_clarity_my_role!='NA')
                  @for($i=0; $i < $check_in_member_details->complete_clarity_my_role; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">Overall I am happy with my job role  
                @if($check_in_member_details->overall_happy_with_job_role!='NA')
                  @for($i=0; $i < $check_in_member_details->overall_happy_with_job_role; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>


              <h2>Q. 16 - Let's talk about your training experience</h2>
      
              <li>
              <div class="col-left">Training was elaborative & well explained
                @if($check_in_member_details->training_elaborative_well_explained!='NA')
                  @for($i=0; $i < $check_in_member_details->training_elaborative_well_explained; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Duration of training was apt
                @if($check_in_member_details->training_duration_apt!='NA')
                  @for($i=0; $i < $check_in_member_details->training_duration_apt; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">Proper modules are defined for each topic
                @if($check_in_member_details->proper_modules_defined_topic!='NA')
                  @for($i=0; $i < $check_in_member_details->proper_modules_defined_topic; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">Adequate supporting material is provided to help learn faster & better
                @if($check_in_member_details->adequate_supporting_material!='NA')
                  @for($i=0; $i < $check_in_member_details->adequate_supporting_material; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">The clarity given on topics during training was apt
                @if($check_in_member_details->clarity_on_topics_during_training!='NA')
                  @for($i=0; $i < $check_in_member_details->clarity_on_topics_during_training; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <h2>Q. 17 - Let's talk about your training experience</h2>
      
              <li>
              <div class="col-left">I have great relationship with {{ $check_in_member_details->reporting_manager_name }}
                @if($check_in_member_details->great_relationship_with_manager!='NA')
                  @for($i=0; $i < $check_in_member_details->great_relationship_with_manager; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">My work is reviewed properly & feedback is shared timely
                @if($check_in_member_details->reviewed_properly_feedback_shared_timely!='NA')
                  @for($i=0; $i < $check_in_member_details->reviewed_properly_feedback_shared_timely; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

            
              <li>
              <div class="col-left">I can openly share opinions & feedback with {{ $check_in_member_details->reporting_manager_name }}
                @if($check_in_member_details->openly_share_opinions!='NA')
                  @for($i=0; $i < $check_in_member_details->openly_share_opinions; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">I receive adequate guidance from {{ $check_in_member_details->reporting_manager_name }}
                @if($check_in_member_details->receive_adequate_guidance!='NA')
                  @for($i=0; $i < $check_in_member_details->receive_adequate_guidance; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <li>
              <div class="col-left">I receive adequate & timely feedback from {{ $check_in_member_details->reporting_manager_name }}
                @if($check_in_member_details->receive_adequate_timely_feedback!='NA')
                  @for($i=0; $i < $check_in_member_details->receive_adequate_timely_feedback; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              <li>
              <div class="col-left">I get quick resolution to issues from {{ $check_in_member_details->reporting_manager_name }}
                @if($check_in_member_details->get_quick_resolution_issue!='NA')
                  @for($i=0; $i < $check_in_member_details->get_quick_resolution_issue; $i++)
                    <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                  @endfor
                @else 
                  <span class="float_right_div"> NA</span>
                @endif
              </div>
              </li>

              
              <h2>Q. 18 - How frequently do you want to receive feedback from your manager about your performance?</h2>
              <li>
              <div class="col-left">{{ $check_in_member_details->frequently_receive_feedback_manager }}</div>
              </li>


              <h2>Q. 19 - Any additional feedback for {{ $check_in_member_details->reporting_manager_name }}</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->any_additional_feedback_manager !!}</div>
              </li>


              <h2>Q. 20 - Has the following happened for you yet?</h2>
      
              <li>
              <div class="col-left">Did you receive a proper Job Description/KRA sheet from your manager at the time of joining
                <span class="float_right_div">{{ $check_in_member_details->receive_proper_job_kra }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Did you receive a proper training plan from your reporting manager at the time of our joining?  
                <span class="float_right_div">{{ $check_in_member_details->proper_training_plan }}</span>
              </div>
              </li>

            
              <li>
              <div class="col-left">Was the training executed as planned?
                <span class="float_right_div">{{ $check_in_member_details->training_executed_planned }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Are you marked regularly on your EODs? 
                <span class="float_right_div">{{ $check_in_member_details->marked_regularly_your_eod }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Do your WPRs happen atleast once a week?
                <span class="float_right_div">{{ $check_in_member_details->wpr_happen_atleast_once_week }}</span>
              </div>
              </li>

              
              <li>
              <div class="col-left">Has your 1:1 interaction happened with {{ $check_in_member_details->reporting_manager_name }} atleast twice? 
                <span class="float_right_div">{{ $check_in_member_details->one_to_one_interaction }}</span>
              </div>
              </li>

              <h2>Q. 21 - What’s the best experience you have had during your tenure till date?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->best_experience_tenure !!}</div>
              </li>

              <h2>Q. 22 - What do you like the most working here?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->like_most_working !!}</div>
              </li>

              <h2>Q. 23 - What would you like to change/add in the organization?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->like_to_change_add !!}</div>
              </li>

              <h2>Q. 24 - What/Who has inspired you in this organization, based on your experiences so far?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->who_inspired_you_organization !!}</div>
              </li>

              <h2>Q. 25 - Mention your achievement(s) in terms of your work till date</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->mention_achievement !!}</div>
              </li>

              <h2>Q. 26 - Any challenges that you are facing right now?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->facing_any_challenges !!}</div>
              </li>

              <h2>Q. 27 - Do you need any additional training or support?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->need_additional_training !!}</div>
              </li>

              <h2>Q. 28 - Any additional feedback that you wish to share?</h2>
              <li>
              <div class="col-left text-justify">{!! $check_in_member_details->any_additional_feedback_share !!}</div>
              </li>

              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
				        <a href="{{ url('/training-survey/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/fresh-eye-journal/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection