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

    .disable-text{
      background-color: #ddd!important;
    }

    .form-label {
	    margin-bottom: 0.5rem;
	    font-weight: 600!important;
	}

	.rdioBtn{
		font-weight: 400!important;
		font-size: 15px;
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
              <h5 class="card-title">Fill Hiring Survey</h5>
              

              <div class="hiring_survey_heading"><strong>Your Details</strong></div>

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-hiring-survey') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Your Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $member_details->first_name }} {{ $member_details->last_name }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="designation" class="form-label">Designation</label>
                  <select class="form-select disable-text" name="designation" id="designation">
                    <option value="">Choose...</option>
                    @foreach($designation_names as $designation_name)
                    <option value="{{$designation_name['id']}}" @if((Auth::user()->designation)==$designation_name['id']) selected @endif>{{$designation_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('designation'))
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select disable-text" name="department" id="department">
                    <option value="">Choose...</option>
                    @foreach($department_names as $department_name)
                    <option value="{{$department_name['id']}}" @if((Auth::user()->department)==$department_name['id']) selected @endif>{{$department_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="location" class="form-label">Location <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="location" id="location">
                    <option  value="">Choose...</option>
                    @foreach($company_locations as $company_location)
                    <option value="{{$company_location['id']}}" @if((Auth::user()->company_location_id)==$company_location['id']) selected @endif>{{$company_location['name']}}</option>
                    @endforeach
                  </select>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Please choose the name of your company. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="company_name" id="company_name">
                    <option value="">Choose...</option>
                    @foreach($company_names as $company_name)
                    <option value="{{$company_name['id']}}" @if((Auth::user()->company_id)==$company_name['id']) selected @endif>{{$company_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid company.
                  </div>
                  @if ($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
                </div>


                <div class="hiring_survey_heading"><strong>Details of the closed position</strong></div>


                <div class="col-md-12 position-relative">
                  <label for="recruiter_name" class="form-label">Please choose name of the recruiter who worked on your position. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="recruiter_name" id="recruiter_name">
                    <option value="">Choose...</option>
                    @foreach($recruiter_details as $recruiter_detail)
                    <option value="{{$recruiter_detail['id']}}" @if(old('recruiter_name')==$recruiter_detail['id']) selected @endif>{{$recruiter_detail['first_name']}} {{$recruiter_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid company.
                  </div>
                  @if ($errors->has('recruiter_name'))
                    <span class="text-danger">{{ $errors->first('recruiter_name') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="location_name" class="form-label">For which location was the position open? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="location_name" id="location_name">
                    <option  value="">Choose...</option>
                    @foreach($company_locations as $company_location)
                    <option value="{{$company_location['id']}}" @if(old('location_name')==$company_location['id']) selected @endif>{{$company_location['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid location.
                  </div>
                  @if ($errors->has('location_name'))
                    <span class="text-danger">{{ $errors->first('location_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="open_designation_name" class="form-label">Name the designation of the open position. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="open_designation_name" id="open_designation_name" value="{{ old('open_designation_name') }}">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('open_designation_name'))
                    <span class="text-danger">{{ $errors->first('open_designation_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="no_of_openings" class="form-label">No. of openings that were shared? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="no_of_openings" id="no_of_openings" value="{{ old('no_of_openings') }}">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('no_of_openings'))
                    <span class="text-danger">{{ $errors->first('no_of_openings') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="all_posoitions_closed" class="form-label">Do all these posoitions stand closed? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="all_posoitions_closed" id="all_posoitions_closed" value="Yes" @if(old('all_posoitions_closed')=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="all_posoitions_closed" id="all_posoitions_closed" value="No" @if(old('all_posoitions_closed')=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('all_posoitions_closed'))
                    <span class="text-danger">{{ $errors->first('all_posoitions_closed') }}</span>
                  @endif
                </div>


                <div class="hiring_survey_heading">Feedback for the Recruiter</div>

               
                <div class="col-md-12 position-relative">
                  <label class="form-label"><strong>Rate in the following parameters out of 5:</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="recruiter_helpful_recruitment_process" class="form-label rdioBtn">How much was the recruiter helpful throughout the recruitment process?:  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="recruiter_helpful_recruitment_process" id="recruiter_helpful_recruitment_process" value="1" @if(old('recruiter_helpful_recruitment_process')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="recruiter_helpful_recruitment_process" id="recruiter_helpful_recruitment_process" value="2" @if(old('recruiter_helpful_recruitment_process')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="recruiter_helpful_recruitment_process" id="recruiter_helpful_recruitment_process" value="3" @if(old('recruiter_helpful_recruitment_process')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="recruiter_helpful_recruitment_process" id="recruiter_helpful_recruitment_process" value="4" @if(old('recruiter_helpful_recruitment_process')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="recruiter_helpful_recruitment_process" id="recruiter_helpful_recruitment_process" value="5" @if(old('recruiter_helpful_recruitment_process')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('recruiter_helpful_recruitment_process'))
                    <span class="text-danger">{{ $errors->first('recruiter_helpful_recruitment_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="recruiter_response" class="form-label rdioBtn">How prompt was the recruiter's response? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="recruiter_response" id="recruiter_response" value="1" @if(old('recruiter_response')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="recruiter_response" id="recruiter_response" value="2" @if(old('recruiter_response')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="recruiter_response" id="recruiter_response" value="3" @if(old('recruiter_response')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="recruiter_response" id="recruiter_response" value="4" @if(old('recruiter_response')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="recruiter_response" id="recruiter_response" value="5" @if(old('recruiter_response')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('recruiter_response'))
                    <span class="text-danger">{{ $errors->first('recruiter_response') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="recruiter_understanding_job_requirement" class="form-label rdioBtn">How much satisfied are you with the recruiter's understanding of job requirement and needs? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="recruiter_understanding_job_requirement" id="recruiter_understanding_job_requirement" value="1" @if(old('recruiter_understanding_job_requirement')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="recruiter_understanding_job_requirement" id="recruiter_understanding_job_requirement" value="2" @if(old('recruiter_understanding_job_requirement')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="recruiter_understanding_job_requirement" id="recruiter_understanding_job_requirement" value="3" @if(old('recruiter_understanding_job_requirement')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="recruiter_understanding_job_requirement" id="recruiter_understanding_job_requirement" value="4" @if(old('recruiter_understanding_job_requirement')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="recruiter_understanding_job_requirement" id="recruiter_understanding_job_requirement" value="5" @if(old('recruiter_understanding_job_requirement')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('recruiter_understanding_job_requirement'))
                    <span class="text-danger">{{ $errors->first('recruiter_understanding_job_requirement') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="quality_of_candidates_presented" class="form-label rdioBtn">How much satisfied are you with the quality of candidates presented? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="quality_of_candidates_presented" id="quality_of_candidates_presented" value="1" @if(old('quality_of_candidates_presented')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="quality_of_candidates_presented" id="quality_of_candidates_presented" value="2" @if(old('quality_of_candidates_presented')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="quality_of_candidates_presented" id="quality_of_candidates_presented" value="3" @if(old('quality_of_candidates_presented')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="quality_of_candidates_presented" id="quality_of_candidates_presented" value="4" @if(old('quality_of_candidates_presented')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="quality_of_candidates_presented" id="quality_of_candidates_presented" value="5" @if(old('quality_of_candidates_presented')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('quality_of_candidates_presented'))
                    <span class="text-danger">{{ $errors->first('quality_of_candidates_presented') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="number_of_candidates_presented" class="form-label rdioBtn">How much satisfied are you with the number of candidates presented? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="number_of_candidates_presented" id="number_of_candidates_presented" value="1" @if(old('number_of_candidates_presented')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="number_of_candidates_presented" id="number_of_candidates_presented" value="2" @if(old('number_of_candidates_presented')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="number_of_candidates_presented" id="number_of_candidates_presented" value="3" @if(old('number_of_candidates_presented')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="number_of_candidates_presented" id="number_of_candidates_presented" value="4" @if(old('number_of_candidates_presented')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="number_of_candidates_presented" id="number_of_candidates_presented" value="5" @if(old('number_of_candidates_presented')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('number_of_candidates_presented'))
                    <span class="text-danger">{{ $errors->first('number_of_candidates_presented') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="rate_the_recruiter_correct_information" class="form-label rdioBtn">How much you would rate the recruiter for providing the correct information to the candidate? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="rate_the_recruiter_correct_information" id="rate_the_recruiter_correct_information" value="1" @if(old('rate_the_recruiter_correct_information')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="rate_the_recruiter_correct_information" id="rate_the_recruiter_correct_information" value="2" @if(old('rate_the_recruiter_correct_information')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="rate_the_recruiter_correct_information" id="rate_the_recruiter_correct_information" value="3" @if(old('rate_the_recruiter_correct_information')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="rate_the_recruiter_correct_information" id="rate_the_recruiter_correct_information" value="4" @if(old('rate_the_recruiter_correct_information')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="rate_the_recruiter_correct_information" id="rate_the_recruiter_correct_information" value="5" @if(old('rate_the_recruiter_correct_information')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('rate_the_recruiter_correct_information'))
                    <span class="text-danger">{{ $errors->first('rate_the_recruiter_correct_information') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="assessment_screening_candidates" class="form-label rdioBtn">How well did the assessment and screening of candidates go by the recruiter? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="assessment_screening_candidates" id="assessment_screening_candidates" value="1" @if(old('assessment_screening_candidates')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="assessment_screening_candidates" id="assessment_screening_candidates" value="2" @if(old('assessment_screening_candidates')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="assessment_screening_candidates" id="assessment_screening_candidates" value="3" @if(old('assessment_screening_candidates')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="assessment_screening_candidates" id="assessment_screening_candidates" value="4" @if(old('assessment_screening_candidates')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="assessment_screening_candidates" id="assessment_screening_candidates" value="5" @if(old('assessment_screening_candidates')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('assessment_screening_candidates'))
                    <span class="text-danger">{{ $errors->first('assessment_screening_candidates') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="time_taken_fill_open_position" class="form-label rdioBtn">How much satisfied are you with the time taken to fill the open position? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="time_taken_fill_open_position" id="time_taken_fill_open_position" value="1" @if(old('time_taken_fill_open_position')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="time_taken_fill_open_position" id="time_taken_fill_open_position" value="2" @if(old('time_taken_fill_open_position')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="time_taken_fill_open_position" id="time_taken_fill_open_position" value="3" @if(old('time_taken_fill_open_position')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="time_taken_fill_open_position" id="time_taken_fill_open_position" value="4" @if(old('time_taken_fill_open_position')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="time_taken_fill_open_position" id="time_taken_fill_open_position" value="5" @if(old('time_taken_fill_open_position')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('time_taken_fill_open_position'))
                    <span class="text-danger">{{ $errors->first('time_taken_fill_open_position') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="overall_satisfied_hiring_recruiting_process" class="form-label rdioBtn">Overall how satisfied are you with our hiring and recruiting process? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="overall_satisfied_hiring_recruiting_process" id="overall_satisfied_hiring_recruiting_process" value="1" @if(old('overall_satisfied_hiring_recruiting_process')=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="overall_satisfied_hiring_recruiting_process" id="overall_satisfied_hiring_recruiting_process" value="2" @if(old('overall_satisfied_hiring_recruiting_process')=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="overall_satisfied_hiring_recruiting_process" id="overall_satisfied_hiring_recruiting_process" value="3" @if(old('overall_satisfied_hiring_recruiting_process')=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="overall_satisfied_hiring_recruiting_process" id="overall_satisfied_hiring_recruiting_process" value="4" @if(old('overall_satisfied_hiring_recruiting_process')=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="overall_satisfied_hiring_recruiting_process" id="overall_satisfied_hiring_recruiting_process" value="5" @if(old('overall_satisfied_hiring_recruiting_process')=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('overall_satisfied_hiring_recruiting_process'))
                    <span class="text-danger">{{ $errors->first('overall_satisfied_hiring_recruiting_process') }}</span>
                  @endif

                </div>

                <div style="clear: both; height: 10px;"></div>

                <div class="col-md-12 position-relative">
                  <label for="additional_feedback_recruiter" class="form-label">Any additional feedback you would like to give for the recruiter? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="additional_feedback_recruiter" id="additional_feedback_recruiter" style="height: 100px">{{ old('additional_feedback_recruiter')}}</textarea>

                  @if ($errors->has('additional_feedback_recruiter'))
                    <span class="text-danger">{{ $errors->first('additional_feedback_recruiter') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'additional_feedback_recruiter' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="any_suggestions_improve_hiring_process" class="form-label">Any suggestions you would like to give that would help us to improve the hiring process? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_suggestions_improve_hiring_process" id="any_suggestions_improve_hiring_process" style="height: 100px">{{ old('any_suggestions_improve_hiring_process')}}</textarea>

                  @if ($errors->has('any_suggestions_improve_hiring_process'))
                    <span class="text-danger">{{ $errors->first('any_suggestions_improve_hiring_process') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_suggestions_improve_hiring_process' );
                  </script>
                </div>

                <div class="col-12">
                  <input type="submit" name="submit" value="Save in Draft" class="btn btn-info">

                  <input type="submit" name="submit" value="Publish" class="btn btn-primary">
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              <br>
              <p><strong>Note:</strong> <span class="text-danger"><strong>*</strong></span> mandatory fields.</p>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection