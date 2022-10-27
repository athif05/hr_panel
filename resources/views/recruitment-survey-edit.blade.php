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
              <h5 class="card-title">Edit Recruitment Survey</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              @if($form_details)
              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-recruitment-survey-form')}}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="your_name" class="form-label">Your Name</label>
                  <input type="text" class="form-control disable-text" name="your_name" id="your_name" value="{{ $form_details->your_name}}" readonly>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('your_name'))
                    <span class="text-danger">{{ $errors->first('your_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_id" class="form-label">Member ID</label>
                  <input type="text" class="form-control disable-text" name="member_id" id="member_id" value="{{ $form_details->member_id }}" readonly>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('member_id'))
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                  @endif
                </div>

                <input type="hidden" name="designation" id="designation" value="{{ $form_details->designation }}" />
                <div class="col-md-6 position-relative">
                  <label for="designation" class="form-label">Designation</label>
                  <select class="form-select disable-text" name="designation_dis" id="designation_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($designation_names as $designation_name)
                    <option value="{{$designation_name['id']}}" @if(($form_details->designation)==$designation_name['id']) selected @endif>{{$designation_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('designation'))
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                  @endif
                </div>

                <input type="hidden" name="department" id="department" value="{{ $form_details->department}}" />
                <div class="col-md-6 position-relative">
                  <label for="department" class="form-label">Department <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="department_dis" id="department_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($department_names as $department_name)
                    <option value="{{$department_name['id']}}" @if(($form_details->department)==$department_name['id']) selected @endif>{{$department_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
                </div>

                <input type="hidden" name="company_name" id="company_name" value="{{$form_details->company_name}}" />
                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Please choose the name of your company <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="company_name_dis" id="company_name_dis" disabled>
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
                  <label for="date_of_joining" class="form-label">Date of Joining <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" class="form-control disable-text" name="date_of_joining" id="date_of_joining" value="{{ $form_details->date_of_joining }}" max="<?php echo date("Y-m-d"); ?>" readonly>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('date_of_joining'))
                    <span class="text-danger">{{ $errors->first('date_of_joining') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="how_come_for_job_opening" class="form-label">How did you come across this job opening? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="how_come_for_job_opening" id="how_come_for_job_opening" onchange="openReferalData(this.value)">
                    <option value="">Choose...</option>
                    @foreach($job_opening_types as $job_opening_type)
                    <option value="{{$job_opening_type['id']}}" @if(old('how_come_for_job_opening',$form_details->how_come_for_job_opening)==$job_opening_type['id']) selected @endif>{{$job_opening_type['name']}}</option>
                    @endforeach
                    <option value="Others" @if(old('how_come_for_job_opening',$form_details->how_come_for_job_opening)=='Others') selected @endif>Others</option>
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid job opening.
                  </div>
                  @if ($errors->has('how_come_for_job_opening'))
                    <span class="text-danger">{{ $errors->first('how_come_for_job_opening') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative" id="internalEmployeeReferenceName" @if(old('how_come_for_job_opening',$form_details->how_come_for_job_opening)!='1') style="display: none;" @endif >
                  <label for="internal_employee_name" class="form-label">Internal Member Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="internal_employee_name" id="internal_employee_name" value="{{ old('internal_employee_name',$form_details->internal_employee_name) }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('internal_employee_name'))
                    <span class="text-danger">{{ $errors->first('internal_employee_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative" id="internalEmployeeReferenceDesignation" @if(old('how_come_for_job_opening',$form_details->how_come_for_job_opening)!='1') style="display: none;" @endif>
                  <label for="internal_employee_designation" class="form-label">Internal Member Designation <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>

                  <select class="form-select" name="internal_employee_designation" id="internal_employee_designation">
                    <option value="">Choose...</option>
                    @foreach($designation_names as $designation_name)
                    <option value="{{$designation_name['id']}}" @if(old('internal_employee_designation', $form_details->internal_employee_designation)==$designation_name['id']) selected @endif>{{$designation_name['name']}}</option>
                    @endforeach
                  </select>

                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('internal_employee_designation'))
                    <span class="text-danger">{{ $errors->first('internal_employee_designation') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative" id="internalEmployeeReferenceDepartment" @if(old('how_come_for_job_opening',$form_details->how_come_for_job_opening)!='1') style="display: none;" @endif>
                  <label for="internal_employee_department" class="form-label">Internal Member Department <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>

                  <select class="form-select" name="internal_employee_department" id="internal_employee_department">
                    <option value="">Choose...</option>
                    @foreach($department_names as $department_name)
                    <option value="{{$department_name['id']}}" @if(old('internal_employee_department',$form_details->internal_employee_department)==$department_name['id']) selected @endif>{{$department_name['name']}}</option>
                    @endforeach
                  </select>

                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('internal_employee_department'))
                    <span class="text-danger">{{ $errors->first('internal_employee_department') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="name_of_your_recruiter" class="form-label">What's the name of your recruiter? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>

                  <select class="form-select" name="name_of_your_recruiter" id="name_of_your_recruiter">
                    <option value="">Choose...</option>
                    @foreach($recruiter_details as $recruiter_detail)
                    <option value="{{ $recruiter_detail['id'] }}" @if(old('name_of_your_recruiter',$form_details->name_of_your_recruiter)==$recruiter_detail['id']) selected @endif>{{ $recruiter_detail['first_name'] }} {{ $recruiter_detail['last_name'] }}</option>
                    @endforeach
                  </select>

                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('name_of_your_recruiter'))
                    <span class="text-danger">{{ $errors->first('name_of_your_recruiter') }}</span>
                  @endif
                </div>

               
                <div class="col-md-12 position-relative">
					       <h5 class="card-title">Rate your recruiter in the following parameters</h5>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="professionalism" class="form-label rdioBtn">Professionalism  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	
                    <div class="rating">
  					          <label class="form_row form_row_0">
                        <input type="radio" name="professionalism" id="professionalism" value="NA" @if(old('professionalism', $form_details->professionalism)=='NA') checked @elseif(old('professionalism')=='') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating0.png" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
  					  

                      <label class="form_row form_row_1">
                        <input type="radio" name="professionalism" id="professionalism" value="1" @if(old('professionalism',$form_details->professionalism)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating5.png" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="professionalism" id="professionalism" value="2" @if(old('professionalism',$form_details->professionalism)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating4.png" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="professionalism" id="professionalism" value="3" @if(old('professionalism',$form_details->professionalism)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating3.png" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="professionalism" id="professionalism" value="4" @if(old('professionalism',$form_details->professionalism)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating2.png" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="professionalism" id="professionalism" value="5" @if(old('professionalism',$form_details->professionalism)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating1.png" alt="img">
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
                  <label for="friendliness" class="form-label rdioBtn">Friendliness <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">

                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="friendliness" id="friendliness" value="NA" @if(old('friendliness', $form_details->friendliness)=='NA') checked @elseif(old('friendliness')=='') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating0.png" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="friendliness" id="friendliness" value="1" @if(old('friendliness',$form_details->friendliness)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating5.png" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="friendliness" id="friendliness" value="2" @if(old('friendliness',$form_details->friendliness)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating4.png" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="friendliness" id="friendliness" value="3" @if(old('friendliness',$form_details->friendliness)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating3.png" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="friendliness" id="friendliness" value="4" @if(old('friendliness',$form_details->friendliness)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating2.png" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="friendliness" id="friendliness" value="5" @if(old('friendliness',$form_details->friendliness)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating1.png" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>

                  	<!-- <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="NA" @if(old('friendliness', $form_details->friendliness)=='NA') checked @elseif(old('friendliness')=='') checked @endif >
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="1" @if(old('friendliness',$form_details->friendliness)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="2" @if(old('friendliness',$form_details->friendliness)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="3" @if(old('friendliness',$form_details->friendliness)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="4" @if(old('friendliness',$form_details->friendliness)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="5" @if(old('friendliness',$form_details->friendliness)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label> -->
                  </span>
                  @if ($errors->has('friendliness'))
                    <span class="text-danger">{{ $errors->first('friendliness') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="length_time_spent_talking" class="form-label rdioBtn">Length of the time spent talking to you <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">

                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="NA" @if(old('length_time_spent_talking', $form_details->length_time_spent_talking)=='NA') checked @elseif(old('length_time_spent_talking')=='') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating0.png" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="1" @if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating5.png" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="2" @if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating4.png" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="3" @if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating3.png" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="4" @if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating2.png" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="5" @if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating1.png" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>

                    <!-- <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="NA" @if(old('length_time_spent_talking', $form_details->length_time_spent_talking)=='NA') checked @elseif(old('length_time_spent_talking')=='') checked @endif >
                    <label class="form-check-label" for="gridRadios1">NA</label>

                  	<input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="1"@if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="2"@if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="3"@if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="4"@if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="5"@if(old('length_time_spent_talking',$form_details->length_time_spent_talking)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label> -->
                  </span>
                  @if ($errors->has('length_time_spent_talking'))
                    <span class="text-danger">{{ $errors->first('length_time_spent_talking') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="company_knowledge" class="form-label rdioBtn">Company knowledge <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">

                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="company_knowledge" id="company_knowledge" value="NA" @if(old('company_knowledge', $form_details->company_knowledge)=='NA') checked @elseif(old('company_knowledge')=='') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating0.png" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="company_knowledge" id="company_knowledge" value="1" @if(old('company_knowledge',$form_details->company_knowledge)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating5.png" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="company_knowledge" id="company_knowledge" value="2" @if(old('company_knowledge',$form_details->company_knowledge)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating4.png" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="company_knowledge" id="company_knowledge" value="3" @if(old('company_knowledge',$form_details->company_knowledge)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating3.png" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="company_knowledge" id="company_knowledge" value="4" @if(old('company_knowledge',$form_details->company_knowledge)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating2.png" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="company_knowledge" id="company_knowledge" value="5" @if(old('company_knowledge',$form_details->company_knowledge)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating1.png" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>

                  	<!-- <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="NA" @if(old('company_knowledge', $form_details->company_knowledge)=='NA') checked @elseif(old('company_knowledge')=='') checked @endif >
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="1" @if(old('company_knowledge',$form_details->company_knowledge)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="2" @if(old('company_knowledge',$form_details->company_knowledge)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="3" @if(old('company_knowledge',$form_details->company_knowledge)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="4" @if(old('company_knowledge',$form_details->company_knowledge)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="5" @if(old('company_knowledge',$form_details->company_knowledge)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label> -->
                  </span>
                  @if ($errors->has('company_knowledge'))
                    <span class="text-danger">{{ $errors->first('company_knowledge') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="specific_knowledge_job_profile" class="form-label rdioBtn">Specific knowledge about the job profile <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">

                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="NA" @if(old('specific_knowledge_job_profile', $form_details->specific_knowledge_job_profile)=='NA') checked @elseif(old('specific_knowledge_job_profile')=='') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating0.png" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="1" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating5.png" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="2" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating4.png" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="3" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating3.png" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="4" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating2.png" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="5" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating1.png" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>

                  	<!-- <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="NA" @if(old('specific_knowledge_job_profile', $form_details->specific_knowledge_job_profile)=='NA') checked @elseif(old('specific_knowledge_job_profile')=='') checked @endif >
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="1" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="2" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="3" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="4" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="5" @if(old('specific_knowledge_job_profile',$form_details->specific_knowledge_job_profile)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label> -->
                  </span>
                  @if ($errors->has('specific_knowledge_job_profile'))
                    <span class="text-danger">{{ $errors->first('specific_knowledge_job_profile') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="timely_response_email_phone" class="form-label rdioBtn">Timely response to your communications - email or phone <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">

                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="NA" @if(old('timely_response_email_phone', $form_details->timely_response_email_phone)=='NA') checked @elseif(old('timely_response_email_phone')=='') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating0.png" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="1" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating5.png" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="2" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating4.png" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="3" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating3.png" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="4" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating2.png" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="5" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating1.png" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>

                  	<!-- <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="NA" @if(old('timely_response_email_phone', $form_details->timely_response_email_phone)=='NA') checked @elseif(old('timely_response_email_phone')=='') checked @endif >
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="1" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="2" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="3" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="4" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="5" @if(old('timely_response_email_phone',$form_details->timely_response_email_phone)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label> -->
                  </span>
                  @if ($errors->has('timely_response_email_phone'))
                    <span class="text-danger">{{ $errors->first('timely_response_email_phone') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <h5 class="card-title">Yes/No Questions</h5>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="company_policies_procedures" class="form-label rdioBtn">Do you completely understand our company policies and procedures as outlined in the handbook? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<input class="form-check-input" type="radio" name="company_policies_procedures" id="company_policies_procedures" value="Yes" @if(old('company_policies_procedures',$form_details->company_policies_procedures)=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="company_policies_procedures" id="company_policies_procedures" value="No" @if(old('company_policies_procedures',$form_details->company_policies_procedures)=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('company_policies_procedures'))
                    <span class="text-danger">{{ $errors->first('company_policies_procedures') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="manager_expectation_setting" class="form-label rdioBtn">Do you completely understand departmental processes as explained in 'Manager's Expectation Setting' session? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<input class="form-check-input" type="radio" name="manager_expectation_setting" id="manager_expectation_setting" value="Yes" @if(old('manager_expectation_setting',$form_details->manager_expectation_setting)=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="manager_expectation_setting" id="manager_expectation_setting" value="No" @if(old('manager_expectation_setting',$form_details->manager_expectation_setting)=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('manager_expectation_setting'))
                    <span class="text-danger">{{ $errors->first('manager_expectation_setting') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="job_duties_responsibilities" class="form-label rdioBtn">Do you completely understand your job duties and responsibilities? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<input class="form-check-input" type="radio" name="job_duties_responsibilities" id="job_duties_responsibilities" value="Yes" @if(old('job_duties_responsibilities',$form_details->job_duties_responsibilities)=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="job_duties_responsibilities" id="job_duties_responsibilities" value="No" @if(old('job_duties_responsibilities',$form_details->job_duties_responsibilities)=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('job_duties_responsibilities'))
                    <span class="text-danger">{{ $errors->first('job_duties_responsibilities') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="job_title_properly_named" class="form-label rdioBtn">Do you feel that your job title is properly named? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	<input class="form-check-input" type="radio" name="job_title_properly_named" id="job_title_properly_named" value="Yes" @if(old('job_title_properly_named',$form_details->job_title_properly_named)=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="job_title_properly_named" id="job_title_properly_named" value="No" @if(old('job_title_properly_named',$form_details->job_title_properly_named)=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('job_title_properly_named'))
                    <span class="text-danger">{{ $errors->first('job_title_properly_named') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="mission_for_first_year" class="form-label">What will be your mission for the first year? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="mission_for_first_year" id="mission_for_first_year" style="height: 100px">{{ old('mission_for_first_year',$form_details->mission_for_first_year) }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('mission_for_first_year'))
                    <span class="text-danger">{{ $errors->first('mission_for_first_year') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'mission_for_first_year' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="aim_in_second_year" class="form-label">What do you aim in the second year? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="aim_in_second_year" id="aim_in_second_year" style="height: 100px">{{ old('aim_in_second_year',$form_details->aim_in_second_year) }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('aim_in_second_year'))
                    <span class="text-danger">{{ $errors->first('aim_in_second_year') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'aim_in_second_year' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="aim_third_year_tenure" class="form-label">What will be your aim in the third year of your tenure with us? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="aim_third_year_tenure" id="aim_third_year_tenure" style="height: 100px">{{ old('aim_third_year_tenure',$form_details->aim_third_year_tenure) }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('aim_third_year_tenure'))
                    <span class="text-danger">{{ $errors->first('aim_third_year_tenure') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'aim_third_year_tenure' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="rate_overall_recruitment_process" class="form-label">Rate the overall recruitment process of our company! <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">

                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="NA" @if(old('rate_overall_recruitment_process', $form_details->rate_overall_recruitment_process)=='NA') checked @elseif(old('rate_overall_recruitment_process')=='') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating0.png" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="1" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating5.png" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="2" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating4.png" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="3" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating3.png" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="4" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating2.png" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="5" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating1.png" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>

                  	<!-- <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="NA" @if(old('rate_overall_recruitment_process', $form_details->rate_overall_recruitment_process)=='NA') checked @elseif(old('rate_overall_recruitment_process')=='') checked @endif >
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="1" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="2" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="3" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="4" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='4') checked @endif
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="5" @if(old('rate_overall_recruitment_process',$form_details->rate_overall_recruitment_process)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label> -->
                  </span>
                  @if ($errors->has('rate_overall_recruitment_process'))
                    <span class="text-danger">{{ $errors->first('rate_overall_recruitment_process') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="additional_feedback_recruitment_process" class="form-label">Any additional feedback for the recruitment process? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="additional_feedback_recruitment_process" id="additional_feedback_recruitment_process" style="height: 100px">{{ old('additional_feedback_recruitment_process',$form_details->additional_feedback_recruitment_process) }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('additional_feedback_recruitment_process'))
                    <span class="text-danger">{{ $errors->first('additional_feedback_recruitment_process') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'additional_feedback_recruitment_process' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="rate_hr_induction" class="form-label">Rate your HR induction session! <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">

                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="rate_hr_induction" id="rate_hr_induction" value="NA" @if(old('rate_hr_induction', $form_details->rate_hr_induction)=='NA') checked @elseif(old('rate_hr_induction')=='') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating0.png" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="rate_hr_induction" id="rate_hr_induction" value="1" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating5.png" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="rate_hr_induction" id="rate_hr_induction" value="2" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating4.png" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="rate_hr_induction" id="rate_hr_induction" value="3" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating3.png" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="rate_hr_induction" id="rate_hr_induction" value="4" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating2.png" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="rate_hr_induction" id="rate_hr_induction" value="5" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="../assests/assets/img/rating1.png" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  	<!-- <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="NA" @if(old('rate_hr_induction', $form_details->rate_hr_induction)=='NA') checked @elseif(old('rate_hr_induction')=='') checked @endif >
                    <label class="form-check-label" for="gridRadios1">NA</label>
                    
                    <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="1" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="2" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="3" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="4" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="5" @if(old('rate_hr_induction',$form_details->rate_hr_induction)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label> -->
                  </span>
                  @if ($errors->has('rate_hr_induction'))
                    <span class="text-danger">{{ $errors->first('rate_hr_induction') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="additional_feedback_hr_induction" class="form-label">Any additional feedback for HR induction session? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="additional_feedback_hr_induction" id="additional_feedback_hr_induction" style="height: 100px">{{ old('additional_feedback_hr_induction',$form_details->additional_feedback_hr_induction) }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('additional_feedback_hr_induction'))
                    <span class="text-danger">{{ $errors->first('additional_feedback_hr_induction') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'additional_feedback_hr_induction' );
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

                @else
              <h4>You can edit only own form.</h4>
              
              @endif

            </div>


          </div>

        </div>
      </div>
    </section>


    <script type="text/javascript">
    	function openReferalData(data){

    		console.log(data);

    		if(data=='1'){
    			document.getElementById('internalEmployeeReferenceName').style.display='block';
    			document.getElementById('internalEmployeeReferenceDesignation').style.display='block';
    			document.getElementById('internalEmployeeReferenceDepartment').style.display='block';

				document.getElementById("internal_employee_name").required = true; 
				document.getElementById("internal_employee_designation").required = true; 
				document.getElementById("internal_employee_department").required = true; 

    		} else {
    			document.getElementById('internalEmployeeReferenceName').style.display='none';
    			document.getElementById('internalEmployeeReferenceDesignation').style.display='none';
    			document.getElementById('internalEmployeeReferenceDepartment').style.display='none';

				document.getElementById("internal_employee_name").required = false; 
				document.getElementById("internal_employee_designation").required = false; 
				document.getElementById("internal_employee_department").required = false; 
    		}
    		
    	}
    </script>

  </main>
@endsection