@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Member Check-In Form | {{ env('MY_SITE_NAME') }}</title>

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
        font-weight: 600;
    }

    .rdioBtn{
      font-weight: 400!important;
      font-size: 15px;
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
              <h5 class="card-title">Fill Member Check-In Form</h5>
              

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-member-check-in-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Full Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_id" class="form-label">Member Code</label>
                  <input type="text" class="form-control disable-text" name="member_id" id="member_id" value="{{ Auth::user()->member_id }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_id'))
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                  @endif
                </div>

                <input type="hidden" name="designation" id="designation" value="{{Auth::user()->designation}}" />
                <div class="col-md-6 position-relative">
                  <label for="designation" class="form-label">Designation</label>
                  <select class="form-select disable-text" name="designation_dis" id="designation_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($designation_details as $designation_detail)
                    <option value="{{$designation_detail['id']}}" @if((Auth::user()->designation)==$designation_detail['id']) selected @endif>{{$designation_detail['name']}}</option>
                    @endforeach
                  </select>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('designation'))
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                  @endif
                </div>

                <input type="hidden" name="department" id="department" value="{{Auth::user()->department}}" />
                <div class="col-md-6 position-relative">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select disable-text" name="department_dis" id="department_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($department_details as $department_detail)
                    <option value="{{$department_detail['id']}}" @if((Auth::user()->department)==$department_detail['id']) selected @endif>{{$department_detail['name']}}</option>
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
                  <label for="official_email" class="form-label">Email</label>
                  <input type="email" class="form-control disable-text" name="official_email" id="official_email" value="{{ Auth::user()->email }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('official_email'))
                    <span class="text-danger">{{ $errors->first('official_email') }}</span>
                  @endif
                </div>

                <input type="hidden" name="company_name" id="company_name" value="{{Auth::user()->company_id}}" />
                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Company<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="company_name_dis" id="company_name_dis" disabled>
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

                <input type="hidden" name="location_name" id="location_name" value="{{Auth::user()->company_location_id}}" />
                <div class="col-md-6 position-relative">
                  <label for="location_name" class="form-label">Location <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="location_name_dis" id="location_name_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($company_locations as $company_location)
                      <option value="{{$company_location['id']}}" @if((Auth::user()->company_location_id)==$company_location['id']) selected @endif>{{$company_location['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid location.
                  </div>
                  @if ($errors->has('location_name'))
                    <span class="text-danger">{{ $errors->first('location_name') }}</span>
                  @endif
                </div>

                <input type="hidden" name="reporting_manager" id="reporting_manager" value="{{Auth::user()->manager_name}}" />
                <div class="col-md-6 position-relative">
                  <label for="reporting_manager" class="form-label">Your Reporting Manager <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="reporting_manager_dis" id="reporting_manager_dis" disabled>
                    
                    @foreach($manager_details as $manager_detail)
                    <?php  $reporting_manager_name=$manager_detail['first_name'].' '.$manager_detail['last_name']; ?>
                      <option value="{{$manager_detail['id']}}" @if((Auth::user()->manager_name)==$reporting_manager_name) selected @endif>{{$manager_detail['first_name']}} {{$manager_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select reporting manager.
                  </div>
                  @if ($errors->has('reporting_manager'))
                    <span class="text-danger">{{ $errors->first('reporting_manager') }}</span>
                  @endif
                </div>

                <input type="hidden" name="reporting_manager_name_ajax" id="reporting_manager_name_ajax" value="{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default)}}">


                <div class="col-md-6 position-relative">
                  <label for="head_of_department" class="form-label">Head of Department <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="head_of_department" id="head_of_department">
                    <option value="">Choose...</option>
                    @foreach($hod_details as $hod_detail)
                      <option value="{{$hod_detail['id']}}" @if(old('head_of_department')==$hod_detail['id']) selected @endif>{{$hod_detail['first_name']}} {{$hod_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select head of department.
                  </div>
                  @if ($errors->has('head_of_department'))
                    <span class="text-danger">{{ $errors->first('head_of_department') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="joining_date" class="form-label">Your Date of Joining <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" class="form-control disable-text" name="joining_date" id="joining_date" value="{{ Auth::user()->joining_date }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('joining_date'))
                    <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="hr_name_taking_session" class="form-label">Name of the HR taking this session <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="hr_name_taking_session" id="hr_name_taking_session">
                    <option value="">Choose...</option>
                    @foreach($hr_details as $hr_detail)
                      <option value="{{$hr_detail['id']}}" @if(old('hr_name_taking_session')==$hr_detail['id']) selected @endif>{{$hr_detail['first_name']}} {{$hr_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select name of the HR.
                  </div>
                  @if ($errors->has('hr_name_taking_session'))
                    <span class="text-danger">{{ $errors->first('hr_name_taking_session') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="place_yourself_category" class="form-label">Which category would you like to place yourself in ? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="place_yourself_category" id="place_yourself_category">
                    <option value="">Choose...</option>
                    @foreach($yourself_category_details as $yourself_category_detail)
                      <option value="{{$yourself_category_detail['id']}}" @if(old('place_yourself_category')==$yourself_category_detail['id']) selected @endif>{{$yourself_category_detail['name']}}</option>
                    @endforeach
                    <option value="Others" @if(old('place_yourself_category')=='Others') selected @endif>Others</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a category.
                  </div>
                  @if ($errors->has('place_yourself_category'))
                    <span class="text-danger">{{ $errors->first('place_yourself_category') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Please rate yourself on the following parameters.</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="target" class="form-label rdioBtn">Target  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="target" id="target" value="NA" @if(old('target')=='NA') checked @elseif(old('target')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="target" id="target" value="1" @if(old('target')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="target" id="target" value="2" @if(old('target')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="target" id="target" value="3" @if(old('target')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="target" id="target" value="4" @if(old('target')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="target" id="target" value="5" @if(old('target')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>

                  </span>

                  @if ($errors->has('target'))
                    <span class="text-danger">{{ $errors->first('target') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="response" class="form-label rdioBtn">Response <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="response" id="response" value="NA" @if(old('response')=='NA') checked @elseif(old('response')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="response" id="response" value="1" @if(old('response')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="response" id="response" value="2" @if(old('response')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="response" id="response" value="3" @if(old('response')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="response" id="response" value="4" @if(old('response')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="response" id="response" value="5" @if(old('response')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('response'))
                    <span class="text-danger">{{ $errors->first('response') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="jd" class="form-label rdioBtn">JD <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="jd" id="jd" value="NA" @if(old('jd')=='NA') checked @elseif(old('jd')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="jd" id="jd" value="1" @if(old('jd')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="jd" id="jd" value="2" @if(old('jd')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="jd" id="jd" value="3" @if(old('jd')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="jd" id="jd" value="4" @if(old('jd')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="jd" id="jd" value="5" @if(old('jd')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('jd'))
                    <span class="text-danger">{{ $errors->first('jd') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="reliability" class="form-label rdioBtn">Reliability <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="reliability" id="reliability" value="NA" @if(old('reliability')=='NA') checked @elseif(old('reliability')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="reliability" id="reliability" value="1" @if(old('reliability')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="reliability" id="reliability" value="2" @if(old('reliability')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="reliability" id="reliability" value="3" @if(old('reliability')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="reliability" id="reliability" value="4" @if(old('reliability')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="reliability" id="reliability" value="5" @if(old('reliability')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('reliability'))
                    <span class="text-danger">{{ $errors->first('reliability') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="team_spirit" class="form-label rdioBtn">Team Spirit <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="team_spirit" id="team_spirit" value="NA" @if(old('team_spirit')=='NA') checked @elseif(old('team_spirit')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="team_spirit" id="team_spirit" value="1" @if(old('team_spirit')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="team_spirit" id="team_spirit" value="2" @if(old('team_spirit')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="team_spirit" id="team_spirit" value="3" @if(old('team_spirit')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="team_spirit" id="team_spirit" value="4" @if(old('team_spirit')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="team_spirit" id="team_spirit" value="5" @if(old('team_spirit')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('team_spirit'))
                    <span class="text-danger">{{ $errors->first('team_spirit') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="attendance" class="form-label rdioBtn">Attendance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="attendance" id="attendance" value="NA" @if(old('attendance')=='NA') checked @elseif(old('attendance')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="attendance" id="attendance" value="1" @if(old('attendance')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="attendance" id="attendance" value="2" @if(old('attendance')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="attendance" id="attendance" value="3" @if(old('attendance')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="attendance" id="attendance" value="4" @if(old('attendance')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="attendance" id="attendance" value="5" @if(old('attendance')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('attendance'))
                    <span class="text-danger">{{ $errors->first('attendance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="attitude" class="form-label rdioBtn">Attitude <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="attitude" id="attitude" value="NA" @if(old('attitude')=='NA') checked @elseif(old('attitude')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="attitude" id="attitude" value="1" @if(old('attitude')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="attitude" id="attitude" value="2" @if(old('attitude')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="attitude" id="attitude" value="3" @if(old('attitude')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="attitude" id="attitude" value="4" @if(old('attitude')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="attitude" id="attitude" value="5" @if(old('attitude')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('attitude'))
                    <span class="text-danger">{{ $errors->first('attitude') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="rules" class="form-label rdioBtn">Rules <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="rules" id="rules" value="NA" @if(old('rules')=='NA') checked @elseif(old('rules')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="rules" id="rules" value="1" @if(old('rules')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="rules" id="rules" value="2" @if(old('rules')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="rules" id="rules" value="3" @if(old('rules')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="rules" id="rules" value="4" @if(old('rules')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="rules" id="rules" value="5" @if(old('rules')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('rules'))
                    <span class="text-danger">{{ $errors->first('rules') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="peers" class="form-label rdioBtn">Peers <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="peers" id="peers" value="NA" @if(old('peers')=='NA') checked @elseif(old('peers')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="peers" id="peers" value="1" @if(old('peers')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="peers" id="peers" value="2" @if(old('peers')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="peers" id="peers" value="3" @if(old('peers')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="peers" id="peers" value="4" @if(old('peers')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="peers" id="peers" value="5" @if(old('peers')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('peers'))
                    <span class="text-danger">{{ $errors->first('peers') }}</span>
                  @endif

                </div>



                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">How well do you see yourself aligned with the company's core values? Please rate yourself, basis on your everyday conduct at work.</label>
                  <span style="color: red; font-size: 13px;">"HINT: +/+ (follow always) , +/- (follow sometimes) , -/- (never follow)"</span>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="integrity" class="form-label rdioBtn">Integrity: Honesty & respect (ईमानंदारी)  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="integrity" id="integrity" value="+/+" @if(old('integrity')=="+/+") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="integrity" id="integrity" value="+/-" @if(old('integrity')=="+/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="integrity" id="integrity" value="-/-" @if(old('integrity')=="-/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('integrity'))
                    <span class="text-danger">{{ $errors->first('integrity') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="win_win" class="form-label rdioBtn">Win-Win : You win-I win (सब की जीत) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="win_win" id="win_win" value="+/+" @if(old('win_win')=="+/+") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="win_win" id="win_win" value="+/-" @if(old('win_win')=="+/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="win_win" id="win_win" value="-/-" @if(old('win_win')=="-/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>
                  @if ($errors->has('win_win'))
                    <span class="text-danger">{{ $errors->first('win_win') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="synergize" class="form-label rdioBtn">Synergize: Together is better (ताल-मेल) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="synergize" id="synergize" value="+/+" @if(old('synergize')=="+/+") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="synergize" id="synergize" value="+/-" @if(old('synergize')=="+/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="synergize" id="synergize" value="-/-" @if(old('synergize')=="-/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>
                  @if ($errors->has('synergize'))
                    <span class="text-danger">{{ $errors->first('synergize') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="closure" class="form-label rdioBtn">Closure : Do it to close it (समापन) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="closure" id="closure" value="+/+" @if(old('closure')=="+/+") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="closure" id="closure" value="+/-" @if(old('closure')=="+/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="closure" id="closure" value="-/-" @if(old('closure')=="-/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>
                  @if ($errors->has('closure'))
                    <span class="text-danger">{{ $errors->first('closure') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="knowledge" class="form-label rdioBtn">Knowledge: Ace of trade (ज्ञान) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="knowledge" id="knowledge" value="+/+" @if(old('knowledge')=="+/+") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="knowledge" id="knowledge" value="+/-" @if(old('knowledge')=="+/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="knowledge" id="knowledge" value="-/-" @if(old('knowledge')=="-/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>
                  @if ($errors->has('knowledge'))
                    <span class="text-danger">{{ $errors->first('knowledge') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="kiss" class="form-label rdioBtn">KISS: Keep it simple, stupid (सरल) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="kiss" id="kiss" value="+/+" @if(old('kiss')=="+/+") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="kiss" id="kiss" value="+/-" @if(old('kiss')=="+/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="kiss" id="kiss" value="-/-" @if(old('kiss')=="-/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('kiss'))
                    <span class="text-danger">{{ $errors->first('kiss') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="innovation" class="form-label rdioBtn">Innovation: New method or idea (नवीनता) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="innovation" id="innovation" value="+/+" @if(old('innovation')=="+/+") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="innovation" id="innovation" value="+/-" @if(old('innovation')=="+/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="innovation" id="innovation" value="-/-" @if(old('innovation')=="-/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('innovation'))
                    <span class="text-danger">{{ $errors->first('innovation') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label rdioBtn">Celebration: Work hard, party harder (उत्सव) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="celebration" id="celebration" value="+/+" @if(old('celebration')=="+/+") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="celebration" id="celebration" value="+/-" @if(old('celebration')=="+/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="celebration" id="celebration" value="-/-" @if(old('celebration')=="-/-") checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>



                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Let's talk about your work-related experience</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="company_work_culture" class="form-label rdioBtn">The work culture in the company is encouraging  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="company_work_culture" id="company_work_culture" value="NA" @if(old('company_work_culture')=='NA') checked @elseif(old('company_work_culture')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="company_work_culture" id="company_work_culture" value="1" @if(old('company_work_culture')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="company_work_culture" id="company_work_culture" value="2" @if(old('company_work_culture')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="company_work_culture" id="company_work_culture" value="3" @if(old('company_work_culture')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="company_work_culture" id="company_work_culture" value="4" @if(old('company_work_culture')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="company_work_culture" id="company_work_culture" value="5" @if(old('company_work_culture')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('company_work_culture'))
                    <span class="text-danger">{{ $errors->first('company_work_culture') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="processes_policies_well_defined" class="form-label rdioBtn">The processes & policies are well defined & well explained <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="processes_policies_well_defined" id="processes_policies_well_defined" value="NA" @if(old('processes_policies_well_defined')=='NA') checked @elseif(old('processes_policies_well_defined')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="processes_policies_well_defined" id="processes_policies_well_defined" value="1" @if(old('processes_policies_well_defined')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="processes_policies_well_defined" id="processes_policies_well_defined" value="2" @if(old('processes_policies_well_defined')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="processes_policies_well_defined" id="processes_policies_well_defined" value="3" @if(old('processes_policies_well_defined')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="processes_policies_well_defined" id="processes_policies_well_defined" value="4" @if(old('processes_policies_well_defined')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="processes_policies_well_defined" id="processes_policies_well_defined" value="5" @if(old('processes_policies_well_defined')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('processes_policies_well_defined'))
                    <span class="text-danger">{{ $errors->first('processes_policies_well_defined') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="enjoy_work_life_balance" class="form-label rdioBtn">I enjoy the work-life balance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="enjoy_work_life_balance" id="enjoy_work_life_balance" value="NA" @if(old('enjoy_work_life_balance')=='NA') checked @elseif(old('enjoy_work_life_balance')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="enjoy_work_life_balance" id="enjoy_work_life_balance" value="1" @if(old('enjoy_work_life_balance')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="enjoy_work_life_balance" id="enjoy_work_life_balance" value="2" @if(old('enjoy_work_life_balance')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="enjoy_work_life_balance" id="enjoy_work_life_balance" value="3" @if(old('enjoy_work_life_balance')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="enjoy_work_life_balance" id="enjoy_work_life_balance" value="4" @if(old('enjoy_work_life_balance')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="enjoy_work_life_balance" id="enjoy_work_life_balance" value="5" @if(old('enjoy_work_life_balance')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('enjoy_work_life_balance'))
                    <span class="text-danger">{{ $errors->first('enjoy_work_life_balance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="happy_with_treated_in_company" class="form-label rdioBtn">I am happy with how I am treated in the company by managers & peers <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="happy_with_treated_in_company" id="happy_with_treated_in_company" value="NA" @if(old('happy_with_treated_in_company')=='NA') checked @elseif(old('happy_with_treated_in_company')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="happy_with_treated_in_company" id="happy_with_treated_in_company" value="1" @if(old('happy_with_treated_in_company')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="happy_with_treated_in_company" id="happy_with_treated_in_company" value="2" @if(old('happy_with_treated_in_company')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="happy_with_treated_in_company" id="happy_with_treated_in_company" value="3" @if(old('happy_with_treated_in_company')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="happy_with_treated_in_company" id="happy_with_treated_in_company" value="4" @if(old('happy_with_treated_in_company')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="happy_with_treated_in_company" id="happy_with_treated_in_company" value="5" @if(old('happy_with_treated_in_company')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('happy_with_treated_in_company'))
                    <span class="text-danger">{{ $errors->first('happy_with_treated_in_company') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="job_title_kras" class="form-label rdioBtn">My job title & KRAs are apt for me <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="job_title_kras" id="job_title_kras" value="NA" @if(old('job_title_kras')=='NA') checked @elseif(old('job_title_kras')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="job_title_kras" id="job_title_kras" value="1" @if(old('job_title_kras')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="job_title_kras" id="job_title_kras" value="2" @if(old('job_title_kras')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="job_title_kras" id="job_title_kras" value="3" @if(old('job_title_kras')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="job_title_kras" id="job_title_kras" value="4" @if(old('job_title_kras')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="job_title_kras" id="job_title_kras" value="5" @if(old('job_title_kras')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('job_title_kras'))
                    <span class="text-danger">{{ $errors->first('job_title_kras') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="necessary_resources_available" class="form-label rdioBtn">I have necessary resources available, to perform my job <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="necessary_resources_available" id="necessary_resources_available" value="NA" @if(old('necessary_resources_available')=='NA') checked @elseif(old('necessary_resources_available')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="necessary_resources_available" id="necessary_resources_available" value="1" @if(old('necessary_resources_available')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="necessary_resources_available" id="necessary_resources_available" value="2" @if(old('necessary_resources_available')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="necessary_resources_available" id="necessary_resources_available" value="3" @if(old('necessary_resources_available')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="necessary_resources_available" id="necessary_resources_available" value="4" @if(old('necessary_resources_available')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="necessary_resources_available" id="necessary_resources_available" value="5" @if(old('necessary_resources_available')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('necessary_resources_available'))
                    <span class="text-danger">{{ $errors->first('necessary_resources_available') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="feel_grow_in_organization" class="form-label rdioBtn">I feel I will grow in the organization <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="feel_grow_in_organization" id="feel_grow_in_organization" value="NA" @if(old('feel_grow_in_organization')=='NA') checked @elseif(old('feel_grow_in_organization')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="feel_grow_in_organization" id="feel_grow_in_organization" value="1" @if(old('feel_grow_in_organization')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="feel_grow_in_organization" id="feel_grow_in_organization" value="2" @if(old('feel_grow_in_organization')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="feel_grow_in_organization" id="feel_grow_in_organization" value="3" @if(old('feel_grow_in_organization')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="feel_grow_in_organization" id="feel_grow_in_organization" value="4" @if(old('feel_grow_in_organization')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="feel_grow_in_organization" id="feel_grow_in_organization" value="5" @if(old('feel_grow_in_organization')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('feel_grow_in_organization'))
                    <span class="text-danger">{{ $errors->first('feel_grow_in_organization') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="complete_clarity_my_role" class="form-label rdioBtn">I have complete clarity of my role & what's expected out of me <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="complete_clarity_my_role" id="complete_clarity_my_role" value="NA" @if(old('complete_clarity_my_role')=='NA') checked @elseif(old('complete_clarity_my_role')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="complete_clarity_my_role" id="complete_clarity_my_role" value="1" @if(old('complete_clarity_my_role')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="complete_clarity_my_role" id="complete_clarity_my_role" value="2" @if(old('complete_clarity_my_role')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="complete_clarity_my_role" id="complete_clarity_my_role" value="3" @if(old('complete_clarity_my_role')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="complete_clarity_my_role" id="complete_clarity_my_role" value="4" @if(old('complete_clarity_my_role')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="complete_clarity_my_role" id="complete_clarity_my_role" value="5" @if(old('complete_clarity_my_role')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('complete_clarity_my_role'))
                    <span class="text-danger">{{ $errors->first('complete_clarity_my_role') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label rdioBtn">Overall I am happy with my job role <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="overall_happy_with_job_role" id="overall_happy_with_job_role" value="NA" @if(old('overall_happy_with_job_role')=='NA') checked @elseif(old('overall_happy_with_job_role')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="overall_happy_with_job_role" id="overall_happy_with_job_role" value="1" @if(old('overall_happy_with_job_role')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="overall_happy_with_job_role" id="overall_happy_with_job_role" value="2" @if(old('overall_happy_with_job_role')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="overall_happy_with_job_role" id="overall_happy_with_job_role" value="3" @if(old('overall_happy_with_job_role')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="overall_happy_with_job_role" id="overall_happy_with_job_role" value="4" @if(old('overall_happy_with_job_role')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="overall_happy_with_job_role" id="overall_happy_with_job_role" value="5" @if(old('overall_happy_with_job_role')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('overall_happy_with_job_role'))
                    <span class="text-danger">{{ $errors->first('overall_happy_with_job_role') }}</span>
                  @endif

                </div>



                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Let's talk about your training experience</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="training_elaborative_well_explained" class="form-label rdioBtn">Training was elaborative & well explained  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="training_elaborative_well_explained" id="training_elaborative_well_explained" value="NA" @if(old('training_elaborative_well_explained')=='NA') checked @elseif(old('training_elaborative_well_explained')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="training_elaborative_well_explained" id="training_elaborative_well_explained" value="1" @if(old('training_elaborative_well_explained')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="training_elaborative_well_explained" id="training_elaborative_well_explained" value="2" @if(old('training_elaborative_well_explained')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="training_elaborative_well_explained" id="training_elaborative_well_explained" value="3" @if(old('training_elaborative_well_explained')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="training_elaborative_well_explained" id="training_elaborative_well_explained" value="4" @if(old('training_elaborative_well_explained')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="training_elaborative_well_explained" id="training_elaborative_well_explained" value="5" @if(old('training_elaborative_well_explained')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('training_elaborative_well_explained'))
                    <span class="text-danger">{{ $errors->first('training_elaborative_well_explained') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="training_duration_apt" class="form-label rdioBtn">Duration of training was apt <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="training_duration_apt" id="training_duration_apt" value="NA" @if(old('training_duration_apt')=='NA') checked @elseif(old('training_duration_apt')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="training_duration_apt" id="training_duration_apt" value="1" @if(old('training_duration_apt')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="training_duration_apt" id="training_duration_apt" value="2" @if(old('training_duration_apt')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="training_duration_apt" id="training_duration_apt" value="3" @if(old('training_duration_apt')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="training_duration_apt" id="training_duration_apt" value="4" @if(old('training_duration_apt')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="training_duration_apt" id="training_duration_apt" value="5" @if(old('training_duration_apt')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('training_duration_apt'))
                    <span class="text-danger">{{ $errors->first('training_duration_apt') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="proper_modules_defined_topic" class="form-label rdioBtn">Proper modules are defined for each topic <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="proper_modules_defined_topic" id="proper_modules_defined_topic" value="NA" @if(old('proper_modules_defined_topic')=='NA') checked @elseif(old('proper_modules_defined_topic')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="proper_modules_defined_topic" id="proper_modules_defined_topic" value="1" @if(old('proper_modules_defined_topic')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="proper_modules_defined_topic" id="proper_modules_defined_topic" value="2" @if(old('proper_modules_defined_topic')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="proper_modules_defined_topic" id="proper_modules_defined_topic" value="3" @if(old('proper_modules_defined_topic')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="proper_modules_defined_topic" id="proper_modules_defined_topic" value="4" @if(old('proper_modules_defined_topic')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="proper_modules_defined_topic" id="proper_modules_defined_topic" value="5" @if(old('proper_modules_defined_topic')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('proper_modules_defined_topic'))
                    <span class="text-danger">{{ $errors->first('proper_modules_defined_topic') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="adequate_supporting_material" class="form-label rdioBtn">Adequate supporting material is provided to help learn faster & better <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="adequate_supporting_material" id="adequate_supporting_material" value="NA" @if(old('adequate_supporting_material')=='NA') checked @elseif(old('adequate_supporting_material')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="adequate_supporting_material" id="adequate_supporting_material" value="1" @if(old('adequate_supporting_material')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="adequate_supporting_material" id="adequate_supporting_material" value="2" @if(old('adequate_supporting_material')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="adequate_supporting_material" id="adequate_supporting_material" value="3" @if(old('adequate_supporting_material')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="adequate_supporting_material" id="adequate_supporting_material" value="4" @if(old('adequate_supporting_material')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="adequate_supporting_material" id="adequate_supporting_material" value="5" @if(old('adequate_supporting_material')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('adequate_supporting_material'))
                    <span class="text-danger">{{ $errors->first('adequate_supporting_material') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="clarity_on_topics_during_training" class="form-label rdioBtn">The clarity given on topics during training was apt <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="clarity_on_topics_during_training" id="clarity_on_topics_during_training" value="NA" @if(old('clarity_on_topics_during_training')=='NA') checked @elseif(old('clarity_on_topics_during_training')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="clarity_on_topics_during_training" id="clarity_on_topics_during_training" value="1" @if(old('clarity_on_topics_during_training')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="clarity_on_topics_during_training" id="clarity_on_topics_during_training" value="2" @if(old('clarity_on_topics_during_training')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="clarity_on_topics_during_training" id="clarity_on_topics_during_training" value="3" @if(old('clarity_on_topics_during_training')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="clarity_on_topics_during_training" id="clarity_on_topics_during_training" value="4" @if(old('clarity_on_topics_during_training')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="clarity_on_topics_during_training" id="clarity_on_topics_during_training" value="5" @if(old('clarity_on_topics_during_training')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('clarity_on_topics_during_training'))
                    <span class="text-danger">{{ $errors->first('clarity_on_topics_during_training') }}</span>
                  @endif

                </div>



                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Let's talk about your experience with your reporting manager</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="great_relationship_with_manager" class="form-label rdioBtn">I have great relationship with <span id="great_relationship_id">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default)}}</span>  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="great_relationship_with_manager" id="great_relationship_with_manager" value="NA" @if(old('great_relationship_with_manager')=='NA') checked @elseif(old('great_relationship_with_manager')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="great_relationship_with_manager" id="great_relationship_with_manager" value="1" @if(old('great_relationship_with_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="great_relationship_with_manager" id="great_relationship_with_manager" value="2" @if(old('great_relationship_with_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="great_relationship_with_manager" id="great_relationship_with_manager" value="3" @if(old('great_relationship_with_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="great_relationship_with_manager" id="great_relationship_with_manager" value="4" @if(old('great_relationship_with_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="great_relationship_with_manager" id="great_relationship_with_manager" value="5" @if(old('great_relationship_with_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('great_relationship_with_manager'))
                    <span class="text-danger">{{ $errors->first('great_relationship_with_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="reviewed_properly_feedback_shared_timely" class="form-label rdioBtn">My work is reviewed properly & feedback is shared timely <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="reviewed_properly_feedback_shared_timely" id="reviewed_properly_feedback_shared_timely" value="NA" @if(old('reviewed_properly_feedback_shared_timely')=='NA') checked @elseif(old('reviewed_properly_feedback_shared_timely')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="reviewed_properly_feedback_shared_timely" id="reviewed_properly_feedback_shared_timely" value="1" @if(old('reviewed_properly_feedback_shared_timely')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="reviewed_properly_feedback_shared_timely" id="reviewed_properly_feedback_shared_timely" value="2" @if(old('reviewed_properly_feedback_shared_timely')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="reviewed_properly_feedback_shared_timely" id="reviewed_properly_feedback_shared_timely" value="3" @if(old('reviewed_properly_feedback_shared_timely')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="reviewed_properly_feedback_shared_timely" id="reviewed_properly_feedback_shared_timely" value="4" @if(old('reviewed_properly_feedback_shared_timely')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="reviewed_properly_feedback_shared_timely" id="reviewed_properly_feedback_shared_timely" value="5" @if(old('reviewed_properly_feedback_shared_timely')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('reviewed_properly_feedback_shared_timely'))
                    <span class="text-danger">{{ $errors->first('reviewed_properly_feedback_shared_timely') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="openly_share_opinions" class="form-label rdioBtn">I can openly share opinions & feedback with <span id="openly_share_id">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default)}}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="openly_share_opinions" id="openly_share_opinions" value="NA" @if(old('openly_share_opinions')=='NA') checked @elseif(old('openly_share_opinions')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="openly_share_opinions" id="openly_share_opinions" value="1" @if(old('openly_share_opinions')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="openly_share_opinions" id="openly_share_opinions" value="2" @if(old('openly_share_opinions')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="openly_share_opinions" id="openly_share_opinions" value="3" @if(old('openly_share_opinions')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="openly_share_opinions" id="openly_share_opinions" value="4" @if(old('openly_share_opinions')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="openly_share_opinions" id="openly_share_opinions" value="5" @if(old('openly_share_opinions')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('openly_share_opinions'))
                    <span class="text-danger">{{ $errors->first('openly_share_opinions') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="receive_adequate_guidance" class="form-label rdioBtn">I receive adequate guidance from <span id="adequate_guidance_id">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default)}}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="receive_adequate_guidance" id="receive_adequate_guidance" value="NA" @if(old('receive_adequate_guidance')=='NA') checked @elseif(old('receive_adequate_guidance')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_guidance" id="receive_adequate_guidance" value="1" @if(old('receive_adequate_guidance')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_guidance" id="receive_adequate_guidance" value="2" @if(old('receive_adequate_guidance')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_guidance" id="receive_adequate_guidance" value="3" @if(old('receive_adequate_guidance')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_guidance" id="receive_adequate_guidance" value="4" @if(old('receive_adequate_guidance')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_guidance" id="receive_adequate_guidance" value="5" @if(old('receive_adequate_guidance')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('receive_adequate_guidance'))
                    <span class="text-danger">{{ $errors->first('receive_adequate_guidance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="receive_adequate_timely_feedback" class="form-label rdioBtn">I receive adequate & timely feedback from <span id="timely_feedback_id">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default)}}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="receive_adequate_timely_feedback" id="receive_adequate_timely_feedback" value="NA" @if(old('receive_adequate_timely_feedback')=='NA') checked @elseif(old('receive_adequate_timely_feedback')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_timely_feedback" id="receive_adequate_timely_feedback" value="1" @if(old('receive_adequate_timely_feedback')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_timely_feedback" id="receive_adequate_timely_feedback" value="2" @if(old('receive_adequate_timely_feedback')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_timely_feedback" id="receive_adequate_timely_feedback" value="3" @if(old('receive_adequate_timely_feedback')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_timely_feedback" id="receive_adequate_timely_feedback" value="4" @if(old('receive_adequate_timely_feedback')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="receive_adequate_timely_feedback" id="receive_adequate_timely_feedback" value="5" @if(old('receive_adequate_timely_feedback')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('receive_adequate_timely_feedback'))
                    <span class="text-danger">{{ $errors->first('receive_adequate_timely_feedback') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="get_quick_resolution_issue" class="form-label rdioBtn">I get quick resolution to issues from <span id="quick_resolution_id">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default)}}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="get_quick_resolution_issue" id="get_quick_resolution_issue" value="NA" @if(old('get_quick_resolution_issue')=='NA') checked @elseif(old('get_quick_resolution_issue')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="get_quick_resolution_issue" id="get_quick_resolution_issue" value="1" @if(old('get_quick_resolution_issue')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="get_quick_resolution_issue" id="get_quick_resolution_issue" value="2" @if(old('get_quick_resolution_issue')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="get_quick_resolution_issue" id="get_quick_resolution_issue" value="3" @if(old('get_quick_resolution_issue')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="get_quick_resolution_issue" id="get_quick_resolution_issue" value="4" @if(old('get_quick_resolution_issue')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="get_quick_resolution_issue" id="get_quick_resolution_issue" value="5" @if(old('get_quick_resolution_issue')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('get_quick_resolution_issue'))
                    <span class="text-danger">{{ $errors->first('get_quick_resolution_issue') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="frequently_receive_feedback_manager" class="form-label">How frequently do you want to receive feedback from your manager about your performance? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="frequently_receive_feedback_manager" id="frequently_receive_feedback_manager" value="{{ old('frequently_receive_feedback_manager') }}">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('frequently_receive_feedback_manager'))
                    <span class="text-danger">{{ $errors->first('frequently_receive_feedback_manager') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback_manager" class="form-label">Any additional feedback for <span id="any_additional_feedback_manager_id">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default)}}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback_manager" id="any_additional_feedback_manager" style="height: 100px">{{ old('any_additional_feedback_manager')}}</textarea>

                  @if ($errors->has('any_additional_feedback_manager'))
                    <span class="text-danger">{{ $errors->first('any_additional_feedback_manager') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_feedback_manager' );
                  </script>

                </div>


                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Has the following happened for you yet? </label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="receive_proper_job_kra" class="form-label rdioBtn">Did you receive a proper Job Description/KRA sheet from your manager at the time of joining?  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="receive_proper_job_kra" id="receive_proper_job_kra" value="NA" @if(old('receive_proper_job_kra')=='NA') checked @elseif(old('receive_proper_job_kra')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="receive_proper_job_kra" id="receive_proper_job_kra" value="Yes" @if(old('receive_proper_job_kra')=='Yes') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="receive_proper_job_kra" id="receive_proper_job_kra" value="No" @if(old('receive_proper_job_kra')=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>
                  </span>

                  @if ($errors->has('receive_proper_job_kra'))
                    <span class="text-danger">{{ $errors->first('receive_proper_job_kra') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="proper_training_plan" class="form-label rdioBtn">Did you receive a proper training plan from your reporting manager at the time of our joining?  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="proper_training_plan" id="proper_training_plan" value="NA" @if(old('proper_training_plan')=='NA') checked @elseif(old('proper_training_plan')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="proper_training_plan" id="proper_training_plan" value="Yes" @if(old('proper_training_plan')=='Yes') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="proper_training_plan" id="proper_training_plan" value="No" @if(old('proper_training_plan')=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>
                  </span>

                  @if ($errors->has('proper_training_plan'))
                    <span class="text-danger">{{ $errors->first('proper_training_plan') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="training_executed_planned" class="form-label rdioBtn">Was the training executed as planned?  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="training_executed_planned" id="training_executed_planned" value="NA" @if(old('training_executed_planned')=='NA') checked @elseif(old('training_executed_planned')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="training_executed_planned" id="training_executed_planned" value="Yes" @if(old('training_executed_planned')=='Yes') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="training_executed_planned" id="training_executed_planned" value="No" @if(old('training_executed_planned')=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>
                  </span>

                  @if ($errors->has('training_executed_planned'))
                    <span class="text-danger">{{ $errors->first('training_executed_planned') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="marked_regularly_your_eod" class="form-label rdioBtn">Are you marked regularly on your EODs?  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="marked_regularly_your_eod" id="marked_regularly_your_eod" value="NA" @if(old('marked_regularly_your_eod')=='NA') checked @elseif(old('marked_regularly_your_eod')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="marked_regularly_your_eod" id="marked_regularly_your_eod" value="Yes" @if(old('marked_regularly_your_eod')=='Yes') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="marked_regularly_your_eod" id="marked_regularly_your_eod" value="No" @if(old('marked_regularly_your_eod')=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>
                  </span>

                  @if ($errors->has('marked_regularly_your_eod'))
                    <span class="text-danger">{{ $errors->first('marked_regularly_your_eod') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="wpr_happen_atleast_once_week" class="form-label rdioBtn">Do your WPRs happen atleast once a week?  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="wpr_happen_atleast_once_week" id="wpr_happen_atleast_once_week" value="NA" @if(old('wpr_happen_atleast_once_week')=='NA') checked @elseif(old('wpr_happen_atleast_once_week')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="wpr_happen_atleast_once_week" id="wpr_happen_atleast_once_week" value="Yes" @if(old('wpr_happen_atleast_once_week')=='Yes') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="wpr_happen_atleast_once_week" id="wpr_happen_atleast_once_week" value="No" @if(old('wpr_happen_atleast_once_week')=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>
                  </span>

                  @if ($errors->has('wpr_happen_atleast_once_week'))
                    <span class="text-danger">{{ $errors->first('wpr_happen_atleast_once_week') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="one_to_one_interaction" class="form-label rdioBtn">Has your 1:1 interaction happened with <span id="1_on_1_id">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default)}}</span> atleast twice? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="one_to_one_interaction" id="one_to_one_interaction" value="NA" @if(old('one_to_one_interaction')=='NA') checked @elseif(old('one_to_one_interaction')=='') checked @endif
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="one_to_one_interaction" id="one_to_one_interaction" value="Yes" @if(old('one_to_one_interaction')=='Yes') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="one_to_one_interaction" id="one_to_one_interaction" value="No" @if(old('one_to_one_interaction')=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>
                  </span>

                  @if ($errors->has('one_to_one_interaction'))
                    <span class="text-danger">{{ $errors->first('one_to_one_interaction') }}</span>
                  @endif

                </div>

                
                <div class="col-md-12 position-relative">
                  <label for="best_experience_tenure" class="form-label">What’s the best experience you have had during your tenure till date? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="best_experience_tenure" id="best_experience_tenure" style="height: 100px">{{ old('best_experience_tenure') }}</textarea>
                  <div class="invalid-feedback">
                    What’s the best experience you have had during your tenure till date?
                  </div>
                  @if ($errors->has('best_experience_tenure'))
                    <span class="text-danger">{{ $errors->first('best_experience_tenure') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'best_experience_tenure' );
                  </script>

                </div>


                <div class="col-md-12 position-relative">
                  <label for="like_most_working" class="form-label">What do you like the most working here? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="like_most_working" id="like_most_working" style="height: 100px">{{ old('like_most_working') }}</textarea>
                  <div class="invalid-feedback">
                    What do you like the most working here?
                  </div>
                  @if ($errors->has('like_most_working'))
                    <span class="text-danger">{{ $errors->first('like_most_working') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'like_most_working' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="like_to_change_add" class="form-label">What would you like to change/add in the organization? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="like_to_change_add" id="like_to_change_add" style="height: 100px">{{ old('like_to_change_add') }}</textarea>
                  <div class="invalid-feedback">
                    What would you like to change/add in the organization?
                  </div>
                  @if ($errors->has('like_to_change_add'))
                    <span class="text-danger">{{ $errors->first('like_to_change_add') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'like_to_change_add' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="who_inspired_you_organization" class="form-label">What/Who has inspired you in this organization, based on your experiences so far? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="who_inspired_you_organization" id="who_inspired_you_organization" style="height: 100px">{{ old('who_inspired_you_organization') }}</textarea>
                  <div class="invalid-feedback">
                    What/Who has inspired you in this organization, based on your experiences so far?
                  </div>
                  @if ($errors->has('who_inspired_you_organization'))
                    <span class="text-danger">{{ $errors->first('who_inspired_you_organization') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'who_inspired_you_organization' );
                  </script>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="mention_achievement" class="form-label">Mention your achievement(s) in terms of your work till date <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="mention_achievement" id="mention_achievement" style="height: 100px">{{ old('mention_achievement') }}</textarea>
                  <div class="invalid-feedback">
                    Mention your achievement(s) in terms of your work till date.
                  </div>
                  @if ($errors->has('mention_achievement'))
                    <span class="text-danger">{{ $errors->first('mention_achievement') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'mention_achievement' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="facing_any_challenges" class="form-label">Any challenges that you are facing right now? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="facing_any_challenges" id="facing_any_challenges" style="height: 100px">{{ old('facing_any_challenges') }}</textarea>
                  <div class="invalid-feedback">
                    Any challenges that you are facing right now?
                  </div>
                  @if ($errors->has('facing_any_challenges'))
                    <span class="text-danger">{{ $errors->first('facing_any_challenges') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'facing_any_challenges' );
                  </script>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="need_additional_training" class="form-label">Do you need any additional training or support? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="need_additional_training" id="need_additional_training" style="height: 100px">{{ old('need_additional_training') }}</textarea>
                  <div class="invalid-feedback">
                    Do you need any additional training or support?
                  </div>
                  @if ($errors->has('need_additional_training'))
                    <span class="text-danger">{{ $errors->first('need_additional_training') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'need_additional_training' );
                  </script>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback_share" class="form-label">Any additional feedback that you wish to share? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback_share" id="any_additional_feedback_share" style="height: 100px">{{ old('any_additional_feedback_share') }}</textarea>
                  <div class="invalid-feedback">
                    Any additional feedback that you wish to share?
                  </div>
                  @if ($errors->has('any_additional_feedback_share'))
                    <span class="text-danger">{{ $errors->first('any_additional_feedback_share') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_feedback_share' );
                  </script>
                </div>


                <div class="col-12">
                  <input type="submit" name="submit" value="Save in Draft" class="btn btn-info">

                  <input type="submit" name="submit" value="Publish" class="btn btn-primary">
                </div>

              </form>
              <!-- End Custom Styled Validation with Tooltips -->
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