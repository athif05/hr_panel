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

                <div class="col-md-6 position-relative">
                  <label for="designation" class="form-label">Designation</label>
                  <input type="text" class="form-control disable-text" name="designation" id="designation" value="{{ $form_details->designation }}" readonly>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('designation'))
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="department" class="form-label">Department <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="department" id="department" value="{{ $form_details->department }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Please choose the name of your company <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
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
                  <label for="date_of_joining" class="form-label">Date of Joining <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" class="form-control" name="date_of_joining" id="date_of_joining" value="{{ $form_details->date_of_joining }}" max="<?php echo date("Y-m-d"); ?>" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('date_of_joining'))
                    <span class="text-danger">{{ $errors->first('date_of_joining') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="how_come_for_job_opening" class="form-label">How did you come across this job opening? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="how_come_for_job_opening" id="how_come_for_job_opening" required onchange="openReferalData(this.value)">
                    <option value="">Choose...</option>
                    @foreach($job_opening_types as $job_opening_type)
                    <option value="{{$job_opening_type['id']}}" @if($form_details->how_come_for_job_opening==$job_opening_type['id']) selected @endif>{{$job_opening_type['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid job opening.
                  </div>
                  @if ($errors->has('how_come_for_job_opening'))
                    <span class="text-danger">{{ $errors->first('how_come_for_job_opening') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative" id="internalEmployeeReferenceName" @if($form_details->how_come_for_job_opening!='1') style="display: none;" @endif >
                  <label for="internal_employee_name" class="form-label">Internal Employee Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="internal_employee_name" id="internal_employee_name" value="{{ $form_details->internal_employee_name }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('internal_employee_name'))
                    <span class="text-danger">{{ $errors->first('internal_employee_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative" id="internalEmployeeReferenceDesignation" @if($form_details->how_come_for_job_opening!='1') style="display: none;" @endif>
                  <label for="internal_employee_designation" class="form-label">Internal Employee Designation <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="internal_employee_designation" id="internal_employee_designation" value="{{ $form_details->internal_employee_designation }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('internal_employee_designation'))
                    <span class="text-danger">{{ $errors->first('internal_employee_designation') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative" id="internalEmployeeReferenceDepartment" @if($form_details->how_come_for_job_opening!='1') style="display: none;" @endif>
                  <label for="internal_employee_department" class="form-label">Internal Employee Department <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="internal_employee_department" id="internal_employee_department" value="{{ $form_details->internal_employee_department }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('internal_employee_department'))
                    <span class="text-danger">{{ $errors->first('internal_employee_department') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="name_of_your_recruiter" class="form-label">What's the name of your recruiter? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="name_of_your_recruiter" id="name_of_your_recruiter" value="{{ $form_details->name_of_your_recruiter }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('name_of_your_recruiter'))
                    <span class="text-danger">{{ $errors->first('name_of_your_recruiter') }}</span>
                  @endif
                </div>

               
                <div class="col-md-12 position-relative">
                  <label class="form-label"><strong>Rate your recruiter in the following parameters out of 5: </strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="professionalism" class="form-label">Professionalism:  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="1" @if($form_details->professionalism=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="2" @if($form_details->professionalism=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="3" @if($form_details->professionalism=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="4" @if($form_details->professionalism=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="professionalism" id="professionalism" value="5" @if($form_details->professionalism=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('professionalism'))
                    <span class="text-danger">{{ $errors->first('professionalism') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="friendliness" class="form-label">Friendliness <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="1" @if($form_details->friendliness=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="2" @if($form_details->friendliness=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="3" @if($form_details->friendliness=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="4" @if($form_details->friendliness=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="friendliness" id="friendliness" value="5" @if($form_details->friendliness=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('friendliness'))
                    <span class="text-danger">{{ $errors->first('friendliness') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="length_time_spent_talking" class="form-label">Length of the time spent talking to you <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="1" @if($form_details->length_time_spent_talking=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="2" @if($form_details->length_time_spent_talking=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="3" @if($form_details->length_time_spent_talking=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="4" @if($form_details->length_time_spent_talking=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="length_time_spent_talking" id="length_time_spent_talking" value="5" @if($form_details->length_time_spent_talking=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('length_time_spent_talking'))
                    <span class="text-danger">{{ $errors->first('length_time_spent_talking') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="company_knowledge" class="form-label">Company knowledge <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="1" @if($form_details->company_knowledge=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="2" @if($form_details->company_knowledge=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="3" @if($form_details->company_knowledge=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="4" @if($form_details->company_knowledge=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="company_knowledge" id="company_knowledge" value="5" @if($form_details->company_knowledge=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('company_knowledge'))
                    <span class="text-danger">{{ $errors->first('company_knowledge') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="specific_knowledge_job_profile" class="form-label">Specific knowledge about the job profile <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="1" @if($form_details->specific_knowledge_job_profile=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="2" @if($form_details->specific_knowledge_job_profile=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="3" @if($form_details->specific_knowledge_job_profile=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="4" @if($form_details->specific_knowledge_job_profile=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="specific_knowledge_job_profile" id="specific_knowledge_job_profile" value="5" @if($form_details->specific_knowledge_job_profile=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('specific_knowledge_job_profile'))
                    <span class="text-danger">{{ $errors->first('specific_knowledge_job_profile') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="timely_response_email_phone" class="form-label">Timely response to your communications - email or phone <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="1" @if($form_details->timely_response_email_phone=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="2" @if($form_details->timely_response_email_phone=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="3" @if($form_details->timely_response_email_phone=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="4" @if($form_details->timely_response_email_phone=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="timely_response_email_phone" id="timely_response_email_phone" value="5" @if($form_details->timely_response_email_phone=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('timely_response_email_phone'))
                    <span class="text-danger">{{ $errors->first('timely_response_email_phone') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="validationTooltip02" class="form-label"><strong>Yes/No Questions</strong></label><br>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="company_policies_procedures" class="form-label">Do you completely understand our company policies and procedures as outlined in the handbook? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="company_policies_procedures" id="company_policies_procedures" value="Yes" @if($form_details->company_policies_procedures=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="company_policies_procedures" id="company_policies_procedures" value="No" @if($form_details->company_policies_procedures=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('company_policies_procedures'))
                    <span class="text-danger">{{ $errors->first('company_policies_procedures') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="manager_expectation_setting" class="form-label">Do you completely understand departmental processes as explained in 'Manager's Expectation Setting' session? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="manager_expectation_setting" id="manager_expectation_setting" value="Yes" @if($form_details->manager_expectation_setting=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="manager_expectation_setting" id="manager_expectation_setting" value="No" @if($form_details->manager_expectation_setting=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('manager_expectation_setting'))
                    <span class="text-danger">{{ $errors->first('manager_expectation_setting') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="job_duties_responsibilities" class="form-label">Do you completely understand your job duties and responsibilities? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="job_duties_responsibilities" id="job_duties_responsibilities" value="Yes" @if($form_details->job_duties_responsibilities=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="job_duties_responsibilities" id="job_duties_responsibilities" value="No" @if($form_details->job_duties_responsibilities=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('job_duties_responsibilities'))
                    <span class="text-danger">{{ $errors->first('job_duties_responsibilities') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="job_title_properly_named" class="form-label">Do you feel that your job title is properly named? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="job_title_properly_named" id="job_title_properly_named" value="Yes" @if($form_details->job_title_properly_named=='Yes') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">Yes</label>

	                  <input class="form-check-input" type="radio" name="job_title_properly_named" id="job_title_properly_named" value="No" @if($form_details->job_title_properly_named=='No') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('job_title_properly_named'))
                    <span class="text-danger">{{ $errors->first('job_title_properly_named') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="mission_for_first_year" class="form-label">What will be your mission for the first year? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="mission_for_first_year" id="mission_for_first_year" style="height: 100px">{{ $form_details->mission_for_first_year }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('mission_for_first_year'))
                    <span class="text-danger">{{ $errors->first('mission_for_first_year') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="aim_in_second_year" class="form-label">What do you aim in the second year? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="aim_in_second_year" id="aim_in_second_year" style="height: 100px">{{ $form_details->aim_in_second_year }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('aim_in_second_year'))
                    <span class="text-danger">{{ $errors->first('aim_in_second_year') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="aim_third_year_tenure" class="form-label">What will be your aim in the third year of your tenure with us? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="aim_third_year_tenure" id="aim_third_year_tenure" style="height: 100px">{{ $form_details->aim_third_year_tenure }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('aim_third_year_tenure'))
                    <span class="text-danger">{{ $errors->first('aim_third_year_tenure') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="rate_overall_recruitment_process" class="form-label"><strong>Rate the overall recruitment process of our company! (Rating out of 5) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></strong></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="1" @if($form_details->rate_overall_recruitment_process=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="2" @if($form_details->rate_overall_recruitment_process=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="3" @if($form_details->rate_overall_recruitment_process=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="4" @if($form_details->rate_overall_recruitment_process=='4') checked @endif
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="rate_overall_recruitment_process" id="rate_overall_recruitment_process" value="5" @if($form_details->rate_overall_recruitment_process=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('rate_overall_recruitment_process'))
                    <span class="text-danger">{{ $errors->first('rate_overall_recruitment_process') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="additional_feedback_recruitment_process" class="form-label">Any additional feedback for the recruitment process? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="additional_feedback_recruitment_process" id="additional_feedback_recruitment_process" style="height: 100px">{{ $form_details->additional_feedback_recruitment_process }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('additional_feedback_recruitment_process'))
                    <span class="text-danger">{{ $errors->first('additional_feedback_recruitment_process') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="rate_hr_induction" class="form-label"><strong>Rate your HR induction session! (out of 5)</strong> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                  	  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="1" @if($form_details->rate_hr_induction=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="2" @if($form_details->rate_hr_induction=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="3" @if($form_details->rate_hr_induction=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="4" @if($form_details->rate_hr_induction=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="rate_hr_induction" id="rate_hr_induction" value="5" @if($form_details->rate_hr_induction=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('rate_hr_induction'))
                    <span class="text-danger">{{ $errors->first('rate_hr_induction') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="additional_feedback_hr_induction" class="form-label">Any additional feedback for HR induction session? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="additional_feedback_hr_induction" id="additional_feedback_hr_induction" style="height: 100px">{{ $form_details->additional_feedback_hr_induction }}</textarea>
                  <div class="invalid-tooltip">
                    Please fill this is box.
                  </div>
                  @if ($errors->has('additional_feedback_hr_induction'))
                    <span class="text-danger">{{ $errors->first('additional_feedback_hr_induction') }}</span>
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