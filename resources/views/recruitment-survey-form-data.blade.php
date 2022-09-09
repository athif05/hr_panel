@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Recruitment Survey | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Recruitment Survey Details</h5>

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
                    <td>Your Name</td>
                    <td>{{$find['your_name']}}</td>
                  </tr>

                  <tr>
                    <td>Member ID</td>
                    <td>{{$find['member_id']}}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>
                      @foreach($designation_names as $designation_name)

                        @if($designation_name['id']==$find['designation'])
                        {{$designation_name['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>
                      @foreach($department_names as $department_name)

                        @if($department_name['id']==$find['department'])
                        {{$department_name['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                   <td>Please choose the name of your company?</td>
                    <td>
                    	@foreach($company_names as $company_name)

                    		@if($company_name['id']==$find['company_name'])
                    		{{$company_name['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Date of Joining</td>
                    <td>{{$find['date_of_joining']}}</td>
                  </tr>


                  <tr>
                    <td>How did you come across this job opening?</td>
                    <td>
                    	@foreach($job_opening_types as $job_opening_type)

                    		@if($job_opening_type['id']==$find['how_come_for_job_opening'])
                    		{{$job_opening_type['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  @if($find['how_come_for_job_opening']=='1')
                  <tr>
                    <td>Internal Employee Name</td>
                    <td>{{$find['internal_employee_name']}}</td>
                  </tr>

                  <tr>
                    <td>Internal Employee Designation</td>
                    <td>
                      @foreach($designation_names as $designation_name)

                        @if($designation_name['id']==$find['internal_employee_designation'])
                        {{$designation_name['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Internal Employee Department</td>
                    <td>
                      @foreach($department_names as $department_name)

                        @if($department_name['id']==$find['internal_employee_department'])
                        {{$department_name['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>
                  @endif

                  <tr>
                    <td>What's the name of your recruiter?</td>
                    <td>
                      @foreach($recruiter_details as $recruiter_detail)

                        @if($recruiter_detail['id']==$find['name_of_your_recruiter'])
                          {{ $recruiter_detail['first_name'] }} {{ $recruiter_detail['last_name'] }}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate your recruiter in the following parameters out of 5: </strong></td>
                  </tr>

                  <tr>
                    <td>Professionalism</td>
                    <td>{{$find['professionalism']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Friendliness</td>
                    <td>{{$find['friendliness']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Length of the time spent talking to you</td>
                    <td>{{$find['length_time_spent_talking']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Company knowledge</td>
                    <td>{{$find['company_knowledge']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Specific knowledge about the job profile</td>
                    <td>{{$find['specific_knowledge_job_profile']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Timely response to your communications - email or phone</td>
                    <td>{{$find['timely_response_email_phone']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Yes/No Questions</strong></td>
                  </tr>

                  <tr>
                    <td>Do you completely understand our company policies and procedures as outlined in the handbook?</td>
                    <td>{{$find['company_policies_procedures']}}</td>
                  </tr>

                  <tr>
                    <td>Do you completely understand departmental processes as explained in 'Manager's Expectation Setting' session?</td>
                    <td>{{$find['manager_expectation_setting']}}</td>
                  </tr>

                  <tr>
                    <td>Do you completely understand your job duties and responsibilities?</td>
                    <td>{{$find['job_duties_responsibilities']}}</td>
                  </tr>

                  <tr>
                    <td>Do you feel that your job title is properly named?</td>
                    <td>{{$find['job_title_properly_named']}}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>What will be your mission for the first year? : </strong> {!!  $find['mission_for_first_year'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>What do you aim in the second year? : </strong> {!! $find['aim_in_second_year'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>What will be your aim in the third year of your tenure with us? : </strong> {!! $find['aim_third_year_tenure'] !!}</td>
                  </tr>

                  <tr>
                    <td><strong>Rate the overall recruitment process of our company! (Rating out of 5)</strong></td>
                    <td>{{$find['rate_overall_recruitment_process']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional feedback for the recruitment process? : </strong> {!! $find['additional_feedback_recruitment_process'] !!}</td>
                  </tr>

                  <tr>
                    <td><strong>Rate your HR induction session! (out of 5)</strong></td>
                    <td>{{$find['rate_hr_induction']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional feedback for HR induction session? : </strong> {!! $find['additional_feedback_hr_induction'] !!}</td>
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