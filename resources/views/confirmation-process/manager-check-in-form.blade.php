@extends('confirmation-process.layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Manager Check-In From | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>45 Days Check-In Form (Manager's Feedback) <img src="{{ asset('resources/views/confirmation-process/img/emp-icon.png') }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              @if($check_in_member_details!='data')

              <h2>Q. 1 - Full Name</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 2 - Member Code</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 3 - Designation</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 4 - Department</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 5 - Please choose the name of your company</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 6 - Date of Joining</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 7 - How did you come across this job opening?</h2>
              <li>
              <div class="col-left">
                
              </div>
              </li>

              
              <li>
              <div class="col-left"><strong>Internal Member Name</strong>
                <span class="float_right_div"></span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>Internal Member Designation</strong>
                <span class="float_right_div">
                  
                </span>  
              </div>
              </li>
              <li>
              <div class="col-left"><strong>Internal Member Department</strong>
                <span class="float_right_div">
                 
                </span>  
              </div>
              </li>
              

              <h2>Q. 8 - What's the name of your recruiter?</h2>
              <li>
              <div class="col-left">
                
              </div>
              </li>


              <h2>Q. 9 - Rate your recruiter in the following parameters out of 5:</h2>
      
              <li>
              <div class="col-left">Professionalism
                
              </div>
              </li>

              
              <li>
              <div class="col-left">Friendliness 
                
              </div>
              </li>

            
              <li>
              <div class="col-left">Length of the time spent talking to you
                
              </div>
              </li>

              
              <li>
              <div class="col-left">Company knowledge 
                
              </div>
              </li>

              
              <li>
              <div class="col-left">Specific knowledge about the job profile 
                
              </div>
              </li>

              
              <li>
              <div class="col-left">Timely response to your communications - email or phone 
                
              </div>
              </li>


              <h2>Q. 10 - Yes/No Questions</h2>
              <li>
              <div class="col-left">Do you completely understand our company policies and procedures as outlined in the handbook? <span class="float_right_div"></span></div>
              </li>

              <li>
              <div class="col-left">Do you completely understand departmental processes as explained in 'Manager's Expectation Setting' session? <span class="float_right_div"></span></div>
              </li>

              
              <li>
              <div class="col-left">Do you completely understand your job duties and responsibilities? <span class="float_right_div"></span></div>
              </li>

              
              <li>
              <div class="col-left">Do you feel that your job title is properly named? <span class="float_right_div"></span></div>
              </li>


              <h2>Q. 11 - What will be your mission for the first year?</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 12 - What do you aim in the second year?</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 13 - What will be your aim in the third year of your tenure with us?</h2>
              <li>
              <div class="col-left"></div>
              </li>


              <h2>Q. 14 - Rate the overall recruitment process of our company! (Rating out of 5)</h2>
              <li>
              <div class="col-left">
                
              </div>
              </li>


              <h2>Q. 15 - Any additional feedback for the recruitment process?</h2>
              <li>
              <div class="col-left"></div>
              </li>

              <h2>Q. 16 - Rate your HR induction session! (out of 5)</h2>
              <li>
              <div class="col-left">
              </div>
              </li>


              <h2>Q. 17 - Any additional feedback for HR induction session?</h2>
              <li>
              <div class="col-left"></div>
              </li>

              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
				        <a href="{{ url('/ppt/'.$employee_id) }}" class="btn btn-default">previous</a>
                <a href="{{ url('/manager-confirmation-feedback-form/'.$employee_id) }}" class="btn btn-default btn-active">next</a>
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection