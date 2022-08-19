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

      <div class="right_sec ppt_tab thankyou_tab">
        <div class="top_heading">
            <h2>THANK YOU <img src="{{ asset('resources/views/confirmation-process/img/emp-icon.png') }}" alt="icon" /></h2>
        </div>
        <div class="imployee_detail">
          <div class="thankyou_row">
            <div class="thankyou_col">
              <h2>THANK YOU!</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
            </div>
          </div>
        </div>



        <div class="btn-group">
          <a href="{{ url('/ppt/'.$employee_id) }}" class="btn btn-default">previous</a>
          <a href="{{ url('/start-confirmation-process/'.$employee_id) }}" class="btn btn-default btn-active">FINISH</a>
        </div>


      </div>
      
           
    </div>
  </div>
</div>
@endsection