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
              
              <!-- @if ($errors)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Fill all fields...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif -->


              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-fresh-eye-journal-form') }}" class="row g-3 needs-validation" novalidate>
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
                  <label for="member_id" class="form-label">Member ID</label>
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
                  <div class="invalid-feedback">
                    Please select a valid designation.
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
                  <div class="invalid-feedback">
                    Please select a valid department.
                  </div>
                  @if ($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
                </div>


                <input type="hidden" name="company_name_ajax" id="company_name_ajax" value="{{ old('company_name_ajax',$company_name_ajax_default->name) }}">

                <input type="hidden" name="company_name_fresh" id="company_name_fresh" value="{{Auth::user()->company_id}}" />
                <div class="col-md-6 position-relative">
                  <label for="company_name_fresh" class="form-label">Company<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="company_name_fresh_dis" id="company_name_fresh_dis" disabled>
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

                <div class="col-md-6 position-relative">
                  <label for="tenure_in_month" class="form-label">Tenure (in months)</label>
                  <input type="email" class="form-control disable-text" name="tenure_in_month" id="tenure_in_month" value="{{ $total_tenure }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('tenure_in_month'))
                    <span class="text-danger">{{ $errors->first('tenure_in_month') }}</span>
                  @endif
                </div>


                <input type="hidden" name="reporting_manager_name_ajax" id="reporting_manager_name_ajax" value="{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}">

                <input type="hidden" name="reporting_manager_fresh" id="reporting_manager_fresh" value="{{Auth::user()->manager_name}}" />
                <div class="col-md-6 position-relative">
                  <label for="reporting_manager_fresh" class="form-label">Name of Reporting Manager <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="reporting_manager_fresh_dis" id="reporting_manager_fresh_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($manager_details as $manager_detail)
                    <?php  $reporting_manager_name=$manager_detail['first_name'].' '.$manager_detail['last_name']; ?>
                      <option value="{{$manager_detail['id']}}" @if((Auth::user()->manager_name)==$reporting_manager_name) selected @endif>{{$manager_detail['first_name']}} {{$manager_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select reporting manager.
                  </div>
                  @if ($errors->has('reporting_manager_fresh'))
                    <span class="text-danger">{{ $errors->first('reporting_manager_fresh') }}</span>
                  @endif
                </div>

                <input type="hidden" name="head_of_department_name_ajax" id="head_of_department_name_ajax" value="{{ old('head_of_department_name_ajax') }}">

                <div class="col-md-6 position-relative">
                  <label for="head_of_department" class="form-label">Name of Department Head <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
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

                <div class="col-md-12 position-relative">
                  <label for="your_journey_so_far_in_company" class="form-label">How has your journey been so far in <span id="any_additional_feedback_manager_company_name">{{ old('company_name_ajax',$company_name_ajax_default->name) }}</span>? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="your_journey_so_far_in_company" id="your_journey_so_far_in_company" style="height: 100px">{{ old('your_journey_so_far_in_company')}}</textarea>

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
                      <input type="text" class="form-control" name="top_3_things_like_your_job_1" id="top_3_things_like_your_job_1" value="{{ old('top_3_things_like_your_job_1') }}">
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
                      <input type="text" class="form-control" name="top_3_things_like_your_job_2" id="top_3_things_like_your_job_2" value="{{ old('top_3_things_like_your_job_2') }}">
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
                      <input type="text" class="form-control" name="top_3_things_like_your_job_3" id="top_3_things_like_your_job_3" value="{{ old('top_3_things_like_your_job_3') }}">
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
                      <input type="text" class="form-control" name="three_things_wish_change_job_role_1" id="three_things_wish_change_job_role_1" value="{{ old('three_things_wish_change_job_role_1') }}">
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
                      <input type="text" class="form-control" name="three_things_wish_change_job_role_2" id="three_things_wish_change_job_role_2" value="{{ old('three_things_wish_change_job_role_2') }}">
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
                      <input type="text" class="form-control" name="three_things_wish_change_job_role_3" id="three_things_wish_change_job_role_3" value="{{ old('three_things_wish_change_job_role_3') }}">
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      @if ($errors->has('three_things_wish_change_job_role_3'))
                        <span class="text-danger">{{ $errors->first('three_things_wish_change_job_role_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>

                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Please share your satisfaction on the parameters mentioned below, out of 5</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="satisfaction_job_role" class="form-label rdioBtn">Satisfaction about job role  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="NA" @if(old('satisfaction_job_role')=='NA') checked @elseif(old('satisfaction_job_role')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="1" @if(old('satisfaction_job_role')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="2" @if(old('satisfaction_job_role')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="3" @if(old('satisfaction_job_role')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="4" @if(old('satisfaction_job_role')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="satisfaction_job_role" id="satisfaction_job_role" value="5" @if(old('satisfaction_job_role')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>

                  </span>

                  @if ($errors->has('satisfaction_job_role'))
                    <span class="text-danger">{{ $errors->first('satisfaction_job_role') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="well_equipped_perform_job" class="form-label rdioBtn">I am well equipped to perform my job <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="NA" @if(old('well_equipped_perform_job')=='NA') checked @elseif(old('well_equipped_perform_job')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="1" @if(old('well_equipped_perform_job')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="2" @if(old('well_equipped_perform_job')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="3" @if(old('well_equipped_perform_job')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="4" @if(old('well_equipped_perform_job')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="well_equipped_perform_job" id="well_equipped_perform_job" value="5" @if(old('well_equipped_perform_job')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('well_equipped_perform_job'))
                    <span class="text-danger">{{ $errors->first('well_equipped_perform_job') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="able_maintain_work_life_balance" class="form-label rdioBtn">I am able to maintain work-life balance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="NA" @if(old('able_maintain_work_life_balance')=='NA') checked @elseif(old('able_maintain_work_life_balance')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="1" @if(old('able_maintain_work_life_balance')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="2" @if(old('able_maintain_work_life_balance')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="3" @if(old('able_maintain_work_life_balance')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="4" @if(old('able_maintain_work_life_balance')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="able_maintain_work_life_balance" id="able_maintain_work_life_balance" value="5" @if(old('able_maintain_work_life_balance')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('able_maintain_work_life_balance'))
                    <span class="text-danger">{{ $errors->first('able_maintain_work_life_balance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="feel_respected_my_peers" class="form-label rdioBtn">I feel respected by my peers <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="NA" @if(old('feel_respected_my_peers')=='NA') checked @elseif(old('feel_respected_my_peers')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="1" @if(old('feel_respected_my_peers')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="2" @if(old('feel_respected_my_peers')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="3" @if(old('feel_respected_my_peers')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="4" @if(old('feel_respected_my_peers')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="feel_respected_my_peers" id="feel_respected_my_peers" value="5" @if(old('feel_respected_my_peers')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('feel_respected_my_peers'))
                    <span class="text-danger">{{ $errors->first('feel_respected_my_peers') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="suggestions_heard_implemented" class="form-label rdioBtn">My suggestions are heard & implemented <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="NA" @if(old('suggestions_heard_implemented')=='NA') checked @elseif(old('suggestions_heard_implemented')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="1" @if(old('suggestions_heard_implemented')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="2" @if(old('suggestions_heard_implemented')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="3" @if(old('suggestions_heard_implemented')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="4" @if(old('suggestions_heard_implemented')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="suggestions_heard_implemented" id="suggestions_heard_implemented" value="5" @if(old('suggestions_heard_implemented')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('suggestions_heard_implemented'))
                    <span class="text-danger">{{ $errors->first('suggestions_heard_implemented') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="share_good_bond_superiors" class="form-label rdioBtn">I share good bond with superiors <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="NA" @if(old('share_good_bond_superiors')=='NA') checked @elseif(old('share_good_bond_superiors')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="1" @if(old('share_good_bond_superiors')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="2" @if(old('share_good_bond_superiors')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="3" @if(old('share_good_bond_superiors')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="4" @if(old('share_good_bond_superiors')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="share_good_bond_superiors" id="share_good_bond_superiors" value="5" @if(old('share_good_bond_superiors')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('share_good_bond_superiors'))
                    <span class="text-danger">{{ $errors->first('share_good_bond_superiors') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="know_what_i_expected_to_do" class="form-label rdioBtn">I know what I am expected to do <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="NA" @if(old('know_what_i_expected_to_do')=='NA') checked @elseif(old('know_what_i_expected_to_do')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="1" @if(old('know_what_i_expected_to_do')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="2" @if(old('know_what_i_expected_to_do')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="3" @if(old('know_what_i_expected_to_do')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="4" @if(old('know_what_i_expected_to_do')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="know_what_i_expected_to_do" id="know_what_i_expected_to_do" value="5" @if(old('know_what_i_expected_to_do')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('know_what_i_expected_to_do'))
                    <span class="text-danger">{{ $errors->first('know_what_i_expected_to_do') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="i_feel_grow_in_organization" class="form-label rdioBtn">I feel I will grow in the organization <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="NA" @if(old('i_feel_grow_in_organization')=='NA') checked @elseif(old('i_feel_grow_in_organization')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="1" @if(old('i_feel_grow_in_organization')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="2" @if(old('i_feel_grow_in_organization')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="3" @if(old('i_feel_grow_in_organization')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="4" @if(old('i_feel_grow_in_organization')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="i_feel_grow_in_organization" id="i_feel_grow_in_organization" value="5" @if(old('i_feel_grow_in_organization')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('i_feel_grow_in_organization'))
                    <span class="text-danger">{{ $errors->first('i_feel_grow_in_organization') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_exemplary_work_achievement_showcase" class="form-label">Any exemplary work or achievement that you would like to showcase? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_exemplary_work_achievement_showcase" id="any_exemplary_work_achievement_showcase" style="height: 100px">{{ old('any_exemplary_work_achievement_showcase')}}</textarea>

                  @if ($errors->has('any_exemplary_work_achievement_showcase'))
                    <span class="text-danger">{{ $errors->first('any_exemplary_work_achievement_showcase') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_exemplary_work_achievement_showcase' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_additional_trainings" class="form-label">Any additional trainings that you'd like? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_trainings" id="any_additional_trainings" style="height: 100px">{{ old('any_additional_trainings')}}</textarea>

                  @if ($errors->has('any_additional_trainings'))
                    <span class="text-danger">{{ $errors->first('any_additional_trainings') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_trainings' );
                  </script>

                </div>


                <div class="col-md-12 position-relative">
                  <label for="what_do_you_like_about_company" class="form-label">What do you like about <span id="what_do_you_like_about_company_name">{{ old('company_name_ajax',$company_name_ajax_default->name) }}</span>? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="what_do_you_like_about_company" id="what_do_you_like_about_company" style="height: 100px">{{ old('what_do_you_like_about_company')}}</textarea>

                  @if ($errors->has('what_do_you_like_about_company'))
                    <span class="text-danger">{{ $errors->first('what_do_you_like_about_company') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'what_do_you_like_about_company' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="what_do_you_dislike_about_company" class="form-label">What do you dislike about <span id="what_do_you_dislike_about_company_name">{{ old('company_name_ajax',$company_name_ajax_default->name) }}</span>? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="what_do_you_dislike_about_company" id="what_do_you_dislike_about_company" style="height: 100px">{{ old('what_do_you_dislike_about_company')}}</textarea>

                  @if ($errors->has('what_do_you_dislike_about_company'))
                    <span class="text-danger">{{ $errors->first('what_do_you_dislike_about_company') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'what_do_you_dislike_about_company' );
                  </script>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="satisfied_employee_benefits_offered_company" class="form-label">How satisfied are you with employee benefits being offered by <span id="satisfied_employee_benefits_offered_company_name">{{ old('company_name_ajax',$company_name_ajax_default->name) }}</span>? Please elaborate <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="satisfied_employee_benefits_offered_company" id="satisfied_employee_benefits_offered_company" style="height: 100px">{{ old('satisfied_employee_benefits_offered_company')}}</textarea>

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
                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="NA" @if(old('work_culture')=='NA') checked @elseif(old('work_culture')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="1" @if(old('work_culture')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="2" @if(old('work_culture')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="3" @if(old('work_culture')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="4" @if(old('work_culture')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="work_culture" id="work_culture" value="5" @if(old('work_culture')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('work_culture'))
                    <span class="text-danger">{{ $errors->first('work_culture') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="recruitment_process" class="form-label rdioBtn">Recruitment process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="NA" @if(old('recruitment_process')=='NA') checked @elseif(old('recruitment_process')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="1" @if(old('recruitment_process')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="2" @if(old('recruitment_process')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="3" @if(old('recruitment_process')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="4" @if(old('recruitment_process')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="recruitment_process" id="recruitment_process" value="5" @if(old('recruitment_process')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('recruitment_process'))
                    <span class="text-danger">{{ $errors->first('recruitment_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="induction_process" class="form-label rdioBtn">Induction process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="NA" @if(old('induction_process')=='NA') checked @elseif(old('induction_process')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="1" @if(old('induction_process')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="2" @if(old('induction_process')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="3" @if(old('induction_process')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="4" @if(old('induction_process')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="induction_process" id="induction_process" value="5" @if(old('induction_process')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('induction_process'))
                    <span class="text-danger">{{ $errors->first('induction_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="on_job_training_process" class="form-label rdioBtn">On-job training process <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="NA" @if(old('on_job_training_process')=='NA') checked @elseif(old('on_job_training_process')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="1" @if(old('on_job_training_process')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="2" @if(old('on_job_training_process')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="3" @if(old('on_job_training_process')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="4" @if(old('on_job_training_process')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="on_job_training_process" id="on_job_training_process" value="5" @if(old('on_job_training_process')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('on_job_training_process'))
                    <span class="text-danger">{{ $errors->first('on_job_training_process') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="clear_communication_changes_policy" class="form-label rdioBtn">Clear communication about any changes in the policy <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="NA" @if(old('clear_communication_changes_policy')=='NA') checked @elseif(old('clear_communication_changes_policy')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="1" @if(old('clear_communication_changes_policy')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="2" @if(old('clear_communication_changes_policy')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="3" @if(old('clear_communication_changes_policy')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="4" @if(old('clear_communication_changes_policy')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="clear_communication_changes_policy" id="clear_communication_changes_policy" value="5" @if(old('clear_communication_changes_policy')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('clear_communication_changes_policy'))
                    <span class="text-danger">{{ $errors->first('clear_communication_changes_policy') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="feeling_belongingness_organization" class="form-label rdioBtn">Feeling of belongingness in the organization <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="NA" @if(old('feeling_belongingness_organization')=='NA') checked @elseif(old('feeling_belongingness_organization')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="1" @if(old('feeling_belongingness_organization')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="2" @if(old('feeling_belongingness_organization')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="3" @if(old('feeling_belongingness_organization')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="4" @if(old('feeling_belongingness_organization')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="feeling_belongingness_organization" id="feeling_belongingness_organization" value="5" @if(old('feeling_belongingness_organization')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('feeling_belongingness_organization'))
                    <span class="text-danger">{{ $errors->first('feeling_belongingness_organization') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="having_best_friend_at_work" class="form-label rdioBtn">Having a best friend at work <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="NA" @if(old('having_best_friend_at_work')=='NA') checked @elseif(old('having_best_friend_at_work')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="1" @if(old('having_best_friend_at_work')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="2" @if(old('having_best_friend_at_work')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="3" @if(old('having_best_friend_at_work')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="4" @if(old('having_best_friend_at_work')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="having_best_friend_at_work" id="having_best_friend_at_work" value="5" @if(old('having_best_friend_at_work')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('having_best_friend_at_work'))
                    <span class="text-danger">{{ $errors->first('having_best_friend_at_work') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="work_life_balance" class="form-label rdioBtn">Work-life balance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="NA" @if(old('work_life_balance')=='NA') checked @elseif(old('work_life_balance')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="1" @if(old('work_life_balance')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="2" @if(old('work_life_balance')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="3" @if(old('work_life_balance')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="4" @if(old('work_life_balance')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="work_life_balance" id="work_life_balance" value="5" @if(old('work_life_balance')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('work_life_balance'))
                    <span class="text-danger">{{ $errors->first('work_life_balance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_detailed_feedback_support_your_response" class="form-label">Any detailed feedback you would like to share to support your response on the above parameters? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_detailed_feedback_support_your_response" id="any_detailed_feedback_support_your_response" style="height: 100px">{{ old('any_detailed_feedback_support_your_response')}}</textarea>

                  @if ($errors->has('any_detailed_feedback_support_your_response'))
                    <span class="text-danger">{{ $errors->first('any_detailed_feedback_support_your_response') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_detailed_feedback_support_your_response' );
                  </script>

                </div>
                

                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Rate <span id="rate_5_reporting_manager_name_ajax">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span> on the below-mentioned parameters out of 5</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="quickness_in_respond_reporting_manager" class="form-label rdioBtn">Quickness in respond to your requests/queries/concerns?  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="NA" @if(old('quickness_in_respond_reporting_manager')=='NA') checked @elseif(old('quickness_in_respond_reporting_manager')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="1" @if(old('quickness_in_respond_reporting_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="2" @if(old('quickness_in_respond_reporting_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="3" @if(old('quickness_in_respond_reporting_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="4" @if(old('quickness_in_respond_reporting_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager" id="quickness_in_respond_reporting_manager" value="5" @if(old('quickness_in_respond_reporting_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('quickness_in_respond_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('quickness_in_respond_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_well_received_guidance_reporting_manager" class="form-label rdioBtn">How well have you received guidance? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="NA" @if(old('how_well_received_guidance_reporting_manager')=='NA') checked @elseif(old('how_well_received_guidance_reporting_manager')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="1" @if(old('how_well_received_guidance_reporting_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="2" @if(old('how_well_received_guidance_reporting_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="3" @if(old('how_well_received_guidance_reporting_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="4" @if(old('how_well_received_guidance_reporting_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager" id="how_well_received_guidance_reporting_manager" value="5" @if(old('how_well_received_guidance_reporting_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('how_well_received_guidance_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_well_received_guidance_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_clearly_your_goals_set_reporting_manager" class="form-label rdioBtn">How clearly are your goals set? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="NA" @if(old('how_clearly_your_goals_set_reporting_manager')=='NA') checked @elseif(old('how_clearly_your_goals_set_reporting_manager')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="1" @if(old('how_clearly_your_goals_set_reporting_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="2" @if(old('how_clearly_your_goals_set_reporting_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="3" @if(old('how_clearly_your_goals_set_reporting_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="4" @if(old('how_clearly_your_goals_set_reporting_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager" id="how_clearly_your_goals_set_reporting_manager" value="5" @if(old('how_clearly_your_goals_set_reporting_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('how_clearly_your_goals_set_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_clearly_your_goals_set_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_transparent_is_reporting_manager" class="form-label rdioBtn">How transparent is <span id="how_transparent_reporting_manager_name_ajax">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span> <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="NA" @if(old('how_transparent_is_reporting_manager')=='NA') checked @elseif(old('how_transparent_is_reporting_manager')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="1" @if(old('how_transparent_is_reporting_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="2" @if(old('how_transparent_is_reporting_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="3" @if(old('how_transparent_is_reporting_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="4" @if(old('how_transparent_is_reporting_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager" id="how_transparent_is_reporting_manager" value="5" @if(old('how_transparent_is_reporting_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('how_transparent_is_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_transparent_is_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="wprs_happen_every_week_reporting_manager" class="form-label rdioBtn">WPRs happen every week. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="NA" @if(old('wprs_happen_every_week_reporting_manager')=='NA') checked @elseif(old('wprs_happen_every_week_reporting_manager')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="1" @if(old('wprs_happen_every_week_reporting_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="2" @if(old('wprs_happen_every_week_reporting_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="3" @if(old('wprs_happen_every_week_reporting_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="4" @if(old('wprs_happen_every_week_reporting_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="wprs_happen_every_week_reporting_manager" id="wprs_happen_every_week_reporting_manager" value="5" @if(old('wprs_happen_every_week_reporting_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('wprs_happen_every_week_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('wprs_happen_every_week_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_well_adjust_changing_priorities_reporting_manager" class="form-label rdioBtn">How well does {{ $reporting_manager_name_ajax_default }} adjust to changing priorities <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="NA" @if(old('how_well_adjust_changing_priorities_reporting_manager')=='NA') checked @elseif(old('how_well_adjust_changing_priorities_reporting_manager')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="1" @if(old('how_well_adjust_changing_priorities_reporting_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="2" @if(old('how_well_adjust_changing_priorities_reporting_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="3" @if(old('how_well_adjust_changing_priorities_reporting_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="4" @if(old('how_well_adjust_changing_priorities_reporting_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager" id="how_well_adjust_changing_priorities_reporting_manager" value="5" @if(old('how_well_adjust_changing_priorities_reporting_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_well_adjust_changing_priorities_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_well_adjust_changing_priorities_reporting_manager') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_comfortable_feel_sharing_feedback_reporting_manager" class="form-label rdioBtn">How comfortable do you feel in sharing your feedback with {{ $reporting_manager_name_ajax_default }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="NA" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager')=='NA') checked @elseif(old('how_comfortable_feel_sharing_feedback_reporting_manager')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="1" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="2" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="3" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="4" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager" id="how_comfortable_feel_sharing_feedback_reporting_manager" value="5" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_comfortable_feel_sharing_feedback_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_comfortable_feel_sharing_feedback_reporting_manager') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_well_able_learn_under_guidance_reporting_manager" class="form-label rdioBtn">How well are you able to learn under guidance? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="NA" @if(old('how_well_able_learn_under_guidance_reporting_manager')=='NA') checked @elseif(old('how_well_able_learn_under_guidance_reporting_manager')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="1" @if(old('how_well_able_learn_under_guidance_reporting_manager')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="2" @if(old('how_well_able_learn_under_guidance_reporting_manager')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="3" @if(old('how_well_able_learn_under_guidance_reporting_manager')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="4" @if(old('how_well_able_learn_under_guidance_reporting_manager')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_able_learn_under_guidance_reporting_manager" id="how_well_able_learn_under_guidance_reporting_manager" value="5" @if(old('how_well_able_learn_under_guidance_reporting_manager')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_well_able_learn_under_guidance_reporting_manager'))
                    <span class="text-danger">{{ $errors->first('how_well_able_learn_under_guidance_reporting_manager') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="our_organization_believes_mantra" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra" id="our_organization_believes_mantra" style="height: 100px">{{ old('our_organization_believes_mantra')}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra' );
                  </script>

                </div>


                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Rate Reporting Manager (<span class="rate_5_reporting_manager_name_ajax_class">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span>)  on the below mentioned parameters out of 5 (5- highest, 1- lowest)</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="quickness_in_respond_reporting_manager_qi" class="form-label rdioBtn">How quickly does {{ $reporting_manager_name_ajax_default }} respond to your requests/queries/concerns? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager_qi" id="quickness_in_respond_reporting_manager_qi" value="NA" @if(old('quickness_in_respond_reporting_manager_qi')=='NA') checked @elseif(old('quickness_in_respond_reporting_manager_qi')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager_qi" id="quickness_in_respond_reporting_manager_qi" value="1" @if(old('quickness_in_respond_reporting_manager_qi')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager_qi" id="quickness_in_respond_reporting_manager_qi" value="2" @if(old('quickness_in_respond_reporting_manager_qi')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager_qi" id="quickness_in_respond_reporting_manager_qi" value="3" @if(old('quickness_in_respond_reporting_manager_qi')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager_qi" id="quickness_in_respond_reporting_manager_qi" value="4" @if(old('quickness_in_respond_reporting_manager_qi')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_reporting_manager_qi" id="quickness_in_respond_reporting_manager_qi" value="5" @if(old('quickness_in_respond_reporting_manager_qi')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('quickness_in_respond_reporting_manager_qi'))
                    <span class="text-danger">{{ $errors->first('quickness_in_respond_reporting_manager_qi') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_well_received_guidance_reporting_manager_qi" class="form-label rdioBtn">How well have you received guidance? How well have you received guidance from {{ $reporting_manager_name_ajax_default }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager_qi" id="how_well_received_guidance_reporting_manager_qi" value="NA" @if(old('how_well_received_guidance_reporting_manager_qi')=='NA') checked @elseif(old('how_well_received_guidance_reporting_manager_qi')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager_qi" id="how_well_received_guidance_reporting_manager_qi" value="1" @if(old('how_well_received_guidance_reporting_manager_qi')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager_qi" id="how_well_received_guidance_reporting_manager_qi" value="2" @if(old('how_well_received_guidance_reporting_manager_qi')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager_qi" id="how_well_received_guidance_reporting_manager_qi" value="3" @if(old('how_well_received_guidance_reporting_manager_qi')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager_qi" id="how_well_received_guidance_reporting_manager_qi" value="4" @if(old('how_well_received_guidance_reporting_manager_qi')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_reporting_manager_qi" id="how_well_received_guidance_reporting_manager_qi" value="5" @if(old('how_well_received_guidance_reporting_manager_qi')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_well_received_guidance_reporting_manager_qi'))
                    <span class="text-danger">{{ $errors->first('how_well_received_guidance_reporting_manager_qi') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_clearly_your_goals_set_reporting_manager_qi" class="form-label rdioBtn">How clearly are your goals set by {{ $reporting_manager_name_ajax_default }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager_qi" id="how_clearly_your_goals_set_reporting_manager_qi" value="NA" @if(old('how_clearly_your_goals_set_reporting_manager_qi')=='NA') checked @elseif(old('how_clearly_your_goals_set_reporting_manager_qi')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager_qi" id="how_clearly_your_goals_set_reporting_manager_qi" value="1" @if(old('how_clearly_your_goals_set_reporting_manager_qi')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager_qi" id="how_clearly_your_goals_set_reporting_manager_qi" value="2" @if(old('how_clearly_your_goals_set_reporting_manager_qi')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager_qi" id="how_clearly_your_goals_set_reporting_manager_qi" value="3" @if(old('how_clearly_your_goals_set_reporting_manager_qi')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager_qi" id="how_clearly_your_goals_set_reporting_manager_qi" value="4" @if(old('how_clearly_your_goals_set_reporting_manager_qi')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_reporting_manager_qi" id="how_clearly_your_goals_set_reporting_manager_qi" value="5" @if(old('how_clearly_your_goals_set_reporting_manager_qi')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_clearly_your_goals_set_reporting_manager_qi'))
                    <span class="text-danger">{{ $errors->first('how_clearly_your_goals_set_reporting_manager_qi') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_transparent_is_reporting_manager_qi" class="form-label rdioBtn">How transparent is {{ $reporting_manager_name_ajax_default }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager_qi" id="how_transparent_is_reporting_manager_qi" value="NA" @if(old('how_transparent_is_reporting_manager_qi')=='NA') checked @elseif(old('how_transparent_is_reporting_manager_qi')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager_qi" id="how_transparent_is_reporting_manager_qi" value="1" @if(old('how_transparent_is_reporting_manager_qi')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager_qi" id="how_transparent_is_reporting_manager_qi" value="2" @if(old('how_transparent_is_reporting_manager_qi')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager_qi" id="how_transparent_is_reporting_manager_qi" value="3" @if(old('how_transparent_is_reporting_manager_qi')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager_qi" id="how_transparent_is_reporting_manager_qi" value="4" @if(old('how_transparent_is_reporting_manager_qi')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_reporting_manager_qi" id="how_transparent_is_reporting_manager_qi" value="5" @if(old('how_transparent_is_reporting_manager_qi')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_transparent_is_reporting_manager_qi'))
                    <span class="text-danger">{{ $errors->first('how_transparent_is_reporting_manager_qi') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="frequent_1_1_happen_reporting_manager_qi" class="form-label rdioBtn">How frequent does your 1:1 happen? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager_qi" id="frequent_1_1_happen_reporting_manager_qi" value="NA" @if(old('frequent_1_1_happen_reporting_manager_qi')=='NA') checked @elseif(old('frequent_1_1_happen_reporting_manager_qi')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager_qi" id="frequent_1_1_happen_reporting_manager_qi" value="1" @if(old('frequent_1_1_happen_reporting_manager_qi')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager_qi" id="frequent_1_1_happen_reporting_manager_qi" value="2" @if(old('frequent_1_1_happen_reporting_manager_qi')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager_qi" id="frequent_1_1_happen_reporting_manager_qi" value="3" @if(old('frequent_1_1_happen_reporting_manager_qi')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager_qi" id="frequent_1_1_happen_reporting_manager_qi" value="4" @if(old('frequent_1_1_happen_reporting_manager_qi')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_reporting_manager_qi" id="frequent_1_1_happen_reporting_manager_qi" value="5" @if(old('frequent_1_1_happen_reporting_manager_qi')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('frequent_1_1_happen_reporting_manager_qi'))
                    <span class="text-danger">{{ $errors->first('frequent_1_1_happen_reporting_manager_qi') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_well_adjust_changing_priorities_reporting_manager_qi" class="form-label rdioBtn">How well does {{ $reporting_manager_name_ajax_default }} adjust to changing priorities? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager_qi" id="how_well_adjust_changing_priorities_reporting_manager_qi" value="NA" @if(old('how_well_adjust_changing_priorities_reporting_manager_qi')=='NA') checked @elseif(old('how_well_adjust_changing_priorities_reporting_manager_qi')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager_qi" id="how_well_adjust_changing_priorities_reporting_manager_qi" value="1" @if(old('how_well_adjust_changing_priorities_reporting_manager_qi')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager_qi" id="how_well_adjust_changing_priorities_reporting_manager_qi" value="2" @if(old('how_well_adjust_changing_priorities_reporting_manager_qi')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager_qi" id="how_well_adjust_changing_priorities_reporting_manager_qi" value="3" @if(old('how_well_adjust_changing_priorities_reporting_manager_qi')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager_qi" id="how_well_adjust_changing_priorities_reporting_manager_qi" value="4" @if(old('how_well_adjust_changing_priorities_reporting_manager_qi')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_reporting_manager_qi" id="how_well_adjust_changing_priorities_reporting_manager_qi" value="5" @if(old('how_well_adjust_changing_priorities_reporting_manager_qi')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_well_adjust_changing_priorities_reporting_manager_qi'))
                    <span class="text-danger">{{ $errors->first('how_well_adjust_changing_priorities_reporting_manager_qi') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_comfortable_feel_sharing_feedback_reporting_manager_qi" class="form-label rdioBtn">How comfortable do you feel in sharing your feedback with {{ $reporting_manager_name_ajax_default }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager_qi" id="how_comfortable_feel_sharing_feedback_reporting_manager_qi" value="NA" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager_qi')=='NA') checked @elseif(old('how_comfortable_feel_sharing_feedback_reporting_manager_qi')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager_qi" id="how_comfortable_feel_sharing_feedback_reporting_manager_qi" value="1" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager_qi')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager_qi" id="how_comfortable_feel_sharing_feedback_reporting_manager_qi" value="2" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager_qi')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager_qi" id="how_comfortable_feel_sharing_feedback_reporting_manager_qi" value="3" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager_qi')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager_qi" id="how_comfortable_feel_sharing_feedback_reporting_manager_qi" value="4" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager_qi')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_reporting_manager_qi" id="how_comfortable_feel_sharing_feedback_reporting_manager_qi" value="5" @if(old('how_comfortable_feel_sharing_feedback_reporting_manager_qi')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_comfortable_feel_sharing_feedback_reporting_manager_qi'))
                    <span class="text-danger">{{ $errors->first('how_comfortable_feel_sharing_feedback_reporting_manager_qi') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share top three strengths of Reporting Manager (<span class="rate_5_reporting_manager_name_ajax_class">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span>) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_strengths_reporting_manager_qi_1" id="top_3_strengths_reporting_manager_qi_1" value="{{ old('top_3_strengths_reporting_manager_qi_1') }}">
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
                      <input type="text" class="form-control" name="top_3_strengths_reporting_manager_qi_2" id="top_3_strengths_reporting_manager_qi_2" value="{{ old('top_3_strengths_reporting_manager_qi_2') }}">
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
                      <input type="text" class="form-control" name="top_3_strengths_reporting_manager_qi_3" id="top_3_strengths_reporting_manager_qi_3" value="{{ old('top_3_strengths_reporting_manager_qi_3') }}">
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
                  <label for="company_hr_name" class="form-label">Share three areas of improvement for Reporting Manager (<span class="rate_5_reporting_manager_name_ajax_class">{{ old('reporting_manager_name_ajax', $reporting_manager_name_ajax_default) }}</span>) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_improvement_reporting_manager_qi_1" id="three_areas_improvement_reporting_manager_qi_1" value="{{ old('three_areas_improvement_reporting_manager_qi_1') }}">
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
                      <input type="text" class="form-control" name="three_areas_improvement_reporting_manager_qi_2" id="three_areas_improvement_reporting_manager_qi_2" value="{{ old('three_areas_improvement_reporting_manager_qi_2') }}">
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
                      <input type="text" class="form-control" name="three_areas_improvement_reporting_manager_qi_3" id="three_areas_improvement_reporting_manager_qi_3" value="{{ old('three_areas_improvement_reporting_manager_qi_3') }}">
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
                  <label for="our_organization_believes_mantra_reporting_manager_qi" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra_reporting_manager_qi" id="our_organization_believes_mantra_reporting_manager_qi" style="height: 100px">{{ old('our_organization_believes_mantra_reporting_manager_qi')}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra_reporting_manager_qi'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra_reporting_manager_qi') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra_reporting_manager_qi' );
                  </script>

                </div>


                <!-- Q-H -->
                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label"><strong>Rate HOD (<span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span>)  on the below mentioned parameters out of 5 (5- highest, 1- lowest)</strong></label>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="quickness_in_respond_hod_qj" class="form-label rdioBtn">How quickly does <span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span> respond to your requests/queries/concerns? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="quickness_in_respond_hod_qj" id="quickness_in_respond_hod_qj" value="NA" @if(old('quickness_in_respond_hod_qj')=='NA') checked @elseif(old('quickness_in_respond_hod_qj')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_hod_qj" id="quickness_in_respond_hod_qj" value="1" @if(old('quickness_in_respond_hod_qj')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_hod_qj" id="quickness_in_respond_hod_qj" value="2" @if(old('quickness_in_respond_hod_qj')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_hod_qj" id="quickness_in_respond_hod_qj" value="3" @if(old('quickness_in_respond_hod_qj')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_hod_qj" id="quickness_in_respond_hod_qj" value="4" @if(old('quickness_in_respond_hod_qj')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="quickness_in_respond_hod_qj" id="quickness_in_respond_hod_qj" value="5" @if(old('quickness_in_respond_hod_qj')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('quickness_in_respond_hod_qj'))
                    <span class="text-danger">{{ $errors->first('quickness_in_respond_hod_qj') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_well_received_guidance_hod_qj" class="form-label rdioBtn">How well have you received guidance from <span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span>? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_received_guidance_hod_qj" id="how_well_received_guidance_hod_qj" value="NA" @if(old('how_well_received_guidance_hod_qj')=='NA') checked @elseif(old('how_well_received_guidance_hod_qj')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_hod_qj" id="how_well_received_guidance_hod_qj" value="1" @if(old('how_well_received_guidance_hod_qj')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_hod_qj" id="how_well_received_guidance_hod_qj" value="2" @if(old('how_well_received_guidance_hod_qj')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_hod_qj" id="how_well_received_guidance_hod_qj" value="3" @if(old('how_well_received_guidance_hod_qj')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_hod_qj" id="how_well_received_guidance_hod_qj" value="4" @if(old('how_well_received_guidance_hod_qj')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_received_guidance_hod_qj" id="how_well_received_guidance_hod_qj" value="5" @if(old('how_well_received_guidance_hod_qj')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_well_received_guidance_hod_qj'))
                    <span class="text-danger">{{ $errors->first('how_well_received_guidance_hod_qj') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_clearly_your_goals_set_hod_qj" class="form-label rdioBtn">How clearly are your goals set by <span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span>? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_hod_qj" id="how_clearly_your_goals_set_hod_qj" value="NA" @if(old('how_clearly_your_goals_set_hod_qj')=='NA') checked @elseif(old('how_clearly_your_goals_set_hod_qj')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_hod_qj" id="how_clearly_your_goals_set_hod_qj" value="1" @if(old('how_clearly_your_goals_set_hod_qj')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_hod_qj" id="how_clearly_your_goals_set_hod_qj" value="2" @if(old('how_clearly_your_goals_set_hod_qj')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_hod_qj" id="how_clearly_your_goals_set_hod_qj" value="3" @if(old('how_clearly_your_goals_set_hod_qj')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_hod_qj" id="how_clearly_your_goals_set_hod_qj" value="4" @if(old('how_clearly_your_goals_set_hod_qj')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_clearly_your_goals_set_hod_qj" id="how_clearly_your_goals_set_hod_qj" value="5" @if(old('how_clearly_your_goals_set_hod_qj')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_clearly_your_goals_set_hod_qj'))
                    <span class="text-danger">{{ $errors->first('how_clearly_your_goals_set_hod_qj') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="how_transparent_is_hod_qj" class="form-label rdioBtn">How transparent is <span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span>? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_transparent_is_hod_qj" id="how_transparent_is_hod_qj" value="NA" @if(old('how_transparent_is_hod_qj')=='NA') checked @elseif(old('how_transparent_is_hod_qj')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_hod_qj" id="how_transparent_is_hod_qj" value="1" @if(old('how_transparent_is_hod_qj')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_hod_qj" id="how_transparent_is_hod_qj" value="2" @if(old('how_transparent_is_hod_qj')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_hod_qj" id="how_transparent_is_hod_qj" value="3" @if(old('how_transparent_is_hod_qj')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_hod_qj" id="how_transparent_is_hod_qj" value="4" @if(old('how_transparent_is_hod_qj')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_transparent_is_hod_qj" id="how_transparent_is_hod_qj" value="5" @if(old('how_transparent_is_hod_qj')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_transparent_is_hod_qj'))
                    <span class="text-danger">{{ $errors->first('how_transparent_is_hod_qj') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="frequent_1_1_happen_hod_qj" class="form-label rdioBtn">How frequent does your 1:1 happen? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_hod_qj" id="frequent_1_1_happen_hod_qj" value="NA" @if(old('frequent_1_1_happen_hod_qj')=='NA') checked @elseif(old('frequent_1_1_happen_hod_qj')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_hod_qj" id="frequent_1_1_happen_hod_qj" value="1" @if(old('frequent_1_1_happen_hod_qj')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_hod_qj" id="frequent_1_1_happen_hod_qj" value="2" @if(old('frequent_1_1_happen_hod_qj')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_hod_qj" id="frequent_1_1_happen_hod_qj" value="3" @if(old('frequent_1_1_happen_hod_qj')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_hod_qj" id="frequent_1_1_happen_hod_qj" value="4" @if(old('frequent_1_1_happen_hod_qj')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="frequent_1_1_happen_hod_qj" id="frequent_1_1_happen_hod_qj" value="5" @if(old('frequent_1_1_happen_hod_qj')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('frequent_1_1_happen_hod_qj'))
                    <span class="text-danger">{{ $errors->first('frequent_1_1_happen_hod_qj') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_well_adjust_changing_priorities_hod_qj" class="form-label rdioBtn">How well does <span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span> adjust to changing priorities? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_hod_qj" id="how_well_adjust_changing_priorities_hod_qj" value="NA" @if(old('how_well_adjust_changing_priorities_hod_qj')=='NA') checked @elseif(old('how_well_adjust_changing_priorities_hod_qj')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_hod_qj" id="how_well_adjust_changing_priorities_hod_qj" value="1" @if(old('how_well_adjust_changing_priorities_hod_qj')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_hod_qj" id="how_well_adjust_changing_priorities_hod_qj" value="2" @if(old('how_well_adjust_changing_priorities_hod_qj')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_hod_qj" id="how_well_adjust_changing_priorities_hod_qj" value="3" @if(old('how_well_adjust_changing_priorities_hod_qj')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_hod_qj" id="how_well_adjust_changing_priorities_hod_qj" value="4" @if(old('how_well_adjust_changing_priorities_hod_qj')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_well_adjust_changing_priorities_hod_qj" id="how_well_adjust_changing_priorities_hod_qj" value="5" @if(old('how_well_adjust_changing_priorities_hod_qj')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_well_adjust_changing_priorities_hod_qj'))
                    <span class="text-danger">{{ $errors->first('how_well_adjust_changing_priorities_hod_qj') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_comfortable_feel_sharing_feedback_hod_qj" class="form-label rdioBtn">How comfortable do you feel in sharing your feedback with <span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span>? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_hod_qj" id="how_comfortable_feel_sharing_feedback_hod_qj" value="NA" @if(old('how_comfortable_feel_sharing_feedback_hod_qj')=='NA') checked @elseif(old('how_comfortable_feel_sharing_feedback_hod_qj')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_hod_qj" id="how_comfortable_feel_sharing_feedback_hod_qj" value="1" @if(old('how_comfortable_feel_sharing_feedback_hod_qj')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_hod_qj" id="how_comfortable_feel_sharing_feedback_hod_qj" value="2" @if(old('how_comfortable_feel_sharing_feedback_hod_qj')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_hod_qj" id="how_comfortable_feel_sharing_feedback_hod_qj" value="3" @if(old('how_comfortable_feel_sharing_feedback_hod_qj')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_hod_qj" id="how_comfortable_feel_sharing_feedback_hod_qj" value="4" @if(old('how_comfortable_feel_sharing_feedback_hod_qj')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="how_comfortable_feel_sharing_feedback_hod_qj" id="how_comfortable_feel_sharing_feedback_hod_qj" value="5" @if(old('how_comfortable_feel_sharing_feedback_hod_qj')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('how_comfortable_feel_sharing_feedback_hod_qj'))
                    <span class="text-danger">{{ $errors->first('how_comfortable_feel_sharing_feedback_hod_qj') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Share top three strengths HOD(<span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span>) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_strengths_hod_qj_1" id="top_3_strengths_hod_qj_1" value="{{ old('top_3_strengths_hod_qj_1') }}">
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
                      <input type="text" class="form-control" name="top_3_strengths_hod_qj_2" id="top_3_strengths_hod_qj_2" value="{{ old('top_3_strengths_hod_qj_2') }}">
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
                      <input type="text" class="form-control" name="top_3_strengths_hod_qj_3" id="top_3_strengths_hod_qj_3" value="{{ old('top_3_strengths_hod_qj_3') }}">
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
                  <label for="company_hr_name" class="form-label">Share three areas of improvement HOD(<span class="rate_5_hod_name_ajax_class">{{ old('head_of_department_name_ajax') }}</span>) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="three_areas_improvement_hod_qj_1" id="three_areas_improvement_hod_qj_1" value="{{ old('three_areas_improvement_hod_qj_1') }}">
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
                      <input type="text" class="form-control" name="three_areas_improvement_hod_qj_2" id="three_areas_improvement_hod_qj_2" value="{{ old('three_areas_improvement_hod_qj_2') }}">
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
                      <input type="text" class="form-control" name="three_areas_improvement_hod_qj_3" id="three_areas_improvement_hod_qj_3" value="{{ old('three_areas_improvement_hod_qj_3') }}">
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
                  <label for="our_organization_believes_mantra_hod_qj" class="form-label">Our organization believes in the mantra of 'Lead by Example'. Do you feel motivated by actions/way of work? Explain in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="our_organization_believes_mantra_hod_qj" id="our_organization_believes_mantra_hod_qj" style="height: 100px">{{ old('our_organization_believes_mantra')}}</textarea>

                  @if ($errors->has('our_organization_believes_mantra_hod_qj'))
                    <span class="text-danger">{{ $errors->first('our_organization_believes_mantra_hod_qj') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'our_organization_believes_mantra_hod_qj' );
                  </script>

                </div>


                <div class="col-md-12 position-relative margin_top_bottom">
                  <label class="form-label">Rate the Departments out of 5</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="admin_operations" class="form-label rdioBtn">Admin Operations<!--  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong> --></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="admin_operations" id="admin_operations" value="NA" @if(old('admin_operations')=='NA') checked @elseif(old('admin_operations')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="admin_operations" id="admin_operations" value="1" @if(old('admin_operations')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="admin_operations" id="admin_operations" value="2" @if(old('admin_operations')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="admin_operations" id="admin_operations" value="3" @if(old('admin_operations')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="admin_operations" id="admin_operations" value="4" @if(old('admin_operations')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="admin_operations" id="admin_operations" value="5" @if(old('admin_operations')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('admin_operations'))
                    <span class="text-danger">{{ $errors->first('admin_operations') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="advertiser_sales" class="form-label rdioBtn">Advertiser Sales</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="advertiser_sales" id="advertiser_sales" value="NA" @if(old('advertiser_sales')=='NA') checked @elseif(old('advertiser_sales')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="advertiser_sales" id="advertiser_sales" value="1" @if(old('advertiser_sales')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="advertiser_sales" id="advertiser_sales" value="2" @if(old('advertiser_sales')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="advertiser_sales" id="advertiser_sales" value="3" @if(old('advertiser_sales')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="advertiser_sales" id="advertiser_sales" value="4" @if(old('advertiser_sales')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="advertiser_sales" id="advertiser_sales" value="5" @if(old('advertiser_sales')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('advertiser_sales'))
                    <span class="text-danger">{{ $errors->first('advertiser_sales') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="advertisers" class="form-label rdioBtn">Advertisers</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="advertisers" id="advertisers" value="NA" @if(old('advertisers')=='NA') checked @elseif(old('advertisers')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="advertisers" id="advertisers" value="1" @if(old('advertisers')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="advertisers" id="advertisers" value="2" @if(old('advertisers')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="advertisers" id="advertisers" value="3" @if(old('advertisers')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="advertisers" id="advertisers" value="4" @if(old('advertisers')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="advertisers" id="advertisers" value="5" @if(old('advertisers')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('advertisers'))
                    <span class="text-danger">{{ $errors->first('advertisers') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="finance_accounts" class="form-label rdioBtn">Finance & Accounts</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="finance_accounts" id="finance_accounts" value="NA" @if(old('finance_accounts')=='NA') checked @elseif(old('finance_accounts')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="finance_accounts" id="finance_accounts" value="1" @if(old('finance_accounts')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="finance_accounts" id="finance_accounts" value="2" @if(old('finance_accounts')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="finance_accounts" id="finance_accounts" value="3" @if(old('finance_accounts')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="finance_accounts" id="finance_accounts" value="4" @if(old('finance_accounts')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="finance_accounts" id="finance_accounts" value="5" @if(old('finance_accounts')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('finance_accounts'))
                    <span class="text-danger">{{ $errors->first('finance_accounts') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="human_resources" class="form-label rdioBtn">Human Resources</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="human_resources" id="human_resources" value="NA" @if(old('human_resources')=='NA') checked @elseif(old('human_resources')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="human_resources" id="human_resources" value="1" @if(old('human_resources')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="human_resources" id="human_resources" value="2" @if(old('human_resources')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="human_resources" id="human_resources" value="3" @if(old('human_resources')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="human_resources" id="human_resources" value="4" @if(old('human_resources')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="human_resources" id="human_resources" value="5" @if(old('human_resources')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('human_resources'))
                    <span class="text-danger">{{ $errors->first('human_resources') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="management" class="form-label rdioBtn">Management</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="management" id="management" value="NA" @if(old('management')=='NA') checked @elseif(old('management')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="management" id="management" value="1" @if(old('management')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="management" id="management" value="2" @if(old('management')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="management" id="management" value="3" @if(old('management')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="management" id="management" value="4" @if(old('management')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="management" id="management" value="5" @if(old('management')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('management'))
                    <span class="text-danger">{{ $errors->first('management') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="network_operations" class="form-label rdioBtn">Network Operations</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="network_operations" id="network_operations" value="NA" @if(old('network_operations')=='NA') checked @elseif(old('network_operations')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="network_operations" id="network_operations" value="1" @if(old('network_operations')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="network_operations" id="network_operations" value="2" @if(old('network_operations')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="network_operations" id="network_operations" value="3" @if(old('network_operations')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="network_operations" id="network_operations" value="4" @if(old('network_operations')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="network_operations" id="network_operations" value="5" @if(old('network_operations')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('network_operations'))
                    <span class="text-danger">{{ $errors->first('network_operations') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="pocket_money" class="form-label rdioBtn">Pocket Money</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="pocket_money" id="pocket_money" value="NA" @if(old('pocket_money')=='NA') checked @elseif(old('pocket_money')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="pocket_money" id="pocket_money" value="1" @if(old('pocket_money')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="pocket_money" id="pocket_money" value="2" @if(old('pocket_money')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="pocket_money" id="pocket_money" value="3" @if(old('pocket_money')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="pocket_money" id="pocket_money" value="4" @if(old('pocket_money')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="pocket_money" id="pocket_money" value="5" @if(old('pocket_money')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('pocket_money'))
                    <span class="text-danger">{{ $errors->first('pocket_money') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="publishers" class="form-label rdioBtn">Publishers</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="publishers" id="publishers" value="NA" @if(old('publishers')=='NA') checked @elseif(old('publishers')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="publishers" id="publishers" value="1" @if(old('publishers')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="publishers" id="publishers" value="2" @if(old('publishers')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="publishers" id="publishers" value="3" @if(old('publishers')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="publishers" id="publishers" value="4" @if(old('publishers')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="publishers" id="publishers" value="5" @if(old('publishers')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('publishers'))
                    <span class="text-danger">{{ $errors->first('publishers') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="tech_operations_development" class="form-label rdioBtn">Tech Operations - Development</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="tech_operations_development" id="tech_operations_development" value="NA" @if(old('tech_operations_development')=='NA') checked @elseif(old('tech_operations_development')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="tech_operations_development" id="tech_operations_development" value="1" @if(old('tech_operations_development')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="tech_operations_development" id="tech_operations_development" value="2" @if(old('tech_operations_development')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="tech_operations_development" id="tech_operations_development" value="3" @if(old('tech_operations_development')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="tech_operations_development" id="tech_operations_development" value="4" @if(old('tech_operations_development')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="tech_operations_development" id="tech_operations_development" value="5" @if(old('tech_operations_development')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('tech_operations_development'))
                    <span class="text-danger">{{ $errors->first('tech_operations_development') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="support_ea_pa" class="form-label rdioBtn">Support (EA/PA)</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="support_ea_pa" id="support_ea_pa" value="NA" @if(old('support_ea_pa')=='NA') checked @elseif(old('support_ea_pa')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="support_ea_pa" id="support_ea_pa" value="1" @if(old('support_ea_pa')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="support_ea_pa" id="support_ea_pa" value="2" @if(old('support_ea_pa')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="support_ea_pa" id="support_ea_pa" value="3" @if(old('support_ea_pa')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="support_ea_pa" id="support_ea_pa" value="4" @if(old('support_ea_pa')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="support_ea_pa" id="support_ea_pa" value="5" @if(old('support_ea_pa')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('support_ea_pa'))
                    <span class="text-danger">{{ $errors->first('support_ea_pa') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="education" class="form-label rdioBtn">Education</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="education" id="education" value="NA" @if(old('education')=='NA') checked @elseif(old('education')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="education" id="education" value="1" @if(old('education')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="education" id="education" value="2" @if(old('education')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="education" id="education" value="3" @if(old('education')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="education" id="education" value="4" @if(old('education')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="education" id="education" value="5" @if(old('education')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('education'))
                    <span class="text-danger">{{ $errors->first('education') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="igaming" class="form-label rdioBtn">iGaming</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="igaming" id="igaming" value="NA" @if(old('igaming')=='NA') checked @elseif(old('igaming')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="igaming" id="igaming" value="1" @if(old('igaming')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="igaming" id="igaming" value="2" @if(old('igaming')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="igaming" id="igaming" value="3" @if(old('igaming')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="igaming" id="igaming" value="4" @if(old('igaming')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="igaming" id="igaming" value="5" @if(old('igaming')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('igaming'))
                    <span class="text-danger">{{ $errors->first('igaming') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="tech_operations_shopify" class="form-label rdioBtn">Tech Operations - Shopify</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="tech_operations_shopify" id="tech_operations_shopify" value="NA" @if(old('tech_operations_shopify')=='NA') checked @elseif(old('tech_operations_shopify')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="tech_operations_shopify" id="tech_operations_shopify" value="1" @if(old('tech_operations_shopify')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="tech_operations_shopify" id="tech_operations_shopify" value="2" @if(old('tech_operations_shopify')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="tech_operations_shopify" id="tech_operations_shopify" value="3" @if(old('tech_operations_shopify')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="tech_operations_shopify" id="tech_operations_shopify" value="4" @if(old('tech_operations_shopify')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="tech_operations_shopify" id="tech_operations_shopify" value="5" @if(old('tech_operations_shopify')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('tech_operations_shopify'))
                    <span class="text-danger">{{ $errors->first('tech_operations_shopify') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="tech_operations_creative" class="form-label rdioBtn">Tech Operations - Creative</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="tech_operations_creative" id="tech_operations_creative" value="NA" @if(old('tech_operations_creative')=='NA') checked @elseif(old('tech_operations_creative')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="tech_operations_creative" id="tech_operations_creative" value="1" @if(old('tech_operations_creative')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="tech_operations_creative" id="tech_operations_creative" value="2" @if(old('tech_operations_creative')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="tech_operations_creative" id="tech_operations_creative" value="3" @if(old('tech_operations_creative')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="tech_operations_creative" id="tech_operations_creative" value="4" @if(old('tech_operations_creative')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="tech_operations_creative" id="tech_operations_creative" value="5" @if(old('tech_operations_creative')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('tech_operations_creative'))
                    <span class="text-danger">{{ $errors->first('tech_operations_creative') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="mobile" class="form-label rdioBtn">Mobile</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="mobile" id="mobile" value="NA" @if(old('mobile')=='NA') checked @elseif(old('mobile')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                    <input class="form-check-input" type="radio" name="mobile" id="mobile" value="1" @if(old('mobile')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="mobile" id="mobile" value="2" @if(old('mobile')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="mobile" id="mobile" value="3" @if(old('mobile')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="mobile" id="mobile" value="4" @if(old('mobile')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="mobile" id="mobile" value="5" @if(old('mobile')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="vcommission_uk" class="form-label rdioBtn">vCommission - UK</label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="vcommission_uk" id="vcommission_uk" value="NA" @if(old('vcommission_uk')=='NA') checked @elseif(old('vcommission_uk')=='') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>
                    
                    <input class="form-check-input" type="radio" name="vcommission_uk" id="vcommission_uk" value="1" @if(old('vcommission_uk')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="vcommission_uk" id="vcommission_uk" value="2" @if(old('vcommission_uk')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="vcommission_uk" id="vcommission_uk" value="3" @if(old('vcommission_uk')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="vcommission_uk" id="vcommission_uk" value="4" @if(old('vcommission_uk')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="vcommission_uk" id="vcommission_uk" value="5" @if(old('vcommission_uk')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('vcommission_uk'))
                    <span class="text-danger">{{ $errors->first('vcommission_uk') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback_any_department" class="form-label">Any additional feedback for any department that you would like to share? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback_any_department" id="any_additional_feedback_any_department" style="height: 100px">{{ old('any_additional_feedback_any_department')}}</textarea>

                  @if ($errors->has('any_additional_feedback_any_department'))
                    <span class="text-danger">{{ $errors->first('any_additional_feedback_any_department') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_feedback_any_department' );
                  </script>

                </div>
                
                <div class="col-md-12 position-relative">
                  <label for="any_issue_concern_management" class="form-label">Any issue or concern that you would like to talk to management about? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_issue_concern_management" id="any_issue_concern_management" style="height: 100px">{{ old('any_issue_concern_management') }}</textarea>
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

  </main>
@endsection