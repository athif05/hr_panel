@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Update Role | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">Update Role</h5>

            	<!-- <div class="col-lg-6" style="float: right; text-align: right; padding-top: 12px;">
            		<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("manage-roles")}}';">Show All Roles</button>		
            	</div> -->
              
               <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-role')}}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="role_id" id="role_id" value="{{ $role_details['id']}}">

                <div class="col-md-6 position-relative">
                  <label for="name" class="form-label">Role Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $role_details['name'] }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>

                <div class="col-12">
                  <input type="submit" name="submit" value="Update" class="btn btn-primary">

	              	<input type="button" name="button" value="Cancel" class="btn btn-info" onclick="location.href = '{{ url("manage-roles")}}';">

                  
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection