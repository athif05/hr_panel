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
              <h5 class="card-title">Fill Interview Survey</h5>
              

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-interview-survey-form')}}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Member's Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" readonly>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">Official Email</label>
                  <input type="email" class="form-control disable-text" name="official_email" id="official_email" value="{{ Auth::user()->email }}" readonly>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('official_email'))
                    <span class="text-danger">{{ $errors->first('official_email') }}</span>
                  @endif
                </div>

                <input type="hidden" name="company_name" id="company_name" value="{{Auth::user()->company_id}}" />
                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Which company did you apply for? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="company_name_dis" id="company_name_dis" disabled>
                    @foreach($company_names as $company_name)
                    <option value="{{$company_name['id']}}" @if((Auth::user()->company_id)==$company_name['id']) selected @endif>{{$company_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid company.
                  </div>
                  @if ($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
                </div>

                <input type="hidden" name="job_position_name" id="job_position_name" value="{{Auth::user()->designation}}" />
                <div class="col-md-6 position-relative">
                  <label for="job_position_name" class="form-label">What position were you interviewed for? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="job_position_name_dis" id="job_position_name_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($designation_names as $designation_name)
                    <option value="{{$designation_name['id']}}" @if((Auth::user()->designation)==$designation_name['id']) selected @endif>{{$designation_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('job_position_name'))
                    <span class="text-danger">{{ $errors->first('job_position_name') }}</span>
                  @endif
                </div>

                <input type="hidden" name="location_name" id="location_name" value="{{Auth::user()->company_location_id}}" />
                <div class="col-md-6 position-relative">
                  <label for="location_name" class="form-label">Which location did you apply for? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="location_name_dis" id="location_name_dis" disabled>
                    <option  value="">Choose...</option>
                    @foreach($company_locations as $company_location)
                    <option value="{{$company_location['id']}}" @if((Auth::user()->company_location_id)==$company_location['id']) selected @endif>{{$company_location['name']}}</option>
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
                  <label for="learn_about_job_opening" class="form-label">How did you learn about the job opening with us? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <select class="form-select" name="learn_about_job_opening" id="learn_about_job_opening" >
                    <option value="">Choose...</option>
                    @foreach($job_opening_types as $job_opening_type)
                    <option value="{{$job_opening_type['id']}}" @if(old('learn_about_job_opening')==$job_opening_type['id']) selected @endif>{{$job_opening_type['name']}}</option>
                    @endforeach
                    <option value="Others">Others</option>
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid job opening.
                  </div>
                  @if ($errors->has('learn_about_job_opening'))
                    <span class="text-danger">{{ $errors->first('learn_about_job_opening') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="referral_source_name" class="form-label">Name the Referral Source <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="referral_source_name" id="referral_source_name" value="{{ old('referral_source_name') }}" >
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('referral_source_name'))
                    <span class="text-danger">{{ $errors->first('referral_source_name') }}</span>
                  @endif
                </div>

                
                <input type="hidden" name="hr_name_ajax" id="hr_name_ajax" value="">
                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Name the HR from the company, who coordinated with you for the interview? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <!-- <input type="text" class="form-control" name="company_hr_name" id="company_hr_name" value="{{ old('company_hr_name') }}" > -->
                  <select class="form-select" name="company_hr_name" id="company_hr_name">
                    <option  value="">Choose...</option>
                    @foreach($recruiter_details as $recruiter_detail)
                    <option value="{{$recruiter_detail['id']}}" @if(old('company_hr_name')==$recruiter_detail['id']) selected @endif>{{$recruiter_detail['first_name']}} {{$recruiter_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select HR.
                  </div>
                  @if ($errors->has('company_hr_name'))
                    <span class="text-danger">{{ $errors->first('company_hr_name') }}</span>
                  @endif
                </div>

               
                <div class="col-md-12 position-relative">
                  <label class="card-title">Rate <span id="hr_name_ajax_span" class="hr_name_ajax_span"></span> on the following parameters</label>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="prompt_responding_my_queries" class="form-label rdioBtn">Prompt in responding to my queries  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="prompt_responding_my_queries" id="prompt_responding_my_queries" value="NA" @if(old('prompt_responding_my_queries')=='NA') checked @elseif(old('prompt_responding_my_queries')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="prompt_responding_my_queries" id="prompt_responding_my_queries" value="1" @if(old('prompt_responding_my_queries')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="prompt_responding_my_queries" id="prompt_responding_my_queries" value="2" @if(old('prompt_responding_my_queries')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="prompt_responding_my_queries" id="prompt_responding_my_queries" value="3" @if(old('prompt_responding_my_queries')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="prompt_responding_my_queries" id="prompt_responding_my_queries" value="4" @if(old('prompt_responding_my_queries')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="prompt_responding_my_queries" id="prompt_responding_my_queries" value="5" @if(old('prompt_responding_my_queries')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>

                  @if ($errors->has('prompt_responding_my_queries'))
                    <span class="text-danger">{{ $errors->first('prompt_responding_my_queries') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="approachable" class="form-label rdioBtn">Approachable  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="approachable" id="approachable" value="NA" @if(old('approachable')=='NA') checked @elseif(old('approachable')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="approachable" id="approachable" value="1" @if(old('approachable')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="approachable" id="approachable" value="2" @if(old('approachable')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="approachable" id="approachable" value="3" @if(old('approachable')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="approachable" id="approachable" value="4" @if(old('approachable')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="approachable" id="approachable" value="5" @if(old('approachable')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>

                  @if ($errors->has('approachable'))
                    <span class="text-danger">{{ $errors->first('approachable') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="respectful" class="form-label rdioBtn">Respectful <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="respectful" id="respectful" value="NA" @if(old('respectful')=='NA') checked @elseif(old('respectful')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="respectful" id="respectful" value="1" @if(old('respectful')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="respectful" id="respectful" value="2" @if(old('respectful')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="respectful" id="respectful" value="3" @if(old('respectful')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="respectful" id="respectful" value="4" @if(old('respectful')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="respectful" id="respectful" value="5" @if(old('respectful')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('respectful'))
                    <span class="text-danger">{{ $errors->first('respectful') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="explain_job_role" class="form-label rdioBtn">Could explain the job role well <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="explain_job_role" id="explain_job_role" value="NA" @if(old('explain_job_role')=='NA') checked @elseif(old('explain_job_role')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="explain_job_role" id="explain_job_role" value="1" @if(old('explain_job_role')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="explain_job_role" id="explain_job_role" value="2" @if(old('explain_job_role')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="explain_job_role" id="explain_job_role" value="3" @if(old('explain_job_role')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="explain_job_role" id="explain_job_role" value="4" @if(old('explain_job_role')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="explain_job_role" id="explain_job_role" value="5" @if(old('explain_job_role')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('explain_job_role'))
                    <span class="text-danger">{{ $errors->first('explain_job_role') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="explain_company_background" class="form-label rdioBtn">Could explain the company background well <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="explain_company_background" id="explain_company_background" value="NA" @if(old('explain_company_background')=='NA') checked @elseif(old('explain_company_background')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="explain_company_background" id="explain_company_background" value="1" @if(old('explain_company_background')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="explain_company_background" id="explain_company_background" value="2" @if(old('explain_company_background')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="explain_company_background" id="explain_company_background" value="3" @if(old('explain_company_background')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="explain_company_background" id="explain_company_background" value="4" @if(old('explain_company_background')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="explain_company_background" id="explain_company_background" value="5" @if(old('explain_company_background')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('explain_company_background'))
                    <span class="text-danger">{{ $errors->first('explain_company_background') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="shared_proper_interview_information" class="form-label rdioBtn">Shared proper information about interview process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="NA" @if(old('shared_proper_interview_information')=='NA') checked @elseif(old('shared_proper_interview_information')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="1" @if(old('shared_proper_interview_information')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="2" @if(old('shared_proper_interview_information')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="3" @if(old('shared_proper_interview_information')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="4" @if(old('shared_proper_interview_information')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="shared_proper_interview_information" id="shared_proper_interview_information" value="5" @if(old('shared_proper_interview_information')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('shared_proper_interview_information'))
                    <span class="text-danger">{{ $errors->first('shared_proper_interview_information') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="discussed_my_profile" class="form-label rdioBtn">Discussed about my profile in detail to check my fitment with the role <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="discussed_my_profile" id="discussed_my_profile" value="NA" @if(old('discussed_my_profile')=='NA') checked @elseif(old('discussed_my_profile')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="discussed_my_profile" id="discussed_my_profile" value="1" @if(old('discussed_my_profile')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="discussed_my_profile" id="discussed_my_profile" value="2" @if(old('discussed_my_profile')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="discussed_my_profile" id="discussed_my_profile" value="3" @if(old('discussed_my_profile')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="discussed_my_profile" id="discussed_my_profile" value="4" @if(old('discussed_my_profile')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="discussed_my_profile" id="discussed_my_profile" value="5" @if(old('discussed_my_profile')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>

                  @if ($errors->has('discussed_my_profile'))
                    <span class="text-danger">{{ $errors->first('discussed_my_profile') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="shared_interview_feedback_quickly" class="form-label rdioBtn">Shared my interview feedback quickly after the interview <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="NA" @if(old('shared_interview_feedback_quickly')=='NA') checked @elseif(old('shared_interview_feedback_quickly')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="1" @if(old('shared_interview_feedback_quickly')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="2" @if(old('shared_interview_feedback_quickly')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="3" @if(old('shared_interview_feedback_quickly')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="4" @if(old('shared_interview_feedback_quickly')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="shared_interview_feedback_quickly" id="shared_interview_feedback_quickly" value="5" @if(old('shared_interview_feedback_quickly')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>

                  @if ($errors->has('shared_interview_feedback_quickly'))
                    <span class="text-danger">{{ $errors->first('shared_interview_feedback_quickly') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="additional_feedback_recruiter" class="form-label">Any additional feedback for the recruiter? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <textarea class="form-control" name="additional_feedback_recruiter" id="additional_feedback_recruiter" style="height: 100px">{{ old('additional_feedback_recruiter')}}</textarea>

                  @if ($errors->has('additional_feedback_recruiter'))
                    <span class="text-danger">{{ $errors->first('additional_feedback_recruiter') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'additional_feedback_recruiter' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="rate_overall_conduct" class="form-label">How much will you rate <span id="hr_name_ajax_span" class="hr_name_ajax_span"></span> overall conduct? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="NA" @if(old('rate_overall_conduct')=='NA') checked @elseif(old('rate_overall_conduct')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="1" @if(old('rate_overall_conduct')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="2" @if(old('rate_overall_conduct')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="3" @if(old('rate_overall_conduct')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="4" @if(old('rate_overall_conduct')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="rate_overall_conduct" id="rate_overall_conduct" value="5" @if(old('rate_overall_conduct')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('rate_overall_conduct'))
                    <span class="text-danger">{{ $errors->first('rate_overall_conduct') }}</span>
                  @endif

                </div>

                
                <div class="col-md-12 position-relative">
                  <label class="card-title">Rate the interviewers on the following parameters</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="professionalism" class="form-label rdioBtn">Professionalism <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="professionalism" id="professionalism" value="NA" @if(old('professionalism')=='NA') checked @elseif(old('professionalism')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="professionalism" id="professionalism" value="1" @if(old('professionalism')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="professionalism" id="professionalism" value="2" @if(old('professionalism')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="professionalism" id="professionalism" value="3" @if(old('professionalism')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="professionalism" id="professionalism" value="4" @if(old('professionalism')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="professionalism" id="professionalism" value="5" @if(old('professionalism')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('professionalism'))
                    <span class="text-danger">{{ $errors->first('professionalism') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="friendliness" class="form-label rdioBtn">Friendliness <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="friendliness" id="friendliness" value="NA" @if(old('friendliness')=='NA') checked @elseif(old('friendliness')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="friendliness" id="friendliness" value="1" @if(old('friendliness')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="friendliness" id="friendliness" value="2" @if(old('friendliness')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="friendliness" id="friendliness" value="3" @if(old('friendliness')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="friendliness" id="friendliness" value="4" @if(old('friendliness')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="friendliness" id="friendliness" value="5" @if(old('friendliness')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('friendliness'))
                    <span class="text-danger">{{ $errors->first('friendliness') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="heplful" class="form-label rdioBtn">Heplful <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="heplful" id="heplful" value="NA" @if(old('heplful')=='NA') checked @elseif(old('heplful')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="heplful" id="heplful" value="1" @if(old('heplful')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="heplful" id="heplful" value="2" @if(old('heplful')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="heplful" id="heplful" value="3" @if(old('heplful')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="heplful" id="heplful" value="4" @if(old('heplful')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="heplful" id="heplful" value="5" @if(old('heplful')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('heplful'))
                    <span class="text-danger">{{ $errors->first('heplful') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="approachable_interviewers" class="form-label rdioBtn">Approachable <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="approachable_interviewers" id="approachable_interviewers" value="NA" @if(old('approachable_interviewers')=='NA') checked @elseif(old('approachable_interviewers')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="approachable_interviewers" id="approachable_interviewers" value="1" @if(old('approachable_interviewers')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="approachable_interviewers" id="approachable_interviewers" value="2" @if(old('approachable_interviewers')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="approachable_interviewers" id="approachable_interviewers" value="3" @if(old('approachable_interviewers')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="approachable_interviewers" id="approachable_interviewers" value="4" @if(old('approachable_interviewers')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="approachable_interviewers" id="approachable_interviewers" value="5" @if(old('approachable_interviewers')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('approachable_interviewers'))
                    <span class="text-danger">{{ $errors->first('approachable_interviewers') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="respectable" class="form-label rdioBtn">Respectable <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="respectable" id="respectable" value="NA" @if(old('respectable')=='NA') checked @elseif(old('respectable')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="respectable" id="respectable" value="1" @if(old('respectable')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="respectable" id="respectable" value="2" @if(old('respectable')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="respectable" id="respectable" value="3" @if(old('respectable')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="respectable" id="respectable" value="4" @if(old('respectable')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="respectable" id="respectable" value="5" @if(old('respectable')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('respectable'))
                    <span class="text-danger">{{ $errors->first('respectable') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="knowledgeable" class="form-label rdioBtn">Knowledgeable <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="knowledgeable" id="knowledgeable" value="NA" @if(old('knowledgeable')=='NA') checked @elseif(old('knowledgeable')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="knowledgeable" id="knowledgeable" value="1" @if(old('knowledgeable')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="knowledgeable" id="knowledgeable" value="2" @if(old('knowledgeable')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="knowledgeable" id="knowledgeable" value="3" @if(old('knowledgeable')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="knowledgeable" id="knowledgeable" value="4" @if(old('knowledgeable')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="knowledgeable" id="knowledgeable" value="5" @if(old('knowledgeable')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('knowledgeable'))
                    <span class="text-danger">{{ $errors->first('knowledgeable') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="clear_communication_about_company" class="form-label rdioBtn">Clear communication about company <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="NA" @if(old('clear_communication_about_company')=='NA') checked @elseif(old('clear_communication_about_company')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="1" @if(old('clear_communication_about_company')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="2" @if(old('clear_communication_about_company')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="3" @if(old('clear_communication_about_company')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="4" @if(old('clear_communication_about_company')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="clear_communication_about_company" id="clear_communication_about_company" value="5" @if(old('clear_communication_about_company')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('clear_communication_about_company'))
                    <span class="text-danger">{{ $errors->first('clear_communication_about_company') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="clear_communication_job_role" class="form-label rdioBtn">Clear communication about job role <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="NA" @if(old('clear_communication_job_role')=='NA') checked @elseif(old('clear_communication_job_role')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="1" @if(old('clear_communication_job_role')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="2" @if(old('clear_communication_job_role')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="3" @if(old('clear_communication_job_role')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="4" @if(old('clear_communication_job_role')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="clear_communication_job_role" id="clear_communication_job_role" value="5" @if(old('clear_communication_job_role')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('clear_communication_job_role'))
                    <span class="text-danger">{{ $errors->first('clear_communication_job_role') }}</span>
                  @endif

                </div>


               
                <div class="col-md-12 position-relative">
                  <label class="card-title">Rate the interview process on the following parameters</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="process_started_on_time" class="form-label rdioBtn">The process started on time <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="process_started_on_time" id="process_started_on_time" value="NA" @if(old('process_started_on_time')=='NA') checked @elseif(old('process_started_on_time')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="process_started_on_time" id="process_started_on_time" value="1" @if(old('process_started_on_time')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="process_started_on_time" id="process_started_on_time" value="2" @if(old('process_started_on_time')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="process_started_on_time" id="process_started_on_time" value="3" @if(old('process_started_on_time')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="process_started_on_time" id="process_started_on_time" value="4" @if(old('process_started_on_time')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="process_started_on_time" id="process_started_on_time" value="5" @if(old('process_started_on_time')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('process_started_on_time'))
                    <span class="text-danger">{{ $errors->first('process_started_on_time') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="process_fair_apt" class="form-label rdioBtn">The process was fair & apt <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="process_fair_apt" id="process_fair_apt" value="NA" @if(old('process_fair_apt')=='NA') checked @elseif(old('process_fair_apt')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="process_fair_apt" id="process_fair_apt" value="1" @if(old('process_fair_apt')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="process_fair_apt" id="process_fair_apt" value="2" @if(old('process_fair_apt')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="process_fair_apt" id="process_fair_apt" value="3" @if(old('process_fair_apt')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="process_fair_apt" id="process_fair_apt" value="4" @if(old('process_fair_apt')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="process_fair_apt" id="process_fair_apt" value="5" @if(old('process_fair_apt')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('process_fair_apt'))
                    <span class="text-danger">{{ $errors->first('process_fair_apt') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="seating_arrangement_comfortable" class="form-label rdioBtn">The seating arrangement was comfortable <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="NA" @if(old('seating_arrangement_comfortable')=='NA') checked @elseif(old('seating_arrangement_comfortable')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="1" @if(old('seating_arrangement_comfortable')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="2" @if(old('seating_arrangement_comfortable')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="3" @if(old('seating_arrangement_comfortable')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="4" @if(old('seating_arrangement_comfortable')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="seating_arrangement_comfortable" id="seating_arrangement_comfortable" value="5" @if(old('seating_arrangement_comfortable')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('seating_arrangement_comfortable'))
                    <span class="text-danger">{{ $errors->first('seating_arrangement_comfortable') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="staff_helpful_supportive" class="form-label rdioBtn">Staff was helpful & supportive <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="NA" @if(old('staff_helpful_supportive')=='NA') checked @elseif(old('staff_helpful_supportive')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="1" @if(old('staff_helpful_supportive')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="2" @if(old('staff_helpful_supportive')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="3" @if(old('staff_helpful_supportive')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="4" @if(old('staff_helpful_supportive')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="staff_helpful_supportive" id="staff_helpful_supportive" value="5" @if(old('staff_helpful_supportive')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('staff_helpful_supportive'))
                    <span class="text-danger">{{ $errors->first('staff_helpful_supportive') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="received_interview_feedback" class="form-label rdioBtn">Received my interview feedback on time <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="received_interview_feedback" id="received_interview_feedback" value="NA" @if(old('received_interview_feedback')=='NA') checked @elseif(old('received_interview_feedback')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="received_interview_feedback" id="received_interview_feedback" value="1" @if(old('received_interview_feedback')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="received_interview_feedback" id="received_interview_feedback" value="2" @if(old('received_interview_feedback')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="received_interview_feedback" id="received_interview_feedback" value="3" @if(old('received_interview_feedback')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="received_interview_feedback" id="received_interview_feedback" value="4" @if(old('received_interview_feedback')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="received_interview_feedback" id="received_interview_feedback" value="5" @if(old('received_interview_feedback')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('received_interview_feedback'))
                    <span class="text-danger">{{ $errors->first('received_interview_feedback') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="define_overall_interview_process" class="form-label">How will you define the overall Interview Process? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <select class="form-select" name="define_overall_interview_process" id="define_overall_interview_process" >
                    <option value="">Choose...</option>

                    <option value="Challenging and interesting" @if(old('define_overall_interview_process')=='Challenging and interesting') selected @endif>Challenging and interesting</option>

                    <option value="Time consuming" @if(old('define_overall_interview_process')=='Time consuming') selected @endif>Time consuming</option>

                    <option value="Stressful" @if(old('define_overall_interview_process')=='Stressful') selected @endif>Stressful</option>

                    <option value="Others" @if(old('define_overall_interview_process')=='Others') selected @endif>Others</option>

                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid option.
                  </div>
                  @if ($errors->has('define_overall_interview_process'))
                    <span class="text-danger">{{ $errors->first('define_overall_interview_process') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative" @if(old('define_overall_interview_process')=='Others') style="display: block" @else style="display: none" @endif id="define_overall_interview_process_others_div">
                  <label for="define_overall_interview_process_others" class="form-label">If Others, specify it.<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="define_overall_interview_process_others" id="define_overall_interview_process_others" style="height: 100px" >{{ old('define_overall_interview_process_others')}}</textarea>

                  @if ($errors->has('define_overall_interview_process_others'))
                    <span class="text-danger">{{ $errors->first('define_overall_interview_process_others') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="rate_overall_interview_process" class="form-label rdioBtn">Rate the overall interview process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="NA" @if(old('rate_overall_interview_process')=='NA') checked @elseif(old('rate_overall_interview_process')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="1" @if(old('rate_overall_interview_process')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="2" @if(old('rate_overall_interview_process')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="3" @if(old('rate_overall_interview_process')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="4" @if(old('rate_overall_interview_process')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="rate_overall_interview_process" id="rate_overall_interview_process" value="5" @if(old('rate_overall_interview_process')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>

                  @if ($errors->has('rate_overall_interview_process'))
                    <span class="text-danger">{{ $errors->first('rate_overall_interview_process') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="comments_suggestions_feedback" class="form-label">If you have any comments, suggestions, or feedback, please enter it below <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title=""><strong>*</strong></span></label>
                  <textarea class="form-control" name="comments_suggestions_feedback" id="comments_suggestions_feedback" style="height: 100px">{{ old('comments_suggestions_feedback') }}</textarea>
                  <div class="invalid-tooltip">
                    Please provide a valid city.
                  </div>
                  @if ($errors->has('comments_suggestions_feedback'))
                    <span class="text-danger">{{ $errors->first('comments_suggestions_feedback') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'comments_suggestions_feedback' );
                  </script>

                </div>


                <div class="col-12">
                  <input type="submit" name="submit" value="Save in Draft" class="btn btn-info">

                  <input type="submit" name="submit" value="Publish" class="btn btn-primary">
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              <br>
              <div class="col-12">
              		@include('partials.common-note')
              	</div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection