@extends('layouts.master-confirmation')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>PPT | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
      @include('confirmation-process.partials.sidebar')

        <div class="right_sec ppt_tab">
            <div class="top_heading">
                <h2>Download Member PPT <img src="{{ str_replace('public/', '', asset('assests/confirmation-process/img/download-icon.png')) }}" alt="icon" /></h2>
            </div>
      <div class="imployee_detail">
        <div class="download_ppt_col">

          @if($employee_details['confirmation_ppt'])
          <a href="{{ str_replace('public/', '', asset('')).$employee_details['confirmation_ppt'] }}" download>
            <img src="{{ str_replace('public/', '', asset('assests/confirmation-process/img/ppt-btn.jpg')) }}" alt="img" />
          </a>
          @endif

          </div>
      </div>
            
            
            
            <div class="btn-group">
				        <a href="{{ url('/fresh-eye-journal/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/manager-check-in-from/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection