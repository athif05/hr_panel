@extends('confirmation-process.layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Survey | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>let’s talk about you! <img src="{{ asset('resources/views/confirmation-process/img/emp-icon.png') }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
        <ul>
            <h2>Q. 1 - How has your journey been so far in vCommission? Explain in detail.</h2>
          <li>
            <div class="col-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</div>
          </li>
 <h2>Q. 2 - How has your journey been so far in vCommission? Explain in detail.</h2>
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
				        <a href="{{ url('/score-card/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/ppt/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection