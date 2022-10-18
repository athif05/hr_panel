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
              <h5 class="card-title">Update Fresh Eye Journal Form</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-fresh-eye-journal-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $fresh_eye_journal_details->id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $fresh_eye_journal_details->user_id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Full Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $fresh_eye_journal_details->member_name }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_id" class="form-label">Member ID</label>
                  <input type="text" class="form-control disable-text" name="member_id" id="member_id" value="{{ $fresh_eye_journal_details->member_id }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_id'))
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                  @endif
                </div>

                <input type="hidden" name="designation" id="designation" value="{{$fresh_eye_journal_details->designation}}" />
                <div class="col-md-6 position-relative">
                  <label for="designation" class="form-label">Designation</label>
                  <select class="form-select disable-text" name="designation_dis" id="designation_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($designation_details as $designation_detail)
                    <option value="{{$designation_detail['id']}}" @if(($fresh_eye_journal_details->designation)==$designation_detail['id']) selected @endif>{{$designation_detail['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid designation.
                  </div>
                  @if ($errors->has('designation'))
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                  @endif
                </div>

                <input type="hidden" name="department" id="department" value="{{$fresh_eye_journal_details->department}}" />
                <div class="col-md-6 position-relative">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select disable-text" name="department_dis" id="department_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($department_details as $department_detail)
                    <option value="{{$department_detail['id']}}" @if(($fresh_eye_journal_details->department)==$department_detail['id']) selected @endif>{{$department_detail['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid department.
                  </div>
                  @if ($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
                </div>


                <input type="hidden" name="company_name_ajax" id="company_name_ajax" value="{{ $fresh_eye_journal_details->company_name_ajax }}">

                <input type="hidden" name="company_name_fresh" id="company_name_fresh" value="{{ $fresh_eye_journal_details->company_name_fresh }}" />
                <div class="col-md-6 position-relative">
                  <label for="company_name_fresh" class="form-label">Company<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="company_name_fresh_dis" id="company_name_fresh_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($company_names as $company_name)
                      <option value="{{$company_name['id']}}" @if(($fresh_eye_journal_details->company_name_fresh)==$company_name['id']) selected @endif>{{$company_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid company.
                  </div>
                  @if ($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
                </div>

                <input type="hidden" name="location_name" id="location_name" value="{{$fresh_eye_journal_details->location_name}}" />
                <div class="col-md-6 position-relative">
                  <label for="location_name" class="form-label">Location <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="location_name_dis" id="location_name_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($company_locations as $company_location)
                      <option value="{{$company_location['id']}}" @if(($fresh_eye_journal_details->location_name)==$company_location['id']) selected @endif>{{$company_location['name']}}</option>
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
                  <label for="tenure_in_month" class="form-label">Tenure in {{ $fresh_eye_journal_details->company_name_ajax }} (in months)</label>
                  <input type="email" class="form-control disable-text" name="tenure_in_month" id="tenure_in_month" value="{{ $fresh_eye_journal_details->tenure_in_month }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('tenure_in_month'))
                    <span class="text-danger">{{ $errors->first('tenure_in_month') }}</span>
                  @endif
                </div>


                <input type="hidden" name="reporting_manager_name_ajax" id="reporting_manager_name_ajax" value="{{ $fresh_eye_journal_details->reporting_manager_name_ajax }}">
                
                <input type="hidden" name="reporting_manager_fresh" id="reporting_manager_fresh" value="{{$fresh_eye_journal_details->reporting_manager_fresh}}" />
                <div class="col-md-6 position-relative">
                  <label for="reporting_manager_fresh" class="form-label">Name of Reporting Manager <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="reporting_manager_fresh_dis" id="reporting_manager_fresh_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($manager_details as $manager_detail)
                    <?php  $reporting_manager_name=$manager_detail['first_name'].' '.$manager_detail['last_name']; ?>
                      <option value="{{$manager_detail['id']}}" @if(($fresh_eye_journal_details->reporting_manager_fresh)==$reporting_manager_name) selected @endif>{{$manager_detail['first_name']}} {{$manager_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select reporting manager.
                  </div>
                  @if ($errors->has('reporting_manager_fresh'))
                    <span class="text-danger">{{ $errors->first('reporting_manager_fresh') }}</span>
                  @endif
                </div>



                <input type="hidden" name="head_of_department_id_ajax" id="head_of_department_id_ajax" value="{{ $fresh_eye_journal_details->head_of_department_name_ajax }}">
                <div class="col-md-6 position-relative">
                  <label for="head_of_department" class="form-label">Name of Department Head</label>
                  <input type="text" class="form-control disable-text" name="head_of_department" id="head_of_department" value="{{ $fresh_eye_journal_details->head_of_department }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('head_of_department'))
                    <span class="text-danger">{{ $errors->first('head_of_department') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="your_journey_so_far_in_company" class="form-label">How has your journey been so far in <span id="any_additional_feedback_manager_company_name">{{ old('company_name_ajax',$fresh_eye_journal_details->company_name_ajax) }}</span>? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="your_journey_so_far_in_company" id="your_journey_so_far_in_company" style="height: 100px">{{ old('your_journey_so_far_in_company', $fresh_eye_journal_details->your_journey_so_far_in_company)}}</textarea>

                  @if ($errors->has('your_journey_so_far_in_company'))
                    <span class="text-danger">{{ $errors->first('your_journey_so_far_in_company') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'your_journey_so_far_in_company' );
                  </script>

                </div>


                <div class="col-md-12 position-relative">
                  <label for="top_3_things_like_your_job" class="form-label">Top 3 things that you like about your job role <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_things_like_your_job_1" id="top_3_things_like_your_job_1" value="{{ old('top_3_things_like_your_job_1',$fresh_eye_journal_details->top_3_things_like_your_job_1) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_things_like_your_job_1'))
                        <span class="text-danger">{{ $errors->first('top_3_things_like_your_job_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_things_like_your_job_2" id="top_3_things_like_your_job_2" value="{{ old('top_3_things_like_your_job_2',$fresh_eye_journal_details->top_3_things_like_your_job_2) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_things_like_your_job_2'))
                        <span class="text-danger">{{ $errors->first('top_3_things_like_your_job_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_things_like_your_job_3" id="top_3_things_like_your_job_3" value="{{ old('top_3_things_like_your_job_3',$fresh_eye_journal_details->top_3_things_like_your_job_3) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_things_like_your_job_3'))
                        <span class="text-danger">{{ $errors->first('top_3_things_like_your_job_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="three_things_wish_change_job_role" class="form-label">Three things that you wish to change in your job role <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_things_wish_change_job_role_1" id="three_things_wish_change_job_role_1" value="{{ old('three_things_wish_change_job_role_1',$fresh_eye_journal_details->three_things_wish_change_job_role_1) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_things_wish_change_job_role_1'))
                        <span class="text-danger">{{ $errors->first('three_things_wish_change_job_role_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_things_wish_change_job_role_2" id="three_things_wish_change_job_role_2" value="{{ old('three_things_wish_change_job_role_2',$fresh_eye_journal_details->three_things_wish_change_job_role_2) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_things_wish_change_job_role_2'))
                        <span class="text-danger">{{ $errors->first('three_things_wish_change_job_role_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_things_wish_change_job_role_3" id="three_things_wish_change_job_role_3" value="{{ old('three_things_wish_change_job_role_3',$fresh_eye_journal_details->three_things_wish_change_job_role_3) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_things_wish_change_job_role_3'))
                        <span class="text-danger">{{ $errors->first('three_things_wish_change_job_role_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="understand_company_policies_basic_rules_regulations" class="form-label">Do you understand company's policies & basic rules & regulations? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="understand_company_policies_basic_rules_regulations" id="understand_company_policies_basic_rules_regulations" style="height: 100px">{{ old('understand_company_policies_basic_rules_regulations', $fresh_eye_journal_details->understand_company_policies_basic_rules_regulations) }}</textarea>

                  @if ($errors->has('understand_company_policies_basic_rules_regulations'))
                    <span class="text-danger">{{ $errors->first('understand_company_policies_basic_rules_regulations') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'understand_company_policies_basic_rules_regulations' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="feel_belonged_forsee_growing" class="form-label">Do you feel belonged & forsee yourself growing in the organization? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="feel_belonged_forsee_growing" id="feel_belonged_forsee_growing" style="height: 100px">{{ old('feel_belonged_forsee_growing', $fresh_eye_journal_details->feel_belonged_forsee_growing) }}</textarea>

                  @if ($errors->has('feel_belonged_forsee_growing'))
                    <span class="text-danger">{{ $errors->first('feel_belonged_forsee_growing') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'feel_belonged_forsee_growing' );
                  </script>

                </div>


                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Please share your satisfaction on the parameters mentioned below</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="satisfaction_job_role" class="form-label rdioBtn">Satisfaction about job role  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="NA" @if(old('satisfaction_job_role', $fresh_eye_journal_details->satisfaction_job_role)=='NA') checked @elseif(old('satisfaction_job_role', $fresh_eye_journal_details->satisfaction_job_role)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="1" @if(old('satisfaction_job_role', $fresh_eye_journal_details->satisfaction_job_role)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="2" @if(old('satisfaction_job_role', $fresh_eye_journal_details->satisfaction_job_role)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="3" @if(old('satisfaction_job_role', $fresh_eye_journal_details->satisfaction_job_role)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="4" @if(old('satisfaction_job_role', $fresh_eye_journal_details->satisfaction_job_role)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="5" @if(old('satisfaction_job_role', $fresh_eye_journal_details->satisfaction_job_role)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>

                  </span>

                  @if ($errors->has('satisfaction_job_role'))
                    <span class="text-danger">{{ $errors->first('satisfaction_job_role') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="well_equipped_perform_job" class="form-label rdioBtn">I am well equipped to perform my job <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="NA" @if(old('well_equipped_perform_job', $fresh_eye_journal_details->well_equipped_perform_job)=='NA') checked @elseif(old('well_equipped_perform_job', $fresh_eye_journal_details->well_equipped_perform_job)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="1" @if(old('well_equipped_perform_job', $fresh_eye_journal_details->well_equipped_perform_job)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="2" @if(old('well_equipped_perform_job', $fresh_eye_journal_details->well_equipped_perform_job)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="3" @if(old('well_equipped_perform_job', $fresh_eye_journal_details->well_equipped_perform_job)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="4" @if(old('well_equipped_perform_job', $fresh_eye_journal_details->well_equipped_perform_job)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="5" @if(old('well_equipped_perform_job', $fresh_eye_journal_details->well_equipped_perform_job)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('well_equipped_perform_job'))
                    <span class="text-danger">{{ $errors->first('well_equipped_perform_job') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="able_maintain_work_life_balance" class="form-label rdioBtn">I am able to maintain work-life balance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="NA" @if(old('able_maintain_work_life_balance', $fresh_eye_journal_details->able_maintain_work_life_balance)=='NA') checked @elseif(old('able_maintain_work_life_balance', $fresh_eye_journal_details->able_maintain_work_life_balance)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="1" @if(old('able_maintain_work_life_balance', $fresh_eye_journal_details->able_maintain_work_life_balance)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="2" @if(old('able_maintain_work_life_balance', $fresh_eye_journal_details->able_maintain_work_life_balance)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="3" @if(old('able_maintain_work_life_balance', $fresh_eye_journal_details->able_maintain_work_life_balance)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="4" @if(old('able_maintain_work_life_balance', $fresh_eye_journal_details->able_maintain_work_life_balance)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="5" @if(old('able_maintain_work_life_balance', $fresh_eye_journal_details->able_maintain_work_life_balance)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('able_maintain_work_life_balance'))
                    <span class="text-danger">{{ $errors->first('able_maintain_work_life_balance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="feel_respected_my_peers" class="form-label rdioBtn">I feel respected by my peers <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="NA" @if(old('feel_respected_my_peers', $fresh_eye_journal_details->feel_respected_my_peers)=='NA') checked @elseif(old('feel_respected_my_peers', $fresh_eye_journal_details->feel_respected_my_peers)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="1" @if(old('feel_respected_my_peers', $fresh_eye_journal_details->feel_respected_my_peers)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="2" @if(old('feel_respected_my_peers', $fresh_eye_journal_details->feel_respected_my_peers)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="3" @if(old('feel_respected_my_peers', $fresh_eye_journal_details->feel_respected_my_peers)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="4" @if(old('feel_respected_my_peers', $fresh_eye_journal_details->feel_respected_my_peers)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="5" @if(old('feel_respected_my_peers', $fresh_eye_journal_details->feel_respected_my_peers)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('feel_respected_my_peers'))
                    <span class="text-danger">{{ $errors->first('feel_respected_my_peers') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="suggestions_heard_implemented" class="form-label rdioBtn">My suggestions are heard & implemented <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="NA" @if(old('suggestions_heard_implemented', $fresh_eye_journal_details->suggestions_heard_implemented)=='NA') checked @elseif(old('suggestions_heard_implemented', $fresh_eye_journal_details->suggestions_heard_implemented)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="1" @if(old('suggestions_heard_implemented', $fresh_eye_journal_details->suggestions_heard_implemented)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="2" @if(old('suggestions_heard_implemented', $fresh_eye_journal_details->suggestions_heard_implemented)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="3" @if(old('suggestions_heard_implemented', $fresh_eye_journal_details->suggestions_heard_implemented)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="4" @if(old('suggestions_heard_implemented', $fresh_eye_journal_details->suggestions_heard_implemented)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="5" @if(old('suggestions_heard_implemented', $fresh_eye_journal_details->suggestions_heard_implemented)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('suggestions_heard_implemented'))
                    <span class="text-danger">{{ $errors->first('suggestions_heard_implemented') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="share_good_bond_superiors" class="form-label rdioBtn">I share good bond with superiors <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="NA" @if(old('share_good_bond_superiors', $fresh_eye_journal_details->share_good_bond_superiors)=='NA') checked @elseif(old('share_good_bond_superiors', $fresh_eye_journal_details->share_good_bond_superiors)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="1" @if(old('share_good_bond_superiors', $fresh_eye_journal_details->share_good_bond_superiors)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="2" @if(old('share_good_bond_superiors', $fresh_eye_journal_details->share_good_bond_superiors)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="3" @if(old('share_good_bond_superiors', $fresh_eye_journal_details->share_good_bond_superiors)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="4" @if(old('share_good_bond_superiors', $fresh_eye_journal_details->share_good_bond_superiors)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="5" @if(old('share_good_bond_superiors', $fresh_eye_journal_details->share_good_bond_superiors)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('share_good_bond_superiors'))
                    <span class="text-danger">{{ $errors->first('share_good_bond_superiors') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="know_what_i_expected_to_do" class="form-label rdioBtn">I know what I am expected to do <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="NA" @if(old('know_what_i_expected_to_do', $fresh_eye_journal_details->know_what_i_expected_to_do)=='NA') checked @elseif(old('know_what_i_expected_to_do', $fresh_eye_journal_details->know_what_i_expected_to_do)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="1" @if(old('know_what_i_expected_to_do', $fresh_eye_journal_details->know_what_i_expected_to_do)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="2" @if(old('know_what_i_expected_to_do', $fresh_eye_journal_details->know_what_i_expected_to_do)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="3" @if(old('know_what_i_expected_to_do', $fresh_eye_journal_details->know_what_i_expected_to_do)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="4" @if(old('know_what_i_expected_to_do', $fresh_eye_journal_details->know_what_i_expected_to_do)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="5" @if(old('know_what_i_expected_to_do', $fresh_eye_journal_details->know_what_i_expected_to_do)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('know_what_i_expected_to_do'))
                    <span class="text-danger">{{ $errors->first('know_what_i_expected_to_do') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="i_feel_grow_in_organization" class="form-label rdioBtn">I feel I will grow in the organization <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="NA" @if(old('i_feel_grow_in_organization', $fresh_eye_journal_details->i_feel_grow_in_organization)=='NA') checked @elseif(old('i_feel_grow_in_organization', $fresh_eye_journal_details->i_feel_grow_in_organization)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="1" @if(old('i_feel_grow_in_organization', $fresh_eye_journal_details->i_feel_grow_in_organization)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="2" @if(old('i_feel_grow_in_organization', $fresh_eye_journal_details->i_feel_grow_in_organization)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="3" @if(old('i_feel_grow_in_organization', $fresh_eye_journal_details->i_feel_grow_in_organization)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="4" @if(old('i_feel_grow_in_organization', $fresh_eye_journal_details->i_feel_grow_in_organization)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="5" @if(old('i_feel_grow_in_organization', $fresh_eye_journal_details->i_feel_grow_in_organization)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('i_feel_grow_in_organization'))
                    <span class="text-danger">{{ $errors->first('i_feel_grow_in_organization') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_exemplary_work_achievement_showcase" class="form-label">Any exemplary work or achievement that you would like to showcase? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_exemplary_work_achievement_showcase" id="any_exemplary_work_achievement_showcase" style="height: 100px">{{ old('any_exemplary_work_achievement_showcase', $fresh_eye_journal_details->any_exemplary_work_achievement_showcase)}}</textarea>

                  @if ($errors->has('any_exemplary_work_achievement_showcase'))
                    <span class="text-danger">{{ $errors->first('any_exemplary_work_achievement_showcase') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_exemplary_work_achievement_showcase' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_additional_trainings" class="form-label">Any additional trainings that you'd like? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_trainings" id="any_additional_trainings" style="height: 100px">{{ old('any_additional_trainings', $fresh_eye_journal_details->any_additional_trainings)}}</textarea>

                  @if ($errors->has('any_additional_trainings'))
                    <span class="text-danger">{{ $errors->first('any_additional_trainings') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_trainings' );
                  </script>

                </div>


                <div class="col-md-12 position-relative">
                  <label for="what_do_you_like_about_company" class="form-label">What do you like about <span id="what_do_you_like_about_company_name">{{ old('company_name_ajax',$fresh_eye_journal_details->company_name_ajax) }}</span>? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="what_do_you_like_about_company" id="what_do_you_like_about_company" style="height: 100px">{{ old('what_do_you_like_about_company', $fresh_eye_journal_details->what_do_you_like_about_company)}}</textarea>

                  @if ($errors->has('what_do_you_like_about_company'))
                    <span class="text-danger">{{ $errors->first('what_do_you_like_about_company') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'what_do_you_like_about_company' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="what_do_you_dislike_about_company" class="form-label">What do you dislike about <span id="what_do_you_dislike_about_company_name">{{ old('company_name_ajax',$fresh_eye_journal_details->company_name_ajax) }}</span>? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="what_do_you_dislike_about_company" id="what_do_you_dislike_about_company" style="height: 100px">{{ old('what_do_you_dislike_about_company', $fresh_eye_journal_details->what_do_you_dislike_about_company)}}</textarea>

                  @if ($errors->has('what_do_you_dislike_about_company'))
                    <span class="text-danger">{{ $errors->first('what_do_you_dislike_about_company') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'what_do_you_dislike_about_company' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="satisfied_employee_benefits_offered_company" class="form-label">How satisfied are you with employee benefits being offered by <span id="satisfied_employee_benefits_offered_company_name">{{ old('company_name_ajax',$fresh_eye_journal_details->company_name_ajax) }}</span>? Please elaborate <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="satisfied_employee_benefits_offered_company" id="satisfied_employee_benefits_offered_company" style="height: 100px">{{ old('satisfied_employee_benefits_offered_company', $fresh_eye_journal_details->satisfied_employee_benefits_offered_company)}}</textarea>

                  @if ($errors->has('satisfied_employee_benefits_offered_company'))
                    <span class="text-danger">{{ $errors->first('satisfied_employee_benefits_offered_company') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'satisfied_employee_benefits_offered_company' );
                  </script>

                </div>
                

                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Please share your satisfaction on the parameters mentioned below, out of 5</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="work_culture" class="form-label rdioBtn">Work culture  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="NA" @if(old('work_culture', $fresh_eye_journal_details->work_culture)=='NA') checked @elseif(old('work_culture', $fresh_eye_journal_details->work_culture)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="1" @if(old('work_culture', $fresh_eye_journal_details->work_culture)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="2" @if(old('work_culture', $fresh_eye_journal_details->work_culture)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="3" @if(old('work_culture', $fresh_eye_journal_details->work_culture)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="4" @if(old('work_culture', $fresh_eye_journal_details->work_culture)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="5" @if(old('work_culture', $fresh_eye_journal_details->work_culture)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('work_culture'))
                    <span class="text-danger">{{ $errors->first('work_culture') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="recruitment_process" class="form-label rdioBtn">Recruitment process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="NA" @if(old('recruitment_process', $fresh_eye_journal_details->recruitment_process)=='NA') checked @elseif(old('recruitment_process', $fresh_eye_journal_details->recruitment_process)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="1" @if(old('recruitment_process', $fresh_eye_journal_details->recruitment_process)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="2" @if(old('recruitment_process', $fresh_eye_journal_details->recruitment_process)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="3" @if(old('recruitment_process', $fresh_eye_journal_details->recruitment_process)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="4" @if(old('recruitment_process', $fresh_eye_journal_details->recruitment_process)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="5" @if(old('recruitment_process', $fresh_eye_journal_details->recruitment_process)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('recruitment_process'))
                    <span class="text-danger">{{ $errors->first('recruitment_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="induction_process" class="form-label rdioBtn">Induction process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="NA" @if(old('induction_process', $fresh_eye_journal_details->induction_process)=='NA') checked @elseif(old('induction_process', $fresh_eye_journal_details->induction_process)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="1" @if(old('induction_process', $fresh_eye_journal_details->induction_process)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="2" @if(old('induction_process', $fresh_eye_journal_details->induction_process)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="3" @if(old('induction_process', $fresh_eye_journal_details->induction_process)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="4" @if(old('induction_process', $fresh_eye_journal_details->induction_process)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="5" @if(old('induction_process', $fresh_eye_journal_details->induction_process)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('induction_process'))
                    <span class="text-danger">{{ $errors->first('induction_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="on_job_training_process" class="form-label rdioBtn">On-job training process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="NA" @if(old('on_job_training_process', $fresh_eye_journal_details->on_job_training_process)=='NA') checked @elseif(old('on_job_training_process', $fresh_eye_journal_details->on_job_training_process)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="1" @if(old('on_job_training_process', $fresh_eye_journal_details->on_job_training_process)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="2" @if(old('on_job_training_process', $fresh_eye_journal_details->on_job_training_process)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="3" @if(old('on_job_training_process', $fresh_eye_journal_details->on_job_training_process)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="4" @if(old('on_job_training_process', $fresh_eye_journal_details->on_job_training_process)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="5" @if(old('on_job_training_process', $fresh_eye_journal_details->on_job_training_process)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('on_job_training_process'))
                    <span class="text-danger">{{ $errors->first('on_job_training_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="clear_communication_changes_policy" class="form-label rdioBtn">Clear communication about any changes in the policy <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="NA" @if(old('clear_communication_changes_policy', $fresh_eye_journal_details->clear_communication_changes_policy)=='NA') checked @elseif(old('clear_communication_changes_policy', $fresh_eye_journal_details->clear_communication_changes_policy)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="1" @if(old('clear_communication_changes_policy', $fresh_eye_journal_details->clear_communication_changes_policy)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="2" @if(old('clear_communication_changes_policy', $fresh_eye_journal_details->clear_communication_changes_policy)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="3" @if(old('clear_communication_changes_policy', $fresh_eye_journal_details->clear_communication_changes_policy)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="4" @if(old('clear_communication_changes_policy', $fresh_eye_journal_details->clear_communication_changes_policy)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="5" @if(old('clear_communication_changes_policy', $fresh_eye_journal_details->clear_communication_changes_policy)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('clear_communication_changes_policy'))
                    <span class="text-danger">{{ $errors->first('clear_communication_changes_policy') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="feeling_belongingness_organization" class="form-label rdioBtn">Feeling of belongingness in the organization <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="NA" @if(old('feeling_belongingness_organization', $fresh_eye_journal_details->feeling_belongingness_organization)=='NA') checked @elseif(old('feeling_belongingness_organization', $fresh_eye_journal_details->feeling_belongingness_organization)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="1" @if(old('feeling_belongingness_organization', $fresh_eye_journal_details->feeling_belongingness_organization)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="2" @if(old('feeling_belongingness_organization', $fresh_eye_journal_details->feeling_belongingness_organization)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="3" @if(old('feeling_belongingness_organization', $fresh_eye_journal_details->feeling_belongingness_organization)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="4" @if(old('feeling_belongingness_organization', $fresh_eye_journal_details->feeling_belongingness_organization)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="5" @if(old('feeling_belongingness_organization', $fresh_eye_journal_details->feeling_belongingness_organization)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('feeling_belongingness_organization'))
                    <span class="text-danger">{{ $errors->first('feeling_belongingness_organization') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="having_best_friend_at_work" class="form-label rdioBtn">Having a best friend at work <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="NA" @if(old('having_best_friend_at_work', $fresh_eye_journal_details->having_best_friend_at_work)=='NA') checked @elseif(old('having_best_friend_at_work', $fresh_eye_journal_details->having_best_friend_at_work)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="1" @if(old('having_best_friend_at_work', $fresh_eye_journal_details->having_best_friend_at_work)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="2" @if(old('having_best_friend_at_work', $fresh_eye_journal_details->having_best_friend_at_work)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="3" @if(old('having_best_friend_at_work', $fresh_eye_journal_details->having_best_friend_at_work)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="4" @if(old('having_best_friend_at_work', $fresh_eye_journal_details->having_best_friend_at_work)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="5" @if(old('having_best_friend_at_work', $fresh_eye_journal_details->having_best_friend_at_work)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('having_best_friend_at_work'))
                    <span class="text-danger">{{ $errors->first('having_best_friend_at_work') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="work_life_balance" class="form-label rdioBtn">Work-life balance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="NA" @if(old('work_life_balance', $fresh_eye_journal_details->work_life_balance)=='NA') checked @elseif(old('work_life_balance', $fresh_eye_journal_details->work_life_balance)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="1" @if(old('work_life_balance', $fresh_eye_journal_details->work_life_balance)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="2" @if(old('work_life_balance', $fresh_eye_journal_details->work_life_balance)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="3" @if(old('work_life_balance', $fresh_eye_journal_details->work_life_balance)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="4" @if(old('work_life_balance', $fresh_eye_journal_details->work_life_balance)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="5" @if(old('work_life_balance', $fresh_eye_journal_details->work_life_balance)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('work_life_balance'))
                    <span class="text-danger">{{ $errors->first('work_life_balance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_detailed_feedback_support_your_response" class="form-label">Any detailed feedback you would like to share to support your response on the above parameters? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_detailed_feedback_support_your_response" id="any_detailed_feedback_support_your_response" style="height: 100px">{{ old('any_detailed_feedback_support_your_response', $fresh_eye_journal_details->any_detailed_feedback_support_your_response)}}</textarea>

                  @if ($errors->has('any_detailed_feedback_support_your_response'))
                    <span class="text-danger">{{ $errors->first('any_detailed_feedback_support_your_response') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_detailed_feedback_support_your_response' );
                  </script>

                </div>


                <div class="hiring_survey_heading"><strong>Feedback for the Mentor</strong></div>

                <input type="hidden" name="mentor_name_ajax" id="mentor_name_ajax" value="{{ old('mentor_name_ajax', $fresh_eye_journal_details->mentor_name_ajax) }}">
                <div class="col-md-12 position-relative">
                  <label for="mentor_id" class="form-label">Mentor Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select " name="mentor_id" id="mentor_id"><!--select2-->
                    <option value="">Choose...</option> 
                    @foreach($mentor_details as $mentor_detail)
                      <option value="{{$mentor_detail['id']}}" @if(old('mentor_id', $fresh_eye_journal_details->mentor_id)==$mentor_detail['id']) selected @endif>
                        {{$mentor_detail['mentor_name']}}
                      </option>
                    @endforeach
                  </select>
                  @if ($errors->has('mentor_id'))
                    <span class="text-danger">{{ $errors->first('mentor_id') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="mentor_overall_feedback" class="form-label">Share your overall feedback for <span class="mentor_name_ajax_class">{{ old('mentor_name_ajax', $fresh_eye_journal_details->mentor_name_ajax) }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label> <br>
                  <!-- <textarea class="form-control" name="mentor_overall_feedback" id="mentor_overall_feedback" style="height: 100px">{{ old('mentor_overall_feedback')}}</textarea>

                  @if ($errors->has('mentor_overall_feedback'))
                    <span class="text-danger">{{ $errors->first('mentor_overall_feedback') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'mentor_overall_feedback' );
                  </script> -->

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="overall_feedback_for_mentor" id="overall_feedback_for_mentor" value="NA" @if(old('overall_feedback_for_mentor', $fresh_eye_journal_details->overall_feedback_for_mentor)=='NA') checked @elseif(old('overall_feedback_for_mentor', $fresh_eye_journal_details->overall_feedback_for_mentor)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_mentor" id="overall_feedback_for_mentor" value="1" @if(old('overall_feedback_for_mentor', $fresh_eye_journal_details->overall_feedback_for_mentor)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_mentor" id="overall_feedback_for_mentor" value="2" @if(old('overall_feedback_for_mentor', $fresh_eye_journal_details->overall_feedback_for_mentor)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_mentor" id="overall_feedback_for_mentor" value="3" @if(old('overall_feedback_for_mentor', $fresh_eye_journal_details->overall_feedback_for_mentor)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_mentor" id="overall_feedback_for_mentor" value="4" @if(old('overall_feedback_for_mentor', $fresh_eye_journal_details->overall_feedback_for_mentor)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_mentor" id="overall_feedback_for_mentor" value="5" @if(old('overall_feedback_for_mentor', $fresh_eye_journal_details->overall_feedback_for_mentor)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('overall_feedback_for_mentor'))
                    <span class="text-danger">{{ $errors->first('overall_feedback_for_mentor') }}</span>
                  @endif

                </div>
                

                <div class="col-md-12 position-relative">
                  <label for="mentor_top_three_strengths" class="form-label">Share top three strengths of <span class="mentor_name_ajax_class">{{ old('mentor_name_ajax', $fresh_eye_journal_details->mentor_name_ajax) }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="mentor_top_three_strengths_1" id="mentor_top_three_strengths_1" value="{{ old('mentor_top_three_strengths_1', $fresh_eye_journal_details->mentor_top_three_strengths_1) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('mentor_top_three_strengths_1'))
                        <span class="text-danger">{{ $errors->first('mentor_top_three_strengths_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="mentor_top_three_strengths_2" id="mentor_top_three_strengths_2" value="{{ old('mentor_top_three_strengths_2', $fresh_eye_journal_details->mentor_top_three_strengths_2) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('mentor_top_three_strengths_2'))
                        <span class="text-danger">{{ $errors->first('mentor_top_three_strengths_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="mentor_top_three_strengths_3" id="mentor_top_three_strengths_3" value="{{ old('mentor_top_three_strengths_3', $fresh_eye_journal_details->mentor_top_three_strengths_3) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('mentor_top_three_strengths_3'))
                        <span class="text-danger">{{ $errors->first('mentor_top_three_strengths_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="mentor_three_areas_improvement" class="form-label">Share three areas of improvement for <span class="mentor_name_ajax_class">{{ old('mentor_name_ajax', $fresh_eye_journal_details->mentor_name_ajax) }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="mentor_three_areas_improvement_1" id="mentor_three_areas_improvement_1" value="{{ old('mentor_three_areas_improvement_1', $fresh_eye_journal_details->mentor_three_areas_improvement_1) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('mentor_three_areas_improvement_1'))
                        <span class="text-danger">{{ $errors->first('mentor_three_areas_improvement_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="mentor_three_areas_improvement_2" id="mentor_three_areas_improvement_2" value="{{ old('mentor_three_areas_improvement_2', $fresh_eye_journal_details->mentor_three_areas_improvement_2) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('mentor_three_areas_improvement_2'))
                        <span class="text-danger">{{ $errors->first('mentor_three_areas_improvement_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="mentor_three_areas_improvement_3" id="mentor_three_areas_improvement_3" value="{{ old('mentor_three_areas_improvement_3', $fresh_eye_journal_details->mentor_three_areas_improvement_3) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('mentor_three_areas_improvement_3'))
                        <span class="text-danger">{{ $errors->first('mentor_three_areas_improvement_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="our_organization_believes_mantra_mentor" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by <span class="mentor_name_ajax_class">{{ old('mentor_name_ajax', $fresh_eye_journal_details->mentor_name_ajax) }}</span>'s actions/way of work? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra_mentor" id="our_organization_believes_mantra_mentor" style="height: 100px">{{ old('our_organization_believes_mantra_mentor', $fresh_eye_journal_details->our_organization_believes_mantra_mentor)}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra_mentor'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra_mentor') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra_mentor' );
                  </script>

                </div>


                <div class="hiring_survey_heading"><strong>Feedback for the Reporting Manager</strong></div>


                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Rate <span id="rate_5_reporting_manager_name_ajax">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span> on the below-mentioned parameters out of 5</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="quickness_in_respond_reporting_manager" class="form-label rdioBtn">Quickness in respond to your requests/queries/concerns?  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="NA" @if(old('quickness_in_respond_reporting_manager', $fresh_eye_journal_details->quickness_in_respond_reporting_manager)=='NA') checked @elseif(old('quickness_in_respond_reporting_manager', $fresh_eye_journal_details->quickness_in_respond_reporting_manager)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="1" @if(old('quickness_in_respond_reporting_manager', $fresh_eye_journal_details->quickness_in_respond_reporting_manager)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="2" @if(old('quickness_in_respond_reporting_manager', $fresh_eye_journal_details->quickness_in_respond_reporting_manager)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="3" @if(old('quickness_in_respond_reporting_manager', $fresh_eye_journal_details->quickness_in_respond_reporting_manager)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="4" @if(old('quickness_in_respond_reporting_manager', $fresh_eye_journal_details->quickness_in_respond_reporting_manager)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="5" @if(old('quickness_in_respond_reporting_manager', $fresh_eye_journal_details->quickness_in_respond_reporting_manager)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('quickness_in_respond_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('quickness_in_respond_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_well_received_guidance_reporting_manager" class="form-label rdioBtn">How well have you received guidance? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="NA" @if(old('how_well_received_guidance_reporting_manager', $fresh_eye_journal_details->how_well_received_guidance_reporting_manager)=='NA') checked @elseif(old('how_well_received_guidance_reporting_manager', $fresh_eye_journal_details->how_well_received_guidance_reporting_manager)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="1" @if(old('how_well_received_guidance_reporting_manager', $fresh_eye_journal_details->how_well_received_guidance_reporting_manager)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="2" @if(old('how_well_received_guidance_reporting_manager', $fresh_eye_journal_details->how_well_received_guidance_reporting_manager)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="3" @if(old('how_well_received_guidance_reporting_manager', $fresh_eye_journal_details->how_well_received_guidance_reporting_manager)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="4" @if(old('how_well_received_guidance_reporting_manager', $fresh_eye_journal_details->how_well_received_guidance_reporting_manager)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="5" @if(old('how_well_received_guidance_reporting_manager', $fresh_eye_journal_details->how_well_received_guidance_reporting_manager)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('how_well_received_guidance_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_well_received_guidance_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_clearly_your_goals_set_reporting_manager" class="form-label rdioBtn">How clearly are your goals set? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="NA" @if(old('how_clearly_your_goals_set_reporting_manager', $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager)=='NA') checked @elseif(old('how_clearly_your_goals_set_reporting_manager', $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="1" @if(old('how_clearly_your_goals_set_reporting_manager', $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="2" @if(old('how_clearly_your_goals_set_reporting_manager', $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="3" @if(old('how_clearly_your_goals_set_reporting_manager', $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="4" @if(old('how_clearly_your_goals_set_reporting_manager', $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="5" @if(old('how_clearly_your_goals_set_reporting_manager', $fresh_eye_journal_details->how_clearly_your_goals_set_reporting_manager)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('how_clearly_your_goals_set_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_clearly_your_goals_set_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_transparent_is_reporting_manager" class="form-label rdioBtn">How transparent is <span id="how_transparent_reporting_manager_name_ajax">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="NA" @if(old('how_transparent_is_reporting_manager', $fresh_eye_journal_details->how_transparent_is_reporting_manager)=='NA') checked @elseif(old('how_transparent_is_reporting_manager', $fresh_eye_journal_details->how_transparent_is_reporting_manager)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="1" @if(old('how_transparent_is_reporting_manager', $fresh_eye_journal_details->how_transparent_is_reporting_manager)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="2" @if(old('how_transparent_is_reporting_manager', $fresh_eye_journal_details->how_transparent_is_reporting_manager)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="3" @if(old('how_transparent_is_reporting_manager', $fresh_eye_journal_details->how_transparent_is_reporting_manager)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="4" @if(old('how_transparent_is_reporting_manager', $fresh_eye_journal_details->how_transparent_is_reporting_manager)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="5" @if(old('how_transparent_is_reporting_manager', $fresh_eye_journal_details->how_transparent_is_reporting_manager)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('how_transparent_is_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_transparent_is_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="wprs_happen_every_week_reporting_manager" class="form-label rdioBtn">WPRs happen every week <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="NA" @if(old('wprs_happen_every_week_reporting_manager', $fresh_eye_journal_details->wprs_happen_every_week_reporting_manager)=='NA') checked @elseif(old('wprs_happen_every_week_reporting_manager', $fresh_eye_journal_details->wprs_happen_every_week_reporting_manager)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="1" @if(old('wprs_happen_every_week_reporting_manager', $fresh_eye_journal_details->wprs_happen_every_week_reporting_manager)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="2" @if(old('wprs_happen_every_week_reporting_manager', $fresh_eye_journal_details->wprs_happen_every_week_reporting_manager)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="3" @if(old('wprs_happen_every_week_reporting_manager', $fresh_eye_journal_details->wprs_happen_every_week_reporting_manager)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="4" @if(old('wprs_happen_every_week_reporting_manager', $fresh_eye_journal_details->wprs_happen_every_week_reporting_manager)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="5" @if(old('wprs_happen_every_week_reporting_manager', $fresh_eye_journal_details->wprs_happen_every_week_reporting_manager)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('wprs_happen_every_week_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('wprs_happen_every_week_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_comfortable_feel_sharing_feedback_reporting_manager" class="form-label rdioBtn">How comfortable do you feel in sharing your feedback with {{ $reporting_manager_name_ajax_default }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="NA" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager', $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager)=='NA') checked @elseif(old('how_comfortable_feel_sharing_feedback_reporting_manager', $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="1" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager', $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="2" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager', $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="3" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager', $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="4" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager', $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="5" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager', $fresh_eye_journal_details->how_comfortable_feel_sharing_feedback_reporting_manager)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_comfortable_feel_sharing_feedback_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_comfortable_feel_sharing_feedback_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_well_able_learn_under_guidance_reporting_manager" class="form-label rdioBtn">How well are you able to learn under <span id="how_transparent_reporting_manager_name_ajax">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span> guidance? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="NA" @if(old('how_well_able_learn_under_guidance_reporting_manager', $fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager)=='NA') checked @elseif(old('how_well_able_learn_under_guidance_reporting_manager', $fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="1" @if(old('how_well_able_learn_under_guidance_reporting_manager', $fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="2" @if(old('how_well_able_learn_under_guidance_reporting_manager', $fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="3" @if(old('how_well_able_learn_under_guidance_reporting_manager', $fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="4" @if(old('how_well_able_learn_under_guidance_reporting_manager', $fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="5" @if(old('how_well_able_learn_under_guidance_reporting_manager', $fresh_eye_journal_details->how_well_able_learn_under_guidance_reporting_manager)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_well_able_learn_under_guidance_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_well_able_learn_under_guidance_reporting_manager') }}</span>
                  @endif

                </div>



                <div class="col-md-12 position-relative">
                  <label for="frequent_1_1_happen_reporting_manager" class="form-label rdioBtn">How frequent does your 1:1 happen? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager" id="frequent_1_1_happen_reporting_manager" value="NA" @if(old('frequent_1_1_happen_reporting_manager', $fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi)=='NA') checked @elseif(old('frequent_1_1_happen_reporting_manager', $fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager" id="frequent_1_1_happen_reporting_manager" value="1" @if(old('frequent_1_1_happen_reporting_manager', $fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager" id="frequent_1_1_happen_reporting_manager" value="2" @if(old('frequent_1_1_happen_reporting_manager', $fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager" id="frequent_1_1_happen_reporting_manager" value="3" @if(old('frequent_1_1_happen_reporting_manager', $fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager" id="frequent_1_1_happen_reporting_manager" value="4" @if(old('frequent_1_1_happen_reporting_manager', $fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager" id="frequent_1_1_happen_reporting_manager" value="5" @if(old('frequent_1_1_happen_reporting_manager', $fresh_eye_journal_details->frequent_1_1_happen_reporting_manager_qi)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('frequent_1_1_happen_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('frequent_1_1_happen_reporting_manager') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_well_adjust_changing_priorities_reporting_manager" class="form-label rdioBtn">How well does {{ $reporting_manager_name_ajax_default }} adjust to changing priorities? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="NA" @if(old('how_well_adjust_changing_priorities_reporting_manager', $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager)=='NA') checked @elseif(old('how_well_adjust_changing_priorities_reporting_manager', $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="1" @if(old('how_well_adjust_changing_priorities_reporting_manager', $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="2" @if(old('how_well_adjust_changing_priorities_reporting_manager', $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="3" @if(old('how_well_adjust_changing_priorities_reporting_manager', $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="4" @if(old('how_well_adjust_changing_priorities_reporting_manager', $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="5" @if(old('how_well_adjust_changing_priorities_reporting_manager', $fresh_eye_journal_details->how_well_adjust_changing_priorities_reporting_manager)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_well_adjust_changing_priorities_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_well_adjust_changing_priorities_reporting_manager') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share top three strengths of <span class="rate_5_reporting_manager_name_ajax_class">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_strengths_reporting_manager_qi_1" id="top_3_strengths_reporting_manager_qi_1" value="{{ old('top_3_strengths_reporting_manager_qi_1', $fresh_eye_journal_details->top_3_strengths_reporting_manager_qi_1) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_strengths_reporting_manager_qi_1'))
                        <span class="text-danger">{{ $errors->first('top_3_strengths_reporting_manager_qi_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_strengths_reporting_manager_qi_2" id="top_3_strengths_reporting_manager_qi_2" value="{{ old('top_3_strengths_reporting_manager_qi_2', $fresh_eye_journal_details->top_3_strengths_reporting_manager_qi_2) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_strengths_reporting_manager_qi_2'))
                        <span class="text-danger">{{ $errors->first('top_3_strengths_reporting_manager_qi_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_strengths_reporting_manager_qi_3" id="top_3_strengths_reporting_manager_qi_3" value="{{ old('top_3_strengths_reporting_manager_qi_3', $fresh_eye_journal_details->top_3_strengths_reporting_manager_qi_3) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_strengths_reporting_manager_qi_3'))
                        <span class="text-danger">{{ $errors->first('top_3_strengths_reporting_manager_qi_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share three areas of improvement for <span class="rate_5_reporting_manager_name_ajax_class">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_improvement_reporting_manager_qi_1" id="three_areas_improvement_reporting_manager_qi_1" value="{{ old('three_areas_improvement_reporting_manager_qi_1', $fresh_eye_journal_details->three_areas_improvement_reporting_manager_qi_1) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_improvement_reporting_manager_qi_1'))
                        <span class="text-danger">{{ $errors->first('three_areas_improvement_reporting_manager_qi_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_improvement_reporting_manager_qi_2" id="three_areas_improvement_reporting_manager_qi_2" value="{{ old('three_areas_improvement_reporting_manager_qi_2', $fresh_eye_journal_details->three_areas_improvement_reporting_manager_qi_2) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_improvement_reporting_manager_qi_2'))
                        <span class="text-danger">{{ $errors->first('three_areas_improvement_reporting_manager_qi_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_improvement_reporting_manager_qi_3" id="three_areas_improvement_reporting_manager_qi_3" value="{{ old('three_areas_improvement_reporting_manager_qi_3', $fresh_eye_journal_details->three_areas_improvement_reporting_manager_qi_3) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_improvement_reporting_manager_qi_3'))
                        <span class="text-danger">{{ $errors->first('three_areas_improvement_reporting_manager_qi_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="our_organization_believes_mantra" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by {{ $reporting_manager_name_ajax_default }} actions/way of work? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra" id="our_organization_believes_mantra" style="height: 100px">{{ old('our_organization_believes_mantra', $fresh_eye_journal_details->our_organization_believes_mantra)}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra' );
                  </script>

                </div>

                
                <div class="hiring_survey_heading"><strong>Feedback for the Head</strong></div>

                <!-- Q-H -->
                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label"><strong>Rate <span class="rate_5_hod_name_ajax_class">{{ $hod_details['hod_name'] }}</span> on the below mentioned parameters out of 5</strong></label>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="overall_feedback_for_hod" class="form-label rdioBtn">Share your overall feedback for <span class="rate_5_hod_name_ajax_class">{{ $hod_details['hod_name'] }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="overall_feedback_for_hod" id="overall_feedback_for_hod" value="NA" @if(old('overall_feedback_for_hod', $fresh_eye_journal_details->overall_feedback_for_hod)=='NA') checked @elseif(old('overall_feedback_for_hod', $fresh_eye_journal_details->overall_feedback_for_hod)=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_hod" id="overall_feedback_for_hod" value="1" @if(old('overall_feedback_for_hod', $fresh_eye_journal_details->overall_feedback_for_hod)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_hod" id="overall_feedback_for_hod" value="2" @if(old('overall_feedback_for_hod', $fresh_eye_journal_details->overall_feedback_for_hod)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_hod" id="overall_feedback_for_hod" value="3" @if(old('overall_feedback_for_hod', $fresh_eye_journal_details->overall_feedback_for_hod)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_hod" id="overall_feedback_for_hod" value="4" @if(old('overall_feedback_for_hod', $fresh_eye_journal_details->overall_feedback_for_hod)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="overall_feedback_for_hod" id="overall_feedback_for_hod" value="5" @if(old('overall_feedback_for_hod', $fresh_eye_journal_details->overall_feedback_for_hod)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('overall_feedback_for_hod'))
                    <span class="text-danger">{{ $errors->first('overall_feedback_for_hod') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share top three strengths <span class="rate_5_hod_name_ajax_class">{{ $hod_details['hod_name'] }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_strengths_hod_qj_1" id="top_3_strengths_hod_qj_1" value="{{ old('top_3_strengths_hod_qj_1', $fresh_eye_journal_details->top_3_strengths_hod_qj_1) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_strengths_hod_qj_1'))
                        <span class="text-danger">{{ $errors->first('top_3_strengths_hod_qj_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_strengths_hod_qj_2" id="top_3_strengths_hod_qj_2" value="{{ old('top_3_strengths_hod_qj_2', $fresh_eye_journal_details->top_3_strengths_hod_qj_2) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_strengths_hod_qj_2'))
                        <span class="text-danger">{{ $errors->first('top_3_strengths_hod_qj_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_strengths_hod_qj_3" id="top_3_strengths_hod_qj_3" value="{{ old('top_3_strengths_hod_qj_3', $fresh_eye_journal_details->top_3_strengths_hod_qj_3) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('top_3_strengths_hod_qj_3'))
                        <span class="text-danger">{{ $errors->first('top_3_strengths_hod_qj_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share three areas of improvement <span class="rate_5_hod_name_ajax_class">{{ $hod_details['hod_name'] }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_improvement_hod_qj_1" id="three_areas_improvement_hod_qj_1" value="{{ old('three_areas_improvement_hod_qj_1', $fresh_eye_journal_details->three_areas_improvement_hod_qj_1) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_improvement_hod_qj_1'))
                        <span class="text-danger">{{ $errors->first('three_areas_improvement_hod_qj_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_improvement_hod_qj_2" id="three_areas_improvement_hod_qj_2" value="{{ old('three_areas_improvement_hod_qj_2', $fresh_eye_journal_details->three_areas_improvement_hod_qj_2) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_improvement_hod_qj_2'))
                        <span class="text-danger">{{ $errors->first('three_areas_improvement_hod_qj_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_improvement_hod_qj_3" id="three_areas_improvement_hod_qj_3" value="{{ old('three_areas_improvement_hod_qj_3', $fresh_eye_journal_details->three_areas_improvement_hod_qj_3) }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_areas_improvement_hod_qj_3'))
                        <span class="text-danger">{{ $errors->first('three_areas_improvement_hod_qj_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="our_organization_believes_mantra_hod_qj" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by <span class="rate_5_hod_name_ajax_class">{{ $hod_details['hod_name'] }}</span> actions/way of work? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra_hod_qj" id="our_organization_believes_mantra_hod_qj" style="height: 100px">{{ old('our_organization_believes_mantra_hod_qj', $fresh_eye_journal_details->our_organization_believes_mantra_hod_qj)}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra_hod_qj'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra_hod_qj') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra_hod_qj' );
                  </script>

                </div>


                <div class="hiring_survey_heading"><strong>Feedback for Departments</strong></div>

                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Rate the Departments based on your experience with them</label>
                </div>

                <?php $j=1;?>
                @foreach($department_details as $department_detail)

                  @if(count($fej_department_rating_details))

                      @foreach($fej_department_rating_details as $fej_department_rating_detail)

                        @if($department_detail['name']==$fej_department_rating_detail['department_name'])
                          <div class="col-md-12 position-relative">
                            <input type="hidden" name="all_departments_name[]" value="{{ $department_detail['name'] }}">
                            <label for="departments_name" class="form-label rdioBtn">{{ $department_detail['name'] }}<!--  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong> --></span></label><br>

                            <span id="radioBtn">
                              <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="NA" @if(old('departments_name_{{$j}}',$fej_department_rating_detail['rating'])=='NA') checked @elseif(old('departments_name_{{$j}}',$fej_department_rating_detail['rating'])=='') checked @endif>
                              <label class="form-check-label" for="gridRadios1">NA</label>

                              <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="1" @if(old('departments_name_{{$j}}',$fej_department_rating_detail['rating'])=='1') checked @endif>
                              <label class="form-check-label" for="gridRadios1">1</label>

                              <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="2" @if(old('departments_name_{{$j}}',$fej_department_rating_detail['rating'])=='2') checked @endif>
                              <label class="form-check-label" for="gridRadios1">2</label>

                              <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="3" @if(old('departments_name_{{$j}}',$fej_department_rating_detail['rating'])=='3') checked @endif>
                              <label class="form-check-label" for="gridRadios1">3</label>

                              <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="4" @if(old('departments_name_{{$j}}',$fej_department_rating_detail['rating'])=='4') checked @endif>
                              <label class="form-check-label" for="gridRadios1">4</label>

                              <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="5" @if(old('departments_name_{{$j}}',$fej_department_rating_detail['rating'])=='5') checked @endif>
                              <label class="form-check-label" for="gridRadios1">5</label>
                            </span>

                            @if ($errors->has('departments_name_$j'))
                              <span class="text-danger">{{ $errors->first('departments_name_$j') }}</span>
                            @endif

                          </div>
                          <?php break; ?>
                        @endif
                      @endforeach

                  @else

                    <div class="col-md-12 position-relative">
                      <input type="hidden" name="all_departments_name[]" value="{{ $department_detail['name'] }}">
                      <label for="departments_name" class="form-label rdioBtn">{{ $department_detail['name'] }}<!--  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong> --></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="NA" @if(old('departments_name_{{$j}}')=='NA') checked @elseif(old('departments_name_{{$j}}')=='') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="1" @if(old('departments_name_{{$j}}')=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="2" @if(old('departments_name_{{$j}}')=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="3" @if(old('departments_name_{{$j}}')=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="4" @if(old('departments_name_{{$j}}')=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="departments_name_{{$j}}" id="departments_name_{{$j}}" value="5" @if(old('departments_name_{{$j}}')=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>

                      @if ($errors->has('departments_name_$j'))
                        <span class="text-danger">{{ $errors->first('departments_name_$j') }}</span>
                      @endif

                    </div>
                  @endif

                <?php $j++; ?>
              @endforeach

                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback_any_department" class="form-label">Any additional feedback for any department that you would like to share? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback_any_department" id="any_additional_feedback_any_department" style="height: 100px">{{ old('any_additional_feedback_any_department', $fresh_eye_journal_details->any_additional_feedback_any_department)}}</textarea>

                  @if ($errors->has('any_additional_feedback_any_department'))
                    <span class="text-danger">{{ $errors->first('any_additional_feedback_any_department') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_feedback_any_department' );
                  </script>

                </div>
                
                <div class="col-md-12 position-relative">
                  <label for="any_issue_concern_management" class="form-label">Any issue or concern that you would like to talk to management about? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_issue_concern_management" id="any_issue_concern_management" style="height: 100px">{{ old('any_issue_concern_management', $fresh_eye_journal_details->any_issue_concern_management) }}</textarea>
                  <div class="invalid-feedback">
                    What’s the best experience you have had during your tenure till date?
                  </div>
                  @if ($errors->has('any_issue_concern_management'))
                    <span class="text-danger">{{ $errors->first('any_issue_concern_management') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_issue_concern_management' );
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

    <!-- select box with search box, start here -->
    <script>
        $('.select2').select2();
    </script>
    <!-- select box with search box, end here -->

  </main>
@endsection