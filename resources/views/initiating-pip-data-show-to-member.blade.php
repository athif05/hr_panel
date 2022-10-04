@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Initiating PIP Form | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
    	.form-check-input[type=radio] {
		  margin-left: 30px;
		  border-radius: 50%;
		}

    .text-danger{
      font-size: 13px!important;
    }

    .rate-star-color{
    	color: #f7cd13;
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
              <h5 class="card-title">Initiating PIP Form Details</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              @if($initiating_pip_details)
              <!-- Bordered Table -->
              <table class="table table-striped table-bordered">
                
                <tbody>
                  <tr>
                    <td>Member Name</td>
                    <td>{{ $user_details['full_name']}}</td>
                  </tr>

                  <tr>
                    <td>Member ID</td>
                    <td>{{ $user_details['member_id']}}</td>
                  </tr>

                  <tr>
                    <td>Date of Joining</td>
                    <td>{{ $user_details['joining_date']}}</td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>{{ $user_details['department_name']}}</td>
                  </tr>

                  <tr>
                    <td>Company</td>
                    <td>{{ $user_details['company_name']}}</td>
                  </tr>

                  <tr>
                    <td>Location</td>
                    <td>{{ $user_details['location']}}</td>
                  </tr>

                  <tr>
                    <td>Reporting Manager</td>
                    <td>{{ $user_details['manager_name']}}</td>
                  </tr>

                  <tr>
                    <td>Department Head</td>
                    <td>{{ $user_details['hod_name']}}</td>
                  </tr>

                  <tr>
                    <td>Member Status</td>
                    <td>{{ $user_details['employee_type']}}</td>
                  </tr>

                  <tr>
                    <td>Duration of PIP to be Implemented</td>
                    <td>{{ $initiating_pip_details['no_of_days']}}</td>
                  </tr>

                  <tr>
                    <td>Start Date of PIP</td>
                    <td>{{ $initiating_pip_details['date_initiating_pip']}}</td>
                  </tr>

                  <tr>
                    <td>End Date of PIP</td>
                    <td>{{ $initiating_pip_details['closing_date_pip']}}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Description of the Issue </strong> {!! $initiating_pip_details['issue_description_performance_behaviour'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Description of Expected Performance </strong> {!! $initiating_pip_details['description_expected_performance'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Plan of action to improve the performance </strong> {!! $initiating_pip_details['plan_of_action_to_improve'] !!}</td>
                  </tr>

                </tbody>
              </table>
              <!-- End Bordered Table -->
              @else
                No record found...
              @endif
              
            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
@endsection