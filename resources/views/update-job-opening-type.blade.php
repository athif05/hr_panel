@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Update Job Opening Type | {{ env('MY_SITE_NAME') }}</title>

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
    </style>
@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">Update Job Opening Type</h5>
              
               <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-job-opening-type')}}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $job_opening_details['id']}}">

                <div class="col-md-6 position-relative">
                  <label for="name" class="form-label">Company Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $job_opening_details['name'] }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>

                <div class="col-12">
                    <input type="submit" name="submit" value="Update" class="btn btn-primary">

	              	
					<input type="button" name="button" value="Cancel" class="btn btn-info" onclick="location.href = '{{ url("manage-job-opening-types")}}';">
					
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection