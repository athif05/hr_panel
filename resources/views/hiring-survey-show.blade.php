@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Hiring Survey | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Hiring Survey Details</h5>
              
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
                    <td colspan="2" class="text-center"><strong>Your Details</strong></td>
                  </tr>
                  <tr>
                    <td>Member's Name</td>
                    <td>{{$hiring_survey_details['member_name']}}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>
                      @foreach($designation_names as $designation_name)

                        @if($designation_name['id']==$hiring_survey_details['designation'])
                        {{$designation_name['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>
                      @foreach($department_names as $department_name)

                        @if($department_name['id']==$hiring_survey_details['department'])
                        {{$department_name['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Location</td>
                    <td>
                      @foreach($company_locations as $company_location)

                        @if($company_location['id']==$hiring_survey_details['location'])
                        {{$company_location['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                   <td>Please choose the name of your company</td>
                    <td>
                    	@foreach($company_names as $company_name)

                    		@if($company_name['id']==$hiring_survey_details['company_name'])
                    		{{$company_name['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2" class="text-center"><strong>Details of the closed position</strong></td>
                  </tr>

                  <tr>
                    <td>Please choose name of the recruiter who worked on your position</td>
                    <td>
                      @foreach($recruiter_details as $recruiter_detail)

                        @if($recruiter_detail['id']==$hiring_survey_details['recruiter_name'])
                        {{$recruiter_detail['first_name']}} {{$recruiter_detail['last_name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>For which location was the position open?</td>
                    <td>
                    	@foreach($company_locations as $company_location)

                    		@if($company_location['id']==$hiring_survey_details['location_name_position_open'])
                    		{{$company_location['name']}}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Name the designation of the open position</td>
                    <td>
                      @foreach($designation_names as $designation_name)

                        @if($designation_name['id']==$hiring_survey_details['designation_name_open_position'])
                        {{$designation_name['name']}}
                        @endif
                      
                      @endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>No. of openings that were shared?</td>
                    <td>{{$hiring_survey_details['no_of_openings']}}</td>
                  </tr>

                  <tr>
                    <td>Do all these posoitions stand closed?</td>
                    <td>{{$hiring_survey_details['all_posoitions_closed']}}</td>
                  </tr>


                  <tr>
                    <td colspan="2" class="text-center"><strong>Feedback for the Recruiter</strong></td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate 
                      @foreach($recruiter_details as $recruiter_detail)

                        @if($recruiter_detail['id']==$hiring_survey_details['recruiter_name'])
                        {{$recruiter_detail['first_name']}} {{$recruiter_detail['last_name']}}
                        @endif
                      
                      @endforeach

                     in the following parameters out of 5</strong></td>
                  </tr>

                  <tr>
                    <td>How much was the recruiter helpful throughout the recruitment process?</td>
                    <td>
                      @if($hiring_survey_details['recruiter_helpful_recruitment_process']!='NA')
                        @for($i=0; $i < $hiring_survey_details['recruiter_helpful_recruitment_process']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How prompt was the recruiter's response?</td>
                    <td>
                      @if($hiring_survey_details['recruiter_response']!='NA')
                        @for($i=0; $i < $hiring_survey_details['recruiter_response']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How much satisfied are you with the recruiter's understanding of job requirement and needs?</td>
                    <td>
                      @if($hiring_survey_details['recruiter_understanding_job_requirement']!='NA')
                        @for($i=0; $i < $hiring_survey_details['recruiter_understanding_job_requirement']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How much satisfied are you with the quality of candidates presented?</td>
                    <td>
                      @if($hiring_survey_details['quality_of_candidates_presented']!='NA')
                        @for($i=0; $i < $hiring_survey_details['quality_of_candidates_presented']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How much satisfied are you with the number of candidates presented?</td>
                    <td>
                      @if($hiring_survey_details['number_of_candidates_presented']!='NA')
                        @for($i=0; $i < $hiring_survey_details['number_of_candidates_presented']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How much you would rate the recruiter for providing the correct information to the candidate?</td>
                    <td>
                      @if($hiring_survey_details['rate_the_recruiter_correct_information']!='NA')
                        @for($i=0; $i < $hiring_survey_details['rate_the_recruiter_correct_information']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How well did the assessment and screening of candidates go by the recruiter?</td>
                    <td>
                      @if($hiring_survey_details['assessment_screening_candidates']!='NA')
                        @for($i=0; $i < $hiring_survey_details['assessment_screening_candidates']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How much satisfied are you with the time taken to fill the open position?</td>
                    <td>
                      @if($hiring_survey_details['time_taken_fill_open_position']!='NA')
                        @for($i=0; $i < $hiring_survey_details['time_taken_fill_open_position']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Overall how satisfied are you with our hiring and recruiting process?</td>
                    <td>
                      @if($hiring_survey_details['overall_satisfied_hiring_recruiting_process']!='NA')
                        @for($i=0; $i < $hiring_survey_details['overall_satisfied_hiring_recruiting_process']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional feedback you would like to give for the recruiter?</strong> {!! $hiring_survey_details['additional_feedback_recruiter'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any suggestions you would like to give that would help us to improve the hiring process?</strong> {!! $hiring_survey_details['any_suggestions_improve_hiring_process'] !!}</td>
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