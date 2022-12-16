@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Survey Form | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Survey Form</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              
                  
                  	@foreach($survey_form_section_name_details as $survey_form_section_name_detail)
                  		<h5><strong>{{ $survey_form_section_name_detail['section_name'] }}</strong></h5>

						<!-- Bordered Table -->
                	<table class="table table-striped table-bordered">
                
                		<tbody>
							@foreach($survey_form_details as $survey_form_detail)
							
								@if($survey_form_section_name_detail['section_name'] == $survey_form_detail['section_name'])
								<tr>
									<td><strong>Q : </strong>{{ $survey_form_detail['question'] }}</td>
								</tr>

								<tr class="txt_justify">
									<td><!-- <strong>Ans: </strong> -->
										@if($survey_form_detail['question_type']=='rating')
										
											@if($survey_form_detail['answer']!='NA')
						                        @for($i=0; $i < $survey_form_detail['answer']; $i++)
						                            <i class="bi bi-star-fill rate-star-color"></i>
						                        @endfor
						                    @else
						                        NA
						                    @endif

										@else

											{!! $survey_form_detail['answer'] !!}

										@endif
										
									</td>
								</tr>
								@endif

		              		@endforeach
						</tbody>
					</table>
					@endforeach

                	

                
              <!-- End Bordered Table -->

              
            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
@endsection