@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Annual Review HR 1:1 Form Details | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Annual Review HR 1:1 Form Details</h5>

              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              @if($member_details && $hr_one_on_one_details)
              <!-- Bordered Table -->
              <table class="table table-striped table-bordered">
                
                <tbody>
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
                   <td>Company</td>
                    <td>{{ $member_details['company_name'] }} </td>
                  </tr>

                  <tr>
                   <td>Mentor Name</td>
                    <td>{{ $member_details['hod_name'] }} </td>
                  </tr>

                  <tr>
                   <td>Manager Name</td>
                    <td>{{ $member_details['manager_name'] }} </td>
                  </tr>

                  <tr>
                   <td>Head Name</td>
                    <td>{{ $member_details['hod_name'] }} </td>
                  </tr>

                  <tr>
                   <td>Were you ever put in PIP?</td>
                    <td>{{ $hr_one_on_one_details['put_ever_pip'] }} </td>
                  </tr>

                  @if($hr_one_on_one_details['put_ever_pip']=='Yes')
                  <tr>
                   <td>PIP Start Date</td>
                    <td>{{ $hr_one_on_one_details['pip_start_date'] }} </td>
                  </tr>

                  <tr>
                   <td>PIP End Date</td>
                    <td>{{ $hr_one_on_one_details['pip_end_date'] }} </td>
                  </tr>
                  @endif

                  <tr>
                   <td>Member's Appraisal Cycle</td>
                    <td>{{ $hr_one_on_one_details['member_appraisal_cycle'] }} </td>
                  </tr>

                  <tr>
                   <td>Name of the member taking this HR 1:1 session</td>
                    <td>
                    	@if($hr_one_on_one_details['hr_full_name'])
                    	{{ $hr_one_on_one_details['hr_full_name'] }}
                    	@else
                    	Other
                    	@endif 
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Appraisal Information</strong></td>
                  </tr>

                  <tr>
                   <td>Which level would you like to place yourself in the company?</td>
                    <td>{{ $hr_one_on_one_details['Which_level_place_yourself'] }} </td>
                  </tr>

                  <tr>
                   <td>Current Monthly Salary (in number)</td>
                    <td>{{ number_format($hr_one_on_one_details['current_monthly_salary'],2,".",",") }} </td>
                  </tr>

                  <tr>
                   <td>Current Annual Salary (in number)</td>
                    <td>{{ number_format($hr_one_on_one_details['current_annual_salary'],2,".",",") }} </td>
                  </tr>

                  <tr>
                   <td>Total Expected Increment (Monthly salary)</td>
                    <td>{{ number_format($hr_one_on_one_details['total_expected_increment_monthly_salary'],2,".",",") }} </td>
                  </tr>

                  <tr>
                   <td>Percentage of Current Salary</td>
                    <td>{{ $hr_one_on_one_details['total_expected_increment_monthly_salary_percentage'] }}%</td>
                  </tr>

                  <tr>
                   <td>HR Notes</td>
                    <td>{{ $hr_one_on_one_details['hr_notes'] }} </td>
                  </tr>

                  <tr>
                   <td>Promotion in Designation</td>
                    <td>{{ $hr_one_on_one_details['promotion_in_designation'] }} </td>
                  </tr>

                  @if($hr_one_on_one_details['promotion_in_designation']=='Yes')
                  <tr>
                   <td>Designation Name (For Promotion)</td>
                    <td>{{ $hr_one_on_one_details['designation_name_for_promotion'] }} </td>
                  </tr>
                  @endif

                  
                  <tr>
                    <td colspan="2"><strong>Performance Information</strong></td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Share your accomplishments from FY {{ $hr_one_on_one_details['fy'] }}. </strong> {!! $hr_one_on_one_details->share_your_accomplishments !!}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Share issues/challenges from FY {{ $hr_one_on_one_details['fy'] }}, that impacted your work/mindset negatively. </strong> {!! $hr_one_on_one_details->share_issues_challenges_impact_work !!}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Please openly share issues that still need closures & can help you grow further. </strong> {!! $hr_one_on_one_details->openly_share_issues_need_closures !!}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>How do you see yourself moving ahead in the next year? </strong> {!! $hr_one_on_one_details->see_yourself_moving_ahead_next_year !!}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Any additional feedback that you wish to share about anything else? </strong> {!! $hr_one_on_one_details->any_additional_feedback_wish_to_share !!}</td>
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