@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Confirmation Feedback Form | {{ env('MY_SITE_NAME') }}</title>

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
              
              @if($user_details && $all_details)
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
                    <td>{{$user_details['designation_name']}}</td>
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
                    <td>{{ $user_details['location_name'] }} </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate {{ $user_details['full_name'] }} in the following out of 5 where "1" stands for Poor and "5" stands for excellent.</strong></td>
                  </tr>

                  <tr>
                    <td>Discipline</td>
                    <td>
                      @if($all_details['discipline']!='NA')
                        @for($i=0; $i < $all_details['discipline']; $i++)
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
                      @if($all_details['punctuality']!='NA')
                        @for($i=0; $i < $all_details['punctuality']; $i++)
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
                      @if($all_details['work_ethics']!='NA')
                        @for($i=0; $i < $all_details['work_ethics']; $i++)
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
                      @if($all_details['team_work']!='NA')
                        @for($i=0; $i < $all_details['team_work']; $i++)
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
                      @if($all_details['response_towards_feedback']!='NA')
                        @for($i=0; $i < $all_details['response_towards_feedback']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  
                  <tr>
                    <td colspan="2"><strong>Kindly elaborate on {{ $user_details['full_name'] }} performance of the last 3 months? </strong> {!! $all_details['elaborate_performance'] !!}</td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Mention top 3 highlights of Shweta Jaiswal? </strong> 
                    	<br>
                    	<strong>1. </strong>{{ $all_details['top_3_highlights_1'] }} <br>
                    	<strong>2. </strong>{{ $all_details['top_3_highlights_2'] }} <br>
                    	<strong>3. </strong>{{ $all_details['top_3_highlights_3'] }} <br>
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Mention the major task that have been accomplished by Shweta Jaiswal? </strong> 
                    	<br>
                    	<strong>1. </strong>{{ $all_details['major_task_1'] }} <br>
                    	<strong>2. </strong>{{ $all_details['major_task_2'] }} <br>
                    	<strong>3. </strong>{{ $all_details['major_task_3'] }} <br>
                    </td>
                  </tr>


                  <tr>
                    <td>Has Shweta Jaiswal been able to add value in your team?</td>
                    <td>{{$all_details['add_value_in_team']}}</td>
                  </tr>

                  @if($all_details['add_value_in_team']=='Yes')
                  <tr>
                    <td>If Yes, Please share an instance in details.</td>
                    <td>{!! $all_details['add_value_in_team_share_instance'] !!}</td>
                  </tr>
                  @endif

                  <tr>
                    <td colspan="2"><strong>Mention 3 areas of improvement?</strong> 
                    	<br>
                    	<strong>1. </strong>{{ $all_details['areas_of_improvement_1'] }} <br>
                    	<strong>2. </strong>{{ $all_details['areas_of_improvement_2'] }} <br>
                    	<strong>3. </strong>{{ $all_details['areas_of_improvement_3'] }} <br>
                    </td>
                  </tr>

                  <tr>
                    <td>Has Shweta Jaiswal met your expectations in the last 3 months?</td>
                    <td>{{$all_details['met_your_expectations']}}</td>
                  </tr>


                  <tr>
                    <td>Other (please specify)</td>
                    <td>{!! $all_details['met_your_expectations_other_specify'] !!}</td>
                  </tr>


                  <tr>
                    <td>Are you sure to confirm Shweta Jaiswal in the Organization?</td>
                    <td>{{$all_details['are_you_sure_to_confirm']}}</td>
                  </tr>

                  @if($all_details['are_you_sure_to_confirm']=='No, Put under PIP')
                  <tr>
                    <td colspan="2"><strong>If you want to recommend PIP, Pls share a detailed plan. </strong><br> {{ $all_details['recommend_pip_detailed_plan'] }}</td>
                  </tr>
                  @endif

                  <tr>
                    <td>Has Shweta Jaiswal been committed an increment on confirmation, at the time of joining?</td>
                    <td>{{$all_details['increment_on_confirmation']}}</td>
                  </tr>

                  @if($all_details['increment_on_confirmation']=='Yes')
                  <tr>
                    <td>If yes, then mention the amount.</td>
                    <td>{{$all_details['mention_the_amount']}}</td>
                  </tr>
                  @endif

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