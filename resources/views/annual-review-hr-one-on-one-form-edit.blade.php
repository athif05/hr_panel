@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Annual Review HR 1:1 Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Update Annual Review HR 1:1 Form</h5>
              

              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <div style="clear: both; height: 10px;"></div>
              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-annual-review-hr-one-on-one-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $edit_id }}">
                <input type="hidden" name="filled_for" id="filled_for" value="{{ $filled_for }}">
                <input type="hidden" name="filled_by" id="filled_by" value="{{ $filled_by }}">
                <input type="hidden" name="annual_review_form_id" id="annual_review_form_id" value="{{ $survey_form_id }}">
                <input type="hidden" name="fy" id="fy" value="{{ $fy }}">
                
                <div class="hiring_survey_heading"><strong>Member Details</strong></div>

                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Member Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $member_details['full_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_id" class="form-label">Member Code</label>
                  <input type="text" class="form-control disable-text" name="member_id" id="member_id" value="{{ $member_details['member_id'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="designation_name" class="form-label">Designation <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="designation_name" id="designation_name" value="{{ $member_details['designation_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="department_name" class="form-label">Department <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="department_name" id="department_name" value="{{ $member_details['department_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Company <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="company_name" id="company_name" value="{{ $member_details['company_name'] }}" readonly>
                </div>

  
                <div class="col-md-6 position-relative">
                  <label for="mentor_name" class="form-label">Mentor Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="mentor_name" id="mentor_name" value="{{ $member_details['hod_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="manager_name" class="form-label">Manager Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="manager_name" id="manager_name" value="{{ $member_details['manager_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="hod_name" class="form-label">Head Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="hod_name" id="hod_name" value="{{ $member_details['hod_name'] }}" readonly>
                </div>
              


                <div class="col-md-12 position-relative">
                  <label for="put_ever_pip" class="form-label">Were you ever put in PIP? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="put_ever_pip" id="put_ever_pip">
                  	<option value="Yes" @if((old('put_ever_pip', $hr_one_on_one_details['put_ever_pip'])=='Yes')) selected @endif>Yes</option>
                    <option value="No" @if((old('put_ever_pip', $hr_one_on_one_details['put_ever_pip'])=='No') ) selected @endif>No</option>
                  </select>
                  @if ($errors->has('put_ever_pip'))
                    <span class="text-danger">{{ $errors->first('put_ever_pip') }}</span>
                  @endif
                </div>

                
                <div class="col-md-6 position-relative" id="pipStartDate_Div" @if(old('put_ever_pip',$hr_one_on_one_details['put_ever_pip'])!='Yes') style="display: none;"@endif>
                  <label for="pip_start_date" class="form-label">PIP Start Date <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" name="pip_start_date" id="pip_start_date" value="{{ old('pip_start_date', $hr_one_on_one_details['pip_start_date']) }}" placeholder="Start Date" class="form-control">
                  @if ($errors->has('pip_start_date'))
                    <span class="text-danger">{{ $errors->first('pip_start_date') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative" id="pipEndDate_Div" @if(old('put_ever_pip',$hr_one_on_one_details['put_ever_pip'])!='Yes')style="display: none;"@endif>
                  <label for="pip_end_date" class="form-label">PIP End Date <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" name="pip_end_date" id="pip_end_date" value="{{ old('pip_end_date', $hr_one_on_one_details['pip_end_date']) }}" placeholder="End Date" class="form-control">
                  @if ($errors->has('pip_end_date'))
                    <span class="text-danger">{{ $errors->first('pip_end_date') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_appraisal_cycle" class="form-label">Member's Appraisal Cycle <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="member_appraisal_cycle" id="member_appraisal_cycle" value="{{ date('M-Y',strtotime($member_details['appraisal_cycle'])) }}" readonly>
                </div>
                
                <div class="col-md-6 position-relative">
                  <label for="hr_id_taking_this_1_1" class="form-label">Name of the member taking this HR 1:1 session <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="hr_id_taking_this_1_1" id="hr_id_taking_this_1_1">
                    @foreach($hr_details as $hr_detail)
                    <option value="{{ $hr_detail['id'] }}" @if(old('company_location_id', $hr_one_on_one_details['hr_id_taking_this_1_1'])==$hr_detail['id']) selected @endif>{{ $hr_detail['first_name'].' '.$hr_detail['last_name'] }}</option>
                    @endforeach
                    <option value="Other" @if(old('company_location_id', $hr_one_on_one_details['hr_id_taking_this_1_1'])=='Other') selected @endif>Other</option>
                  </select>
                  @if ($errors->has('hr_id_taking_this_1_1'))
                    <span class="text-danger">{{ $errors->first('hr_id_taking_this_1_1') }}</span>
                  @endif     
                </div>


                <div class="col-md-12 position-relative">
                  <label class="card-title"><strong>Appraisal Information</strong></label>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="Which_level_place_yourself" class="form-label">Which level would you like to place yourself in the company? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="Which_level_place_yourself" id="Which_level_place_yourself">
                    <option value="">Choose...</option>
                    
                    <option value="Category A : I am part of the Best Lot" @if(old('Which_level_place_yourself', $hr_one_on_one_details['Which_level_place_yourself'])=='Category A : I am part of the Best Lot') selected @endif>
                    	Category A : I am part of the Best Lot
                    </option>
                    <option value="Category B: One step below the Best lot" @if(old('Which_level_place_yourself', $hr_one_on_one_details['Which_level_place_yourself'])=='Category B: One step below the Best lot') selected @endif>
                    	Category B: One step below the Best lot
                    </option>
                    <option value="Category C: Little more to go" @if(old('Which_level_place_yourself', $hr_one_on_one_details['Which_level_place_yourself'])=='Category C: Little more to go') selected @endif>
                    	Category C: Little more to go
                    </option>
                    <option value="Category D: More efforts are required" @if(old('Which_level_place_yourself', $hr_one_on_one_details['Which_level_place_yourself'])=='Category D: More efforts are required') selected @endif>
                    	Category D: More efforts are required
                    </option>
                    
                  </select>
                  @if ($errors->has('Which_level_place_yourself'))
                    <span class="text-danger">{{ $errors->first('Which_level_place_yourself') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="current_monthly_salary" class="form-label">Current Monthly Salary (in number) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="current_monthly_salary" id="current_monthly_salary" value="{{ $member_details['current_salary'] }}" readonly>
                </div>


                <div class="col-md-6 position-relative">
                  <label for="current_annual_salary" class="form-label">Current Annual Salary (in number) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="current_annual_salary" id="current_annual_salary" value="{{ $member_details['current_salary']*12 }}" readonly>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="total_expected_increment_monthly_salary" class="form-label">Total Expected Increment (Monthly salary) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="number" class="form-control" name="total_expected_increment_monthly_salary" id="total_expected_increment_monthly_salary" value="{{ old('total_expected_increment_monthly_salary', $hr_one_on_one_details['total_expected_increment_monthly_salary'])}}" placeholder="Amount(Rs)">

                  @if ($errors->has('total_expected_increment_monthly_salary'))
                    <span class="text-danger">{{ $errors->first('total_expected_increment_monthly_salary') }}</span>
                  @endif

                  <br>

                  <input type="text" class="form-control disable-text" name="total_expected_increment_monthly_salary_percentage" id="total_expected_increment_monthly_salary_percentage" value="{{  $hr_one_on_one_details['total_expected_increment_monthly_salary_percentage'] }}" placeholder="Percentage(%)" readonly style="margin-bottom: 8px;">

                  <input type="text" class="form-control" name="hr_notes" id="hr_notes" value="{{ old('hr_notes',  $hr_one_on_one_details['hr_notes']) }}" placeholder="HR Notes">
                  @if ($errors->has('hr_notes'))
                    <span class="text-danger">{{ $errors->first('hr_notes') }}</span>
                  @endif
                </div>



                <div class="col-md-6 position-relative">
                  <label for="promotion_in_designation" class="form-label">Promotion in Designation <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="promotion_in_designation" id="promotion_in_designation">                    
                    <option value="Yes" @if(old('promotion_in_designation',$hr_one_on_one_details['promotion_in_designation'])=='Yes') selected @endif>Yes</option>
                    <option value="No" @if(old('promotion_in_designation',$hr_one_on_one_details['promotion_in_designation'])=='No') selected @endif>No</option>
                  </select>
                  @if ($errors->has('promotion_in_designation'))
                    <span class="text-danger">{{ $errors->first('promotion_in_designation') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative" @if(old('promotion_in_designation',$hr_one_on_one_details['promotion_in_designation'])!='Yes')style="display: none;"@endif id="designation_id_promotion_div">
                  <label for="designation_id_promotion" class="form-label">Designation Name (For Promotion)<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="designation_id_promotion" id="designation_id_promotion">
                    <option value="">Choose...</option>
                    @foreach($designation_names as $designation_name)
                    <option value="{{ $designation_name['id'] }}" @if(old('designation_id_promotion',$hr_one_on_one_details['designation_id_promotion'])==$designation_name['id']) selected @endif>
                    	{{ $designation_name['name'] }}
                    </option>
                    @endforeach
                    
                  </select>
                  @if ($errors->has('designation_id_promotion'))
                    <span class="text-danger">{{ $errors->first('designation_id_promotion') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label class="card-title"><strong>Performance Information</strong></label>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="share_your_accomplishments" class="form-label">Share your accomplishments from FY {{ $fy }}. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="share_your_accomplishments" id="share_your_accomplishments" style="height: 100px">{{ old('share_your_accomplishments', $hr_one_on_one_details['share_your_accomplishments'])}}</textarea>

                  @if ($errors->has('share_your_accomplishments'))
                    <span class="text-danger">{{ $errors->first('share_your_accomplishments') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'share_your_accomplishments' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="share_issues_challenges_impact_work" class="form-label">Share issues/challenges from FY {{ $fy }}, that impacted your work/mindset negatively. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="share_issues_challenges_impact_work" id="share_issues_challenges_impact_work" style="height: 100px">{{ old('share_issues_challenges_impact_work', $hr_one_on_one_details['share_issues_challenges_impact_work'])}}</textarea>

                  @if ($errors->has('share_issues_challenges_impact_work'))
                    <span class="text-danger">{{ $errors->first('share_issues_challenges_impact_work') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'share_issues_challenges_impact_work' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="openly_share_issues_need_closures" class="form-label">Please openly share issues that still need closures & can help you grow further. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="openly_share_issues_need_closures" id="openly_share_issues_need_closures" style="height: 100px">{{ old('openly_share_issues_need_closures', $hr_one_on_one_details['openly_share_issues_need_closures'])}}</textarea>

                  @if ($errors->has('openly_share_issues_need_closures'))
                    <span class="text-danger">{{ $errors->first('openly_share_issues_need_closures') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'openly_share_issues_need_closures' );
                  </script>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="see_yourself_moving_ahead_next_year" class="form-label">How do you see yourself moving ahead in the next year? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="see_yourself_moving_ahead_next_year" id="see_yourself_moving_ahead_next_year" style="height: 100px">{{ old('see_yourself_moving_ahead_next_year', $hr_one_on_one_details['see_yourself_moving_ahead_next_year'])}}</textarea>

                  @if ($errors->has('see_yourself_moving_ahead_next_year'))
                    <span class="text-danger">{{ $errors->first('see_yourself_moving_ahead_next_year') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'see_yourself_moving_ahead_next_year' );
                  </script>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="any_additional_feedback_wish_to_share" class="form-label">Any additional feedback that you wish to share about anything else? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_additional_feedback_wish_to_share" id="any_additional_feedback_wish_to_share" style="height: 100px">{{ old('any_additional_feedback_wish_to_share', $hr_one_on_one_details['any_additional_feedback_wish_to_share'])}}</textarea>

                  @if ($errors->has('any_additional_feedback_wish_to_share'))
                    <span class="text-danger">{{ $errors->first('any_additional_feedback_wish_to_share') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_additional_feedback_wish_to_share' );
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