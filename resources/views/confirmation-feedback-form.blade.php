@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Confirmation Feedback Form | {{ env('MY_SITE_NAME') }}</title>

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
    </style>
@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">
              
              @if($member_details)

              <h5 class="card-title">Confirmation Feedback Form</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-confirmation-feedback-form')}}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="manager_id" id="manager_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $member_details['id'] }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">1. What is your name?</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $member_details['first_name'] }} {{ $member_details['last_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">2. What is your Member ID?</label>
                  <input type="email" class="form-control disable-text" name="member_id" id="member_id" value="{{ $member_details['member_id'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">3. What is your designation in {{ $member_details['company_name'] }}?</label>
                  <input type="email" class="form-control disable-text" name="designation" id="designation" value="{{ $member_details['designation_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">4. What is your department in {{ $member_details['company_name'] }}?</label>
                  <input type="email" class="form-control disable-text" name="department" id="department" value="{{ $member_details['department_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">5. Location</label>
                  <input type="email" class="form-control disable-text" name="location" id="location" value="{{ $member_details['location_name'] }}" readonly>
                </div>

                <div style="clear: both; height: 10px;"></div>

                <div class="col-md-12 position-relative">
                  <label class="form-label"><strong>6. Rate him/her in the following out of 5 where "1" stands for Poor and "5" stands for excellent.</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="discipline" class="form-label">Discipline:  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="discipline" id="discipline" value="1" @if(old('discipline')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="discipline" id="discipline" value="2" @if(old('discipline')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="discipline" id="discipline" value="3" @if(old('discipline')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="discipline" id="discipline" value="4" @if(old('discipline')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="discipline" id="discipline" value="5" @if(old('discipline')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('discipline'))
                    <span class="text-danger">{{ $errors->first('discipline') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="punctuality" class="form-label">Punctuality <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="punctuality" id="punctuality" value="1" @if(old('punctuality')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="punctuality" id="punctuality" value="2" @if(old('punctuality')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="punctuality" id="punctuality" value="3" @if(old('punctuality')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="punctuality" id="punctuality" value="4" @if(old('punctuality')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="punctuality" id="punctuality" value="5" @if(old('punctuality')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('punctuality'))
                    <span class="text-danger">{{ $errors->first('punctuality') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="work_ethics" class="form-label">Work-Ethics <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="work_ethics" id="work_ethics" value="1" @if(old('work_ethics')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="work_ethics" id="work_ethics" value="2" @if(old('work_ethics')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="work_ethics" id="work_ethics" value="3" @if(old('work_ethics')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="work_ethics" id="work_ethics" value="4" @if(old('work_ethics')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="work_ethics" id="work_ethics" value="5" @if(old('work_ethics')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('work_ethics'))
                    <span class="text-danger">{{ $errors->first('work_ethics') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="team_work" class="form-label">Team-Work <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="team_work" id="team_work" value="1" @if(old('team_work')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="team_work" id="team_work" value="2" @if(old('team_work')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="team_work" id="team_work" value="3" @if(old('team_work')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="team_work" id="team_work" value="4" @if(old('team_work')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="team_work" id="team_work" value="5" @if(old('team_work')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('team_work'))
                    <span class="text-danger">{{ $errors->first('team_work') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="response_towards_feedback" class="form-label">Response towards Feedback <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="response_towards_feedback" id="response_towards_feedback" value="1" @if(old('response_towards_feedback')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="response_towards_feedback" id="response_towards_feedback" value="2" @if(old('response_towards_feedback')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="response_towards_feedback" id="response_towards_feedback" value="3" @if(old('response_towards_feedback')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="response_towards_feedback" id="response_towards_feedback" value="4" @if(old('response_towards_feedback')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="response_towards_feedback" id="response_towards_feedback" value="5" @if(old('response_towards_feedback')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('response_towards_feedback'))
                    <span class="text-danger">{{ $errors->first('response_towards_feedback') }}</span>
                  @endif

                </div>


                <div class="col-md-12 position-relative">
                  <label for="elaborate_performance" class="form-label">7. Kindly elaborate on his/her performance of the last 3 months? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="elaborate_performance" id="elaborate_performance" style="height: 100px">{{ old('elaborate_performance')}}</textarea>

                  @if ($errors->has('elaborate_performance'))
                    <span class="text-danger">{{ $errors->first('elaborate_performance') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">8. Mention top 3 highlights of {{ $member_details['first_name'] }} {{ $member_details['last_name'] }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="top_3_highlights_1" id="top_3_highlights_1" value="{{ old('top_3_highlights_1') }}">
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
                      <input type="text" class="form-control" name="top_3_highlights_2" id="top_3_highlights_2" value="{{ old('top_3_highlights_2') }}">
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
                      <input type="text" class="form-control" name="top_3_highlights_3" id="top_3_highlights_3" value="{{ old('top_3_highlights_3') }}">
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
                  <label for="company_hr_name" class="form-label">9. Mention the major task that have been accomplished by {{ $member_details['first_name'] }} {{ $member_details['last_name'] }}? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="major_task_1" id="major_task_1" value="{{ old('major_task_1') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('major_task_1'))
                        <span class="text-danger">{{ $errors->first('major_task_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="major_task_2" id="major_task_2" value="{{ old('major_task_2') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('major_task_2'))
                        <span class="text-danger">{{ $errors->first('major_task_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="major_task_3" id="major_task_3" value="{{ old('major_task_3') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('major_task_3'))
                        <span class="text-danger">{{ $errors->first('major_task_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="add_value_in_team" class="form-label">10. Has {{ $member_details['first_name'] }} {{ $member_details['last_name'] }} been able to add value in your team?</label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="add_value_in_team" id="add_value_in_team" value="Yes" @if(old('add_value_in_team')!='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="add_value_in_team" id="add_value_in_team" value="No" @if(old('add_value_in_team')=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>

                  </span>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="" class="form-label">If Yes, Please share an instance in details.</label>
                  <input type="text" class="form-control" name="add_value_in_team_share_instance" id="add_value_in_team_share_instance" value="{{ old('add_value_in_team_share_instance') }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('add_value_in_team_share_instance'))
                    <span class="text-danger">{{ $errors->first('add_value_in_team_share_instance') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">11. Mention 3 areas of improvement? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <div class="div100 margin_bottom10">
                    <div class="div3">1. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="areas_of_improvement_1" id="areas_of_improvement_1" value="{{ old('areas_of_improvement_1') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('areas_of_improvement_1'))
                        <span class="text-danger">{{ $errors->first('areas_of_improvement_1') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">2. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="areas_of_improvement_2" id="areas_of_improvement_2" value="{{ old('areas_of_improvement_2') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('areas_of_improvement_2'))
                        <span class="text-danger">{{ $errors->first('areas_of_improvement_2') }}</span>
                      @endif
                    </div>
                  </div>

                  <div class="div100 margin_bottom10">
                    <div class="div3">3. </div>
                    <div class="div97">
                      <input type="text" class="form-control" name="areas_of_improvement_3" id="areas_of_improvement_3" value="{{ old('areas_of_improvement_3') }}">
                      <div class="valid-tooltip">
                        Looks good!
                      </div>
                      @if ($errors->has('areas_of_improvement_3'))
                        <span class="text-danger">{{ $errors->first('areas_of_improvement_3') }}</span>
                      @endif
                    </div>
                  </div>
                  
                </div>


                <div class="col-md-12 position-relative">
                  <label for="met_your_expectations" class="form-label">12. Has {{ $member_details['first_name'] }} {{ $member_details['last_name'] }} met your expectations in the last 3 months? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="met_your_expectations" id="met_your_expectations" value="Yes" @if(old('met_your_expectations')!='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">Yes</label>

                    <input class="form-check-input" type="radio" name="met_your_expectations" id="met_your_expectations" value="No" @if(old('met_your_expectations')=='No') checked @endif>
                    <label class="form-check-label" for="gridRadios1">No</label>

                  </span>

                </div>

                <div class="col-md-12 position-relative">
                  <label for="met_your_expectations_other_specify" class="form-label">Other (please specify)</label>
                  <input type="text" class="form-control" name="met_your_expectations_other_specify" id="met_your_expectations_other_specify" value="{{ old('met_your_expectations_other_specify') }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="are_you_sure_to_confirm" class="form-label">13. Are you sure to confirm {{ $member_details['first_name'] }} {{ $member_details['last_name'] }} in the Organization? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="are_you_sure_to_confirm" id="are_you_sure_to_confirm" onchange="open_close_pip(this.value)">
                    <option value="">Choose...</option>

                    <option value="Yes, early confirmation" @if(old('are_you_sure_to_confirm')=='Yes, early confirmation') selected @endif>Yes, early confirmation</option>

                    <option value="Yes, on time confirmation" @if(old('are_you_sure_to_confirm')=='Yes, on time confirmation') selected @endif>Yes, on time confirmation</option>

                    <option value="No, Put under PIP" @if(old('are_you_sure_to_confirm')=='No, Put under PIP') selected @endif>No, Put under PIP</option>

                    <option value="Defer Confirmation without PIP for 30 Days" @if(old('are_you_sure_to_confirm')=='Defer Confirmation without PIP for 30 Days') selected @endif>Defer Confirmation without PIP for 30 Days</option>

                    <option value="Defer Confirmation without PIP for 60 Days" @if(old('are_you_sure_to_confirm')=='Defer Confirmation without PIP for 60 Days') selected @endif>Defer Confirmation without PIP for 60 Days</option>

                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid option.
                  </div>
                  @if ($errors->has('are_you_sure_to_confirm'))
                    <span class="text-danger">{{ $errors->first('are_you_sure_to_confirm') }}</span>
                  @endif
                </div>

                <div class="col-md-12 position-relative">
                  <label for="recommend_pip_detailed_plan" class="form-label">14. If you want to recommend PIP, Pls share a detailed plan. <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea @if(old('are_you_sure_to_confirm')=='No, Put under PIP') class="form-control" @else class="form-control disable-text" readonly @endif name="recommend_pip_detailed_plan" id="recommend_pip_detailed_plan" style="height: 100px" >{{ old('recommend_pip_detailed_plan')}}</textarea>

                  @if ($errors->has('recommend_pip_detailed_plan'))
                    <span class="text-danger">{{ $errors->first('recommend_pip_detailed_plan') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="increment_on_confirmation" class="form-label">15. Has {{ $member_details['first_name'] }} {{ $member_details['last_name'] }} been committed an increment on confirmation, at the time of joining? </label>
                  <select class="form-select" name="increment_on_confirmation" id="increment_on_confirmation">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="mention_the_amount" class="form-label">16. If yes, then mention the amount.</label>
                  <input type="text" class="form-control" name="mention_the_amount" id="mention_the_amount" value="{{ old('mention_the_amount') }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('mention_the_amount'))
                    <span class="text-danger">{{ $errors->first('mention_the_amount') }}</span>
                  @endif
                </div>

                <div class="col-12">
                  <input type="submit" name="submit" value="Save in Draft" class="btn btn-info">

                  <input type="submit" name="submit" value="Publish" class="btn btn-primary">
                </div>

              </form>
              <!-- End Custom Styled Validation with Tooltips -->
              <br>
              <div style="float: left; width: 100%;">
                <div style="float: left; width: 70%;">
              		@include('partials.common-note')
              	</div>
                <div style="float: left; width: 30%;">
                  <a href="{{ url('/confirmation-feedback-form') }}">
                    <button name="cancel" class="btn btn-info" style="float: right; text-align: right;">Cancel/Back</button>
                  </a>
                </div>
              </div>

              @else
              <h4 class="card-title">Member does not exist...</h4>
              @endif

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection