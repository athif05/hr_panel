@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Update Training Survey | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Update Training Survey</h5>

              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-training-survey') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $training_survey_details->id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="edit_ajax" id="edit_ajax" value="2">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Your Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $training_survey_details->member_name }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_id" class="form-label">Member ID</label>
                  <input type="text" class="form-control disable-text" name="member_id" id="member_id" value="{{ $training_survey_details->member_id }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_id'))
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control disable-text" name="email" id="email" value="{{ $training_survey_details->email }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>


                <input type="hidden" name="designation" id="designation" value="{{ $training_survey_details->designation }}" />
                <div class="col-md-6 position-relative">
                  <label for="designation" class="form-label">Designation</label>
                  <select class="form-select disable-text" name="designation_dis" id="designation_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($designation_details as $designation_detail)
                    <option value="{{$designation_detail['id']}}" @if(($training_survey_details->designation)==$designation_detail['id']) selected @endif>{{$designation_detail['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid designation.
                  </div>
                  @if ($errors->has('designation'))
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                  @endif
                </div>

                <input type="hidden" name="department" id="department" value="{{ $training_survey_details->department }}" />
                <div class="col-md-6 position-relative">
                  <label for="department" class="form-label">Department</label>
                  <select class="form-select disable-text" name="department_dis" id="department_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($department_details as $department_detail)
                    <option value="{{$department_detail['id']}}" @if(($training_survey_details->department)==$department_detail['id']) selected @endif>{{$department_detail['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid department.
                  </div>
                  @if ($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
                </div>


                <input type="hidden" name="company_name" id="company_name" value="{{ $training_survey_details->company_name }}" />
                <div class="col-md-6 position-relative">
                  <label for="company_name" class="form-label">Please choose the name of your company <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="company_name_dis" id="company_name_dis" disabled>
                    <option value="">Choose...</option>
                    @foreach($company_names as $company_name)
                    <option value="{{$company_name['id']}}" @if(($training_survey_details->company_name)==$company_name['id']) selected @endif>{{$company_name['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid company.
                  </div>
                  @if ($errors->has('company_name'))
                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                  @endif
                </div>


                <input type="hidden" name="location_name" id="location_name" value="{{ $training_survey_details->location_name }}" />
                <div class="col-md-6 position-relative">
                  <label for="location_name" class="form-label">Please choose your work-location <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select disable-text" name="location_name_dis" id="location_name_dis" disabled>
                    <option  value="">Choose...</option>
                    @foreach($company_locations as $company_location)
                    <option value="{{$company_location['id']}}" @if(($training_survey_details->location_name)==$company_location['id']) selected @endif>{{$company_location['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid location.
                  </div>
                  @if ($errors->has('location_name'))
                    <span class="text-danger">{{ $errors->first('location_name') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="company_hr_name" class="form-label">Please list down the name of your trainers who took your on-job training</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="trainer_list_name" class="form-label">Trainer <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" multiple name="trainer_list_name" id="trainer_list_name">
                    <option  value="" disabled>Choose...</option>
                    @foreach($trainer_details as $trainer_detail)
                    <option value="{{$trainer_detail['id']}}" @if((($training_survey_details->trainer_1_id)==$trainer_detail['id']) || (($training_survey_details->trainer_2_id)==$trainer_detail['id']) || (($training_survey_details->trainer_3_id)==$trainer_detail['id']) || (($training_survey_details->trainer_4_id)==$trainer_detail['id']) || (($training_survey_details->trainer_5_id)==$trainer_detail['id'])) selected @endif>{{$trainer_detail['first_name']}} {{$trainer_detail['last_name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select at least 1 trainer.
                  </div>
                  @if ($errors->has('trainer_list_name'))
                    <span class="text-danger">{{ $errors->first('trainer_list_name') }}</span>
                  @endif
                </div>

                <!-- show trainer list by ajax -->
                <div style="float: left; width: 100%" id="all_trainer_list">
                  
                  @if($training_survey_details->trainer_1_id)
                    
                    <input type="hidden" name="trainer_1_name" id='trainer_1_name' value="{{ $training_survey_details->trainer_1_name}}">
                    <input type="hidden" name="trainer_1_id" id='trainer_1_id' value="{{ $training_survey_details->trainer_1_id}}">

                    <div style="clear: both; height: 1px;"></div>
                      <div class="col-md-12 position-relative" style="margin-bottom: -5px; margin-top: 10px;">
                        <label class="form-label"><strong>Please rate {{$training_survey_details->trainer_1_name}} on the following parameters</strong></label>
                      </div>

                      <div class="col-md-12 position-relative">
                        <label for="expertise_on_subject_matter_1" class="form-label rdioBtn">Expertise on the subject-matter  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                        <span id="radioBtn">
                          <input class="form-check-input" type="radio" name="expertise_on_subject_matter_1" id="expertise_on_subject_matter_1" value="NA" @if(old('expertise_on_subject_matter_1',$training_survey_details->expertise_on_subject_matter_1)=='NA') checked @endif>
                          <label class="form-check-label" for="gridRadios1">NA</label>

                          <input class="form-check-input" type="radio" name="expertise_on_subject_matter_1" id="expertise_on_subject_matter_1" value="1" @if(old('expertise_on_subject_matter_1', $training_survey_details->expertise_on_subject_matter_1)=='1') checked @endif>
                          <label class="form-check-label" for="gridRadios1">1</label>

                          <input class="form-check-input" type="radio" name="expertise_on_subject_matter_1" id="expertise_on_subject_matter_1" value="2" @if(old('expertise_on_subject_matter_1',$training_survey_details->expertise_on_subject_matter_1)=='2') checked @endif>
                          <label class="form-check-label" for="gridRadios1">2</label>

                          <input class="form-check-input" type="radio" name="expertise_on_subject_matter_1" id="expertise_on_subject_matter_1" value="3" @if(old('expertise_on_subject_matter_1',$training_survey_details->expertise_on_subject_matter_1)=='3') checked @endif>
                          <label class="form-check-label" for="gridRadios1">3</label>

                          <input class="form-check-input" type="radio" name="expertise_on_subject_matter_1" id="expertise_on_subject_matter_1" value="4" @if(old('expertise_on_subject_matter_1',$training_survey_details->expertise_on_subject_matter_1)=='4') checked @endif>
                          <label class="form-check-label" for="gridRadios1">4</label>

                          <input class="form-check-input" type="radio" name="expertise_on_subject_matter_1" id="expertise_on_subject_matter_1" value="5" @if(old('expertise_on_subject_matter_1',$training_survey_details->expertise_on_subject_matter_1)=='5') checked @endif>
                          <label class="form-check-label" for="gridRadios1">5</label>
                        </span>

                        @if ($errors->has('expertise_on_subject_matter_1'))
                          <span class="text-danger">{{ $errors->first('expertise_on_subject_matter_1') }}</span>
                        @endif

                      </div>

                      <div class="col-md-12 position-relative">
                        <label for="clear_effective_communication_skills_1" class="form-label rdioBtn">Clear and effective communication skills <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                        <span id="radioBtn">
                          <input class="form-check-input" type="radio" name="clear_effective_communication_skills_1" id="clear_effective_communication_skills_1" value="NA" @if(old('clear_effective_communication_skills_1',$training_survey_details->clear_effective_communication_skills_1)=='NA') checked @endif>
                          <label class="form-check-label" for="gridRadios1">NA</label>

                          <input class="form-check-input" type="radio" name="clear_effective_communication_skills_1" id="clear_effective_communication_skills_1" value="1" @if(old('clear_effective_communication_skills_1',$training_survey_details->clear_effective_communication_skills_1)=='1') checked @endif>
                          <label class="form-check-label" for="gridRadios1">1</label>

                          <input class="form-check-input" type="radio" name="clear_effective_communication_skills_1" id="clear_effective_communication_skills_1" value="2" @if(old('clear_effective_communication_skills_1',$training_survey_details->clear_effective_communication_skills_1)=='2') checked @endif>
                          <label class="form-check-label" for="gridRadios1">2</label>

                          <input class="form-check-input" type="radio" name="clear_effective_communication_skills_1" id="clear_effective_communication_skills_1" value="3" @if(old('clear_effective_communication_skills_1',$training_survey_details->clear_effective_communication_skills_1)=='3') checked @endif>
                          <label class="form-check-label" for="gridRadios1">3</label>

                          <input class="form-check-input" type="radio" name="clear_effective_communication_skills_1" id="clear_effective_communication_skills_1" value="4" @if(old('clear_effective_communication_skills_1',$training_survey_details->clear_effective_communication_skills_1)=='4') checked @endif>
                          <label class="form-check-label" for="gridRadios1">4</label>

                          <input class="form-check-input" type="radio" name="clear_effective_communication_skills_1" id="clear_effective_communication_skills_1" value="5" @if(old('clear_effective_communication_skills_1',$training_survey_details->clear_effective_communication_skills_1)=='5') checked @endif>
                          <label class="form-check-label" for="gridRadios1">5</label>
                        </span>
                        @if ($errors->has('clear_effective_communication_skills_1'))
                          <span class="text-danger">{{ $errors->first('clear_effective_communication_skills_1') }}</span>
                        @endif

                      </div>

                      <div class="col-md-12 position-relative">
                        <label for="effective_delivery_content_1" class="form-label rdioBtn">Effective delivery of content <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                        <span id="radioBtn">
                          <input class="form-check-input" type="radio" name="effective_delivery_content_1" id="effective_delivery_content_1" value="NA" @if(old('effective_delivery_content_1',$training_survey_details->effective_delivery_content_1)=='NA') checked @endif>
                          <label class="form-check-label" for="gridRadios1">NA</label>

                          <input class="form-check-input" type="radio" name="effective_delivery_content_1" id="effective_delivery_content_1" value="1" @if(old('effective_delivery_content_1',$training_survey_details->effective_delivery_content_1)=='1') checked @endif>
                          <label class="form-check-label" for="gridRadios1">1</label>

                          <input class="form-check-input" type="radio" name="effective_delivery_content_1" id="effective_delivery_content_1" value="2" @if(old('effective_delivery_content_1',$training_survey_details->effective_delivery_content_1)=='2') checked @endif>
                          <label class="form-check-label" for="gridRadios1">2</label>

                          <input class="form-check-input" type="radio" name="effective_delivery_content_1" id="effective_delivery_content_1" value="3" @if(old('effective_delivery_content_1',$training_survey_details->effective_delivery_content_1)=='3') checked @endif>
                          <label class="form-check-label" for="gridRadios1">3</label>

                          <input class="form-check-input" type="radio" name="effective_delivery_content_1" id="effective_delivery_content_1" value="4" @if(old('effective_delivery_content_1',$training_survey_details->effective_delivery_content_1)=='4') checked @endif>
                          <label class="form-check-label" for="gridRadios1">4</label>

                          <input class="form-check-input" type="radio" name="effective_delivery_content_1" id="effective_delivery_content_1" value="5" @if(old('effective_delivery_content_1',$training_survey_details->effective_delivery_content_1)=='5') checked @endif>
                          <label class="form-check-label" for="gridRadios1">5</label>
                        </span>
                        @if ($errors->has('effective_delivery_content_1'))
                          <span class="text-danger">{{ $errors->first('effective_delivery_content_1') }}</span>
                        @endif

                      </div>

                      <div class="col-md-12 position-relative">
                        <label for="timely_response_queries_1" class="form-label rdioBtn">Timely response to your queries <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                        <span id="radioBtn">
                          <input class="form-check-input" type="radio" name="timely_response_queries_1" id="timely_response_queries_1" value="NA" @if(old('timely_response_queries_1',$training_survey_details->timely_response_queries_1)=='NA') checked @endif>
                          <label class="form-check-label" for="gridRadios1">NA</label>

                          <input class="form-check-input" type="radio" name="timely_response_queries_1" id="timely_response_queries_1" value="1" @if(old('timely_response_queries_1',$training_survey_details->timely_response_queries_1)=='1') checked @endif>
                          <label class="form-check-label" for="gridRadios1">1</label>

                          <input class="form-check-input" type="radio" name="timely_response_queries_1" id="timely_response_queries_1" value="2" @if(old('timely_response_queries_1',$training_survey_details->timely_response_queries_1)=='2') checked @endif>
                          <label class="form-check-label" for="gridRadios1">2</label>

                          <input class="form-check-input" type="radio" name="timely_response_queries_1" id="timely_response_queries_1" value="3" @if(old('timely_response_queries_1',$training_survey_details->timely_response_queries_1)=='3') checked @endif>
                          <label class="form-check-label" for="gridRadios1">3</label>

                          <input class="form-check-input" type="radio" name="timely_response_queries_1" id="timely_response_queries_1" value="4" @if(old('timely_response_queries_1',$training_survey_details->timely_response_queries_1)=='4') checked @endif>
                          <label class="form-check-label" for="gridRadios1">4</label>

                          <input class="form-check-input" type="radio" name="timely_response_queries_1" id="timely_response_queries_1" value="5" @if(old('timely_response_queries_1',$training_survey_details->timely_response_queries_1)=='5') checked @endif>
                          <label class="form-check-label" for="gridRadios1">5</label>
                        </span>
                        @if ($errors->has('timely_response_queries_1'))
                          <span class="text-danger">{{ $errors->first('timely_response_queries_1') }}</span>
                        @endif

                      </div>

                      <div class="col-md-12 position-relative">
                        <label for="comfortability_sharing_concerns_doubts_1" class="form-label rdioBtn">Comfortability in sharing your concerns & doubts <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                        <span id="radioBtn">
                          <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_1" id="comfortability_sharing_concerns_doubts_1" value="NA" @if(old('comfortability_sharing_concerns_doubts_1',$training_survey_details->comfortability_sharing_concerns_doubts_1)=='NA') checked @endif>
                          <label class="form-check-label" for="gridRadios1">NA</label>

                          <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_1" id="comfortability_sharing_concerns_doubts_1" value="1" @if(old('comfortability_sharing_concerns_doubts_1',$training_survey_details->comfortability_sharing_concerns_doubts_1)=='1') checked @endif>
                          <label class="form-check-label" for="gridRadios1">1</label>

                          <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_1" id="comfortability_sharing_concerns_doubts_1" value="2" @if(old('comfortability_sharing_concerns_doubts_1',$training_survey_details->comfortability_sharing_concerns_doubts_1)=='2') checked @endif>
                          <label class="form-check-label" for="gridRadios1">2</label>

                          <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_1" id="comfortability_sharing_concerns_doubts_1" value="3" @if(old('comfortability_sharing_concerns_doubts_1',$training_survey_details->comfortability_sharing_concerns_doubts_1)=='3') checked @endif>
                          <label class="form-check-label" for="gridRadios1">3</label>

                          <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_1" id="comfortability_sharing_concerns_doubts_1" value="4" @if(old('comfortability_sharing_concerns_doubts_1',$training_survey_details->comfortability_sharing_concerns_doubts_1)=='4') checked @endif>
                          <label class="form-check-label" for="gridRadios1">4</label>

                          <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_1" id="comfortability_sharing_concerns_doubts_1" value="5" @if(old('comfortability_sharing_concerns_doubts_1',$training_survey_details->comfortability_sharing_concerns_doubts_1)=='5') checked @endif>
                          <label class="form-check-label" for="gridRadios1">5</label>
                        </span>
                        @if ($errors->has('comfortability_sharing_concerns_doubts_1"'))
                          <span class="text-danger">{{ $errors->first('comfortability_sharing_concerns_doubts_1"') }}</span>
                        @endif

                      </div>

                      <div class="col-md-12 position-relative">
                        <label for="additional_feedback_trainer_1" class="form-label">Any additional comments for {{$training_survey_details->trainer_1_name}} <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                        <textarea class="form-control" name="additional_feedback_trainer_1" id="additional_feedback_trainer_1" style="height: 100px">{{ old('additional_feedback_trainer_1',$training_survey_details->additional_feedback_trainer_1) }}</textarea>
                        <div class="invalid-feedback">
                          Any additional comments.
                        </div>
                        @if ($errors->has('additional_feedback_trainer_1'))
                          <span class="text-danger">{{ $errors->first('additional_feedback_trainer_1') }}</span>
                        @endif

                        <script>
                          CKEDITOR.replace( 'additional_feedback_trainer_1' );
                        </script>

                      </div>

                  @endif



                  @if($training_survey_details->trainer_2_id)

                    <input type="hidden" name="trainer_2_name" id='trainer_2_name' value="{{ $training_survey_details->trainer_2_name}}">
                    <input type="hidden" name="trainer_2_id" id='trainer_2_id' value="{{ $training_survey_details->trainer_2_id}}">

                    <div class="col-md-12 position-relative" style="margin-bottom: -5px; margin-top: 10px;">
                      <label class="form-label"><strong>Please rate {{$training_survey_details->trainer_2_name}} on the following parameters</strong></label>
                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="expertise_on_subject_matter_2" class="form-label rdioBtn">Expertise on the subject-matter  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_2" id="expertise_on_subject_matter_2" value="NA" @if(old('expertise_on_subject_matter_2',$training_survey_details->expertise_on_subject_matter_2)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_2" id="expertise_on_subject_matter_2" value="1" @if(old('expertise_on_subject_matter_2',$training_survey_details->expertise_on_subject_matter_2)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_2" id="expertise_on_subject_matter_2" value="2" @if(old('expertise_on_subject_matter_2',$training_survey_details->expertise_on_subject_matter_2)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_2" id="expertise_on_subject_matter_2" value="3" @if(old('expertise_on_subject_matter_2',$training_survey_details->expertise_on_subject_matter_2)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_2" id="expertise_on_subject_matter_2" value="4" @if(old('expertise_on_subject_matter_2',$training_survey_details->expertise_on_subject_matter_2)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_2" id="expertise_on_subject_matter_2" value="5" @if(old('expertise_on_subject_matter_2',$training_survey_details->expertise_on_subject_matter_2)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>

                      @if ($errors->has('expertise_on_subject_matter_2'))
                        <span class="text-danger">{{ $errors->first('expertise_on_subject_matter_2') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="clear_effective_communication_skills_2" class="form-label rdioBtn">Clear and effective communication skills <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_2" id="clear_effective_communication_skills_2" value="NA" @if(old('clear_effective_communication_skills_2',$training_survey_details->clear_effective_communication_skills_2)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_2" id="clear_effective_communication_skills_2" value="1" @if(old('clear_effective_communication_skills_2',$training_survey_details->clear_effective_communication_skills_2)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_2" id="clear_effective_communication_skills_2" value="2" @if(old('clear_effective_communication_skills_2',$training_survey_details->clear_effective_communication_skills_2)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_2" id="clear_effective_communication_skills_2" value="3" @if(old('clear_effective_communication_skills_2',$training_survey_details->clear_effective_communication_skills_2)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_2" id="clear_effective_communication_skills_2" value="4" @if(old('clear_effective_communication_skills_2',$training_survey_details->clear_effective_communication_skills_2)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_2" id="clear_effective_communication_skills_2" value="5" @if(old('clear_effective_communication_skills_2',$training_survey_details->clear_effective_communication_skills_2)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('clear_effective_communication_skills_2'))
                        <span class="text-danger">{{ $errors->first('clear_effective_communication_skills_2') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="effective_delivery_content_2" class="form-label rdioBtn">Effective delivery of content <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="effective_delivery_content_2" id="effective_delivery_content_2" value="NA" @if(old('effective_delivery_content_2',$training_survey_details->effective_delivery_content_2)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_2" id="effective_delivery_content_2" value="1" @if(old('effective_delivery_content_2',$training_survey_details->effective_delivery_content_2)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_2" id="effective_delivery_content_2" value="2" @if(old('effective_delivery_content_2',$training_survey_details->effective_delivery_content_2)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_2" id="effective_delivery_content_2" value="3" @if(old('effective_delivery_content_2',$training_survey_details->effective_delivery_content_2)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_2" id="effective_delivery_content_2" value="4" @if(old('effective_delivery_content_2',$training_survey_details->effective_delivery_content_2)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_2" id="effective_delivery_content_2" value="5" @if(old('effective_delivery_content_2',$training_survey_details->effective_delivery_content_2)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('effective_delivery_content_2'))
                        <span class="text-danger">{{ $errors->first('effective_delivery_content_2') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="timely_response_queries_2" class="form-label rdioBtn">Timely response to your queries <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="timely_response_queries_2" id="timely_response_queries_2" value="NA" @if(old('timely_response_queries_2',$training_survey_details->timely_response_queries_2)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_2" id="timely_response_queries_2" value="1" @if(old('timely_response_queries_2',$training_survey_details->timely_response_queries_2)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_2" id="timely_response_queries_2" value="2" @if(old('timely_response_queries_2',$training_survey_details->timely_response_queries_2)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_2" id="timely_response_queries_2" value="3" @if(old('timely_response_queries_2',$training_survey_details->timely_response_queries_2)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_2" id="timely_response_queries_2" value="4" @if(old('timely_response_queries_2',$training_survey_details->timely_response_queries_2)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_2" id="timely_response_queries_2" value="5" @if(old('timely_response_queries_2',$training_survey_details->timely_response_queries_2)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('timely_response_queries_2'))
                        <span class="text-danger">{{ $errors->first('timely_response_queries_2') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="comfortability_sharing_concerns_doubts_2" class="form-label rdioBtn">Comfortability in sharing your concerns & doubts <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_2" id="comfortability_sharing_concerns_doubts_2" value="NA" @if(old('comfortability_sharing_concerns_doubts_2',$training_survey_details->comfortability_sharing_concerns_doubts_2)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_2" id="comfortability_sharing_concerns_doubts_2" value="1" @if(old('comfortability_sharing_concerns_doubts_2',$training_survey_details->comfortability_sharing_concerns_doubts_2)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_2" id="comfortability_sharing_concerns_doubts_2" value="2" @if(old('comfortability_sharing_concerns_doubts_2',$training_survey_details->comfortability_sharing_concerns_doubts_2)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_2" id="comfortability_sharing_concerns_doubts_2" value="3" @if(old('comfortability_sharing_concerns_doubts_2',$training_survey_details->comfortability_sharing_concerns_doubts_2)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_2" id="comfortability_sharing_concerns_doubts_2" value="4" @if(old('comfortability_sharing_concerns_doubts_2',$training_survey_details->comfortability_sharing_concerns_doubts_2)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_2" id="comfortability_sharing_concerns_doubts_2" value="5" @if(old('comfortability_sharing_concerns_doubts_2',$training_survey_details->comfortability_sharing_concerns_doubts_2)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('comfortability_sharing_concerns_doubts_2"'))
                        <span class="text-danger">{{ $errors->first('comfortability_sharing_concerns_doubts_2"') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="additional_feedback_trainer_2" class="form-label">Any additional comments for {{$training_survey_details->trainer_2_name}} <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                      <textarea class="form-control" name="additional_feedback_trainer_2" id="additional_feedback_trainer_2" style="height: 100px">{{ old('additional_feedback_trainer_2',$training_survey_details->additional_feedback_trainer_2) }}</textarea>
                      <div class="invalid-feedback">
                        Any additional comments.
                      </div>
                      @if ($errors->has('additional_feedback_trainer_2'))
                        <span class="text-danger">{{ $errors->first('additional_feedback_trainer_2') }}</span>
                      @endif

                      <script>
                          CKEDITOR.replace( 'additional_feedback_trainer_2' );
                        </script>

                    </div>
                  @endif



                  @if($training_survey_details->trainer_3_id)

                    <input type="hidden" name="trainer_3_name" id='trainer_3_name' value="{{ $training_survey_details->trainer_3_name}}">
                    <input type="hidden" name="trainer_3_id" id='trainer_3_id' value="{{ $training_survey_details->trainer_3_id}}">

                    <div class="col-md-12 position-relative" style="margin-bottom: -5px; margin-top: 10px;">
                      <label class="form-label"><strong>Please rate {{$training_survey_details->trainer_3_name}} on the following parameters</strong></label>
                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="expertise_on_subject_matter_3" class="form-label rdioBtn">Expertise on the subject-matter  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_3" id="expertise_on_subject_matter_3" value="NA" @if(old('expertise_on_subject_matter_3',$training_survey_details->expertise_on_subject_matter_3)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_3" id="expertise_on_subject_matter_3" value="1" @if(old('expertise_on_subject_matter_3',$training_survey_details->expertise_on_subject_matter_3)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_3" id="expertise_on_subject_matter_3" value="2" @if(old('expertise_on_subject_matter_3',$training_survey_details->expertise_on_subject_matter_3)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_3" id="expertise_on_subject_matter_3" value="3" @if(old('expertise_on_subject_matter_3',$training_survey_details->expertise_on_subject_matter_3)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_3" id="expertise_on_subject_matter_3" value="4" @if(old('expertise_on_subject_matter_3',$training_survey_details->expertise_on_subject_matter_3)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_3" id="expertise_on_subject_matter_3" value="5" @if(old('expertise_on_subject_matter_3',$training_survey_details->expertise_on_subject_matter_3)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>

                      @if ($errors->has('expertise_on_subject_matter_3'))
                        <span class="text-danger">{{ $errors->first('expertise_on_subject_matter_3') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="clear_effective_communication_skills_3" class="form-label rdioBtn">Clear and effective communication skills <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_3" id="clear_effective_communication_skills_3" value="NA" @if(old('clear_effective_communication_skills_3',$training_survey_details->clear_effective_communication_skills_3)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_3" id="clear_effective_communication_skills_3" value="1" @if(old('clear_effective_communication_skills_3',$training_survey_details->clear_effective_communication_skills_3)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_3" id="clear_effective_communication_skills_3" value="2" @if(old('clear_effective_communication_skills_3',$training_survey_details->clear_effective_communication_skills_3)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_3" id="clear_effective_communication_skills_3" value="3" @if(old('clear_effective_communication_skills_3',$training_survey_details->clear_effective_communication_skills_3)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_3" id="clear_effective_communication_skills_3" value="4" @if(old('clear_effective_communication_skills_3',$training_survey_details->clear_effective_communication_skills_3)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_3" id="clear_effective_communication_skills_3" value="5" @if(old('clear_effective_communication_skills_3',$training_survey_details->clear_effective_communication_skills_3)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('clear_effective_communication_skills_3'))
                        <span class="text-danger">{{ $errors->first('clear_effective_communication_skills_3') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="effective_delivery_content_3" class="form-label rdioBtn">Effective delivery of content <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="effective_delivery_content_3" id="effective_delivery_content_3" value="NA" @if(old('effective_delivery_content_3',$training_survey_details->effective_delivery_content_3)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_3" id="effective_delivery_content_3" value="1" @if(old('effective_delivery_content_3',$training_survey_details->effective_delivery_content_3)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_3" id="effective_delivery_content_3" value="2" @if(old('effective_delivery_content_3',$training_survey_details->effective_delivery_content_3)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_3" id="effective_delivery_content_3" value="3" @if(old('effective_delivery_content_3',$training_survey_details->effective_delivery_content_3)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_3" id="effective_delivery_content_3" value="4" @if(old('effective_delivery_content_3',$training_survey_details->effective_delivery_content_3)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_3" id="effective_delivery_content_3" value="5" @if(old('effective_delivery_content_3',$training_survey_details->effective_delivery_content_3)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('effective_delivery_content_3'))
                        <span class="text-danger">{{ $errors->first('effective_delivery_content_3') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="timely_response_queries_3" class="form-label rdioBtn">Timely response to your queries <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="timely_response_queries_3" id="timely_response_queries_3" value="NA" @if(old('timely_response_queries_3',$training_survey_details->timely_response_queries_3)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_3" id="timely_response_queries_3" value="1" @if(old('timely_response_queries_3',$training_survey_details->timely_response_queries_3)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_3" id="timely_response_queries_3" value="2" @if(old('timely_response_queries_3',$training_survey_details->timely_response_queries_3)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_3" id="timely_response_queries_3" value="3" @if(old('timely_response_queries_3',$training_survey_details->timely_response_queries_3)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_3" id="timely_response_queries_3" value="4" @if(old('timely_response_queries_3',$training_survey_details->timely_response_queries_3)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_3" id="timely_response_queries_3" value="5" @if(old('timely_response_queries_3',$training_survey_details->timely_response_queries_3)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('timely_response_queries_3'))
                        <span class="text-danger">{{ $errors->first('timely_response_queries_3') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="comfortability_sharing_concerns_doubts_3" class="form-label rdioBtn">Comfortability in sharing your concerns & doubts <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_3" id="comfortability_sharing_concerns_doubts_3" value="NA" @if(old('comfortability_sharing_concerns_doubts_3',$training_survey_details->comfortability_sharing_concerns_doubts_3)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_3" id="comfortability_sharing_concerns_doubts_3" value="1" @if(old('comfortability_sharing_concerns_doubts_3',$training_survey_details->comfortability_sharing_concerns_doubts_3)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_3" id="comfortability_sharing_concerns_doubts_3" value="2" @if(old('comfortability_sharing_concerns_doubts_3',$training_survey_details->comfortability_sharing_concerns_doubts_3)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_3" id="comfortability_sharing_concerns_doubts_3" value="3" @if(old('comfortability_sharing_concerns_doubts_3',$training_survey_details->comfortability_sharing_concerns_doubts_3)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_3" id="comfortability_sharing_concerns_doubts_3" value="4" @if(old('comfortability_sharing_concerns_doubts_3',$training_survey_details->comfortability_sharing_concerns_doubts_3)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_3" id="comfortability_sharing_concerns_doubts_3" value="5" @if(old('comfortability_sharing_concerns_doubts_3',$training_survey_details->comfortability_sharing_concerns_doubts_3)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('comfortability_sharing_concerns_doubts_3"'))
                        <span class="text-danger">{{ $errors->first('comfortability_sharing_concerns_doubts_3"') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="additional_feedback_trainer_3" class="form-label">Any additional comments for {{$training_survey_details->trainer_3_name}} <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                      <textarea class="form-control" name="additional_feedback_trainer_3" id="additional_feedback_trainer_3" style="height: 100px">{{ old('additional_feedback_trainer_3',$training_survey_details->additional_feedback_trainer_3) }}</textarea>
                      <div class="invalid-feedback">
                        Any additional comments.
                      </div>
                      @if ($errors->has('additional_feedback_trainer_3'))
                        <span class="text-danger">{{ $errors->first('additional_feedback_trainer_3') }}</span>
                      @endif

                      <script>
                          CKEDITOR.replace( 'additional_feedback_trainer_3' );
                        </script>

                    </div>
                  @endif



                  @if($training_survey_details->trainer_4_id)

                    <input type="hidden" name="trainer_4_name" id='trainer_4_name' value="{{ $training_survey_details->trainer_4_name}}">
                    <input type="hidden" name="trainer_4_id" id='trainer_4_id' value="{{ $training_survey_details->trainer_4_id}}">

                    <div class="col-md-12 position-relative" style="margin-bottom: -5px; margin-top: 10px;">
                      <label class="form-label"><strong>Please rate {{$training_survey_details->trainer_4_name}} on the following parameters</strong></label>
                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="expertise_on_subject_matter_4" class="form-label rdioBtn">Expertise on the subject-matter  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_4" id="expertise_on_subject_matter_4" value="NA" @if(old('expertise_on_subject_matter_4',$training_survey_details->expertise_on_subject_matter_4)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_4" id="expertise_on_subject_matter_4" value="1" @if(old('expertise_on_subject_matter_4',$training_survey_details->expertise_on_subject_matter_4)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_4" id="expertise_on_subject_matter_4" value="2" @if(old('expertise_on_subject_matter_4',$training_survey_details->expertise_on_subject_matter_4)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_4" id="expertise_on_subject_matter_4" value="3" @if(old('expertise_on_subject_matter_4',$training_survey_details->expertise_on_subject_matter_4)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_4" id="expertise_on_subject_matter_4" value="4" @if(old('expertise_on_subject_matter_4',$training_survey_details->expertise_on_subject_matter_4)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_4" id="expertise_on_subject_matter_4" value="5" @if(old('expertise_on_subject_matter_4',$training_survey_details->expertise_on_subject_matter_4)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>

                      @if ($errors->has('expertise_on_subject_matter_4'))
                        <span class="text-danger">{{ $errors->first('expertise_on_subject_matter_4') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="clear_effective_communication_skills_4" class="form-label rdioBtn">Clear and effective communication skills <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_4" id="clear_effective_communication_skills_4" value="NA" @if(old('clear_effective_communication_skills_4',$training_survey_details->clear_effective_communication_skills_4)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_4" id="clear_effective_communication_skills_4" value="1" @if(old('clear_effective_communication_skills_4',$training_survey_details->clear_effective_communication_skills_4)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_4" id="clear_effective_communication_skills_4" value="2" @if(old('clear_effective_communication_skills_4',$training_survey_details->clear_effective_communication_skills_4)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_4" id="clear_effective_communication_skills_4" value="3" @if(old('clear_effective_communication_skills_4',$training_survey_details->clear_effective_communication_skills_4)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_4" id="clear_effective_communication_skills_4" value="4" @if(old('clear_effective_communication_skills_4',$training_survey_details->clear_effective_communication_skills_4)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_4" id="clear_effective_communication_skills_4" value="5" @if(old('clear_effective_communication_skills_4',$training_survey_details->clear_effective_communication_skills_4)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('clear_effective_communication_skills_4'))
                        <span class="text-danger">{{ $errors->first('clear_effective_communication_skills_4') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="effective_delivery_content_4" class="form-label rdioBtn">Effective delivery of content <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="effective_delivery_content_4" id="effective_delivery_content_4" value="NA" @if(old('effective_delivery_content_4',$training_survey_details->effective_delivery_content_4)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_4" id="effective_delivery_content_4" value="1" @if(old('effective_delivery_content_4',$training_survey_details->effective_delivery_content_4)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_4" id="effective_delivery_content_4" value="2" @if(old('effective_delivery_content_4',$training_survey_details->effective_delivery_content_4)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_4" id="effective_delivery_content_4" value="3" @if(old('effective_delivery_content_4',$training_survey_details->effective_delivery_content_4)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_4" id="effective_delivery_content_4" value="4" @if(old('effective_delivery_content_4',$training_survey_details->effective_delivery_content_4)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_4" id="effective_delivery_content_4" value="5" @if(old('effective_delivery_content_4',$training_survey_details->effective_delivery_content_4)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('effective_delivery_content_4'))
                        <span class="text-danger">{{ $errors->first('effective_delivery_content_4') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="timely_response_queries_4" class="form-label rdioBtn">Timely response to your queries <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="timely_response_queries_4" id="timely_response_queries_4" value="NA" @if(old('timely_response_queries_4',$training_survey_details->timely_response_queries_4)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_4" id="timely_response_queries_4" value="1" @if(old('timely_response_queries_4',$training_survey_details->timely_response_queries_4)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_4" id="timely_response_queries_4" value="2" @if(old('timely_response_queries_4',$training_survey_details->timely_response_queries_4)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_4" id="timely_response_queries_4" value="3" @if(old('timely_response_queries_4',$training_survey_details->timely_response_queries_4)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_4" id="timely_response_queries_4" value="4" @if(old('timely_response_queries_4',$training_survey_details->timely_response_queries_4)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_4" id="timely_response_queries_4" value="5" @if(old('timely_response_queries_4',$training_survey_details->timely_response_queries_4)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('timely_response_queries_4'))
                        <span class="text-danger">{{ $errors->first('timely_response_queries_4') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="comfortability_sharing_concerns_doubts_4" class="form-label rdioBtn">Comfortability in sharing your concerns & doubts <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_4" id="comfortability_sharing_concerns_doubts_4" value="NA" @if(old('comfortability_sharing_concerns_doubts_4',$training_survey_details->comfortability_sharing_concerns_doubts_4)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_4" id="comfortability_sharing_concerns_doubts_4" value="1" @if(old('comfortability_sharing_concerns_doubts_4',$training_survey_details->comfortability_sharing_concerns_doubts_4)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_4" id="comfortability_sharing_concerns_doubts_4" value="2" @if(old('comfortability_sharing_concerns_doubts_4',$training_survey_details->comfortability_sharing_concerns_doubts_4)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_4" id="comfortability_sharing_concerns_doubts_4" value="3" @if(old('comfortability_sharing_concerns_doubts_4',$training_survey_details->comfortability_sharing_concerns_doubts_4)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_4" id="comfortability_sharing_concerns_doubts_4" value="4" @if(old('comfortability_sharing_concerns_doubts_4',$training_survey_details->comfortability_sharing_concerns_doubts_4)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_4" id="comfortability_sharing_concerns_doubts_4" value="5" @if(old('comfortability_sharing_concerns_doubts_4',$training_survey_details->comfortability_sharing_concerns_doubts_4)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('comfortability_sharing_concerns_doubts_4"'))
                        <span class="text-danger">{{ $errors->first('comfortability_sharing_concerns_doubts_4"') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="additional_feedback_trainer_4" class="form-label">Any additional comments for {{$training_survey_details->trainer_4_name}} <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                      <textarea class="form-control" name="additional_feedback_trainer_4" id="additional_feedback_trainer_4" style="height: 100px">{{ old('additional_feedback_trainer_4',$training_survey_details->additional_feedback_trainer_4) }}</textarea>
                      <div class="invalid-feedback">
                        Any additional comments.
                      </div>
                      @if ($errors->has('additional_feedback_trainer_4'))
                        <span class="text-danger">{{ $errors->first('additional_feedback_trainer_4') }}</span>
                      @endif

                      <script>
                          CKEDITOR.replace( 'additional_feedback_trainer_4' );
                        </script>
                    </div>
                  @endif



                  @if($training_survey_details->trainer_5_id)

                    <input type="hidden" name="trainer_5_name" id='trainer_5_name' value="{{ $training_survey_details->trainer_5_name}}">
                    <input type="hidden" name="trainer_5_id" id='trainer_5_id' value="{{ $training_survey_details->trainer_5_id}}">

                    <div class="col-md-12 position-relative" style="margin-bottom: -5px; margin-top: 10px;">
                      <label class="form-label"><strong>Please rate Traininer_5_name on the following parameters</strong></label>
                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="expertise_on_subject_matter_5" class="form-label rdioBtn">Expertise on the subject-matter  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_5" id="expertise_on_subject_matter_5" value="NA" @if(old('expertise_on_subject_matter_5',$training_survey_details->expertise_on_subject_matter_5)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_5" id="expertise_on_subject_matter_5" value="1" @if(old('expertise_on_subject_matter_5',$training_survey_details->expertise_on_subject_matter_5)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_5" id="expertise_on_subject_matter_5" value="2" @if(old('expertise_on_subject_matter_5',$training_survey_details->expertise_on_subject_matter_5)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_5" id="expertise_on_subject_matter_5" value="3" @if(old('expertise_on_subject_matter_5',$training_survey_details->expertise_on_subject_matter_5)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_5" id="expertise_on_subject_matter_5" value="4" @if(old('expertise_on_subject_matter_5',$training_survey_details->expertise_on_subject_matter_5)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="expertise_on_subject_matter_5" id="expertise_on_subject_matter_5" value="5" @if(old('expertise_on_subject_matter_5',$training_survey_details->expertise_on_subject_matter_5)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>

                      @if ($errors->has('expertise_on_subject_matter_5'))
                        <span class="text-danger">{{ $errors->first('expertise_on_subject_matter_5') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="clear_effective_communication_skills_5" class="form-label rdioBtn">Clear and effective communication skills <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_5" id="clear_effective_communication_skills_5" value="NA" @if(old('clear_effective_communication_skills_5',$training_survey_details->clear_effective_communication_skills_5)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_5" id="clear_effective_communication_skills_5" value="1" 
                          @if(old('clear_effective_communication_skills_5',$training_survey_details->clear_effective_communication_skills_5)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_5" id="clear_effective_communication_skills_5" value="2" @if(old('clear_effective_communication_skills_5',$training_survey_details->clear_effective_communication_skills_5)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_5" id="clear_effective_communication_skills_5" value="3" @if(old('clear_effective_communication_skills_5',$training_survey_details->clear_effective_communication_skills_5)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_5" id="clear_effective_communication_skills_5" value="4" @if(old('clear_effective_communication_skills_5',$training_survey_details->clear_effective_communication_skills_5)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="clear_effective_communication_skills_5" id="clear_effective_communication_skills_5" value="5" @if(old('clear_effective_communication_skills_5',$training_survey_details->clear_effective_communication_skills_5)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('clear_effective_communication_skills_5'))
                        <span class="text-danger">{{ $errors->first('clear_effective_communication_skills_5') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="effective_delivery_content_5" class="form-label rdioBtn">Effective delivery of content <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="effective_delivery_content_5" id="effective_delivery_content_5" value="NA" @if(old('effective_delivery_content_5',$training_survey_details->effective_delivery_content_5)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_5" id="effective_delivery_content_5" value="1" @if(old('effective_delivery_content_5',$training_survey_details->effective_delivery_content_5)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_5" id="effective_delivery_content_5" value="2" @if(old('effective_delivery_content_5',$training_survey_details->effective_delivery_content_5)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_5" id="effective_delivery_content_5" value="3" @if(old('effective_delivery_content_5',$training_survey_details->effective_delivery_content_5)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_5" id="effective_delivery_content_5" value="4" @if(old('effective_delivery_content_5',$training_survey_details->effective_delivery_content_5)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="effective_delivery_content_5" id="effective_delivery_content_5" value="5" @if(old('effective_delivery_content_5',$training_survey_details->effective_delivery_content_5)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('effective_delivery_content_5'))
                        <span class="text-danger">{{ $errors->first('effective_delivery_content_5') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="timely_response_queries_5" class="form-label rdioBtn">Timely response to your queries <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="timely_response_queries_5" id="timely_response_queries_5" value="NA" @if(old('timely_response_queries_5',$training_survey_details->timely_response_queries_5)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_5" id="timely_response_queries_5" value="1" @if(old('timely_response_queries_5',$training_survey_details->timely_response_queries_5)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_5" id="timely_response_queries_5" value="2" @if(old('timely_response_queries_5',$training_survey_details->timely_response_queries_5)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_5" id="timely_response_queries_5" value="3" @if(old('timely_response_queries_5',$training_survey_details->timely_response_queries_5)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_5" id="timely_response_queries_5" value="4" @if(old('timely_response_queries_5',$training_survey_details->timely_response_queries_5)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="timely_response_queries_5" id="timely_response_queries_5" value="5" @if(old('timely_response_queries_5',$training_survey_details->timely_response_queries_5)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('timely_response_queries_5'))
                        <span class="text-danger">{{ $errors->first('timely_response_queries_5') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="comfortability_sharing_concerns_doubts_5" class="form-label rdioBtn">Comfortability in sharing your concerns & doubts <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                      <span id="radioBtn">
                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_5" id="comfortability_sharing_concerns_doubts_5" value="NA" @if(old('comfortability_sharing_concerns_doubts_5',$training_survey_details->comfortability_sharing_concerns_doubts_5)=='NA') checked @endif>
                        <label class="form-check-label" for="gridRadios1">NA</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_5" id="comfortability_sharing_concerns_doubts_5" value="1" @if(old('comfortability_sharing_concerns_doubts_5',$training_survey_details->comfortability_sharing_concerns_doubts_5)=='1') checked @endif>
                        <label class="form-check-label" for="gridRadios1">1</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_5" id="comfortability_sharing_concerns_doubts_5" value="2" @if(old('comfortability_sharing_concerns_doubts_5',$training_survey_details->comfortability_sharing_concerns_doubts_5)=='2') checked @endif>
                        <label class="form-check-label" for="gridRadios1">2</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_5" id="comfortability_sharing_concerns_doubts_5" value="3" @if(old('comfortability_sharing_concerns_doubts_5',$training_survey_details->comfortability_sharing_concerns_doubts_5)=='3') checked @endif>
                        <label class="form-check-label" for="gridRadios1">3</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_5" id="comfortability_sharing_concerns_doubts_5" value="4" @if(old('comfortability_sharing_concerns_doubts_5',$training_survey_details->comfortability_sharing_concerns_doubts_5)=='4') checked @endif>
                        <label class="form-check-label" for="gridRadios1">4</label>

                        <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_5" id="comfortability_sharing_concerns_doubts_5" value="5" @if(old('comfortability_sharing_concerns_doubts_5',$training_survey_details->comfortability_sharing_concerns_doubts_5)=='5') checked @endif>
                        <label class="form-check-label" for="gridRadios1">5</label>
                      </span>
                      @if ($errors->has('comfortability_sharing_concerns_doubts_5"'))
                        <span class="text-danger">{{ $errors->first('comfortability_sharing_concerns_doubts_5"') }}</span>
                      @endif

                    </div>

                    <div class="col-md-12 position-relative">
                      <label for="additional_feedback_trainer_5" class="form-label">Any additional comments for {{$training_survey_details->trainer_5_name}} <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                      <textarea class="form-control" name="additional_feedback_trainer_5" id="additional_feedback_trainer_5" style="height: 100px">{{ old('additional_feedback_trainer_5',$training_survey_details->additional_feedback_trainer_5) }}</textarea>
                      <div class="invalid-feedback">
                        Any additional comments.
                      </div>
                      @if ($errors->has('additional_feedback_trainer_5'))
                        <span class="text-danger">{{ $errors->first('additional_feedback_trainer_5') }}</span>
                      @endif

                      <script>
                          CKEDITOR.replace( 'additional_feedback_trainer_5' );
                        </script>

                    </div>
                  @endif


                </div>


                <div class="col-md-12 position-relative" style="margin-bottom: -5px; margin-top: 10px;">
                  <label class="form-label">Please share your experience with the following</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="training_first_week_joining" class="form-label rdioBtn">Training plan was shared with me within the first week of joining  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="training_first_week_joining" id="training_first_week_joining" value="NA" @if(old('training_first_week_joining',$training_survey_details->training_first_week_joining)=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

                  	<input class="form-check-input" type="radio" name="training_first_week_joining" id="training_first_week_joining" value="1" @if(old('training_first_week_joining',$training_survey_details->training_first_week_joining)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="training_first_week_joining" id="training_first_week_joining" value="2" @if(old('training_first_week_joining',$training_survey_details->training_first_week_joining)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="training_first_week_joining" id="training_first_week_joining" value="3" @if(old('training_first_week_joining',$training_survey_details->training_first_week_joining)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="training_first_week_joining" id="training_first_week_joining" value="4" @if(old('training_first_week_joining',$training_survey_details->training_first_week_joining)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="training_first_week_joining" id="training_first_week_joining" value="5" @if(old('training_first_week_joining',$training_survey_details->training_first_week_joining)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('training_first_week_joining'))
                    <span class="text-danger">{{ $errors->first('training_first_week_joining') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="training_sessions_went_as_planned" class="form-label rdioBtn">The training sessions went as planned <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="training_sessions_went_as_planned" id="training_sessions_went_as_planned" value="NA" @if(old('training_sessions_went_as_planned',$training_survey_details->training_sessions_went_as_planned)=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

	                  <input class="form-check-input" type="radio" name="training_sessions_went_as_planned" id="training_sessions_went_as_planned" value="1" @if(old('training_sessions_went_as_planned',$training_survey_details->training_sessions_went_as_planned)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="training_sessions_went_as_planned" id="training_sessions_went_as_planned" value="2" @if(old('training_sessions_went_as_planned',$training_survey_details->training_sessions_went_as_planned)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="training_sessions_went_as_planned" id="training_sessions_went_as_planned" value="3" @if(old('training_sessions_went_as_planned',$training_survey_details->training_sessions_went_as_planned)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="training_sessions_went_as_planned" id="training_sessions_went_as_planned" value="4" @if(old('training_sessions_went_as_planned',$training_survey_details->training_sessions_went_as_planned)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="training_sessions_went_as_planned" id="training_sessions_went_as_planned" value="5" @if(old('training_sessions_went_as_planned',$training_survey_details->training_sessions_went_as_planned)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('training_sessions_went_as_planned'))
                    <span class="text-danger">{{ $errors->first('training_sessions_went_as_planned') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="training_topics_were_covered_in_detail" class="form-label rdioBtn">Training topics were covered in detail <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="training_topics_were_covered_in_detail" id="training_topics_were_covered_in_detail" value="NA"@if(old('training_topics_were_covered_in_detail',$training_survey_details->training_topics_were_covered_in_detail)=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

	                  <input class="form-check-input" type="radio" name="training_topics_were_covered_in_detail" id="training_topics_were_covered_in_detail" value="1"@if(old('training_topics_were_covered_in_detail',$training_survey_details->training_topics_were_covered_in_detail)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="training_topics_were_covered_in_detail" id="training_topics_were_covered_in_detail" value="2"@if(old('training_topics_were_covered_in_detail',$training_survey_details->training_topics_were_covered_in_detail)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="training_topics_were_covered_in_detail" id="training_topics_were_covered_in_detail" value="3"@if(old('training_topics_were_covered_in_detail',$training_survey_details->training_topics_were_covered_in_detail)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="training_topics_were_covered_in_detail" id="training_topics_were_covered_in_detail" value="4"@if(old('training_topics_were_covered_in_detail',$training_survey_details->training_topics_were_covered_in_detail)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="training_topics_were_covered_in_detail" id="training_topics_were_covered_in_detail" value="5"@if(old('training_topics_were_covered_in_detail',$training_survey_details->training_topics_were_covered_in_detail)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('training_topics_were_covered_in_detail'))
                    <span class="text-danger">{{ $errors->first('training_topics_were_covered_in_detail') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="training_was_effective_helping" class="form-label rdioBtn">Training was effective & is helping me do my job well <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="training_was_effective_helping" id="training_was_effective_helping" value="NA" @if(old('training_was_effective_helping',$training_survey_details->training_was_effective_helping)=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

	                  <input class="form-check-input" type="radio" name="training_was_effective_helping" id="training_was_effective_helping" value="1" @if(old('training_was_effective_helping',$training_survey_details->training_was_effective_helping)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="training_was_effective_helping" id="training_was_effective_helping" value="2" @if(old('training_was_effective_helping',$training_survey_details->training_was_effective_helping)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="training_was_effective_helping" id="training_was_effective_helping" value="3" @if(old('training_was_effective_helping',$training_survey_details->training_was_effective_helping)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="training_was_effective_helping" id="training_was_effective_helping" value="4" @if(old('training_was_effective_helping',$training_survey_details->training_was_effective_helping)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="training_was_effective_helping" id="training_was_effective_helping" value="5" @if(old('training_was_effective_helping',$training_survey_details->training_was_effective_helping)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('training_was_effective_helping'))
                    <span class="text-danger">{{ $errors->first('training_was_effective_helping') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="clearly_understood_all_modules" class="form-label rdioBtn">I have clearly understood all the modules <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="clearly_understood_all_modules" id="clearly_understood_all_modules" value="NA"@if(old('clearly_understood_all_modules',$training_survey_details->clearly_understood_all_modules)=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

	                  <input class="form-check-input" type="radio" name="clearly_understood_all_modules" id="clearly_understood_all_modules" value="1"@if(old('clearly_understood_all_modules',$training_survey_details->clearly_understood_all_modules)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="clearly_understood_all_modules" id="clearly_understood_all_modules" value="2"@if(old('clearly_understood_all_modules',$training_survey_details->clearly_understood_all_modules)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="clearly_understood_all_modules" id="clearly_understood_all_modules" value="3"@if(old('clearly_understood_all_modules',$training_survey_details->clearly_understood_all_modules)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="clearly_understood_all_modules" id="clearly_understood_all_modules" value="4"@if(old('clearly_understood_all_modules',$training_survey_details->clearly_understood_all_modules)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="clearly_understood_all_modules" id="clearly_understood_all_modules" value="5"@if(old('clearly_understood_all_modules',$training_survey_details->clearly_understood_all_modules)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('clearly_understood_all_modules'))
                    <span class="text-danger">{{ $errors->first('clearly_understood_all_modules') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="self_study_material_useful" class="form-label rdioBtn">Self-study material has been very useful for me <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <input class="form-check-input" type="radio" name="self_study_material_useful" id="self_study_material_useful" value="NA" @if(old('self_study_material_useful',$training_survey_details->self_study_material_useful)=='NA') checked @endif>
                    <label class="form-check-label" for="gridRadios1">NA</label>

	                  <input class="form-check-input" type="radio" name="self_study_material_useful" id="self_study_material_useful" value="1" @if(old('self_study_material_useful',$training_survey_details->self_study_material_useful)=='1') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">1</label>

	                  <input class="form-check-input" type="radio" name="self_study_material_useful" id="self_study_material_useful" value="2" @if(old('self_study_material_useful',$training_survey_details->self_study_material_useful)=='2') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">2</label>

	                  <input class="form-check-input" type="radio" name="self_study_material_useful" id="self_study_material_useful" value="3" @if(old('self_study_material_useful',$training_survey_details->self_study_material_useful)=='3') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">3</label>

	                  <input class="form-check-input" type="radio" name="self_study_material_useful" id="self_study_material_useful" value="4" @if(old('self_study_material_useful',$training_survey_details->self_study_material_useful)=='4') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">4</label>

	                  <input class="form-check-input" type="radio" name="self_study_material_useful" id="self_study_material_useful" value="5" @if(old('self_study_material_useful',$training_survey_details->self_study_material_useful)=='5') checked @endif>
	                  <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('self_study_material_useful'))
                    <span class="text-danger">{{ $errors->first('self_study_material_useful') }}</span>
                  @endif

                </div>

                <div style="clear: both; height: 10px;"></div>

                <div class="col-md-12 position-relative">
                  <label for="is_there_any_topic" class="form-label">Is there any topic that you still need training on? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="is_there_any_topic" id="is_there_any_topic" style="height: 100px">{{ old('is_there_any_topic',$training_survey_details->is_there_any_topic) }}</textarea>
                  <div class="invalid-feedback">
                    Is there any topic that you still need training on
                  </div>
                  @if ($errors->has('is_there_any_topic'))
                    <span class="text-danger">{{ $errors->first('is_there_any_topic') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'is_there_any_topic' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="interesting_part_elaborate" class="form-label">Which part of the training was the most interesting? Please elaborate <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="interesting_part_elaborate" id="interesting_part_elaborate" style="height: 100px">{{ old('interesting_part_elaborate',$training_survey_details->interesting_part_elaborate) }}</textarea>
                  <div class="invalid-feedback">
                    Please elaborate.
                  </div>
                  @if ($errors->has('interesting_part_elaborate'))
                    <span class="text-danger">{{ $errors->first('interesting_part_elaborate') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'interesting_part_elaborate' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="any_suggestions_feedback" class="form-label">Any suggestion/feedback you would like to give in helping us to improve our training sessions? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="any_suggestions_feedback" id="any_suggestions_feedback" style="height: 100px">{{ old('any_suggestions_feedback',$training_survey_details->any_suggestions_feedback) }}</textarea>
                  <div class="invalid-feedback">
                    Please elaborate.
                  </div>
                  @if ($errors->has('any_suggestions_feedback'))
                    <span class="text-danger">{{ $errors->first('any_suggestions_feedback') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'any_suggestions_feedback' );
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

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection