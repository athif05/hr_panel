@extends('confirmation-process.layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Score Card | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">

      @include('confirmation-process.partials.sidebar')

      <div class="right_sec survey_tab feedback_tab">
        <div class="top_heading">
          <h2>MANAGER FEEDBACKS <img src="{{ asset('resources/views/confirmation-process/img/emp-icon.png') }}" alt="icon" /></h2>
        </div>
        <div class="imployee_detail mCustomScrollbar">
          <div class="month_overview feedback_overview">
            <div class="score_col_row">
              <div class="score_col">
                <p>JD</p>
                <span>2.0</span> </div>
              <div class="score_col">
                <p>Reliabillity</p>
                <span>2.0</span> </div>
              <div class="score_col">
                <p>Team Spirit</p>
                <span>2.0</span> </div>
              <div class="score_col">
                <p>Attendance</p>
                <span>2.0</span> </div>
              <div class="score_col">
                <p>Attitude</p>
                <span>2.0</span> </div>
              <div class="score_col">
                <p>Rules</p>
                <span>2.0</span> </div>
              <div class="score_col">
                <p>TL’s Feedback</p>
                <span>2.0</span> </div>
              <div class="score_col">
                <p>Peer</p>
                <span>2.0</span> </div>
            </div>
          </div>
          <ul>
            <h2>Q. 1 - How has your journey been so far in vCommission? Explain in detail.</h2>
            <li>
              <div class="col-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</div>
            </li>
            <h2>Q. 2 - Top 3 things that you like about your job role.</h2>
            <li>
              <div class="col-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</div>
            </li>
            <h2>Q. 3 - How has your journey been so far in vCommission? Explain in detail.</h2>
            <li>
              <div class="col-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</div>
            </li>
            <h2>Q. 4 - How has your journey been so far in vCommission? Explain in detail.</h2>
            <li>
              <div class="col-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</div>
            </li>
            <h2>Q. 5 - How has your journey been so far in vCommission? Explain in detail.</h2>
            <li>
              <div class="col-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</div>
            </li>
            <h2>Q. 6 - How has your journey been so far in vCommission? Explain in detail.</h2>
            <li>
              <div class="col-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</div>
            </li>
          </ul>
        </div>
        <div class="btn-group"> 
          <a href="{{ url('/evaluation/'.$employee_id) }}" class="btn btn-default">previous</a> 
          <a href="{{ url('/thankyou/'.$employee_id) }}" class="btn btn-default btn-active">next</a> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection