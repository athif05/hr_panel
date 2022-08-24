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
              <h5 class="card-title">MOM Form</h5>
              

              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="" class="row g-3 needs-validation" novalidate>
                @csrf

                <input type="text" name="manager_id" id="manager_id" value="{{ Auth::user()->id }}">
                <input type="text" name="member_id" id="member_id" value="{{ $member_details['id'] }}">
                
                <div class="col-md-6 position-relative">
                  <label for="member_name" class="form-label">1. Member name</label>
                  <input type="text" class="form-control disable-text" name="member_name" id="member_name" value="{{ $member_details['first_name'] }} {{ $member_details['last_name'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">2. Member Designation</label>
                  <input type="email" class="form-control disable-text" name="designation" id="designation" value="{{ $member_details['designation'] }}" readonly>
                </div>

                <div class="col-md-6 position-relative">
                  <label for="official_email" class="form-label">3. Department</label>
                  <input type="email" class="form-control disable-text" name="department" id="department" value="{{ $member_details['department'] }}" readonly>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="confirmation_commitment_details" class="form-label">4. Confirmation commitment details.</label>
                  <textarea class="form-control disable-text" name="confirmation_commitment_details" id="confirmation_commitment_details" style="height: 100px" readonly>{{ $member_details['confirmation_commitment_details'] }}</textarea>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="minutes_of_meeting" class="form-label">5. Minutes of Meeting<br>
                  	<span class="span_green">Please provide your Minutes Of Meeting in bullet points</span>
                  </label>
                  <textarea class="form-control" name="minutes_of_meeting" id="minutes_of_meeting" style="height: 100px" required>{{ old('minutes_of_meeting')}}</textarea>
                  @if ($errors->has('minutes_of_meeting'))
                    <span class="text-danger">{{ $errors->first('minutes_of_meeting') }}</span>
                  @endif
                </div>


                <div class="col-md-12 position-relative">
                  <label for="hidden_notes" class="form-label">N. Hidden notes</label>
                  <textarea class="form-control" name="hidden_notes" id="hidden_notes" style="height: 100px" required>{{ old('hidden_notes')}}</textarea>
                  @if ($errors->has('hidden_notes'))
                    <span class="text-danger">{{ $errors->first('hidden_notes') }}</span>
                  @endif
                </div>

                <div style="clear: both; height: 10px;"></div>

                <div class="col-md-12 position-relative">
                  <label class="form-label"><strong>6. Rate the presentation on the following parameters:</strong></label>
                </div>

                <div class="col-md-12 position-relative">
                  <label for="content" class="form-label">Content:  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="content" id="content" value="1" @if(old('content')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="content" id="content" value="2" @if(old('content')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="content" id="content" value="3" @if(old('content')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="content" id="content" value="4" @if(old('content')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="content" id="content" value="5" @if(old('content')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>

                  @if ($errors->has('content'))
                    <span class="text-danger">{{ $errors->first('content') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="confidence" class="form-label">Confidence <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="confidence" id="confidence" value="1" @if(old('confidence')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="confidence" id="confidence" value="2" @if(old('confidence')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="confidence" id="confidence" value="3" @if(old('confidence')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="confidence" id="confidence" value="4" @if(old('confidence')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="confidence" id="confidence" value="5" @if(old('confidence')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('confidence'))
                    <span class="text-danger">{{ $errors->first('confidence') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="communication" class="form-label">Communication <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="communication" id="communication" value="1" @if(old('communication')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="communication" id="communication" value="2" @if(old('communication')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="communication" id="communication" value="3" @if(old('communication')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="communication" id="communication" value="4" @if(old('communication')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="communication" id="communication" value="5" @if(old('communication')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('communication'))
                    <span class="text-danger">{{ $errors->first('communication') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="data_relevance" class="form-label">Data Relevance <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="1" @if(old('data_relevance')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="2" @if(old('data_relevance')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="3" @if(old('data_relevance')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="4" @if(old('data_relevance')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="data_relevance" id="data_relevance" value="5" @if(old('data_relevance')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('data_relevance'))
                    <span class="text-danger">{{ $errors->first('data_relevance') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="overall_growth_individual" class="form-label">Overall growth of the individual <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

                  <span id="radioBtn">
                      <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="1" @if(old('overall_growth_individual')=='1') checked @endif>
                    <label class="form-check-label" for="gridRadios1">1</label>

                    <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="2" @if(old('overall_growth_individual')=='2') checked @endif>
                    <label class="form-check-label" for="gridRadios1">2</label>

                    <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="3" @if(old('overall_growth_individual')=='3') checked @endif>
                    <label class="form-check-label" for="gridRadios1">3</label>

                    <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="4" @if(old('overall_growth_individual')=='4') checked @endif>
                    <label class="form-check-label" for="gridRadios1">4</label>

                    <input class="form-check-input" type="radio" name="overall_growth_individual" id="overall_growth_individual" value="5" @if(old('overall_growth_individual')=='5') checked @endif>
                    <label class="form-check-label" for="gridRadios1">5</label>
                  </span>
                  @if ($errors->has('overall_growth_individual'))
                    <span class="text-danger">{{ $errors->first('overall_growth_individual') }}</span>
                  @endif

                </div>

                <div class="col-md-12 position-relative">
                  <label for="elaborate_performance" class="form-label" style="font-weight: 400;">Average Rating of the entire presentation 

                  	<span class="avg_rating">3.5</span>
                  </label>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="recommend_increment" class="form-label">7. Would you like to recommend him/her for Increment? </label>
                  <select class="form-select" name="recommend_increment" id="recommend_increment">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Out of Turn">Out of Turn</option>
                  </select>
                </div>


                <div class="col-md-12 position-relative">
                  <label for="how_much_increment" class="form-label">8. How much increment would you recommend? </label>
                  <select class="form-select" name="how_much_increment" id="how_much_increment">
                    <option value="INR">INR</option>
                    <option value="%">%</option>
                  </select>

                  <input type="text" class="form-control" name="how_much_increment_amount" id="how_much_increment_amount" value="{{ old('how_much_increment_amount') }}" style="margin-top: 10px;">
                      
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
                  
  					<tr>
  						<td>Sarbari Dey</td>
  						<td>Yes, on time confirmation</td>
  					</tr>

  					<tr>
  						<td>Pankaj Gupta</td>
  						<td>Yes, on time confirmation</td>
  					</tr>

                  </tbody>
                </table>                      
                </div>



                <div class="col-md-12 position-relative">
                  <label for="are_you_sure_to_confirm" class="form-label">9. Are you sure to confirm his/her in the Organization? <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
                  <select class="form-select" name="are_you_sure_to_confirm" id="are_you_sure_to_confirm" required>
                    <option value="Yes, early confirmation">Yes, early confirmation</option>
                    <option value="Yes, on time confirmation">Yes, on time confirmation</option>
                    <option value="No, Put under PIP">No, Put under PIP</option>
                    <option value="Defer Confirmation without PIP for 30 Days">Defer Confirmation without PIP for 30 Days</option>
                    <option value="Defer Confirmation without PIP for 60 Days">Defer Confirmation without PIP for 60 Days</option>
                  </select>
                  <div class="invalid-tooltip">
                    Please select a valid company.
                  </div>
                  @if ($errors->has('are_you_sure_to_confirm'))
                    <span class="text-danger">{{ $errors->first('are_you_sure_to_confirm') }}</span>
                  @endif
                </div>


                <div class="col-12">
                  <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </div>

              </form>
              <!-- End Custom Styled Validation with Tooltips -->
              <br>
              <p><strong>Note:</strong> <span class="text-danger"><strong>*</strong></span> mandatory fields.</p>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection