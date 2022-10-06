@extends('layouts.master-confirmation')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Stakeholder’s Feedback | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>let’s talk about you! <img src="{{ str_replace('public/', '', asset('assests/confirmation-process/img/emp-icon.png')) }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              @if(count($confirmation_mom_details)>0)

              <h2>Q. 1 - What is your name?</h2>
              <li>
              <div class="col-left">{{ $user_details['full_name'] }}</div>
              </li>

              <h2>Q. 2 - What is your Member ID?</h2>
              <li>
              <div class="col-left">{{ $user_details['member_id'] }}</div>
              </li>

              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
				<a href="{{ url('/manager-confirmation-feedback-form/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/mom-form/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection