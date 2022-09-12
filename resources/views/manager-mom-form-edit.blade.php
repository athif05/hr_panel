@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Edit MOM Form | {{ env('MY_SITE_NAME') }}</title>

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

              @if($member_details && $mom_form_details)

              <h5 class="card-title">MOM Form</h5>


              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('update-manager-mom') }}" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="hidden" name="edit_id" id="edit_id" value="{{ $mom_form_details->id }}">
                <input type="hidden" name="manager_id" id="manager_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $member_details['id'] }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">1. Member name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $member_details['first_name'] }} {{ $member_details['last_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">2. Member Designation</label>
                  <input type="email" class="form-control disable-text" name="designation" id="designation" value="{{ $member_details['designation_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">3. Department</label>
                  <input type="email" class="form-control disable-text" name="department" id="department" value="{{ $member_details['department_name'] }}" readonly>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="confirmation_commitment_details" class="form-label">4. Confirmation commitment details.</label>
                  <textarea class="form-control disable-text" name="confirmation_commitment_details" id="confirmation_commitment_details" style="height: 100px" readonly>{{ $member_details['confirmation_commitment_details'] }}</textarea>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="minutes_of_meeting" class="form-label">5. Minutes of Meeting<br>
                    <span class="span_green">Please provide your Minutes Of Meeting in bullet points</span>
                  </label>
                  <textarea class="form-control" name="minutes_of_meeting" id="minutes_of_meeting" style="height: 100px" required>{{ old('minutes_of_meeting',$mom_form_details->minutes_of_meeting) }}</textarea>
                  @if ($errors->has('minutes_of_meeting'))
                    <span class="text-danger">{{ $errors->first('minutes_of_meeting') }}</span>
                  @endif

                  <script>
                    CKEDITOR.replace( 'minutes_of_meeting' );
                  </script>

                </div>

                @if((Auth::user()->role_id=='5') || (Auth::user()->role_id=='6') || (Auth::user()->role_id=='7'))
                <div class="col-md-12 position-relative">
                  <label for="hidden_notes" class="form-label">N. Hidden notes</label>
                  <textarea class="form-control" name="hidden_notes" id="hidden_notes" style="height: 100px" required>{{ old('hidden_notes',$mom_form_details->hidden_notes) }}</textarea>
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
                  <label class="form-label">6. Rate the presentation on the following parameters:</label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="content" class="form-label rdioBtn">Content:  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="content" id="content" value="1" onclick="agv_rat_fun()" @if(old('content',$mom_form_details->content)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="content" id="content" value="2" onclick="agv_rat_fun()" @if(old('content',$mom_form_details->content)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="content" id="content" value="3" onclick="agv_rat_fun()" @if(old('content',$mom_form_details->content)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="content" id="content" value="4" onclick="agv_rat_fun()"@if(old('content',$mom_form_details->content)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="content" id="content" value="5" onclick="agv_rat_fun()" @if(old('content',$mom_form_details->content)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('content'))
                    <span class="text-danger">{{ $errors->first('content') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="confidence" class="form-label rdioBtn">Confidence <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="confidence" id="confidence" value="1" onclick="agv_rat_fun()" @if(old('confidence',$mom_form_details->confidence)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="confidence" id="confidence" value="2" onclick="agv_rat_fun()" @if(old('confidence',$mom_form_details->confidence)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="confidence" id="confidence" value="3" onclick="agv_rat_fun()" @if(old('confidence',$mom_form_details->confidence)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="confidence" id="confidence" value="4" onclick="agv_rat_fun()" @if(old('confidence',$mom_form_details->confidence)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="confidence" id="confidence" value="5" onclick="agv_rat_fun()" @if(old('confidence',$mom_form_details->confidence)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('confidence'))
                    <span class="text-danger">{{ $errors->first('confidence') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="communication" class="form-label rdioBtn">Communication <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="communication" id="communication" value="1" onclick="agv_rat_fun()" @if(old('communication',$mom_form_details->communication)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="communication" id="communication" value="2" onclick="agv_rat_fun()" @if(old('communication',$mom_form_details->communication)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="communication" id="communication" value="3" onclick="agv_rat_fun()" @if(old('communication',$mom_form_details->communication)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="communication" id="communication" value="4" onclick="agv_rat_fun()" @if(old('communication',$mom_form_details->communication)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="communication" id="communication" value="5" onclick="agv_rat_fun()" @if(old('communication',$mom_form_details->communication)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('communication'))
                    <span class="text-danger">{{ $errors->first('communication') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="data_relevance" class="form-label rdioBtn">Data Relevance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="1" onclick="agv_rat_fun()" @if(old('data_relevance',$mom_form_details->data_relevance)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="2" onclick="agv_rat_fun()" @if(old('data_relevance',$mom_form_details->data_relevance)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="3" onclick="agv_rat_fun()" @if(old('data_relevance',$mom_form_details->data_relevance)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="4" onclick="agv_rat_fun()" @if(old('data_relevance',$mom_form_details->data_relevance)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="5" onclick="agv_rat_fun()" @if(old('data_relevance',$mom_form_details->data_relevance)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('data_relevance'))
                    <span class="text-danger">{{ $errors->first('data_relevance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="overall_growth_individual" class="form-label rdioBtn">Overall growth of the individual <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="1" onclick="agv_rat_fun()" @if(old('overall_growth_individual',$mom_form_details->overall_growth_individual)=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="2" onclick="agv_rat_fun()" @if(old('overall_growth_individual',$mom_form_details->overall_growth_individual)=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="3" onclick="agv_rat_fun()" @if(old('overall_growth_individual',$mom_form_details->overall_growth_individual)=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="4" onclick="agv_rat_fun()" @if(old('overall_growth_individual',$mom_form_details->overall_growth_individual)=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="5" onclick="agv_rat_fun()" @if(old('overall_growth_individual',$mom_form_details->overall_growth_individual)=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('overall_growth_individual'))
                    <span class="text-danger">{{ $errors->first('overall_growth_individual') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="elaborate_performance" class="form-label" style="font-weight: 400;">Average Rating of the entire presentation 
                    <input type="hidden" name="average_rating_entire_presentation" id="average_rating_entire_presentation" value="{{ old('average_rating_entire_presentation',$mom_form_details->average_rating_entire_presentation) }}">
                    <span class="avg_rating" id="avg_rating_span">{{ old('average_rating_entire_presentation',$mom_form_details->average_rating_entire_presentation) }}</span>
                  </label>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="recommend_increment" class="form-label">7. Would you like to recommend him/her for Increment?</label>
                  <select class="form-select" name="recommend_increment" id="recommend_increment" onchange="recommend_increment_fun(this.value)">
                    <option value="Yes" @if(old('recommend_increment',$mom_form_details->recommend_increment)=="Yes") selected @endif>Yes</option>
                    <option value="No" @if(old('recommend_increment',$mom_form_details->recommend_increment)=="No") selected @endif>No</option>
                    <option value="Out of Turn" @if(old('recommend_increment',$mom_form_details->recommend_increment)=="Out of Turn") selected @endif>Out of Turn</option>
                  </select>
                </div>

                
                <div class="col-md-12 position-relative">
                  <label for="how_much_increment" class="form-label">8. How much increment would you recommend? </label>
                  <select class="form-select @if($mom_form_details->recommend_increment=='No')disable-text @endif" name="how_much_increment" id="how_much_increment" @if($mom_form_details->recommend_increment=='No') disabled @endif>
                    <option value="INR" @if(old('how_much_increment',$mom_form_details->how_much_increment)=='INR') selected @endif>INR</option>
                    <option value="%" @if(old('how_much_increment',$mom_form_details->how_much_increment)=='%') selected @endif>%</option>
                  </select>

                  <input type="text" class="form-control @if($mom_form_details->recommend_increment=='No')disable-text @endif" name="how_much_increment_amount" id="how_much_increment_amount" value="{{ old('how_much_increment_amount',$mom_form_details->how_much_increment_amount) }}" style="margin-top: 10px;" @if($mom_form_details->recommend_increment=='No') readonly @endif>
                  @if ($errors->has('how_much_increment_amount'))
                    <span class="text-danger">{{ $errors->first('how_much_increment_amount') }}</span>
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
                  <label for="are_you_sure_to_confirm" class="form-label">9. Are you sure to confirm his/her in the Organization? {{$mom_form_details->are_you_sure_to_confirm}}<span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="are_you_sure_to_confirm" id="are_you_sure_to_confirm" required>

                    <option value="Yes, early confirmation" @if(old('are_you_sure_to_confirm',$mom_form_details->are_you_sure_to_confirm)=='Yes, early confirmation') selected @endif>Yes, early confirmation</option>

                    <option value="Yes, on time confirmation" @if(old('are_you_sure_to_confirm',$mom_form_details->are_you_sure_to_confirm)=='Yes, on time confirmation') selected @endif>Yes, on time confirmation</option>

                    <option value="No, Put under PIP" @if(old('are_you_sure_to_confirm',$mom_form_details->are_you_sure_to_confirm)=='No, Put under PIP') selected @endif>No, Put under PIP</option>

                    <option value="Defer Confirmation without PIP for 30 Days" @if(old('are_you_sure_to_confirm',$mom_form_details->are_you_sure_to_confirm)=='Defer Confirmation without PIP for 30 Days') selected @endif>Defer Confirmation without PIP for 30 Days</option>

                    <option value="Defer Confirmation without PIP for 60 Days" @if(old('are_you_sure_to_confirm',$mom_form_details->are_you_sure_to_confirm)=='Defer Confirmation without PIP for 60 Days') selected @endif>Defer Confirmation without PIP for 60 Days</option>

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