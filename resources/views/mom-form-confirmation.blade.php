@extends('confirmation-process.layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>MOM Form | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<div class="survey_sec">
  <div class="survey_container">
    <div class="imployee_data">
      
        @include('confirmation-process.partials.sidebar')

        <div class="right_sec survey_tab">
            <div class="top_heading">
                <h2>MOM Form <img src="{{ str_replace('public/', '', asset('resources/views/confirmation-process/img/emp-icon.png')) }}" alt="icon" /></h2>
            </div>
            <div class="imployee_detail mCustomScrollbar">
            <ul>
  
              @if(count($confirmation_mom_details)>0)

              <h2>Q. 1 - Member name</h2>
              <li>
              <div class="col-left">{{ $user_details['full_name'] }}</div>
              </li>

              <h2>Q. 2 - Member Designation</h2>
              <li>
              <div class="col-left">{{ $user_details['designation_name'] }}</div>
              </li>

              <h2>Q. 3 - Department</h2>
              <li>
              <div class="col-left">{{ $user_details['department_name'] }}</div>
              </li>

              <h2>Q. 4 - Current Salary</h2>
              <li>
              <div class="col-left">{{ $user_details['current_salary'] }}</div>
              </li>

              <h2>Q. 5 - Confirmation commitment details</h2>
              <li>
              <div class="col-left">{{ $user_details['confirmation_commitment_details'] }}</div>
              </li>


              @foreach($confirmation_mom_details as $confirmation_mom_detail)

                <h2 style="margin-bottom: -20px;"><strong>MOM by {{ $confirmation_mom_detail['manager_full_name'] }}</strong></h2>

                <h2>Q. Minutes of Meeting</h2>
                <li>
                <div class="col-left">{!! $confirmation_mom_detail['minutes_of_meeting'] !!}</div>
                </li>

                @if(($confirmation_mom_detail['role_id']=='5') || ($confirmation_mom_detail['role_id']=='6') || ($confirmation_mom_detail['role_id']=='7'))
                  <h2>Q. Hidden Notes</h2>
                  <li>
                  <div class="col-left">{!! $confirmation_mom_detail['hidden_notes'] !!}</div>
                  </li>
                @endif


                <h2>Q. Rate the presentation on the following parameters</h2>  
                <li>
                  <div class="col-left">Content
                    @if($confirmation_mom_detail['content']!='NA')
                      @for($i=0; $i < $confirmation_mom_detail['content']; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>

                  <li>
                  <div class="col-left">Confidence
                    @if($confirmation_mom_detail['confidence']!='NA')
                      @for($i=0; $i < $confirmation_mom_detail['confidence']; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>

                  <li>
                  <div class="col-left">Communication
                    @if($confirmation_mom_detail['communication']!='NA')
                      @for($i=0; $i < $confirmation_mom_detail['communication']; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>

                  <li>
                  <div class="col-left">Data Relevance
                    @if($confirmation_mom_detail['data_relevance']!='NA')
                      @for($i=0; $i < $confirmation_mom_detail['data_relevance']; $i++)
                        <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                      @endfor
                    @else 
                      <span class="float_right_div"> NA</span>
                    @endif
                  </div>
                  </li>

                  <li>
                    <div class="col-left">Overall growth of the individual
                      @if($confirmation_mom_detail['overall_growth_individual']!='NA')
                        @for($i=0; $i < $confirmation_mom_detail['overall_growth_individual']; $i++)
                          <span class="float_right_div"> <i class="fa fa-star rating_star"></i></span>
                        @endfor
                      @else 
                        <span class="float_right_div"> NA</span>
                      @endif
                    </div>
                  </li>

                  <li>
                    <div class="col-left"><strong>Average Rating of the entire presentation</strong>
                      
                      <span class="float_right_div"><strong>{{ $confirmation_mom_detail['average_rating_entire_presentation'] }}</strong></span>
                        
                    </div>
                  </li>

                  <h2>Q. Would you like to recommend {{ $user_details['full_name'] }} for Increment?</h2>
                  <li>
                    <div class="col-left text-justify">{{ $confirmation_mom_detail['recommend_increment'] }}</div>
                  </li>

                  @if($confirmation_mom_detail['recommend_increment']!='No')
                    <h2>Q. How much increment would you recommend?</h2>
                    <li>
                      <div class="col-left text-justify">
                        @if($confirmation_mom_detail['how_much_increment']=='INR')
                          {{ $confirmation_mom_detail['how_much_increment_amount'] }} {{ $confirmation_mom_detail['how_much_increment'] }}
                        @elseif($confirmation_mom_detail['how_much_increment']=='%')
                          {{ $confirmation_mom_detail['how_much_increment_percentage'] }} {{ $confirmation_mom_detail['how_much_increment'] }}
                        @endif
                      </div>
                    </li>
                  @endif


                  <h2>Q. Would you like to recommend {{ $user_details['full_name'] }} for promotion?</h2>
                  <li>
                    <div class="col-left text-justify">{{ $confirmation_mom_detail['recommend_for_promotion'] }}</div>
                  </li>

                  @if($confirmation_mom_detail['recommend_for_promotion']=='Yes')
                    <h2>Q. If Yes, Select Designation</h2>
                    <li>
                      <div class="col-left text-justify">
                        {{ $confirmation_mom_detail['designation_name_recommend'] }}
                      </div>
                    </li>
                  @endif


                  <h2>Q. Are you sure to confirm {{ $user_details['full_name'] }} in the Organization?</h2>
                  <li>
                    <div class="col-left">
                      <span class="">{{ $confirmation_mom_detail['are_you_sure_to_confirm'] }}</span>  
                    </div>
                  </li>


              @endforeach

              


              
                               

              @else 

              <h2>No record found...</h2>

              @endif

            </ul>
          </div>
            
            
            
            <div class="btn-group">
                <a href="{{ url('/stakeholder-feedback/'.$employee_id) }}" class="btn btn-default">previous</a>
                <!-- <a href="{{ url('/mom-form/'.$employee_id) }}" class="btn btn-default btn-active">next</a> -->
           </div>
            
            
        </div>
      
           
    </div>
  </div>
</div>
@endsection