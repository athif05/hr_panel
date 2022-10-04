@extends('confirmation-process.layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Member Details | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
  
      @include('confirmation-process.partials.sidebar')

        <div class="right_sec">
            <div class="top_heading">
                <h2>Member DETAILS <img src="{{ asset('resources/views/confirmation-process/img/emp-icon.png') }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
        <ul>
          <li>
            <div class="col-left">Member Name</div>
            <div class="col-right">{{ $employee_details['first_name'] }} {{ $employee_details['last_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Member ID</div>
            <div class="col-right">{{ $employee_details['member_id'] }}</div>
          </li>
          <li>
            <div class="col-left">Member Email</div>
            <div class="col-right">{{ $employee_details['email'] }}</div>
          </li>
          <li>
            <div class="col-left">Curr. Designation</div>
            <div class="col-right">{{ $employee_details['designation_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Department</div>
            <div class="col-right">{{ $employee_details['department_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Manager's Name</div>
            <div class="col-right">{{ $employee_details['manager_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Company Name</div>
            <div class="col-right">{{ $employee_details['company_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Company Location</div>
            <div class="col-right">{{ $employee_details['location_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Gender</div>
            <div class="col-right">{{ $employee_details['gender'] }}</div>
          </li>
          <li>
            <div class="col-left">Date Of Joining</div>
            <div class="col-right">{{ $employee_details['joining_date'] ? date('Y-M-d', strtotime($employee_details['joining_date'])) : '' }}</div>
          </li>
          <!-- <li>
            <div class="col-left">Date of Confirmation</div>
            <div class="col-right">{{ $employee_details['date_of_confirmation'] ? date('d-M-Y', strtotime($employee_details['date_of_confirmation'])) : ''}}</div>
          </li> -->
          <li>
            <div class="col-left">Due Date of Confirmation</div>
            <div class="col-right">{{ $employee_details['due_date_of_confirmation'] ? date('Y-M-d', strtotime($employee_details['due_date_of_confirmation'])) : ''}}</div>
          </li>
          <li>
            <div class="col-left">Member Status</div>
            <div class="col-right">{{ $employee_details['employee_type'] }}</div>
          </li>
          <li>
            <div class="col-left">Appraisal Cycle</div>
            <div class="col-right">{{ $employee_details['appraisal_cycle'] ? date('Y-M-d', strtotime($employee_details['appraisal_cycle'])) : ''}}</div>
          </li>
          <li>
            <div class="col-left">Total Tenure</div>
            <div class="col-right">{{ $total_tenure }}</div>
          </li>
        </ul>
      </div>
            
            
            
            <div class="btn-group">
                <a href="{{ url('/recruitment-survey/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection