@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Add ROAD Survey Question | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">Add ROAD Survey Question</h5>
              
              @if(session()->has('success_msg'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              @if(session()->has('error_msg'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error_msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif


              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-new-company')}}" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="col-md-4 position-relative">
                  <label for="appraisal_cycle" class="form-label">Appraisal Cycle <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="appraisal_cycle" id="appraisal_cycle" value="{{ $appraisal_cycle_data->appraisal_cycle }}" readonly>
                </div>


                <div class="col-md-4 position-relative">
                  <label for="appraisal_cycle" class="form-label">Section Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="appraisal_cycle" id="appraisal_cycle" value="{{ $section_name_data['section_name'] }}" readonly>
                </div>

                <div class="col-md-4 position-relative">
                  <label for="appraisal_cycle" class="form-label">Visible For <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="appraisal_cycle" id="appraisal_cycle" value="{{ $section_name_data['visible_for'] }}" readonly>
                </div>


                <div class="col-md-12 position-relative">
                	<h6 class="card-title">Add Question</h6>
                	<div class="container">
						<div class='road_fy_element' id="roadFyDiv_1">
							<div style="float: left; width: 100%; margin-top:5px;">
								<div style="float: left; width: 45%;">
									<label for="question_title" class="form-label">Question Title</label>
									<input type='text' placeholder='Question' name='question_title[]' id='txt_1' value="" class="form-control" style="width: 98%;">
								</div>
								<div style="float: left; width: 24%;">
									<label for="question_type" class="form-label">Question Type</label>
									<select class="form-select" name="question_type[]" id="txt_2" style="width: 98%;">
					                	<option value="textbox" @if(old('question_type')=='textbox') selected @endif>Text Box</option>
					                	<option value="textarea" @if(old('question_type')=='textarea') selected @endif>Text Area</option>
					                	<option value="radiobutton" @if(old('question_type')=='radiobutton') selected @endif>Radio Button</option>
					                	<option value="checkbox" @if(old('question_type')=='checkbox') selected @endif>Check Box</option>
					                	<option value="dropdown" @if(old('question_type')=='dropdown') selected @endif>Drop Down</option>
					                </select>

								</div>
								<div style="float: left; width: 25%;">
									<label for="question_value" class="form-label">Question Value <span style="font-size: 10px;">(Comma seprated value)</span></label>
									<input type='text' name='question_value[]' id='txt_3' value="" class="form-control" style="width: 98%;">


									<!-- <input type='text' name='question_value[]' id='txt_3' value="" data-role="tagsinput" class="form-control" style="width: 98%;"> -->
								</div>
								<div style="float: left; width: 6%; font-size: 31px; color: green; cursor: pointer; text-align: center; padding-top: 25px;">
									<span class='road_fy_add'><i class="bi bi-plus"></i></span>
								</div>
							</div>
						</div>
					</div>

                </div>

                


                <div class="col-12">
                  <input type="submit" name="submit" value="Add" class="btn btn-primary">


                  <input type="button" name="button" value="Cancel" class="btn btn-info" onclick="location.href = '{{ url("manage-company-names")}}';">

                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection