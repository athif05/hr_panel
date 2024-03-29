@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Annual Review Stakeholder Feedback Form | {{ env('MY_SITE_NAME') }}</title>

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

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Fill Annual Review Stakeholder Feedback Form</h5>
              

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-annual-review-stakeholder-feedback-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="filled_for" id="filled_for" value="{{ $filled_for }}">
                <input type="hidden" name="filled_by" id="filled_by" value="{{ $filled_by }}">
                <input type="hidden" name="annual_review_form_id" id="annual_review_form_id" value="{{ $survey_form_id }}">
                
                <div class="hiring_survey_heading"><strong>Stakeholder Details</strong></div>

                <div class="col-md-6 position-relative">
                  <label for="manager_name" class="form-label">Your Name</label>
                  <input type="text" class="form-control disable-text" name="manager_name" id="manager_name" value="{{ $manager_details['full_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="manager_member_id" class="form-label">Your Member Code</label>
                  <input type="text" class="form-control disable-text" name="manager_member_id" id="manager_member_id" value="{{ $manager_details['member_id'] }}" readonly>
                </div>

                <input type="hidden" name="manager_company_name" id="manager_company_name" value="{{ $manager_details['company_name'] }}" />
                <div class="col-md-6 position-relative">
                  <label for="manager_company_id" class="form-label">Company <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="manager_company_id" id="manager_company_id" disabled>
                    <option value="">Choose...</option>
                    @foreach($company_names as $company_name)
                    <option value="{{$company_name['id']}}" @if(($manager_details['company_id'])==$company_name['id']) selected @endif>{{$company_name['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="manager_designation_id" class="form-label">Designation <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="manager_designation_id" id="manager_designation_id" disabled>
                    <option value="">Choose...</option>
                    @foreach($designation_names as $designation_name)
                    <option value="{{$designation_name['id']}}" @if(($manager_details['designation'])==$designation_name['id']) selected @endif>{{$designation_name['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="manager_department_id" class="form-label">Department <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="manager_department_id" id="manager_department_id" disabled>
                    <option value="">Choose...</option>
                    @foreach($department_names as $department_name)
                    <option value="{{$department_name['id']}}" @if(($manager_details['department'])==$department_name['id']) selected @endif>{{$department_name['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="manager_email" class="form-label">Email</label>
                  <input type="email" class="form-control disable-text" name="manager_email" id="manager_email" value="{{ $manager_details['email'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="manager_location_id" class="form-label">Location <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="manager_location_id" id="manager_location_id" disabled>
                    <option value="">Choose...</option>
                    @foreach($company_locations as $company_location)
                    <option value="{{$company_location['id']}}" @if(($manager_details['company_location_id'])==$company_location['id']) selected @endif>{{$company_location['name']}}</option>
                    @endforeach
                  </select>
                </div>



                <div class="hiring_survey_heading"><strong>Member Details</strong></div>



                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Member Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $member_details['full_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_code" class="form-label">Member Code</label>
                  <input type="text" class="form-control disable-text" name="member_code" id="member_code" value="{{ $member_details['member_id'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_designation" class="form-label">Designation <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="member_designation" id="member_designation" disabled>
                    <option value="">Choose...</option>
                    @foreach($designation_names as $designation_name)
                    <option value="{{$designation_name['id']}}" @if(($member_details['designation'])==$designation_name['id']) selected @endif>{{$designation_name['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_department" class="form-label">Department <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="member_department" id="member_department" disabled>
                    <option value="">Choose...</option>
                    @foreach($department_names as $department_name)
                    <option value="{{$department_name['id']}}" @if(($member_details['department'])==$department_name['id']) selected @endif>{{$department_name['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_email" class="form-label">Email</label>
                  <input type="email" class="form-control disable-text" name="member_email" id="member_email" value="{{ $member_details['email'] }}" readonly>
                </div>

                <div class="col-md-12 position-relative">
                  <label class="card-title"><strong>Rate {{ $member_details['full_name'] }} on the following parameters</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="quality_of_the_work" class="form-label rdioBtn">Quality of the work  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_1">
                        <input type="radio" name="quality_of_the_work" id="quality_of_the_work" value="1" @if(old('quality_of_the_work')=='1') checked @elseif(old('quality_of_the_work')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="quality_of_the_work" id="quality_of_the_work" value="2" @if(old('quality_of_the_work')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="quality_of_the_work" id="quality_of_the_work" value="3" @if(old('quality_of_the_work')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="quality_of_the_work" id="quality_of_the_work" value="4" @if(old('quality_of_the_work')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="quality_of_the_work" id="quality_of_the_work" value="5" @if(old('quality_of_the_work')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>

                  @if ($errors->has('quality_of_the_work'))
                    <span class="text-danger">{{ $errors->first('quality_of_the_work') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="tat_adherence" class="form-label rdioBtn">TAT Adherence <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_1">
                        <input type="radio" name="tat_adherence" id="tat_adherence" value="1" @if(old('tat_adherence')=='1') checked @elseif(old('tat_adherence')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="tat_adherence" id="tat_adherence" value="2" @if(old('tat_adherence')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="tat_adherence" id="tat_adherence" value="3" @if(old('tat_adherence')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="tat_adherence" id="tat_adherence" value="4" @if(old('tat_adherence')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="tat_adherence" id="tat_adherence" value="5" @if(old('tat_adherence')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('tat_adherence'))
                    <span class="text-danger">{{ $errors->first('tat_adherence') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="ability_to_understand_project_requirements" class="form-label rdioBtn">Ability to understand project requirements  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_1">
                        <input type="radio" name="ability_to_understand_project_requirements" id="ability_to_understand_project_requirements" value="1" @if(old('ability_to_understand_project_requirements')=='1') checked @elseif(old('ability_to_understand_project_requirements')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="ability_to_understand_project_requirements" id="ability_to_understand_project_requirements" value="2" @if(old('ability_to_understand_project_requirements')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="ability_to_understand_project_requirements" id="ability_to_understand_project_requirements" value="3" @if(old('ability_to_understand_project_requirements')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="ability_to_understand_project_requirements" id="ability_to_understand_project_requirements" value="4" @if(old('ability_to_understand_project_requirements')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="ability_to_understand_project_requirements" id="ability_to_understand_project_requirements" value="5" @if(old('ability_to_understand_project_requirements')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('ability_to_understand_project_requirements'))
                    <span class="text-danger">{{ $errors->first('ability_to_understand_project_requirements') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="ability_to_absorb_feedback" class="form-label rdioBtn">Ability to absorb feedback <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_1">
                        <input type="radio" name="ability_to_absorb_feedback" id="ability_to_absorb_feedback" value="1" @if(old('ability_to_absorb_feedback')=='1') checked @elseif(old('ability_to_absorb_feedback')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="ability_to_absorb_feedback" id="ability_to_absorb_feedback" value="2" @if(old('ability_to_absorb_feedback')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="ability_to_absorb_feedback" id="ability_to_absorb_feedback" value="3" @if(old('ability_to_absorb_feedback')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="ability_to_absorb_feedback" id="ability_to_absorb_feedback" value="4" @if(old('ability_to_absorb_feedback')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="ability_to_absorb_feedback" id="ability_to_absorb_feedback" value="5" @if(old('ability_to_absorb_feedback')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('ability_to_absorb_feedback'))
                    <span class="text-danger">{{ $errors->first('ability_to_absorb_feedback') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="responsiveness_on_all_platforms" class="form-label rdioBtn">Responsiveness on all platforms <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_1">
                        <input type="radio" name="responsiveness_on_all_platforms" id="responsiveness_on_all_platforms" value="1" @if(old('responsiveness_on_all_platforms')=='1') checked @elseif(old('responsiveness_on_all_platforms')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="responsiveness_on_all_platforms" id="responsiveness_on_all_platforms" value="2" @if(old('responsiveness_on_all_platforms')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="responsiveness_on_all_platforms" id="responsiveness_on_all_platforms" value="3" @if(old('responsiveness_on_all_platforms')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="responsiveness_on_all_platforms" id="responsiveness_on_all_platforms" value="4" @if(old('responsiveness_on_all_platforms')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="responsiveness_on_all_platforms" id="responsiveness_on_all_platforms" value="5" @if(old('responsiveness_on_all_platforms')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('responsiveness_on_all_platforms'))
                    <span class="text-danger">{{ $errors->first('responsiveness_on_all_platforms') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_happy_you_with_performance" class="form-label rdioBtn">How happy are you with {{ $member_details['full_name'] }} performance? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_1">
                        <input type="radio" name="how_happy_you_with_performance" id="how_happy_you_with_performance" value="1" @if(old('how_happy_you_with_performance')=='1') checked @elseif(old('how_happy_you_with_performance')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="how_happy_you_with_performance" id="how_happy_you_with_performance" value="2" @if(old('how_happy_you_with_performance')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="how_happy_you_with_performance" id="how_happy_you_with_performance" value="3" @if(old('how_happy_you_with_performance')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="how_happy_you_with_performance" id="how_happy_you_with_performance" value="4" @if(old('how_happy_you_with_performance')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="how_happy_you_with_performance" id="how_happy_you_with_performance" value="5" @if(old('how_happy_you_with_performance')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                  </span>
                  @if ($errors->has('how_happy_you_with_performance'))
                    <span class="text-danger">{{ $errors->first('how_happy_you_with_performance') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="three_qualities" class="form-label">Share three qualities of {{ $member_details['full_name'] }} <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_qualities_1" id="three_qualities_1" value="{{ old('three_qualities_1') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('three_qualities_1'))
                        <span class="text-danger">{{ $errors->first('three_qualities_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_qualities_2" id="three_qualities_2" value="{{ old('three_qualities_2') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('three_qualities_2'))
                        <span class="text-danger">{{ $errors->first('three_qualities_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_qualities_3" id="three_qualities_3" value="{{ old('three_qualities_3') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('three_qualities_3'))
                        <span class="text-danger">{{ $errors->first('three_qualities_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="three_areas_of_improvement" class="form-label">Share three areas of improvement for {{ $member_details['full_name'] }} <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_of_improvement_1" id="three_areas_of_improvement_1" value="{{ old('three_areas_of_improvement_1') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_of_improvement_1'))
                        <span class="text-danger">{{ $errors->first('three_areas_of_improvement_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_of_improvement_2" id="three_areas_of_improvement_2" value="{{ old('three_areas_of_improvement_2') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_of_improvement_2'))
                        <span class="text-danger">{{ $errors->first('three_areas_of_improvement_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_of_improvement_3" id="three_areas_of_improvement_3" value="{{ old('three_areas_of_improvement_3') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_of_improvement_3'))
                        <span class="text-danger">{{ $errors->first('three_areas_of_improvement_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                  
                </div>
                


                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback" class="form-label">Any additional feedback that you would like to share about {{ $member_details['full_name'] }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback" id="any_additional_feedback" style="height: 100px">{{ old('any_additional_feedback')}}</textarea>

                  @if ($errors->has('any_additional_feedback'))
                    <span class="text-danger">{{ $errors->first('any_additional_feedback') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_feedback' );
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