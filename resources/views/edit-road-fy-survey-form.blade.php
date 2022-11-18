@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Edit ROAD Survey Question | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">Edit ROAD Survey Question</h5>
              
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

                <div class="col-md-6 position-relative">
                  <label for="appraisal_cycle" class="form-label">Appraisal Cycle <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <?php
                  $c1='Apr-'.$current_year;
                  $c2='Oct-'.$current_year;
                  ?>
                  <select class="form-select" name="appraisal_cycle" id="appraisal_cycle">
                    <option value="">Choose...</option>

                    <option value="{{$c1}}" @if(old('appraisal_cycle', $roadfys->appraisal_cycle)==$c1) selected @endif>{{ $c1 }}</option>

                    <option value="{{$c2}}" @if(old('appraisal_cycle', $roadfys->appraisal_cycle)==$c2) selected @endif>{{ $c2 }}</option>

                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid option.
                  </div>
                  @if ($errors->has('appraisal_cycle'))
                    <span class="text-danger">{{ $errors->first('appraisal_cycle') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="no_of_section" class="form-label">No of Section</label>
                  <input type="number" min="1" max="15" class="form-control" name="no_of_section" id="no_of_section" value="{{ old('no_of_section', $roadfys->no_of_section) }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="role_id" class="form-label">Role Name <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="role_id" id="role_id">
                    <option value="">Choose...</option>

                    @foreach($roles as $role)
                    <option value="{{ $role['id'] }}" @if(old('role_id', $roadfys->role_id)==$role['id']) selected @endif>{{ $role['name'] }}</option>
                    @endforeach

                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid option.
                  </div>
                  @if ($errors->has('role_id'))
                    <span class="text-danger">{{ $errors->first('role_id') }}</span>
                  @endif
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
								<div style="float: left; width: 6%; font-size: 31px; color: green; cursor: pointer; text-align: center; ">
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