@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Stakeholder Feedback Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Stakeholder Feedback Form Details</h5>

              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              @if($manager_details && $stackholder_feedback_details)
              <!-- Bordered Table -->
              <table class="table table-striped table-bordered">
                
                <tbody>

                  <tr>
                    <td colspan="2"><strong>Manager Details</strong></td>
                  </tr>

                  <tr>
                    <td>Your Name</td>
                    <td>{{ $manager_details['full_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Your Member Code</td>
                    <td>{{ $manager_details['member_id'] }}</td>
                  </tr>

                  <tr>
                    <td>Company</td>
                    <td>{{$manager_details['company_name']}}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>{{ $manager_details['designation_name'] }}</td>
                  </tr>

                  <tr>
                   <td>Department</td>
                    <td>{{ $manager_details['department_name'] }} </td>
                  </tr>

                  <tr>
                   <td>Email</td>
                    <td>{{ $manager_details['email'] }} </td>
                  </tr>

                  <tr>
                   <td>Location</td>
                    <td>{{ $manager_details['location_name'] }} </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Member Details</strong></td>
                  </tr>

                  <tr>
                    <td>Member Name</td>
                    <td>{{ $member_details['full_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Member Code</td>
                    <td>{{ $member_details['member_id'] }}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>{{$member_details['designation_name']}}</td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>{{ $member_details['department_name'] }}</td>
                  </tr>

                  <tr>
                   <td>Email</td>
                    <td>{{ $member_details['email'] }} </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Rate {{ $member_details['full_name'] }} on the following parameters</strong></td>
                  </tr>

                  <tr>
                    <td>Quality of the work</td>
                    <td>
                      @if($stackholder_feedback_details->quality_of_the_work!='NA')
                        @for($i=0; $i < $stackholder_feedback_details->quality_of_the_work; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>TAT Adherence</td>
                    <td>
                      @if($stackholder_feedback_details->tat_adherence!='NA')
                        @for($i=0; $i < $stackholder_feedback_details->tat_adherence; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Ability to understand project requirements</td>
                    <td>
                      @if($stackholder_feedback_details->ability_to_understand_project_requirements!='NA')
                        @for($i=0; $i < $stackholder_feedback_details->ability_to_understand_project_requirements; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Ability to absorb feedback</td>
                    <td>
                      @if($stackholder_feedback_details->ability_to_absorb_feedback!='NA')
                        @for($i=0; $i < $stackholder_feedback_details->ability_to_absorb_feedback; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Responsiveness on all platforms</td>
                    <td>
                      @if($stackholder_feedback_details->responsiveness_on_all_platforms!='NA')
                        @for($i=0; $i < $stackholder_feedback_details->responsiveness_on_all_platforms; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>How happy are you with {{ $member_details['full_name'] }}'s performance?</td>
                    <td>
                      @if($stackholder_feedback_details->how_happy_you_with_performance!='NA')
                        @for($i=0; $i < $stackholder_feedback_details->how_happy_you_with_performance; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Share three qualities of {{ $member_details['full_name'] }}  </strong> 
                    	<br>
                    	<strong>1. </strong>{{ $stackholder_feedback_details['three_qualities_1'] }} <br>
                    	<strong>2. </strong>{{ $stackholder_feedback_details['three_qualities_2'] }} <br>
                    	<strong>3. </strong>{{ $stackholder_feedback_details['three_qualities_3'] }} <br>
                    </td>
                  </tr>


                  <tr>
                    <td colspan="2"><strong>Share three areas of improvement for {{ $member_details['full_name'] }}  </strong> 
                    	<br>
                    	<strong>1. </strong>{{ $stackholder_feedback_details['three_areas_of_improvement_1'] }} <br>
                    	<strong>2. </strong>{{ $stackholder_feedback_details['three_areas_of_improvement_2'] }} <br>
                    	<strong>3. </strong>{{ $stackholder_feedback_details['three_areas_of_improvement_3'] }} <br>
                    </td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Any additional feedback that you would like to share about {{ $member_details['full_name'] }}?</strong> {!! $stackholder_feedback_details->any_additional_feedback !!}</td>
                  </tr>


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