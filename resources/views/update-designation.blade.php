@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Update Designation | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <h5 class="card-title">Update Designation</h5>
              
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
              <form method="post" action="{{ route('update-designation')}}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="designation_id" id="designation_id" value="{{ $designation_details['id']}}">

                <div class="col-md-6 position-relative">
                  <label for="name" class="form-label">Designation Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $designation_details['name'] }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="name" class="form-label">Company Name</label>
                  <select class="form-select" name="company_id" id="company_id" required>
                    <option value="">Choose...</option>
                    @foreach($company_details as $company_detail)
                    <option value="{{$company_detail['id']}}" @if($designation_details['company_id']==$company_detail['id']) selected @endif>{{$company_detail['name']}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Please select company name.
                  </div>
                  @if ($errors->has('company_id'))
                    <span class="text-danger">{{ $errors->first('company_id') }}</span>
                  @endif
                 
                </div>


                <div class="col-12">
                  <input type="submit" name="submit" value="Update" class="btn btn-primary">
                  
                  <input type="button" name="button" value="Cancel" class="btn btn-info" onclick="location.href = '{{ url("manage-designations")}}';">
                  
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection