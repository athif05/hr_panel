@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Interview Survey | {{ env('MY_SITE_NAME') }}</title>

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

    <!-- <div class="pagetitle">
      <h1>Form Validation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Validation</li>
        </ol>
      </nav>
    </div> --><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Interview Survey Details</h5>
              
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
                    <td>Member's Name</td>
                    <td>{{$find['member_name']}}</td>
                  </tr>

                  <tr>
                    <td>Official Email</td>
                    <td>{{$find['official_email']}}</td>
                  </tr>

                  <tr>
                   <td>Which company did you apply for?</td>
                    <td>
                    	@foreach($company_names as $company_name)

                    		@if($company_name['id']==$find['company_name'])
                    		{{$company_name['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>What position were you interviewed for?</td>
                    <td>
                      @foreach($designation_names as $designation_name)

                        @if($designation_name['id']==$find['job_position_name'])
                        {{$designation_name['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Which location did you apply for?</td>
                    <td>
                    	@foreach($company_locations as $company_location)

                    		@if($company_location['id']==$find['location_name'])
                    		{{$company_location['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>How did you learn about the job opening with us?</td>
                    <td>
                    	@foreach($job_opening_types as $job_opening_type)

                    		@if($job_opening_type['id']==$find['learn_about_job_opening'])
                    		{{$job_opening_type['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Name the Referral Source</td>
                    <td>{{$find['referral_source_name']}}</td>
                  </tr>

                  <tr>
                    <td>Name the HR from the company, who coordinated with you for the interview?</td>
                    <td>{{$find['company_hr_name']}}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate {{$find['company_hr_name']}} on the following parameters, out of 5.</strong></td>
                  </tr>

                  <tr>
                    <td>Approachable</td>
                    <td>
                      @for($i=0; $i < $find['approachable']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Respectful</td>
                    <td>
                      @for($i=0; $i < $find['respectful']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Could explain the job role well</td>
                    <td>
                      @for($i=0; $i < $find['explain_job_role']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Could explain the company background well</td>
                    <td>
                      @for($i=0; $i < $find['explain_company_background']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Shared proper information about interview process</td>
                    <td>
                      @for($i=0; $i < $find['shared_proper_interview_information']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Discussed about my profile in detail to check my fitment with the role</td>
                    <td>
                      @for($i=0; $i < $find['discussed_my_profile']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Shared my interview feedback quickly after the interview</td>
                    <td>
                      @for($i=0; $i < $find['shared_interview_feedback_quickly']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional feedback for the recruiter?</strong> : {!! $find['additional_feedback_recruiter'] !!}</td>
                  </tr>

                  <tr>
                    <td>How much will you rate ${Q-H}'s overall conduct? (out of 5)</td>
                    <td>
                      @for($i=0; $i < $find['rate_overall_conduct']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate the interviewers on the following parameters (Out of 5)</strong></td>
                  </tr>

                  <tr>
                    <td>Professionalism</td>
                    <td>
                      @for($i=0; $i < $find['professionalism']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Friendliness</td>
                    <td>
                      @for($i=0; $i < $find['friendliness']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Hepful</td>
                    <td>
                      @for($i=0; $i < $find['heplful']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Approachable</td>
                    <td>
                      @for($i=0; $i < $find['approachable_interviewers']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Respectable</td>
                    <td>
                      @for($i=0; $i < $find['respectable']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Knowledgeable</td>
                    <td>
                      @for($i=0; $i < $find['knowledgeable']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Clear communication about company</td>
                    <td>
                      @for($i=0; $i < $find['clear_communication_about_company']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Clear communication about job role</td>
                    <td>
                      @for($i=0; $i < $find['clear_communication_job_role']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate the interview process on the following parameters (out of 5)</strong></td>
                  </tr>

                  <tr>
                    <td>The process started on time</td>
                    <td>
                      @for($i=0; $i < $find['process_started_on_time']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>The process was fair & apt</td>
                    <td>
                      @for($i=0; $i < $find['process_fair_apt']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>The seating arrangement was comfortable</td>
                    <td>
                      @for($i=0; $i < $find['seating_arrangement_comfortable']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>


                  <tr>
                    <td>Staff was helpful & supportive</td>
                    <td>
                      @for($i=0; $i < $find['staff_helpful_supportive']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr>
                    <td>Received my interview feedback on time</td>
                    <td>
                      @for($i=0; $i < $find['received_interview_feedback']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>How will you define the overall Interview Process?</strong> : {{$find['define_overall_interview_process']}}</td>
                  </tr>

                  <tr>
                    <td><strong>Rate the overall interview process. (out of 5)</strong></td>
                    <td>
                      @for($i=0; $i < $find['rate_overall_interview_process']; $i++)
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endfor
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>If you have any comments, suggestions, or feedback, please enter it below:</strong> {!! $find['comments_suggestions_feedback'] !!}</td>
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