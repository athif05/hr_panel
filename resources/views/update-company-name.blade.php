@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Update Company Name | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">Update Company Name</h5>
              
               <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-company-name')}}" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $company_details['id']}}">

                <div class="col-md-6 position-relative">
                  <label for="name" class="form-label">Company Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $company_details['name'] }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="name" class="form-label">Company Logo</label>
                  <input type="file" class="form-control" name="image" id="image" accept="image/png, image/jpeg, image/jpg">
                  @if($company_details['logo'])
                    <img src="{{ asset('').$company_details['logo'] }}" alt="Profile" class="rounded-circle" style="width: 100px;">
                  @endif
                  @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                  @endif
                </div>


                <div class="col-12">
                  <input type="submit" name="submit" value="Update" class="btn btn-primary">

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