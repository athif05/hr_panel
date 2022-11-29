@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Annual Review Form | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">Annual Review Form</h5>
              

              @if(session()->has('error_msg'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error_msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif


              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-annual-review-form')}}" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="col-md-6 position-relative">
                  <label for="form_name" class="form-label">Form Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="form_name" id="form_name" value="{{ old('form_name') }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('form_name'))
                    <span class="text-danger">{{ $errors->first('form_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="appraisal_month" class="form-label">Appraisal Month <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>

                  <select class="form-select" name="appraisal_month" id="appraisal_month">
                    <option value="April" >April</option>
                    <option value="October" >October</option>
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid option.
                  </div>
                  @if ($errors->has('appraisal_month'))
                    <span class="text-danger">{{ $errors->first('appraisal_month') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="appraisal_year" class="form-label">Appraisal Year <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="appraisal_year" id="appraisal_year">
                  	@foreach($appraisal_year_lists as $appraisal_year_list)
                    <option value="{{ $appraisal_year_list }}" >{{ $appraisal_year_list }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid option.
                  </div>
                  @if ($errors->has('appraisal_year'))
                    <span class="text-danger">{{ $errors->first('appraisal_year') }}</span>
                  @endif
                </div>



                <h6>Optional Fields</h6>

                <div class="col-md-6 position-relative">
                  <label for="survey_form_label" class="form-label">Survey Form Label</label>
                  <input type="text" class="form-control" name="survey_form_label" id="survey_form_label" value="{{ old('survey_form_label') }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('survey_form_label'))
                    <span class="text-danger">{{ $errors->first('survey_form_label') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="hr_1_1_label" class="form-label">HR 1:1 Label</label>
                  <input type="text" class="form-control" name="hr_1_1_label" id="hr_1_1_label" value="{{ old('hr_1_1_label') }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('hr_1_1_label'))
                    <span class="text-danger">{{ $errors->first('hr_1_1_label') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="ppt_label" class="form-label">PPT Label</label>
                  <input type="text" class="form-control" name="ppt_label" id="ppt_label" value="{{ old('ppt_label') }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('ppt_label'))
                    <span class="text-danger">{{ $errors->first('ppt_label') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="stakeholder_label" class="form-label">Stakeholder Label</label>
                  <input type="text" class="form-control" name="stakeholder_label" id="stakeholder_label" value="{{ old('stakeholder_label') }}">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('stakeholder_label'))
                    <span class="text-danger">{{ $errors->first('stakeholder_label') }}</span>
                  @endif
                </div>

                

                <div class="col-12">
                  <!-- <input type="submit" name="submit" value="Save in Draft" class="btn btn-info"> -->

                  <input type="submit" name="submit" value="Add" class="btn btn-primary">
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              
              <br>

              <div style="float: left; width: 100%;">
              	<div style="float: left; width: 70%;">
              		@include('partials.common-note')
              	</div>
              </div>
              

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection