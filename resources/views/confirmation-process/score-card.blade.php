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
        
        <div class="right_sec score_card_tab">
            <div class="top_heading">
                <h2>SCORE CARD <img src="{{ asset('resources/views/confirmation-process/img/card-icon.png') }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
        <ul>
          <li>
            <div class="col-left"># Of Reportees</div>
            <div class="col-right">05</div>
          </li>
            
            <h2>Top Strengths</h2>
          <li>
            <div class="col-left">1 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">2 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">3 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">4 - Ability to learn from mistakes.</div>
          </li>
       
            
              
            <h2>Top Weaknesses</h2>
          <li>
            <div class="col-left">1 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">2 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">3 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">4 - Ability to learn from mistakes.</div>
          </li>
       
            
            
              
            <h2>Top Strengths</h2>
          <li>
            <div class="col-left">1 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">2 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">3 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">4 - Ability to learn from mistakes.</div>
          </li>
       
            
              
            <h2>Top Weaknesses</h2>
          <li>
            <div class="col-left">1 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">2 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">3 - Ability to learn from mistakes.</div>
          </li>
          <li>
            <div class="col-left">4 - Ability to learn from mistakes.</div>
          </li>
       
        </ul>
      </div>
            
            
            
            <div class="btn-group">
				        <a href="{{ url('/start-confirmation-process/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/survey/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection