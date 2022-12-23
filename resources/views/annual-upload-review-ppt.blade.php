@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Annual Review PPT Upload | {{ env('MY_SITE_NAME') }}</title>
@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">Annual Review PPT Upload</h5>
              
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
              <form method="post" action="{{ route('save-annual-review-ppt')}}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="member_id" id="member_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="annual_review_form_id" id="annual_review_form_id" value="{{ $survey_from_id }}">

                <div class="col-md-6 position-relative">
                  <label for="name" class="form-label">Choose PPT</label>
                  <input class="form-control" type="file" name="image" id="image" accept=".ppt, .pptx">
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                  @endif
                </div>

                @if($annual_review_ppt_details)
                <div class="col-md-6 position-relative" style="text-align: center!important; line-height: 24px;">
                  
                  <a href="{{ asset($annual_review_ppt_details) }}" download>Click here</a> for download PPT. <br>

                  <a href="{{ asset($annual_review_ppt_details) }}" download> <i class="bi bi-filetype-pptx" style="font-size: 50px; color: #0d6efd;"></i> </a>

                  

                </div>
                @endif

                <div class="col-12">
                  <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection