@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Annual Review MOM Form Details | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">{{ $survey_form_details['form_name'] }} | Annual Review MOM Form Details</h5>

              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              @if($member_details && $mom_form_details)
              <!-- Bordered Table -->
              <table class="table table-striped table-bordered">
                
                <tbody>
                  <tr>
                    <td>Member name</td>
                    <td>{{ $member_details['full_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Member Designation</td>
                    <td>{{ $member_details['designation_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>{{$member_details['department_name']}}</td>
                  </tr>

                  <tr>
                    <td>Current Salary</td>
                    <td>{{$member_details['current_salary']}} / Month</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Confirmation commitment details </strong><br> {{ $member_details['confirmation_commitment_details'] }}</td>
                  </tr>

                  <tr>
                    <td colspan="2"><strong>Minutes of Meeting </strong> {!! $mom_form_details['minutes_of_meeting'] !!}</td>
                  </tr>

                  @if((Auth::user()->role_id=='5') || (Auth::user()->role_id=='6') || (Auth::user()->role_id=='7'))
                  <tr>
                    <td colspan="2"><strong>Hidden notes </strong> {!! $mom_form_details['hidden_notes'] !!}</td>
                  </tr>
                  @endif


                  <tr>
                    <td colspan="2"><strong>Rate the presentation on the following parameters</strong></td>
                  </tr>

                  <tr>
                    <td>Content</td>
                    <td> 
                      @if($mom_form_details['content']!='NA')
                        @for($i=0; $i < $mom_form_details['content']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Confidence</td>
                    <td>
                      @if($mom_form_details['confidence']!='NA')
                        @for($i=0; $i < $mom_form_details['confidence']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Communication</td>
                    <td>
                      @if($mom_form_details['communication']!='NA')
                        @for($i=0; $i < $mom_form_details['communication']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Data Relevance</td>
                    <td>
                      @if($mom_form_details['data_relevance']!='NA')
                        @for($i=0; $i < $mom_form_details['data_relevance']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td>Overall growth of the individual</td>
                    <td>
                      @if($mom_form_details['overall_growth_individual']!='NA')
                        @for($i=0; $i < $mom_form_details['overall_growth_individual']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  <tr>
                    <td><strong>Average Rating of the entire presentation</strong></td>
                    <td>
                      @if($mom_form_details['average_rating_entire_presentation']!='NA')
                        @for($i=0; $i < $mom_form_details['average_rating_entire_presentation']; $i++)
                        <i class="bi bi-star-fill rate-star-color"></i>
                        @endfor
                      @else
                        NA
                      @endif
                    </td>
                  </tr>

                  
                  <tr>
                    <td>Would you like to recommend {{ $member_details['full_name'] }} for Increment?</td>
                    <td>{{$mom_form_details['recommend_increment']}}</td>
                  </tr>

                  @if($mom_form_details['recommend_increment']=='Yes')
                  <tr>
                    <td>How much increment would you recommend?</td>
                    <td>
                      @if($mom_form_details['how_much_increment']=='INR') 
                        {{$mom_form_details['how_much_increment_amount']}} {{$mom_form_details['how_much_increment']}}
                      @elseif($mom_form_details['how_much_increment']=='%') 
                        {{$mom_form_details['how_much_increment_percentage']}} {{$mom_form_details['how_much_increment']}}
                      @endif
                      
                    </td>
                  </tr>
                  @endif


                  <tr>
                    <td>Would you like to recommend {{ $member_details['full_name'] }} for promotion?</td>
                    <td>{{$mom_form_details['recommend_for_promotion']}}</td>
                  </tr>

                  @if($mom_form_details['recommend_for_promotion']=='Yes')
                  <tr>
                    <td>Designation name for promotion</td>
                    <td>
                      @foreach($designation_names as $designation_name_promotion)
                        @if($designation_name_promotion['id']==$mom_form_details['recommend_for_promotion_id'])
                          {{ $designation_name_promotion['name'] }}
                        @endif
                      @endforeach
                    </td>
                  </tr>
                  @endif

                  <tr>
                    <td>Are you sure to confirm his/her in the Organization?</td>
                    <td>{{$mom_form_details['are_you_sure_to_confirm']}}</td>
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