@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Fresh Eye Journal Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Fill Fresh Eye Journal Form</h5>
              

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-fresh-eye-journal-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" name="member_name" id="member_name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_id" class="form-label">Member ID</label>
                  <input type="text" class="form-control" name="member_id" id="member_id" value="{{ Auth::user()->member_id }}">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_id'))
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="designation" class="form-label">Designation</label>
                  <select class="form-select" name="designation" id="designation" required>
                    <option value="">Choose...</option>
                    @foreach($designation_details as $designation_detail)
                    <option value="{{$designation_detail['id']}}" @if(old('designation')==$designation_detail['id']) selected @endif>{{$designation_detail['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid designation.
                  </div>
                  @if ($errors->has('designation'))
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select" name="department" id="department" required>
                    <option value="">Choose...</option>
                    @foreach($department_details as $department_detail)
                    <option value="{{$department_detail['id']}}" @if(old('department')==$department_detail['id']) selected @endif>{{$department_detail['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid department.
                  </div>
                  @if ($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Company<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="company_name" id="company_name" required>
                    <option value="">Choose...</option>
                    @foreach($company_names as $company_name)
                      <option value="{{$company_name['id']}}" @if(old('company_name')==$company_name['id']) selected @endif>{{$company_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid company.
                  </div>
                  @if ($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="location_name" class="form-label">Location <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="location_name" id="location_name" required>
                    <option value="">Choose...</option>
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
                  <label for="official_email" class="form-label">Tenure (in months)</label>
                  <input type="email" class="form-control" name="official_email" id="official_email" value="">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('official_email'))
                    <span class="text-danger">{{ $errors->first('official_email') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="reporting_manager" class="form-label">Name of Reporting Manager <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="reporting_manager" id="reporting_manager" required>
                    <option value="">Choose...</option>
                    @foreach($manager_details as $manager_detail)
                      <option value="{{$manager_detail['id']}}" @if(old('reporting_manager')==$manager_detail['id']) selected @endif>{{$manager_detail['first_name']}} {{$manager_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select reporting manager.
                  </div>
                  @if ($errors->has('reporting_manager'))
                    <span class="text-danger">{{ $errors->first('reporting_manager') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="head_of_department" class="form-label">Name of Department Head <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="head_of_department" id="head_of_department" required>
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

                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback_manager" class="form-label">How has your journey been so far in company_name? Explain in detail. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback_manager" id="any_additional_feedback_manager" style="height: 100px" required>{{ old('any_additional_feedback_manager')}}</textarea>

                  @if ($errors->has('any_additional_feedback_manager'))
                    <span class="text-danger">{{ $errors->first('any_additional_feedback_manager') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_feedback_manager' );
                  </script>

                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Top 3 things that you like about your job role. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_1" id="top_3_highlights_1" value="{{ old('top_3_highlights_1') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_1'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_2" id="top_3_highlights_2" value="{{ old('top_3_highlights_2') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_2'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_3" id="top_3_highlights_3" value="{{ old('top_3_highlights_3') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_3'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Three things that you wish to chnage in your job role. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_1" id="top_3_highlights_1" value="{{ old('top_3_highlights_1') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_1'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_2" id="top_3_highlights_2" value="{{ old('top_3_highlights_2') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_2'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_3" id="top_3_highlights_3" value="{{ old('top_3_highlights_3') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_3'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>

                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label"><strong>Please share your satisfaction on the parameters mentioned below, out of 5.</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="target" class="form-label rdioBtn">Satisfaction about job role:  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="target" id="target" value="NA" @if(old('target')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                  </span>

                  @if ($errors->has('target'))
                    <span class="text-danger">{{ $errors->first('target') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="response" class="form-label rdioBtn">I am well equipped to perform my job <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    
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

                    <input class="form-check-input" type="radio" name="response" id="response" value="NA" @if(old('response')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('response'))
                    <span class="text-danger">{{ $errors->first('response') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="jd" class="form-label rdioBtn">I am able to maintain work-life balance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">

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

                    <input class="form-check-input" type="radio" name="jd" id="jd" value="NA" @if(old('jd')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('jd'))
                    <span class="text-danger">{{ $errors->first('jd') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="reliability" class="form-label rdioBtn">I feel respected by my peers <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="reliability" id="reliability" value="NA" @if(old('reliability')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('reliability'))
                    <span class="text-danger">{{ $errors->first('reliability') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="team_spirit" class="form-label rdioBtn">My suggestions are heard & implemented <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="team_spirit" id="team_spirit" value="NA" @if(old('team_spirit')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('team_spirit'))
                    <span class="text-danger">{{ $errors->first('team_spirit') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="attendance" class="form-label rdioBtn">I share good bond with superiors <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="attendance" id="attendance" value="NA" @if(old('attendance')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('attendance'))
                    <span class="text-danger">{{ $errors->first('attendance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="attitude" class="form-label rdioBtn">I know what I am expected to do <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="attitude" id="attitude" value="NA" @if(old('attitude')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('attitude'))
                    <span class="text-danger">{{ $errors->first('attitude') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="rules" class="form-label rdioBtn">I fee I will grow in the organization <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="rules" id="rules" value="NA" @if(old('rules')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('rules'))
                    <span class="text-danger">{{ $errors->first('rules') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_exemplary_work_achievement" class="form-label">Any exemplary work or achievement that you would like to showcase? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_exemplary_work_achievement" id="any_exemplary_work_achievement" style="height: 100px" required>{{ old('any_exemplary_work_achievement')}}</textarea>

                  @if ($errors->has('any_exemplary_work_achievement'))
                    <span class="text-danger">{{ $errors->first('any_exemplary_work_achievement') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_exemplary_work_achievement' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_additional_trainings" class="form-label">Any additional trainings that you'd like? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_trainings" id="any_additional_trainings" style="height: 100px" required>{{ old('any_additional_trainings')}}</textarea>

                  @if ($errors->has('any_additional_trainings'))
                    <span class="text-danger">{{ $errors->first('any_additional_trainings') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_trainings' );
                  </script>

                </div>


                <div class="col-md-12 position-relative">
                  <label for="like_about_company_name" class="form-label">What do you like about company_name? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="like_about_company_name" id="like_about_company_name" style="height: 100px" required>{{ old('like_about_company_name')}}</textarea>

                  @if ($errors->has('like_about_company_name'))
                    <span class="text-danger">{{ $errors->first('like_about_company_name') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'like_about_company_name' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="dislike_about_company_name" class="form-label">What do you dislike about company_name? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="dislike_about_company_name" id="dislike_about_company_name" style="height: 100px" required>{{ old('dislike_about_company_name')}}</textarea>

                  @if ($errors->has('dislike_about_company_name'))
                    <span class="text-danger">{{ $errors->first('dislike_about_company_name') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'dislike_about_company_name' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="satisfied_employee_benefits_offered_company" class="form-label">How satisfied are you with employee benefits being offered by company_name? Please elaborate. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="satisfied_employee_benefits_offered_company" id="satisfied_employee_benefits_offered_company" style="height: 100px" required>{{ old('satisfied_employee_benefits_offered_company')}}</textarea>

                  @if ($errors->has('satisfied_employee_benefits_offered_company'))
                    <span class="text-danger">{{ $errors->first('satisfied_employee_benefits_offered_company') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'satisfied_employee_benefits_offered_company' );
                  </script>

                </div>
                

                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label"><strong>Please share your satisfaction on the parameters mentioned below, out of 5.</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="company_work_culture" class="form-label rdioBtn">Work culture  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="company_work_culture" id="company_work_culture" value="NA" @if(old('company_work_culture')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('company_work_culture'))
                    <span class="text-danger">{{ $errors->first('company_work_culture') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="processes_policies_well_defined" class="form-label rdioBtn">Recruitment process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="processes_policies_well_defined" id="processes_policies_well_defined" value="NA" @if(old('processes_policies_well_defined')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('processes_policies_well_defined'))
                    <span class="text-danger">{{ $errors->first('processes_policies_well_defined') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="enjoy_work_life_balance" class="form-label rdioBtn">Induction process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="enjoy_work_life_balance" id="enjoy_work_life_balance" value="NA" @if(old('enjoy_work_life_balance')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('enjoy_work_life_balance'))
                    <span class="text-danger">{{ $errors->first('enjoy_work_life_balance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="happy_with_treated_in_company" class="form-label rdioBtn">On-job training process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="happy_with_treated_in_company" id="happy_with_treated_in_company" value="NA" @if(old('happy_with_treated_in_company')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('happy_with_treated_in_company'))
                    <span class="text-danger">{{ $errors->first('happy_with_treated_in_company') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="job_title_kras" class="form-label rdioBtn">Clear communication about any changes in the policy <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="job_title_kras" id="job_title_kras" value="NA" @if(old('job_title_kras')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('job_title_kras'))
                    <span class="text-danger">{{ $errors->first('job_title_kras') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="necessary_resources_available" class="form-label rdioBtn">Feeling of belongingness in the organization <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="necessary_resources_available" id="necessary_resources_available" value="NA" @if(old('necessary_resources_available')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('necessary_resources_available'))
                    <span class="text-danger">{{ $errors->first('necessary_resources_available') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="feel_grow_in_organization" class="form-label rdioBtn">Having a best friend at work <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="feel_grow_in_organization" id="feel_grow_in_organization" value="NA" @if(old('feel_grow_in_organization')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('feel_grow_in_organization'))
                    <span class="text-danger">{{ $errors->first('feel_grow_in_organization') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="complete_clarity_my_role" class="form-label rdioBtn">Work-life balance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="complete_clarity_my_role" id="complete_clarity_my_role" value="NA" @if(old('complete_clarity_my_role')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('complete_clarity_my_role'))
                    <span class="text-danger">{{ $errors->first('complete_clarity_my_role') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_detailed_feedback_support_your_response" class="form-label">Any detailed feedback you would like to share to support your response on the above parameters? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_detailed_feedback_support_your_response" id="any_detailed_feedback_support_your_response" style="height: 100px" required>{{ old('any_detailed_feedback_support_your_response')}}</textarea>

                  @if ($errors->has('any_detailed_feedback_support_your_response'))
                    <span class="text-danger">{{ $errors->first('any_detailed_feedback_support_your_response') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_detailed_feedback_support_your_response' );
                  </script>

                </div>
                

                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label"><strong>Rate Reporting_Manager_name on the below-mentioned parameters out of 5</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="company_work_culture" class="form-label rdioBtn">Quickness in respond to your requests/queries/concerns?  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="company_work_culture" id="company_work_culture" value="NA" @if(old('company_work_culture')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('company_work_culture'))
                    <span class="text-danger">{{ $errors->first('company_work_culture') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="processes_policies_well_defined" class="form-label rdioBtn">How well have you received guidance? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="processes_policies_well_defined" id="processes_policies_well_defined" value="NA" @if(old('processes_policies_well_defined')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('processes_policies_well_defined'))
                    <span class="text-danger">{{ $errors->first('processes_policies_well_defined') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="enjoy_work_life_balance" class="form-label rdioBtn">How clearly are your goals set? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="enjoy_work_life_balance" id="enjoy_work_life_balance" value="NA" @if(old('enjoy_work_life_balance')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('enjoy_work_life_balance'))
                    <span class="text-danger">{{ $errors->first('enjoy_work_life_balance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="happy_with_treated_in_company" class="form-label rdioBtn">How transparent is Reporting_Manager_Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="happy_with_treated_in_company" id="happy_with_treated_in_company" value="NA" @if(old('happy_with_treated_in_company')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('happy_with_treated_in_company'))
                    <span class="text-danger">{{ $errors->first('happy_with_treated_in_company') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="job_title_kras" class="form-label rdioBtn">WPRs happen every week. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="job_title_kras" id="job_title_kras" value="NA" @if(old('job_title_kras')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>
                  @if ($errors->has('job_title_kras'))
                    <span class="text-danger">{{ $errors->first('job_title_kras') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="necessary_resources_available" class="form-label rdioBtn">How well does he/she adjust to changing priorities <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="necessary_resources_available" id="necessary_resources_available" value="NA" @if(old('necessary_resources_available')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('necessary_resources_available'))
                    <span class="text-danger">{{ $errors->first('necessary_resources_available') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="feel_grow_in_organization" class="form-label">How comfortable do you feel in sharing your feedback with him/her? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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
                  <label for="complete_clarity_my_role" class="form-label">How well are you able to learn under guidance? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                    <input class="form-check-input" type="radio" name="complete_clarity_my_role" id="complete_clarity_my_role" value="NA" @if(old('complete_clarity_my_role')=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                  </span>

                  @if ($errors->has('complete_clarity_my_role'))
                    <span class="text-danger">{{ $errors->first('complete_clarity_my_role') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="our_organization_believes_mantra" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra" id="our_organization_believes_mantra" style="height: 100px" required>{{ old('our_organization_believes_mantra')}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra' );
                  </script>

                </div>


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How quickly does he/she respond to your requests/queries/concerns? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How well have you received guidance from him/her? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How clearly are your goals set by him/her? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How transparent is he/she? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How frequent does your 1:1 happen? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How well does he/she adjust to changing priorities? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How comfortable do you feel in sharing your feedback with him/her? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share top three strengths. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_1" id="top_3_highlights_1" value="{{ old('top_3_highlights_1') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_1'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_2" id="top_3_highlights_2" value="{{ old('top_3_highlights_2') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_2'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_3" id="top_3_highlights_3" value="{{ old('top_3_highlights_3') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_3'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share three areas of improvement. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_1" id="top_3_highlights_1" value="{{ old('top_3_highlights_1') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_1'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_2" id="top_3_highlights_2" value="{{ old('top_3_highlights_2') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_2'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_3" id="top_3_highlights_3" value="{{ old('top_3_highlights_3') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_3'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="our_organization_believes_mantra" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra" id="our_organization_believes_mantra" style="height: 100px" required>{{ old('our_organization_believes_mantra')}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra' );
                  </script>

                </div>


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How quickly does he/she respond to your requests/queries/concerns? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How well have you received guidance from him/her? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How clearly are your goals set by him/her? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How transparent is he/she? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How frequent does your 1:1 happen? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How well does he/she adjust to changing priorities? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="overall_happy_with_job_role" class="form-label">How comfortable do you feel in sharing your feedback with him/her? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share top three strengths. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_1" id="top_3_highlights_1" value="{{ old('top_3_highlights_1') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_1'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_2" id="top_3_highlights_2" value="{{ old('top_3_highlights_2') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_2'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_3" id="top_3_highlights_3" value="{{ old('top_3_highlights_3') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_3'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share three areas of improvement. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_1" id="top_3_highlights_1" value="{{ old('top_3_highlights_1') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_1'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_2" id="top_3_highlights_2" value="{{ old('top_3_highlights_2') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_2'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_3" id="top_3_highlights_3" value="{{ old('top_3_highlights_3') }}" required>
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_highlights_3'))
                        <span class="text-danger">{{ $errors->first('top_3_highlights_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="our_organization_believes_mantra" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra" id="our_organization_believes_mantra" style="height: 100px" required>{{ old('our_organization_believes_mantra')}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra' );
                  </script>

                </div>


                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label"><strong>"Rate the Departments out of 5"</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="integrity" class="form-label">Admin Operations <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('integrity'))
                    <span class="text-danger">{{ $errors->first('integrity') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="win_win" class="form-label">Advertiser Sales <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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
                  @if ($errors->has('win_win'))
                    <span class="text-danger">{{ $errors->first('win_win') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="synergize" class="form-label">Advertisers <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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
                  @if ($errors->has('synergize'))
                    <span class="text-danger">{{ $errors->first('synergize') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="closure" class="form-label">Finance & Accounts <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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
                  @if ($errors->has('closure'))
                    <span class="text-danger">{{ $errors->first('closure') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="knowledge" class="form-label">Human Resources <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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
                  @if ($errors->has('knowledge'))
                    <span class="text-danger">{{ $errors->first('knowledge') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="kiss" class="form-label">Management <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('kiss'))
                    <span class="text-danger">{{ $errors->first('kiss') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="innovation" class="form-label">Network Operations <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('innovation'))
                    <span class="text-danger">{{ $errors->first('innovation') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">Pocket Money <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">Publishers <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">Tech Operations - Development <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">Support (EA/PA) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">Education <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">iGaming <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">Tech Operations - Shopify <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">Tech Operations - Creative <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">Mobile <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label">vCommission - UK <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
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

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback_any_department" class="form-label">Any additional feedback for any department that you would like to share? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback_any_department" id="any_additional_feedback_any_department" style="height: 100px" required>{{ old('any_additional_feedback_any_department')}}</textarea>

                  @if ($errors->has('any_additional_feedback_any_department'))
                    <span class="text-danger">{{ $errors->first('any_additional_feedback_any_department') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_feedback_any_department' );
                  </script>

                </div>
                
                <div class="col-md-12 position-relative">
                  <label for="any_issue_concern_management" class="form-label">Any issue or concern that you would like to talk to management about? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_issue_concern_management" id="any_issue_concern_management" style="height: 100px" required>{{ old('any_issue_concern_management') }}</textarea>
                  <div class="invalid-feedback">
                    What’s the best experience you have had during your tenure till date?
                  </div>
                  @if ($errors->has('any_issue_concern_management'))
                    <span class="text-danger">{{ $errors->first('any_issue_concern_management') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'best_experience_tenure' );
                  </script>

                </div>


                <div class="col-12">
                  <input type="submit" name="submit" value="Save in Draft" class="btn btn-info">

                  <input type="submit" name="submit" value="Publish" class="btn btn-primary">
                </div>

              </form>
              <!-- End Custom Styled Validation with Tooltips -->
              <br>
              <p><strong>Note:</strong> <span class="text-danger"><strong>*</strong></span> mandatory fields.</p>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection