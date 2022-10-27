@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Confirmation Feedback Form Details | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
    	.form-check-input[type=radio] {
		  margin-left: 30px;
		  border-radius: 50%;
		}

    .text-danger{
      font-size: 13px!important;
    }

    .rate-star-color{
    	color: #f7cd13;
    }
    </style>
@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Confirmation Feedback Form Details</h5>

              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              @if($user_details && count($confirmation_feedback_details)>0)
              <!-- Bordered Table -->
              <table class="table table-striped table-bordered">
                
                <tbody>
                  <tr>
                    <td>What is your name?</td>
                    <td>{{ $user_details['full_name'] }}</td>
                  </tr>

                  <tr>
                    <td>What is your Member ID?</td>
                    <td>{{ $user_details['member_id'] }}</td>
                  </tr>

                  <tr>
                    <td>What is your designation in {{ $user_details['company_name'] }}?</td>
                    <td>{{ $user_details['designation_name'] }}</td>
                  </tr>

                  <tr>
                    <td>What is your department in {{ $user_details['company_name'] }}?</td>
                    <td>{{ $user_details['department_name'] }}</td>
                  </tr>

                  <tr>
                   <td>Location</td>
                    <td>{{ $user_details['location_name'] }} </td>
                  </tr>

                  <tr>
                   <td>Tenure(In Months)</td>
                    <td>{{ $total_tenure }} </td>
                  </tr>

                  

                  @foreach($confirmation_feedback_details as $confirmation_feedback_detail)

                    <tr>
                      <td colspan="2" class="text-center"><strong>Confirmation Feedback By {{ $confirmation_feedback_detail['full_manager_name'] }}</strong></td>
                    </tr>

                    <tr>
                      <td colspan="2"><strong>Rate {{ $user_details['full_name'] }} in the following</strong></td>
                    </tr>

                    <tr>
                      <td>Discipline</td>
                      <td>
                        @if($confirmation_feedback_detail['discipline']!='NA')
                          @for($i=0; $i < $confirmation_feedback_detail['discipline']; $i++)
                          <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                        @else
                          NA
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td>Punctuality</td>
                      <td>
                        @if($confirmation_feedback_detail['punctuality']!='NA')
                          @for($i=0; $i < $confirmation_feedback_detail['punctuality']; $i++)
                          <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                        @else
                          NA
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td>Work-Ethics</td>
                      <td>
                        @if($confirmation_feedback_detail['work_ethics']!='NA')
                          @for($i=0; $i < $confirmation_feedback_detail['work_ethics']; $i++)
                          <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                        @else
                          NA
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td>Team-Work</td>
                      <td>
                        @if($confirmation_feedback_detail['team_work']!='NA')
                          @for($i=0; $i < $confirmation_feedback_detail['team_work']; $i++)
                          <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                        @else
                          NA
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td>Response towards Feedback</td>
                      <td>
                        @if($confirmation_feedback_detail['response_towards_feedback']!='NA')
                          @for($i=0; $i < $confirmation_feedback_detail['response_towards_feedback']; $i++)
                          <i class="bi bi-star-fill rate-star-color"></i>
                          @endfor
                        @else
                          NA
                        @endif
                      </td>
                    </tr>

                    
                    <tr>
                      <td colspan="2"><strong>Kindly elaborate on {{ $user_details['full_name'] }} performance of the last 3 months? </strong> {!! $confirmation_feedback_detail['elaborate_performance'] !!}</td>
                    </tr>


                    <tr>
                      <td colspan="2"><strong>Mention top 3 highlights of {{ $user_details['full_name'] }}? </strong> 
                      	<br>
                      	<strong>1. </strong>{{ $confirmation_feedback_detail['top_3_highlights_1'] }} <br>
                      	<strong>2. </strong>{{ $confirmation_feedback_detail['top_3_highlights_2'] }} <br>
                      	<strong>3. </strong>{{ $confirmation_feedback_detail['top_3_highlights_3'] }} <br>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="2"><strong>Mention the major task that have been accomplished by {{ $user_details['full_name'] }}? </strong> 
                      	<br>
                      	<strong>1. </strong>{{ $confirmation_feedback_detail['major_task_1'] }} <br>
                      	<strong>2. </strong>{{ $confirmation_feedback_detail['major_task_2'] }} <br>
                      	<strong>3. </strong>{{ $confirmation_feedback_detail['major_task_3'] }} <br>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="2"><strong>Mention 3 areas of improvement?</strong> 
                        <br>
                        <strong>1. </strong>{{ $confirmation_feedback_detail['areas_of_improvement_1'] }} <br>
                        <strong>2. </strong>{{ $confirmation_feedback_detail['areas_of_improvement_2'] }} <br>
                        <strong>3. </strong>{{ $confirmation_feedback_detail['areas_of_improvement_3'] }} <br>
                      </td>
                    </tr>

                    <tr>
                      <td>Has {{ $user_details['full_name'] }} been able to add value in your team?</td>
                      <td>{{$confirmation_feedback_detail['add_value_in_team']}}</td>
                    </tr>

                    @if($confirmation_feedback_detail['add_value_in_team']=='Yes')
                    <tr>
                      <td colspan="2"><strong>If Yes, Please share an instance in details.</strong> {!! $confirmation_feedback_detail['add_value_in_team_share_instance'] !!}</td>
                    </tr>
                    @endif
                    

                    <tr>
                      <td>Has {{ $user_details['full_name'] }} met your expectations in the last 3 months?</td>
                      <td>{{$confirmation_feedback_detail['met_your_expectations']}}</td>
                    </tr>


                    <tr>
                      <td colspan="2"><strong>Other (please specify)</strong> {!! $confirmation_feedback_detail['met_your_expectations_other_specify'] !!}</td>
                    </tr>


                    <tr>
                      <td>Are you sure to confirm {{ $user_details['full_name'] }} in the Organization?</td>
                      <td>{{$confirmation_feedback_detail['are_you_sure_to_confirm']}}</td>
                    </tr>

                    @if($confirmation_feedback_detail['are_you_sure_to_confirm']=='No, Put under PIP')
                      <tr>
                        <td colspan="2"><strong>If you want to recommend PIP, Pls share a detailed plan. </strong><br> {{ $confirmation_feedback_detail['recommend_pip_detailed_plan'] }}</td>
                      </tr>
                    @endif

                    <tr>
                      <td>Has {{ $user_details['full_name'] }} been committed an increment on confirmation, at the time of joining?</td>
                      <td>{{$confirmation_feedback_detail['increment_on_confirmation']}}</td>
                    </tr>

                    @if($confirmation_feedback_detail['increment_on_confirmation']=='Yes')
                      <tr>
                        <td>If yes, then mention the amount.</td>
                        <td>{{$confirmation_feedback_detail['mention_the_amount']}}</td>
                      </tr>
                    @endif
                  @endforeach

                </tbody>
              </table>
              <!-- End Bordered Table -->
              @else
              <table class="table table-striped table-bordered">
                
	                <tbody>
	                  <tr>
	                    <td colspan="2">No record found...</td>
	                  </tr>
	              </tbody>
	          </table>
              @endif
              
            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
@endsection