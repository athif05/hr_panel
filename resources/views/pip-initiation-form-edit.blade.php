@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>PIP Initiation Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Fill PIP Initiation Form</h5>
              



              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-initiating-pip-email-form') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $initiating_pip_details['id'] }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $initiating_pip_details['user_id'] }}">
                <input type="hidden" name="updated_by_id" id="updated_by_id" value="{{ $initiating_pip_details['updated_by_id'] }}">
                
                

                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Member Name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $user_details['full_name']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_name'))
                    <span class="text-danger">{{ $errors->first('member_name') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_id" class="form-label">Member ID</label>
                  <input type="text" class="form-control disable-text" name="member_id" id="member_id" value="{{ $user_details['member_id']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_id'))
                    <span class="text-danger">{{ $errors->first('member_id') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="date_of_joining" class="form-label">Date of Joining</label>
                  <input type="text" class="form-control disable-text" name="date_of_joining" id="date_of_joining" value="{{ $user_details['joining_date']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('date_of_joining'))
                    <span class="text-danger">{{ $errors->first('date_of_joining') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="department" class="form-label">Department</label>
                  <input type="text" class="form-control disable-text" name="department" id="department" value="{{ $user_details['department_name']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="company" class="form-label">Company</label>
                  <input type="text" class="form-control disable-text" name="company" id="company" value="{{ $user_details['company_name']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="location" class="form-label">Location</label>
                  <input type="text" class="form-control disable-text" name="location" id="location" value="{{ $user_details['location']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="reporting_manager" class="form-label">Reporting Manager</label>
                  <input type="text" class="form-control disable-text" name="reporting_manager" id="reporting_manager" value="{{ $user_details['manager_name']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('reporting_manager'))
                    <span class="text-danger">{{ $errors->first('reporting_manager') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="department_head" class="form-label">Department Head</label>
                  <input type="text" class="form-control disable-text" name="department_head" id="department_head" value="{{ $user_details['hod_name']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('department_head'))
                    <span class="text-danger">{{ $errors->first('department_head') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="member_status" class="form-label">Member Status</label>
                  <input type="text" class="form-control disable-text" name="member_status" id="member_status" value="{{ $user_details['employee_type']}}" readonly>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('member_status'))
                    <span class="text-danger">{{ $errors->first('member_status') }}</span>
                  @endif
                </div>

               
                <div class="col-md-6 position-relative">
                  <label for="no_of_days" class="form-label">Duration of PIP to be Implemented <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="no_of_days" id="no_of_days">
                    <option value="">-- Choose Days --</option>
                    
                    <option value="15 days" @if(($initiating_pip_details->no_of_days)=='15 days') selected @endif>15 days</option>
                    <option value="30 days" @if(($initiating_pip_details->no_of_days)=='30 days') selected @endif>30 days</option>
                    
                    @if($user_details['employee_type']=='Probation')
                      <option value="45 days" @if(old('no_of_days', $initiating_pip_details->no_of_days)=='45 days') selected @endif>45 days</option>
                      <option value="60 days" @if(old('no_of_days', $initiating_pip_details->no_of_days)=='60 days') selected @endif>60 days</option>
                      <option value="75 days" @if(old('no_of_days', $initiating_pip_details->no_of_days)=='75 days') selected @endif>75 days</option>
                      <option value="90 days" @if(old('no_of_days', $initiating_pip_details->no_of_days)=='90 days') selected @endif>90 days</option>
                    @endif
                  </select>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('no_of_days'))
                    <span class="text-danger">{{ $errors->first('no_of_days') }}</span>
                  @endif
                </div>

                <div class="col-md-6 position-relative">
                  <label for="date_initiating_pip" class="form-label">Start Date of PIP <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" class="form-control" name="date_initiating_pip" id="date_initiating_pip" value="{{ old('date_initiating_pip', $initiating_pip_details->date_initiating_pip) }}">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('date_initiating_pip'))
                    <span class="text-danger">{{ $errors->first('date_initiating_pip') }}</span>
                  @endif
                </div>


                <div class="col-md-6 position-relative">
                  <label for="closing_date_pip" class="form-label">End Date of PIP <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <input type="date" class="form-control" name="closing_date_pip" id="closing_date_pip" value="{{ old('closing_date_pip', $initiating_pip_details->closing_date_pip) }}">
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  @if ($errors->has('closing_date_pip'))
                    <span class="text-danger">{{ $errors->first('closing_date_pip') }}</span>
                  @endif
                </div>

                
                <div class="col-md-12 position-relative">
                  <label for="issue_description_performance_behaviour" class="form-label">Description of the Issue (Performance related concerns or Behaviour related concerns) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="issue_description_performance_behaviour" id="issue_description_performance_behaviour" style="height: 100px">{{ old('issue_description_performance_behaviour', $initiating_pip_details->issue_description_performance_behaviour)}}</textarea>

                  @if ($errors->has('issue_description_performance_behaviour'))
                    <span class="text-danger">{{ $errors->first('issue_description_performance_behaviour') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'issue_description_performance_behaviour' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="description_expected_performance" class="form-label">Description of Expected Performance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="description_expected_performance" id="description_expected_performance" style="height: 100px">{{ old('description_expected_performance', $initiating_pip_details->description_expected_performance)}}</textarea>

                  @if ($errors->has('description_expected_performance'))
                    <span class="text-danger">{{ $errors->first('description_expected_performance') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'description_expected_performance' );
                  </script>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="plan_of_action_to_improve" class="form-label">Plan of action to improve the performance (Identify and specify the support and resources you will provide to assist the member) <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <textarea class="form-control" name="plan_of_action_to_improve" id="plan_of_action_to_improve" style="height: 100px">{{ old('plan_of_action_to_improve', $initiating_pip_details->plan_of_action_to_improve)}}</textarea>

                  @if ($errors->has('plan_of_action_to_improve'))
                    <span class="text-danger">{{ $errors->first('plan_of_action_to_improve') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'plan_of_action_to_improve' );
                  </script>
                </div>


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