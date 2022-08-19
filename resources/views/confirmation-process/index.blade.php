@extends('confirmation-process.layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Employee Details | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
  
      @include('confirmation-process.partials.sidebar')

        <div class="right_sec">
            <div class="top_heading">
                <h2>EMPLOYEE DETAILS <img src="{{ asset('resources/views/confirmation-process/img/emp-icon.png') }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
        <ul>
          <li>
            <div class="col-left">Employee Name</div>
            <div class="col-right">{{ $employee_details['first_name'] }} {{ $employee_details['last_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Employee ID</div>
            <div class="col-right">{{ $employee_details['member_id'] }}</div>
          </li>
          <li>
            <div class="col-left">Date Of Joining</div>
            <div class="col-right">{{ $employee_details['joining_date'] ? date('d-M-Y', strtotime($employee_details['joining_date'])) : '' }}</div>
          </li>
          <li>
            <div class="col-left">Date of Confirmation</div>
            <div class="col-right">{{ $employee_details['date_of_confirmation'] ? date('d-M-Y', strtotime($employee_details['date_of_confirmation'])) : ''}}</div>
          </li>
          <li>
            <div class="col-left">Total Tenure</div>
            <div class="col-right">{{ $total_tenure }}</div>
          </li>
          <!-- <li>
            <div class="col-left">Confirmation Date</div>
            <div class="col-right">01 Feb 2019</div>
          </li> -->
          <li>
            <div class="col-left">Employee Status</div>
            <div class="col-right">{{ $employee_details['employee_type'] }}</div>
          </li>
          <li>
            <div class="col-left">Curr. Designation</div>
            <div class="col-right">{{ $employee_details['designation'] }}</div>
          </li>
          <li>
            <div class="col-left">Appraisal Cycle</div>
            <div class="col-right">{{ $employee_details['appraisal_cycle'] ? date('d-M-Y', strtotime($employee_details['appraisal_cycle'])) : ''}}</div>
          </li>
          <li>
            <div class="col-left">Curr. Salary Details</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">Increment details so far</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">PIP History</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">Manager's Name</div>
            <div class="col-right">{{ $employee_details['manager_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Mentor's name</div>
            <div class="col-right">{{ $employee_details['manager_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Head's name</div>
            <div class="col-right">{{ $employee_details['manager_name'] }}</div>
          </li>
          <li>
            <div class="col-left">Expected Salary_Employee</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">Suggested Salary_HR</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">Suggested Salary_TL</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">Suggested Salary_Heads</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">Suggested Salary_Management</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">PPT Scores by Head</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">PPT Scores by Management</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">PPT Scores by TL</div>
            <div class="col-right">-NA-</div>
          </li>
          <li>
            <div class="col-left">Average PPT Scores</div>
            <div class="col-right">-NA-</div>
          </li>
        </ul>
      </div>
            
            
            
            <div class="btn-group">
                <a href="{{ url('/score-card/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection