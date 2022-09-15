@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Generate Email | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Fill Generate Email</h5>
              
              @if($confirmation_generate_email_details)

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-generate-email-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $confirmation_generate_email_details['id'] }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $confirmation_generate_email_details['user_id'] }}">
                <input type="hidden" name="updated_by_id" id="updated_by_id" value="{{ Auth::user()->id }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $confirmation_generate_email_details['member_name'] }}" readonly>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                
                <div class="col-md-6 position-relative">
                  <label for="letter_type" class="form-label">Letter Type <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="letter_type" id="letter_type">
                    <option value="">Choose...</option>
                    @foreach($lettre_types as $lettre_type)
                    <option value="{{$lettre_type['id']}}" @if(old('letter_type',$confirmation_generate_email_details['letter_type'])==$lettre_type['id']) selected @endif>{{$lettre_type['name']}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('letter_type'))
                    <span class="text-danger">{{ $errors->first('letter_type') }}</span>
                  @endif
                </div>

                
                <div class="col-md-6 position-relative">
                  <label for="increment_amount" class="form-label">Increment Amount </label>
                  <input type="number" class="form-control" name="increment_amount" id="increment_amount" min="0" value="{{ old('increment_amount',$confirmation_generate_email_details['increment_amount']) }}">
                  @if ($errors->has('increment_amount'))
                    <span class="text-danger">{{ $errors->first('increment_amount') }}</span>
                  @endif
                </div>


                
                <div class="col-md-6 position-relative">
                  <label for="promotion" class="form-label">Promotion </label>
                  <input type="text" class="form-control" name="promotion" id="promotion" value="{{ old('promotion',$confirmation_generate_email_details['promotion']) }}">
                  @if ($errors->has('promotion'))
                    <span class="text-danger">{{ $errors->first('promotion') }}</span>
                  @endif
                </div>

                
                <div class="col-md-6 position-relative">
                  <label for="appraisal_cycle" class="form-label">Appraisal cycle <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="text" class="form-control disable-text" name="appraisal_cycle" id="appraisal_cycle" value="{{ $confirmation_generate_email_details['appraisal_cycle']  }}" readonly>
                  @if ($errors->has('appraisal_cycle'))
                    <span class="text-danger">{{ $errors->first('appraisal_cycle') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="session_date" class="form-label">Session Date <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" class="form-control" name="session_date" id="session_date" value="{{ old('session_date',$confirmation_generate_email_details['session_date']) }}">
                  @if ($errors->has('session_date'))
                    <span class="text-danger">{{ $errors->first('session_date') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="session_time" class="form-label">Session Time <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="time" class="form-control" name="session_time" id="session_time2" value="{{ old('session_time',$confirmation_generate_email_details['session_time']) }}">
                  @if ($errors->has('session_time'))
                    <span class="text-danger">{{ $errors->first('session_time') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="poc_name" class="form-label">POC <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>

                  <select class="form-select" name="poc_name" id="poc_name">
                    <option value="">Choose...</option>
                    @foreach($poc_details as $poc_detail)
                    <option value="{{$poc_detail['id']}}" @if(old('poc_name',$confirmation_generate_email_details['poc_name'])==$poc_detail['id']) selected @endif>{{$poc_detail['full_name']}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('poc_name'))
                    <span class="text-danger">{{ $errors->first('poc_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="location" class="form-label">Location <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <!-- <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}"> -->
                  <input type="text" class="form-control disable-text" name="location" id="location" value="{{ $user_details->location }}" readonly>
                  @if ($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
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

              @else
                <h6>No data found.</h6>
              @endif

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection