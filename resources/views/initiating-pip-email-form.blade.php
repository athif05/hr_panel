@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Initiating PIP | {{ env('MY_SITE_NAME') }}</title>

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

    .form-label {
	    margin-bottom: 0.5rem;
	    font-weight: 600!important;
	}

	.rdioBtn{
		font-weight: 400!important;
		font-size: 15px;
	}
    </style>
@endsection


@section('content')
<main id="main" class="main">

    <!-- <div class="pagetitle">
      <h1>Form Validation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Validation</li>
        </ol>
      </nav>
    </div> --><!-- End Page Title -->

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Fill Initiating PIP Email</h5>
              
              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-initiating-pip-email-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{ $user_details->id }}">
                <input type="hidden" name="updated_by_id" id="updated_by_id" value="{{ Auth::user()->id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Member Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $user_details->full_name }}" readonly>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="date_initiating_pip" class="form-label">Date Initiating PIP <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" class="form-control" name="date_initiating_pip" id="date_initiating_pip" value="{{ old('date_initiating_pip') }}">
                  @if ($errors->has('date_initiating_pip'))
                    <span class="text-danger">{{ $errors->first('date_initiating_pip') }}</span>
                  @endif
                </div>

                 <div class="col-md-6 position-relative">
                  <label for="no_of_days" class="form-label">No Of Days <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control" name="no_of_days" id="no_of_days" value="{{old('no_of_days')}}">
                  @if ($errors->has('no_of_days'))
                    <span class="text-danger">{{ $errors->first('no_of_days') }}</span>
                  @endif
                </div>
                
                <!-- <div class="col-md-6 position-relative">
                  <label for="letter_type" class="form-label">day<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="no_of_days" id="no_of_days" value="{{ $user_details->no_of_days }}" readonly>
                  @if ($errors->has('letter_type'))
                    <span class="text-danger">{{ $errors->first('letter_type') }}</span>
                  @endif
                </div> -->

                <div class="col-md-6 position-relative">
                  <label for="closing_date_pip" class="form-label">Closing Date of PIP <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" class="form-control" name="closing_date_pip" id="closing_date_pip" value="{{ old('closing_date_pip') }}">
                  @if ($errors->has('closing_date_pip'))
                    <span class="text-danger">{{ $errors->first('closing_date_pip') }}</span>
                  @endif
                </div>


                <div style="clear: both; height: 10px;">&nbsp;</div>

                <div class="col-12">
                  <input type="submit" name="submit" value="Save in Draft" class="btn btn-info">

                  <input type="submit" name="submit" value="Publish" class="btn btn-primary">
                </div>

              </form><!-- End Custom Styled Validation with Tooltips -->
              <br>
              <div class="col-12">
              		@include('partials.common-note')
              	</div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection