@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Change Password | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">Change Password</h5>

            	<!-- <div class="col-lg-6" style="float: right; text-align: right; padding-top: 12px;">
            		<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("manage-roles")}}';">Show All Roles</button>		
            	</div> -->
              
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
              <div style="clear: both; height: 10px;"></div>
              @endif


            <div class="col-lg-12">
              <!-- Change Password Form -->
              <form method="post" action="{{ route('update-password')}}" class="row g-3 needs-validation" novalidate>
              	@csrf

              	<input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" class="form-control" name="currentPassword" id="currentPassword" value="{{ old('currentPassword')}}" required>
                    @if ($errors->has('currentPassword'))
	                    <span class="text-danger">{{ $errors->first('currentPassword') }}</span>
	                @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" class="form-control" name="newPassword" id="newPassword" value="{{ old('newPassword')}}" required>
                    @if ($errors->has('newPassword'))
	                    <span class="text-danger">{{ $errors->first('newPassword') }}</span>
	                @endif
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirm New Password</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" value="{{ old('confirmPassword')}}" required>
                    @if ($errors->has('confirmPassword'))
	                    <span class="text-danger">{{ $errors->first('confirmPassword') }}</span>
	                @endif
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection