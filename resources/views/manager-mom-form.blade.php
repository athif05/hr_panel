@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>MOM Form | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
    	.form-check-input[type=radio] {
		  margin-left: 30px;
		  border-radius: 50%;
		}

    .text-danger{
      font-size: 13px!important;
    }

    .disable-text{
      background-color: #ddd!important;
    }

    .form-label {
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .rdioBtn{
      font-weight: 400!important;
      font-size: 15px;
    }

    .form-label .span_green{
    	font-weight: 400;
	    background: green;
	    color: white;
	    font-size: 12px;
	    padding: 1px 5px 2px 5px;
    }

    .avg_rating{
    	background-color: yellow; font-size: 16px; padding: 4px 8px 4px 8px; margin-left: 70px;
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

              @if($member_details)

              <h5 class="card-title">MOM Form</h5>


              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-manager-mom') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="manager_id" id="manager_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $member_details['id'] }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">Member name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $member_details['first_name'] }} {{ $member_details['last_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">Member Designation</label>
                  <input type="email" class="form-control disable-text" name="designation" id="designation" value="{{ $member_details['designation_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">Department</label>
                  <input type="email" class="form-control disable-text" name="department" id="department" value="{{ $member_details['department_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">Current Salary</label>
                  <input type="text" class="form-control disable-text" name="current_salary" id="current_salary" value="{{ $member_details['current_salary'] }}" readonly>
                  <input type="hidden" name="salary_percentage_automate" id="salary_percentage_automate" value="{{ $member_details['current_salary'] }}" readonly>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="confirmation_commitment_details" class="form-label">Confirmation commitment details</label>
                  <textarea class="form-control disable-text" name="confirmation_commitment_details" id="confirmation_commitment_details" style="height: 100px" readonly>{{ $member_details['confirmation_commitment_details'] }}</textarea>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="minutes_of_meeting" class="form-label">Minutes of Meeting<br>
                  	<span class="span_green">Please provide your Minutes Of Meeting in bullet points</span>
                  </label>
                  <textarea class="form-control" name="minutes_of_meeting" id="minutes_of_meeting" style="height: 100px">{{ old('minutes_of_meeting')}}</textarea>
                  @if ($errors->has('minutes_of_meeting'))
                    <span class="text-danger">{{ $errors->first('minutes_of_meeting') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'minutes_of_meeting' );
                  </script>

                </div>

                @if((Auth::user()->role_id=='5') || (Auth::user()->role_id=='6') || (Auth::user()->role_id=='7'))
                <div class="col-md-12 position-relative">
                  <label for="hidden_notes" class="form-label">Hidden notes</label>
                  <textarea class="form-control" name="hidden_notes" id="hidden_notes" style="height: 100px">{{ old('hidden_notes')}}</textarea>
                  @if ($errors->has('hidden_notes'))
                    <span class="text-danger">{{ $errors->first('hidden_notes') }}</span>
                  @endif
                  <script>
                    CKEDITOR.replace( 'hidden_notes' );
                  </script>
                </div>
                @endif

                <div style="clear: both; height: 10px;"></div>

                <div class="col-md-12 position-relative">
                  <label class="card-title">Rate the presentation on the following parameters</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="content" class="form-label rdioBtn">Content  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="content" id="content" value="NA" @if(old('content')=='NA') checked @elseif(old('content')=='') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="content" id="content" value="1" @if(old('content')=='1') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="content" id="content" value="2" @if(old('content')=='2') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="content" id="content" value="3" @if(old('content')=='3') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="content" id="content" value="4" @if(old('content')=='4') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="content" id="content" value="5" @if(old('content')=='5') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>

                  @if ($errors->has('content'))
                    <span class="text-danger">{{ $errors->first('content') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="confidence" class="form-label rdioBtn">Confidence <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="confidence" id="confidence" value="NA" @if(old('confidence')=='NA') checked @elseif(old('confidence')=='') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="confidence" id="confidence" value="1" @if(old('confidence')=='1') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="confidence" id="confidence" value="2" @if(old('confidence')=='2') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="confidence" id="confidence" value="3" @if(old('confidence')=='3') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="confidence" id="confidence" value="4" @if(old('confidence')=='4') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="confidence" id="confidence" value="5" @if(old('confidence')=='5') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
                  @if ($errors->has('confidence'))
                    <span class="text-danger">{{ $errors->first('confidence') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="communication" class="form-label rdioBtn">Communication <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="communication" id="communication" value="NA" @if(old('communication')=='NA') checked @elseif(old('communication')=='') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="communication" id="communication" value="1" @if(old('communication')=='1') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="communication" id="communication" value="2" @if(old('communication')=='2') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="communication" id="communication" value="3" @if(old('communication')=='3') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="communication" id="communication" value="4" @if(old('communication')=='4') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="communication" id="communication" value="5" @if(old('communication')=='5') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
                  @if ($errors->has('communication'))
                    <span class="text-danger">{{ $errors->first('communication') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="data_relevance" class="form-label rdioBtn">Data Relevance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="data_relevance" id="data_relevance" value="NA" @if(old('data_relevance')=='NA') checked @elseif(old('data_relevance')=='') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="data_relevance" id="data_relevance" value="1" @if(old('data_relevance')=='1') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="data_relevance" id="data_relevance" value="2" @if(old('data_relevance')=='2') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="data_relevance" id="data_relevance" value="3" @if(old('data_relevance')=='3') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="data_relevance" id="data_relevance" value="4" @if(old('data_relevance')=='4') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="data_relevance" id="data_relevance" value="5" @if(old('data_relevance')=='5') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
                  @if ($errors->has('data_relevance'))
                    <span class="text-danger">{{ $errors->first('data_relevance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="overall_growth_individual" class="form-label rdioBtn">Overall growth of the individual <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="overall_growth_individual" id="overall_growth_individual" value="NA" @if(old('overall_growth_individual')=='NA') checked @elseif(old('overall_growth_individual')=='') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="overall_growth_individual" id="overall_growth_individual" value="1" @if(old('overall_growth_individual')=='1') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="overall_growth_individual" id="overall_growth_individual" value="2" @if(old('overall_growth_individual')=='2') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="overall_growth_individual" id="overall_growth_individual" value="3" @if(old('overall_growth_individual')=='3') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="overall_growth_individual" id="overall_growth_individual" value="4" @if(old('overall_growth_individual')=='4') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="overall_growth_individual" id="overall_growth_individual" value="5" @if(old('overall_growth_individual')=='5') checked @endif onclick="agv_rat_fun()">
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
                  @if ($errors->has('overall_growth_individual'))
                    <span class="text-danger">{{ $errors->first('overall_growth_individual') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="elaborate_performance" class="form-label" style="font-weight: 400;">Average Rating of the entire presentation 
                    <input type="hidden" name="average_rating_entire_presentation" id="average_rating_entire_presentation" value="{{ old('average_rating_entire_presentation','0') }}">
                  	<span class="avg_rating" id="avg_rating_span">{{ old('average_rating_entire_presentation','0') }}</span>
                  </label>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="recommend_increment" class="form-label">Would you like to recommend {{ $member_details['first_name'] }} {{ $member_details['last_name'] }} for Increment? </label>
                  <select class="form-select" name="recommend_increment" id="recommend_increment" onchange="recommend_increment_fun(this.value)">
                    <option value="Yes" @if(old('recommend_increment')=='Yes') selected @endif>Yes</option>
                    <option value="No" @if(old('recommend_increment')=='No') checked @endif>No</option>
                    <option value="Out of Turn" @if(old('recommend_increment')=='Out of Turn') checked @endif>Out of Turn</option>
                  </select>
                </div>


                <div class="col-md-12 position-relative" id="recommend_increment_div" @if((old('recommend_increment')!="No") || (old('recommend_increment')=='')) style="display: block;"  @else style="display: none;" @endif>
                  <label for="how_much_increment" class="form-label">How much increment would you recommend? </label>
                  <select class="form-select" name="how_much_increment" id="how_much_increment">
                    <option value="INR" @if(old('recommend_increment')=='INR') selected @endif>INR</option>
                    <option value="%" @if(old('recommend_increment')=='%') selected @endif>%</option>
                  </select>

                  <input type="text" class="form-control" name="how_much_increment_amount" id="how_much_increment_amount" value="{{ old('how_much_increment_amount','0') }}" style="margin-top: 10px;">
                  @if ($errors->has('how_much_increment_amount'))
                    <span class="text-danger">{{ $errors->first('how_much_increment_amount') }}</span>
                  @endif
                      
                </div>


                <div class="col-md-12 position-relative">
                  <label for="recommend_for_promotion" class="form-label">Would you like to recommend {{ $member_details['first_name'] }} {{ $member_details['last_name'] }} for promotion? </label>
                  <select class="form-select" name="recommend_for_promotion" id="recommend_for_promotion">
                    <option value="Yes" @if(old('recommend_for_promotion')=='Yes') selected @endif>Yes</option>
                    <option value="No" @if(old('recommend_for_promotion')=='No') checked @endif>No</option>
                  </select>
                </div>

                <div class="col-md-12 position-relative" id="recommend_for_promotion_id_div">
                  <label for="how_much_increment" class="form-label">If Yes, Select Designation </label>
                  <select class="form-select" name="recommend_for_promotion_id" id="recommend_for_promotion_id">
                    <option value="">-- Select Designation --</option>
                    @foreach($designation_names as $designation_name)
                    <option value="{{ $designation_name['id'] }}" @if(old('recommend_for_promotion_id')==$designation_name['id']) selected @endif>
                      {{ $designation_name['name'] }}
                    </option>
                    @endforeach
                  </select>

                  
                  @if ($errors->has('recommend_for_promotion_id'))
                    <span class="text-danger">{{ $errors->first('recommend_for_promotion_id') }}</span>
                  @endif
                      
                </div>


                <div class="col-md-12 position-relative">
                  <table class="table table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Answer</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($manager_details as $manager_detail)
          					<tr>
          						<td>{{$manager_detail->f_name}} {{$manager_detail->l_name}}</td>
          						<td>{{$manager_detail->are_you_sure_to_confirm}}</td>
          					</tr>
                    @endforeach
          					
                  </tbody>
                </table>                      
                </div>



                <div class="col-md-12 position-relative">
                  <label for="are_you_sure_to_confirm" class="form-label">Are you sure to confirm {{ $member_details['first_name'] }} {{ $member_details['last_name'] }} in the Organization? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="are_you_sure_to_confirm" id="are_you_sure_to_confirm">

                    <option value="Yes" @if(old('are_you_sure_to_confirm')=='Yes') selected @endif>Yes</option>

                    <option value="No" @if(old('are_you_sure_to_confirm')=='No') selected @endif>No</option>

                    <option value="No, Put under PIP" @if(old('are_you_sure_to_confirm')=='No, Put under PIP') selected @endif>No, Put under PIP</option>

                  </select>
                  @if ($errors->has('are_you_sure_to_confirm'))
                    <span class="text-danger">{{ $errors->first('are_you_sure_to_confirm') }}</span>
                  @endif
                </div>


                <div class="col-12">
                  <input type="submit" name="submit" value="Save in Draft" class="btn btn-info">

                  <input type="submit" name="submit" value="Publish" class="btn btn-primary">
                </div>

              </form>
              <!-- End Custom Styled Validation with Tooltips -->
              <br>
              <div style="float: left; width: 100%;">
                <div style="float: left; width: 70%;">
              		@include('partials.common-note')
              	</div>
                <div style="float: left; width: 30%;">
                  <a href="{{ url('/manager-mom') }}">
                    <button name="cancel" class="btn btn-info" style="float: right; text-align: right;">Cancel/Back</button>
                  </a>
                </div>
              </div>

              @else
              <h4 class="card-title">Member does not exist...</h4>
              @endif

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection