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
                    <td>Member name</td>
                    <td>{{ $user_details['full_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Member Designation</td>
                    <td>{{ $user_details['designation_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>{{$user_details['department_name']}}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Confirmation commitment details. </strong> {{ $user_details['confirmation_commitment_details'] }}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Minutes of Meeting : </strong> {!! $all_details['minutes_of_meeting'] !!}</td>
                  </tr>

                  @if((Auth::user()->role_id=='5') || (Auth::user()->role_id=='6') || (Auth::user()->role_id=='7'))
                  <tr>
                    <td colspan="2"><strong>Hidden notes : </strong> {!! $all_details['hidden_notes'] !!}</td>
                  </tr>
                  @endif


                  <tr>
                    <td colspan="2"><strong>Rate the presentation on the following parameters:</strong></td>
                  </tr>

                  <tr>
                    <td>Content</td>
                    <td>{{$all_details['content']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Confidence</td>
                    <td>{{$all_details['confidence']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Communication</td>
                    <td>{{$all_details['communication']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Data Relevance</td>
                    <td>{{$all_details['data_relevance']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td>Overall growth of the individual</td>
                    <td>{{$all_details['overall_growth_individual']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  <tr>
                    <td><strong>Average Rating of the entire presentation</strong></td>
                    <td>{{$all_details['average_rating_entire_presentation']}} <i class="bi bi-star-fill rate-star-color"></i></td>
                  </tr>

                  
                  <tr>
                    <td>Would you like to recommend him/her for Increment?</td>
                    <td>{{$all_details['recommend_increment']}}</td>
                  </tr>

                  @if($all_details['recommend_increment']=='Yes')
                  <tr>
                    <td>How much increment would you recommend?</td>
                    <td>{{$all_details['how_much_increment_amount']}} {{$all_details['how_much_increment']}}</td>
                  </tr>
                  @endif


                  <tr>
                    <td colspan="2">
                    	<div class="col-md-12 position-relative">
		                  <table class="table table-bordered" style="width:100%;  line-height: 15px;">
			                  <thead>
			                    <tr style="background-color: bisque;">
			                      <th scope="col">Name</th>
			                      <th scope="col">Answer</th>
			                    </tr>
			                  </thead>
			                  <tbody>
			                  
			                    @foreach($manager_details as $manager_detail)
			                    <tr style="background-color: #fff;">
			                      <td>{{$manager_detail->f_name}} {{$manager_detail->l_name}}</td>
			                      <td>{{$manager_detail->are_you_sure_to_confirm}}</td>
			                    </tr>
			                    @endforeach

			                  </tbody>
		                	</table>                      
		                </div>
                    </td>
                  </tr>

                  


                  <tr>
                    <td>Are you sure to confirm his/her in the Organization?</td>
                    <td>{{$all_details['are_you_sure_to_confirm']}}</td>
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