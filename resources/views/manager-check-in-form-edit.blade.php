@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Manager Check-In Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Update Manager Check-In Form</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif


              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-manager-check-in-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $check_in_manager_details->id }}">
                <input type="hidden" name="member_id" id="member_id" value="{{ $member_details['id'] }}">
                <input type="hidden" name="manager_id" id="manager_id" value="{{ $manager_details['id'] }}">
                
                <div class="hiring_survey_heading"><strong>Manager Details</strong></div>

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
                  <label class="card-title">Rate {{ $member_details['full_name'] }} level of understanding on the following parameters</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="departmental_processes" class="form-label rdioBtn">Departmental Processes  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="departmental_processes" id="departmental_processes" value="NA" @if(old('departmental_processes', $check_in_manager_details->departmental_processes)=='NA') checked @elseif(old('departmental_processes')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="departmental_processes" id="departmental_processes" value="1" @if(old('departmental_processes',$check_in_manager_details->departmental_processes)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="departmental_processes" id="departmental_processes" value="2" @if(old('departmental_processes',$check_in_manager_details->departmental_processes)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="departmental_processes" id="departmental_processes" value="3" @if(old('departmental_processes',$check_in_manager_details->departmental_processes)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="departmental_processes" id="departmental_processes" value="4" @if(old('departmental_processes',$check_in_manager_details->departmental_processes)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="departmental_processes" id="departmental_processes" value="5" @if(old('departmental_processes',$check_in_manager_details->departmental_processes)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>

                  @if ($errors->has('departmental_processes'))
                    <span class="text-danger">{{ $errors->first('departmental_processes') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="tod_eod_process" class="form-label rdioBtn">TOD/EOD Process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="tod_eod_process" id="tod_eod_process" value="NA" @if(old('tod_eod_process', $check_in_manager_details->tod_eod_process)=='NA') checked @elseif(old('tod_eod_process')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="tod_eod_process" id="tod_eod_process" value="1" @if(old('tod_eod_process',$check_in_manager_details->tod_eod_process)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="tod_eod_process" id="tod_eod_process" value="2" @if(old('tod_eod_process',$check_in_manager_details->tod_eod_process)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="tod_eod_process" id="tod_eod_process" value="3" @if(old('tod_eod_process',$check_in_manager_details->tod_eod_process)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="tod_eod_process" id="tod_eod_process" value="4" @if(old('tod_eod_process',$check_in_manager_details->tod_eod_process)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="tod_eod_process" id="tod_eod_process" value="5" @if(old('tod_eod_process',$check_in_manager_details->tod_eod_process)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
                  @if ($errors->has('tod_eod_process'))
                    <span class="text-danger">{{ $errors->first('tod_eod_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="month_summary_process" class="form-label rdioBtn">Month Summary Process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="month_summary_process" id="month_summary_process" value="NA" @if(old('month_summary_process', $check_in_manager_details->month_summary_process)=='NA') checked @elseif(old('month_summary_process')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="month_summary_process" id="month_summary_process" value="1" @if(old('month_summary_process',$check_in_manager_details->month_summary_process)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="month_summary_process" id="month_summary_process" value="2" @if(old('month_summary_process',$check_in_manager_details->month_summary_process)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="month_summary_process" id="month_summary_process" value="3" @if(old('month_summary_process',$check_in_manager_details->month_summary_process)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="month_summary_process" id="month_summary_process" value="4" @if(old('month_summary_process',$check_in_manager_details->month_summary_process)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="month_summary_process" id="month_summary_process" value="5" @if(old('month_summary_process',$check_in_manager_details->month_summary_process)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
                  @if ($errors->has('month_summary_process'))
                    <span class="text-danger">{{ $errors->first('month_summary_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="relevant_software_tools" class="form-label rdioBtn">Relevant software/tools <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="relevant_software_tools" id="relevant_software_tools" value="NA" @if(old('relevant_software_tools', $check_in_manager_details->relevant_software_tools)=='NA') checked @elseif(old('relevant_software_tools')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="relevant_software_tools" id="relevant_software_tools" value="1" @if(old('relevant_software_tools',$check_in_manager_details->relevant_software_tools)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="relevant_software_tools" id="relevant_software_tools" value="2" @if(old('relevant_software_tools',$check_in_manager_details->relevant_software_tools)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="relevant_software_tools" id="relevant_software_tools" value="3" @if(old('relevant_software_tools',$check_in_manager_details->relevant_software_tools)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="relevant_software_tools" id="relevant_software_tools" value="4" @if(old('relevant_software_tools',$check_in_manager_details->relevant_software_tools)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="relevant_software_tools" id="relevant_software_tools" value="5" @if(old('relevant_software_tools',$check_in_manager_details->relevant_software_tools)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
                  @if ($errors->has('relevant_software_tools'))
                    <span class="text-danger">{{ $errors->first('relevant_software_tools') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="organization_policies_processes" class="form-label rdioBtn">Organization's Policies & Processes <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="organization_policies_processes" id="organization_policies_processes" value="NA" @if(old('organization_policies_processes', $check_in_manager_details->organization_policies_processes)=='NA') checked @elseif(old('organization_policies_processes')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="organization_policies_processes" id="organization_policies_processes" value="1" @if(old('organization_policies_processes',$check_in_manager_details->organization_policies_processes)=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="organization_policies_processes" id="organization_policies_processes" value="2" @if(old('organization_policies_processes',$check_in_manager_details->organization_policies_processes)=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="organization_policies_processes" id="organization_policies_processes" value="3" @if(old('organization_policies_processes',$check_in_manager_details->organization_policies_processes)=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="organization_policies_processes" id="organization_policies_processes" value="4" @if(old('organization_policies_processes',$check_in_manager_details->organization_policies_processes)=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="organization_policies_processes" id="organization_policies_processes" value="5" @if(old('organization_policies_processes',$check_in_manager_details->organization_policies_processes)=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
                  @if ($errors->has('organization_policies_processes'))
                    <span class="text-danger">{{ $errors->first('organization_policies_processes') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="which_category_like_place" class="form-label">Which category would  you like to place {{ $member_details['full_name'] }} in? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="which_category_like_place" id="which_category_like_place" value="A" @if(old('which_category_like_place',$check_in_manager_details->which_category_like_place)=='A') checked @endif>
                    <label class="form-check-label" for="gridRadios1">A</label>

                    <input class="form-check-input" type="radio" name="which_category_like_place" id="which_category_like_place" value="B" @if(old('which_category_like_place',$check_in_manager_details->which_category_like_place)=='B') checked @endif>
                    <label class="form-check-label" for="gridRadios1">B</label>

                    <input class="form-check-input" type="radio" name="which_category_like_place" id="which_category_like_place" value="C" @if(old('which_category_like_place',$check_in_manager_details->which_category_like_place)=='C') checked @endif>
                    <label class="form-check-label" for="gridRadios1">C</label>

                    <input class="form-check-input" type="radio" name="which_category_like_place" id="which_category_like_place" value="D" @if(old('which_category_like_place',$check_in_manager_details->which_category_like_place)=='D') checked @endif>
                    <label class="form-check-label" for="gridRadios1">D</label>
                  </span>
                  @if ($errors->has('which_category_like_place'))
                    <span class="text-danger">{{ $errors->first('which_category_like_place') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label class="card-title">Rate Organization's Policies & Processes on core values of the organization</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="integrity" class="form-label rdioBtn">Integrity  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="integrity" id="integrity" value="+/+" @if(old('integrity',$check_in_manager_details->integrity)=='+/+') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="integrity" id="integrity" value="+/-" @if(old('integrity',$check_in_manager_details->integrity)=='+/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="integrity" id="integrity" value="-/-" @if(old('integrity',$check_in_manager_details->integrity)=='-/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('integrity'))
                    <span class="text-danger">{{ $errors->first('integrity') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="win_win" class="form-label rdioBtn">Win-Win  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="win_win" id="win_win" value="+/+" @if(old('win_win',$check_in_manager_details->win_win)=='+/+') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="win_win" id="win_win" value="+/-" @if(old('win_win',$check_in_manager_details->win_win)=='+/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="win_win" id="win_win" value="-/-" @if(old('win_win',$check_in_manager_details->win_win)=='-/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('win_win'))
                    <span class="text-danger">{{ $errors->first('win_win') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="synergise" class="form-label rdioBtn">Synergise  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="synergise" id="synergise" value="+/+" @if(old('synergise',$check_in_manager_details->synergise)=='+/+') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="synergise" id="synergise" value="+/-" @if(old('synergise',$check_in_manager_details->synergise)=='+/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="synergise" id="synergise" value="-/-" @if(old('synergise',$check_in_manager_details->synergise)=='-/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('synergise'))
                    <span class="text-danger">{{ $errors->first('synergise') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="closure" class="form-label rdioBtn">Closure  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="closure" id="closure" value="+/+" @if(old('closure',$check_in_manager_details->closure)=='+/+') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="closure" id="closure" value="+/-" @if(old('closure',$check_in_manager_details->closure)=='+/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="closure" id="closure" value="-/-" @if(old('closure',$check_in_manager_details->closure)=='-/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('closure'))
                    <span class="text-danger">{{ $errors->first('closure') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="knowledge" class="form-label rdioBtn">Knowledge  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="knowledge" id="knowledge" value="+/+" @if(old('knowledge',$check_in_manager_details->knowledge)=='+/+') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="knowledge" id="knowledge" value="+/-" @if(old('knowledge',$check_in_manager_details->knowledge)=='+/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="knowledge" id="knowledge" value="-/-" @if(old('knowledge',$check_in_manager_details->knowledge)=='-/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('knowledge'))
                    <span class="text-danger">{{ $errors->first('knowledge') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="kiss" class="form-label rdioBtn">KISS  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="kiss" id="kiss" value="+/+" @if(old('kiss',$check_in_manager_details->kiss)=='+/+') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="kiss" id="kiss" value="+/-" @if(old('kiss',$check_in_manager_details->kiss)=='+/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="kiss" id="kiss" value="-/-" @if(old('kiss',$check_in_manager_details->kiss)=='-/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('kiss'))
                    <span class="text-danger">{{ $errors->first('kiss') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="innovation" class="form-label rdioBtn">Innovation  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="innovation" id="innovation" value="+/+" @if(old('innovation',$check_in_manager_details->innovation)=='+/+') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="innovation" id="innovation" value="+/-" @if(old('innovation',$check_in_manager_details->innovation)=='+/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="innovation" id="innovation" value="-/-" @if(old('innovation',$check_in_manager_details->innovation)=='-/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('innovation'))
                    <span class="text-danger">{{ $errors->first('innovation') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="celebration" class="form-label rdioBtn">Celebration  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="celebration" id="celebration" value="+/+" @if(old('celebration',$check_in_manager_details->celebration)=='+/+') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/+</label>

                    <input class="form-check-input" type="radio" name="celebration" id="celebration" value="+/-" @if(old('celebration',$check_in_manager_details->celebration)=='+/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">+/-</label>

                    <input class="form-check-input" type="radio" name="celebration" id="celebration" value="-/-" @if(old('celebration',$check_in_manager_details->celebration)=='-/-') checked @endif>
                    <label class="form-check-label" for="gridRadios1">-/-</label>
                  </span>

                  @if ($errors->has('celebration'))
                    <span class="text-danger">{{ $errors->first('celebration') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="major_achievements" class="form-label">What have been {{ $member_details['full_name'] }} major achievements? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="major_achievements" id="major_achievements" style="height: 100px">{{ old('major_achievements',$check_in_manager_details->major_achievements)}}</textarea>

                  @if ($errors->has('major_achievements'))
                    <span class="text-danger">{{ $errors->first('major_achievements') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'major_achievements' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="major_fallbacks" class="form-label">What have been {{ $member_details['full_name'] }} major fallbacks? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="major_fallbacks" id="major_fallbacks" style="height: 100px">{{ old('major_fallbacks',$check_in_manager_details->major_fallbacks)}}</textarea>

                  @if ($errors->has('major_fallbacks'))
                    <span class="text-danger">{{ $errors->first('major_fallbacks') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'major_fallbacks' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="recommend_to_change_approach" class="form-label">What would you recommend to change about {{ $member_details['full_name'] }} approach towards the work/otherwise? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="recommend_to_change_approach" id="recommend_to_change_approach" style="height: 100px">{{ old('recommend_to_change_approach',$check_in_manager_details->recommend_to_change_approach)}}</textarea>

                  @if ($errors->has('recommend_to_change_approach'))
                    <span class="text-danger">{{ $errors->first('recommend_to_change_approach') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'recommend_to_change_approach' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="adding_value_your_team_expectations" class="form-label">Do you see {{ $member_details['full_name'] }} adding value to your team & meeting your expectations? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="adding_value_your_team_expectations" id="adding_value_your_team_expectations" value="Yes" @if(old('adding_value_your_team_expectations',$check_in_manager_details->adding_value_your_team_expectations)=='Yes') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="adding_value_your_team_expectations" id="adding_value_your_team_expectations" value="No" @if(old('adding_value_your_team_expectations',$check_in_manager_details->adding_value_your_team_expectations)=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>
                  </span>
                  @if ($errors->has('adding_value_your_team_expectations'))
                    <span class="text-danger">{{ $errors->first('adding_value_your_team_expectations') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="justify_above_answer" class="form-label">Pleasse justify above answer with examples <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="justify_above_answer" id="justify_above_answer" style="height: 100px">{{ old('justify_above_answer',$check_in_manager_details->justify_above_answer)}}</textarea>

                  @if ($errors->has('justify_above_answer'))
                    <span class="text-danger">{{ $errors->first('justify_above_answer') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'justify_above_answer' );
                  </script>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="long_term_goal" class="form-label">What kind of long-term goal do you foresee for {{ $member_details['full_name'] }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="long_term_goal" id="long_term_goal" style="height: 100px">{{ old('long_term_goal',$check_in_manager_details->long_term_goal)}}</textarea>

                  @if ($errors->has('long_term_goal'))
                    <span class="text-danger">{{ $errors->first('long_term_goal') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'long_term_goal' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback" class="form-label">Any Additional feedback for {{ $member_details['full_name'] }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback" id="any_additional_feedback" style="height: 100px">{{ old('any_additional_feedback',$check_in_manager_details->any_additional_feedback)}}</textarea>

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