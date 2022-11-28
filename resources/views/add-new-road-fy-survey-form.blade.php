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
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
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
              <form method="post" action="{{ route('save-section-list-fy')}}" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <input type="hidden" name="annual_review_form_id" id="annual_review_form_id" value="{{ $review_form_name_data['id'] }}">

                <div class="col-md-6 position-relative">
                  <label for="appraisal_cycle" class="form-label">Appraisal Cycle <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="appraisal_cycle" id="appraisal_cycle" value="{{ $review_form_name_data['appraisal_month'] }} {{ $review_form_name_data['appraisal_year'] }}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('appraisal_cycle'))
                    <span class="text-danger">{{ $errors->first('appraisal_cycle') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="no_of_section" class="form-label">No of Section</label>

                  <!-- <input type="number" min="1" max="9"class="form-control" name="no_of_section" id="no_of_section" value="{{ old('no_of_section') }}" onKeyDown="if(this.value.length==2 && event.keyCode!=8) return false;" required>
                  <div class="valid-feedback">
                    Looks good!
                  </div> -->
                  <input type="hidden" name="ajax_url" id="ajax_url" value="{{  URL::to('/'); }}">
                  <select class="form-select" name="no_of_section" id="no_of_section">
                    <option value="">Choose...</option>

                    @for($i=1;$i<=$no_of_section;$i++)
                    <option value="{{ $i }}" @if(old('role_id',$road_fy_data->no_of_section)==$i) selected @endif>{{ $i }}</option>
                    @endfor

                  </select>
                  <div class="invalid-feedback">
                    Please select a valid option.
                  </div>
                  @if ($errors->has('no_of_section'))
                    <span class="text-danger">{{ $errors->first('no_of_section') }}</span>
                  @endif
                </div>



                <div id="section_display_div">
                  <?php $n=1;?>
                  @foreach($section_fy_lists as $section_fy_list)

                  <div class='road_fy_element'>
                    <div style="float: left; width: 100%; margin-bottom: 10px; border: 1px solid #ccc; padding: 5px;">
                      <div class="section_div_padding13" style="float: left; width: 5%;">{{ $n }}.</div>
                      <div style="float: left; width: 60%;">
                        Section Name <input type="text" class="form-control" name="section_name[]" id="section_name_{{$n}}" value="{{ $section_fy_list['section_name'] }}" style="width: 95%;" required>
                      </div>

                      <div style="float: left; width: 35%;">
                        Visible For 
                        <select class="form-select" name="visible_for[]" id="visible_for" style="width: 95%;">
                          <option value="Member" @if($section_fy_list['visible_for']=='Member') selected @endif>Member</option>
                          <option value="Manager" @if($section_fy_list['visible_for']=='Manager') selected @endif>Manager</option>
                          <option value="HR" @if($section_fy_list['visible_for']=='HR') selected @endif>HR</option>
                          <option value="All" @if($section_fy_list['visible_for']=='All') selected @endif>All</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php $n++;?>
                  @endforeach
                </div>


                <div class="col-12">
                  <input type="submit" name="submit" value="Add" class="btn btn-info">

                  <!-- <input type="submit" name="submit" value="Add & Next" class="btn btn-primary"> -->

                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection