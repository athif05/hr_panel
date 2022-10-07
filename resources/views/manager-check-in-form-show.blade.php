@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Manager Check-In Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Manager Check-In Form Details</h5>

              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              @if($manager_details && $check_in_manager_details)
              <!-- Bordered Table -->
              <table class="table table-striped table-bordered">
                
                <tbody>

                  <tr>
                    <td colspan="2"><strong>Manager Details</strong></td>
                  </tr>

                  <tr>
                    <td>Your Name</td>
                    <td>{{ $manager_details['full_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Your Member Code</td>
                    <td>{{ $manager_details['member_id'] }}</td>
                  </tr>

                  <tr>
                    <td>Company</td>
                    <td>{{$manager_details['company_name']}}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>{{ $manager_details['designation_name'] }}</td>
                  </tr>

                  <tr>
                   <td>Department</td>
                    <td>{{ $manager_details['department_name'] }} </td>
                  </tr>

                  <tr>
                   <td>Email</td>
                    <td>{{ $manager_details['email'] }} </td>
                  </tr>

                  <tr>
                   <td>Location</td>
                    <td>{{ $manager_details['location_name'] }} </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Member Details</strong></td>
                  </tr>

                  <tr>
                    <td>Member Name</td>
                    <td>{{ $member_details['full_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Member Code</td>
                    <td>{{ $member_details['member_id'] }}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>{{$member_details['designation_name']}}</td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>{{ $member_details['department_name'] }}</td>
                  </tr>

                  <tr>
                   <td>Email</td>
                    <td>{{ $member_details['email'] }} </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate {{ $member_details['full_name'] }} level of understanding on the following parameters</strong></td>
                  </tr>

                  <tr>
                    <td>Departmental Processes</td>
                    <td>
                      @if($check_in_manager_details->departmental_processes!='NA')
                        @for($i=0; $i < $check_in_manager_details->departmental_processes; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>TOD/EOD Process</td>
                    <td>
                      @if($check_in_manager_details->tod_eod_process!='NA')
                        @for($i=0; $i < $check_in_manager_details->tod_eod_process; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Month Summary Process</td>
                    <td>
                      @if($check_in_manager_details->month_summary_process!='NA')
                        @for($i=0; $i < $check_in_manager_details->month_summary_process; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Relevant software/tools</td>
                    <td>
                      @if($check_in_manager_details->relevant_software_tools!='NA')
                        @for($i=0; $i < $check_in_manager_details->relevant_software_tools; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Organization's Policies & Processes</td>
                    <td>
                      @if($check_in_manager_details->organization_policies_processes!='NA')
                        @for($i=0; $i < $check_in_manager_details->organization_policies_processes; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>


                  <tr>
                    <td>Which category would  you like to place {{ $member_details['full_name'] }} in?</td>
                    <td>{{$check_in_manager_details->which_category_like_place }}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Rate Organization's Policies & Processes on core values of the organization</strong></td>
                  </tr>

                  <tr>
                    <td>Integrity</td>
                    <td>{{ $check_in_manager_details->integrity }}</td>
                  </tr>

                  <tr>
                    <td>Win-Win</td>
                    <td>{{ $check_in_manager_details->win_win }}</td>
                  </tr>

                  <tr>
                    <td>Synergise</td>
                    <td>{{ $check_in_manager_details->synergise }}</td>
                  </tr>

                  <tr>
                    <td>Closure</td>
                    <td>{{ $check_in_manager_details->closure }}</td>
                  </tr>

                  <tr>
                    <td>Knowledge</td>
                    <td>{{ $check_in_manager_details->knowledge }}</td>
                  </tr>

                  <tr>
                    <td>KISS</td>
                    <td>{{ $check_in_manager_details->kiss }}</td>
                  </tr>

                  <tr>
                    <td>Innovation</td>
                    <td>{{ $check_in_manager_details->innovation }}</td>
                  </tr>

                  <tr>
                    <td>Celebration</td>
                    <td>{{ $check_in_manager_details->celebration }}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>What have been {{ $member_details['full_name'] }} major achievements?</strong> {!! $check_in_manager_details->major_achievements !!}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>What have been {{ $member_details['full_name'] }} major fallbacks?</strong> {!! $check_in_manager_details->major_fallbacks !!}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>What would you recommend to change about {{ $member_details['full_name'] }} approach towards the work/otherwise?</strong> {!! $check_in_manager_details->recommend_to_change_approach !!}</td>
                  </tr>

                  <tr>
                    <td>Do you see {{ $member_details['full_name'] }} adding value to your team & meeting your expectations?</td>
                    <td>{{ $check_in_manager_details->adding_value_your_team_expectations }}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Pleasse justify above answer with examples</strong> {!! $check_in_manager_details->justify_above_answer !!}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>What kind of long-term goal do you foresee for {{ $member_details['full_name'] }}?</strong> {!! $check_in_manager_details->long_term_goal !!}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Any Additional feedback for {{ $member_details['full_name'] }}?</strong> {!! $check_in_manager_details->any_additional_feedback !!}</td>
                  </tr>


                </tbody>
              </table>
              <!-- End Bordered Table -->
              @else
              <table class="table table-striped table-bordered">
                
	                <tbody>
	                  <tr>
	                    <td colspan="2">No record found...</td>
	                  </tr>
	              </tbody>
	          </table>
              @endif
              
            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
@endsection