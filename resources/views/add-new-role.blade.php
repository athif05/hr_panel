@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Add Role | {{ env('MY_SITE_NAME') }}</title>

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
              
              	<h5 class="card-title">Add New Role</h5>

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
              @endif


              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-new-role')}}" class="row g-3 needs-validation" novalidate>
                @csrf

                <div class="col-md-6 position-relative">
                  <label for="name" class="form-label">Role Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>

                <div class="col-12">
                  <input type="submit" name="submit" value="Add" class="btn btn-primary">
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection