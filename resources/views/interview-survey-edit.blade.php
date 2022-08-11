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

    .disable-text{
      background-color: #ddd!important;
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
              <h5 class="card-title">Update Interview Survey</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-interview-survey-form')}}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{ $form_details->user_id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Member's Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $form_details->member_name}}" readonly>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">Official Email</label>
                  <input type="email" class="form-control disable-text" name="official_email" id="official_email" value="{{ $form_details->official_email}}" readonly>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('official_email'))
                    <span class="text-danger">{{ $errors->first('official_email') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Which company did you apply for? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="company_name" id="company_name" required>
                    <option value="">Choose...</option>
                    @foreach($company_names as $company_name)
                    <option value="{{$company_name['id']}}" @if($form_details->company_name==$company_name['id']) selected @endif>{{$company_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid company.
                  </div>
                  @if ($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="job_position_name" class="form-label">What position were you interviewed for? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="job_position_name" id="job_position_name" value="{{ $form_details->job_position_name }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('job_position_name'))
                    <span class="text-danger">{{ $errors->first('job_position_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="location_name" class="form-label">Which location did you apply for? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="location_name" id="location_name" required>
                    <option  value="">Choose...</option>
                    @foreach($company_locations as $company_location)
                    <option value="{{$company_location['id']}}" @if($form_details->location_name==$company_location['id']) selected @endif>{{$company_location['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid location.
                  </div>
                  @if ($errors->has('location_name'))
                    <span class="text-danger">{{ $errors->first('location_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="learn_about_job_opening" class="form-label">How did you learn about the job opening with us? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="learn_about_job_opening" id="learn_about_job_opening" required>
                    <option value="">Choose...</option>
                    @foreach($job_opening_types as $job_opening_type)
                    <option value="{{$job_opening_type['id']}}" @if(($form_details->learn_about_job_opening)==$job_opening_type['id']) selected @endif>{{$job_opening_type['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid job opening.
                  </div>
                  @if ($errors->has('learn_about_job_opening'))
                    <span class="text-danger">{{ $errors->first('learn_about_job_opening') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="referral_source_name" class="form-label">Name the Referral Source <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="referral_source_name" id="referral_source_name" value="{{ $form_details->referral_source_name }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('referral_source_name'))
                    <span class="text-danger">{{ $errors->first('referral_source_name') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Name the HR from the company, who coordinated with you for the interview? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="company_hr_name" id="company_hr_name" value="{{ $form_details->company_hr_name }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('company_hr_name'))
                    <span class="text-danger">{{ $errors->first('company_hr_name') }}</span>
                  @endif
                </div>

               
                <div class="col-md-12 position-relative">
                  <label class="form-label"><strong>Rate on the following parameters, out of 5. [Prompt in responding to my queries]</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="approachable" class="form-label">Approachable:  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="approachable" id="approachable" value="1" @if(($form_details->approachable)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="approachable" id="approachable" value="2" @if(($form_details->approachable)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="approachable" id="approachable" value="3" @if(($form_details->approachable)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="approachable" id="approachable" value="4" @if(($form_details->approachable)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="approachable" id="approachable" value="5" @if(($form_details->approachable)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('approachable'))
                    <span class="text-danger">{{ $errors->first('approachable') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Respectful <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="respectful" id="respectful" value="1" @if(($form_details->respectful)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="respectful" id="respectful" value="2" @if(($form_details->respectful)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="respectful" id="respectful" value="3" @if(($form_details->respectful)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="respectful" id="respectful" value="4" @if(($form_details->respectful)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="respectful" id="respectful" value="5" @if(($form_details->respectful)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('respectful'))
                    <span class="text-danger">{{ $errors->first('respectful') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Could explain the job role well <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="explain_job_role" id="explain_job_role" value="1" @if(($form_details->explain_job_role)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="explain_job_role" id="explain_job_role" value="2" @if(($form_details->explain_job_role)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="explain_job_role" id="explain_job_role" value="3" @if(($form_details->explain_job_role)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="explain_job_role" id="explain_job_role" value="4" @if(($form_details->explain_job_role)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="explain_job_role" id="explain_job_role" value="5" @if(($form_details->explain_job_role)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('explain_job_role'))
                    <span class="text-danger">{{ $errors->first('explain_job_role') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Could explain the company background well <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="explain_company_background" id="explain_company_background" value="1" @if(($form_details->explain_company_background)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="explain_company_background" id="explain_company_background" value="2" @if(($form_details->explain_company_background)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="explain_company_background" id="explain_company_background" value="3" @if(($form_details->explain_company_background)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="explain_company_background" id="explain_company_background" value="4" @if(($form_details->explain_company_background)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="explain_company_background" id="explain_company_background" value="5" @if(($form_details->explain_company_background)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('explain_company_background'))
                    <span class="text-danger">{{ $errors->first('explain_company_background') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Shared proper information about interview process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="1" @if(($form_details->shared_proper_interview_information)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="2" @if(($form_details->shared_proper_interview_information)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="3" @if(($form_details->shared_proper_interview_information)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="4" @if(($form_details->shared_proper_interview_information)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="5" @if(($form_details->shared_proper_interview_information)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('shared_proper_interview_information'))
                    <span class="text-danger">{{ $errors->first('shared_proper_interview_information') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Discussed about my profile in detail to check my fitment with the role <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="discussed_my_profile" id="discussed_my_profile" value="1" @if(($form_details->discussed_my_profile)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="discussed_my_profile" id="discussed_my_profile" value="2" @if(($form_details->discussed_my_profile)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="discussed_my_profile" id="discussed_my_profile" value="3" @if(($form_details->discussed_my_profile)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="discussed_my_profile" id="discussed_my_profile" value="4" @if(($form_details->discussed_my_profile)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="discussed_my_profile" id="discussed_my_profile" value="5" @if(($form_details->discussed_my_profile)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('discussed_my_profile'))
                    <span class="text-danger">{{ $errors->first('discussed_my_profile') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Shared my interview feedback quickly after the interview <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="1" @if(($form_details->shared_interview_feedback_quickly)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="2" @if(($form_details->shared_interview_feedback_quickly)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="3" @if(($form_details->shared_interview_feedback_quickly)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="4" @if(($form_details->shared_interview_feedback_quickly)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="5" @if(($form_details->shared_interview_feedback_quickly)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('shared_interview_feedback_quickly'))
                    <span class="text-danger">{{ $errors->first('shared_interview_feedback_quickly') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Any additional feedback for the recruiter? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="additional_feedback_recruiter" id="additional_feedback_recruiter" style="height: 100px">{{ $form_details->additional_feedback_recruiter}}</textarea>

                  @if ($errors->has('additional_feedback_recruiter'))
                    <span class="text-danger">{{ $errors->first('additional_feedback_recruiter') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label"><strong>How much will you rate overall conduct? (out of 5)</strong> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="1" @if(($form_details->rate_overall_conduct)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="2" @if(($form_details->rate_overall_conduct)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="3" @if(($form_details->rate_overall_conduct)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="4" @if(($form_details->rate_overall_conduct)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="5" @if(($form_details->rate_overall_conduct)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('rate_overall_conduct'))
                    <span class="text-danger">{{ $errors->first('rate_overall_conduct') }}</span>
                  @endif

                </div>

                
                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label"><strong>Rate the interviewers on the following parameters (Out of 5)</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Professionalism <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="1" @if(($form_details->professionalism)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="2" @if(($form_details->professionalism)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="3" @if(($form_details->professionalism)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="4" @if(($form_details->professionalism)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="5" @if(($form_details->professionalism)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('professionalism'))
                    <span class="text-danger">{{ $errors->first('professionalism') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Friendliness <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="1" @if(($form_details->friendliness)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="2" @if(($form_details->friendliness)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="3" @if(($form_details->friendliness)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="4" @if(($form_details->friendliness)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="5" @if(($form_details->friendliness)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('friendliness'))
                    <span class="text-danger">{{ $errors->first('friendliness') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Heplful <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="heplful" id="heplful" value="1" @if(($form_details->heplful)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="heplful" id="heplful" value="2" @if(($form_details->heplful)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="heplful" id="heplful" value="3" @if(($form_details->heplful)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="heplful" id="heplful" value="4" @if(($form_details->heplful)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="heplful" id="heplful" value="5" @if(($form_details->heplful)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('heplful'))
                    <span class="text-danger">{{ $errors->first('heplful') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Approachable <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="approachable_interviewers" id="approachable_interviewers" value="1" @if(($form_details->approachable_interviewers)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="approachable_interviewers" id="approachable_interviewers" value="2" @if(($form_details->approachable_interviewers)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="approachable_interviewers" id="approachable_interviewers" value="3" @if(($form_details->approachable_interviewers)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="approachable_interviewers" id="approachable_interviewers" value="4" @if(($form_details->approachable_interviewers)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="approachable_interviewers" id="approachable_interviewers" value="5" @if(($form_details->approachable_interviewers)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('approachable_interviewers'))
                    <span class="text-danger">{{ $errors->first('approachable_interviewers') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Respectable <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="respectable" id="respectable" value="1" @if(($form_details->respectable)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="respectable" id="respectable" value="2" @if(($form_details->respectable)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="respectable" id="respectable" value="3" @if(($form_details->respectable)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="respectable" id="respectable" value="4" @if(($form_details->respectable)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="respectable" id="respectable" value="5" @if(($form_details->respectable)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('respectable'))
                    <span class="text-danger">{{ $errors->first('respectable') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Knowledgeable <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="knowledgeable" id="knowledgeable" value="1" @if(($form_details->knowledgeable)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="knowledgeable" id="knowledgeable" value="2" @if(($form_details->knowledgeable)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="knowledgeable" id="knowledgeable" value="3" @if(($form_details->knowledgeable)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="knowledgeable" id="knowledgeable" value="4" @if(($form_details->knowledgeable)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="knowledgeable" id="knowledgeable" value="5" @if(($form_details->knowledgeable)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('knowledgeable'))
                    <span class="text-danger">{{ $errors->first('knowledgeable') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Clear communication about company <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="1" @if(($form_details->clear_communication_about_company)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="2" @if(($form_details->clear_communication_about_company)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="3" @if(($form_details->clear_communication_about_company)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="4" @if(($form_details->clear_communication_about_company)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="5" @if(($form_details->clear_communication_about_company)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('clear_communication_about_company'))
                    <span class="text-danger">{{ $errors->first('clear_communication_about_company') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Clear communication about job role <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="1" @if(($form_details->clear_communication_job_role)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="2" @if(($form_details->clear_communication_job_role)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="3" @if(($form_details->clear_communication_job_role)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="4" @if(($form_details->clear_communication_job_role)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="5" @if(($form_details->clear_communication_job_role)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('clear_communication_job_role'))
                    <span class="text-danger">{{ $errors->first('clear_communication_job_role') }}</span>
                  @endif

                </div>


               
                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label"><strong>Rate the interview process on the following parameters (out of 5)</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">The process started on time <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="process_started_on_time" id="process_started_on_time" value="1" @if(($form_details->process_started_on_time)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="process_started_on_time" id="process_started_on_time" value="2" @if(($form_details->process_started_on_time)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="process_started_on_time" id="process_started_on_time" value="3" @if(($form_details->process_started_on_time)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="process_started_on_time" id="process_started_on_time" value="4" @if(($form_details->process_started_on_time)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="process_started_on_time" id="process_started_on_time" value="5" @if(($form_details->process_started_on_time)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('process_started_on_time'))
                    <span class="text-danger">{{ $errors->first('process_started_on_time') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">The process was fair & apt <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="process_fair_apt" id="process_fair_apt" value="1" @if(($form_details->process_fair_apt)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="process_fair_apt" id="process_fair_apt" value="2" @if(($form_details->process_fair_apt)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="process_fair_apt" id="process_fair_apt" value="3" @if(($form_details->process_fair_apt)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="process_fair_apt" id="process_fair_apt" value="4" @if(($form_details->process_fair_apt)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="process_fair_apt" id="process_fair_apt" value="5" @if(($form_details->process_fair_apt)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('process_fair_apt'))
                    <span class="text-danger">{{ $errors->first('process_fair_apt') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">The seating arrangement was comfortable <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="1" @if(($form_details->seating_arrangement_comfortable)=='51') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="2" @if(($form_details->seating_arrangement_comfortable)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="3" @if(($form_details->seating_arrangement_comfortable)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="4" @if(($form_details->seating_arrangement_comfortable)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="5" @if(($form_details->seating_arrangement_comfortable)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('seating_arrangement_comfortable'))
                    <span class="text-danger">{{ $errors->first('seating_arrangement_comfortable') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Staff was helpful & supportive <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="1" @if(($form_details->staff_helpful_supportive)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="2" @if(($form_details->staff_helpful_supportive)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="3" @if(($form_details->staff_helpful_supportive)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="4" @if(($form_details->staff_helpful_supportive)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="5" @if(($form_details->staff_helpful_supportive)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('staff_helpful_supportive'))
                    <span class="text-danger">{{ $errors->first('staff_helpful_supportive') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label">Received my interview feedback on time <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="received_interview_feedback" id="received_interview_feedback" value="1" @if(($form_details->received_interview_feedback)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="received_interview_feedback" id="received_interview_feedback" value="2" @if(($form_details->received_interview_feedback)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="received_interview_feedback" id="received_interview_feedback" value="3" @if(($form_details->received_interview_feedback)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="received_interview_feedback" id="received_interview_feedback" value="4" @if(($form_details->received_interview_feedback)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="received_interview_feedback" id="received_interview_feedback" value="5" @if(($form_details->received_interview_feedback)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('received_interview_feedback'))
                    <span class="text-danger">{{ $errors->first('received_interview_feedback') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="define_overall_interview_process" class="form-label">How will you define the overall Interview Process? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="define_overall_interview_process" id="define_overall_interview_process" required>
                    <option value="">Choose...</option>

                    <option value="Challenging and interesting" @if(($form_details->define_overall_interview_process)=='Challenging and interesting') selected @endif>Challenging and interesting</option>

                    <option value="Time consuming" @if(($form_details->define_overall_interview_process)=='Time consuming') selected @endif>Time consuming</option>

                    <option value="stressful" @if(($form_details->define_overall_interview_process)=='stressful') selected @endif>stressful</option>

                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid state.
                  </div>
                  @if ($errors->has('define_overall_interview_process'))
                    <span class="text-danger">{{ $errors->first('define_overall_interview_process') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="rate_overall_interview_process" class="form-label"><strong>Rate the overall interview process. (out of 5)</strong> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="1" @if(($form_details->rate_overall_interview_process)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="2" @if(($form_details->rate_overall_interview_process)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="3" @if(($form_details->rate_overall_interview_process)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="4" @if(($form_details->rate_overall_interview_process)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="5" @if(($form_details->rate_overall_interview_process)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('rate_overall_interview_process'))
                    <span class="text-danger">{{ $errors->first('rate_overall_interview_process') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="comments_suggestions_feedback" class="form-label">If you have any comments, suggestions, or feedback, please enter it below: <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="comments_suggestions_feedback" id="comments_suggestions_feedback" style="height: 100px">{{ $form_details->comments_suggestions_feedback }}</textarea>
                  <div class="invalid-tooltip">
                    Please provide a valid city.
                  </div>
                  @if ($errors->has('comments_suggestions_feedback'))
                    <span class="text-danger">{{ $errors->first('comments_suggestions_feedback') }}</span>
                  @endif
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