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
                <h2>EVALUATION <img src="{{ asset('resources/views/confirmation-process/img/evalution-icon.png') }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
                <div class="month_overview">
                    <h2><img src="{{ asset('resources/views/confirmation-process/img/calender-icon.png') }}" alt="icon" /> january 2019</h2>
                    <div class="score_col_row">
                        <div class="score_col">
                            <p>Target</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>Response</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>JD</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>Reliabillity</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>Team Spirit</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>Attendance</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>Attitude</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>Rules</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>TL’s Feedback</p>
                            <span>2.0</span>
                        </div>
                        <div class="score_col">
                            <p>Peer</p>
                            <span>2.0</span>
                        </div>
                    </div>
                    
                    <div class="total_score_row">
                        <div class="avrg_score"><h3><img src="{{ asset('resources/views/confirmation-process/img/avrg-icon.png') }}" alt="icon" /> Average Score: 17.00</h3></div>
                        <div class="total_score"><h3><img src="{{ asset('resources/views/confirmation-process/img/score-icon.png') }}" alt="icon" /> Total : 16.5/25</h3></div>
                    </div>
                    
                    <div class="comment_section">
                        <div class="comment_row">
                            <div class="name_col">Supriya Kaushik <span>HR</span></div>
                            <div class="comment_col">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse </div>
                        </div>
                        <div class="comment_row">
                            <div class="name_col">Gangandep Singh  <span>Manager</span></div>
                            <div class="comment_col">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse </div>
                        </div>
                        <div class="comment_row">
                            <div class="name_col">Supriya Kaushik  <span>HR</span></div>
                            <div class="comment_col">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            
            
            <div class="btn-group">
				<a href="{{ url('/ppt/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/feedback/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection