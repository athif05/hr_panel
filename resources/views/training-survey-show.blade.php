@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Training Survey | {{ env('MY_SITE_NAME') }}</title>

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
              <h5 class="card-title">Training Survey Details</h5>
              
              @if(session()->has('thank_you'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('thank_you') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              
              <!-- Bordered Table -->
              <table class="table table-striped table-bordered">
                
                <tbody>
                  
                  <tr>
                    <td>Your Name</td>
                    <td>{{ $training_survey_details['member_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Member ID</td>
                    <td>{{ $training_survey_details['member_id'] }}</td>
                  </tr>

                  <tr>
                    <td>Designation</td>
                    <td>
                    	@foreach($designation_details as $designation_detail)

                    		@if($designation_detail['id']==$training_survey_details['designation'])
                    		{{ $designation_detail['name'] }}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Department</td>
                    <td>
                    	@foreach($department_details as $department_detail)

                    		@if($department_detail['id']==$training_survey_details['department'])
                    		{{ $department_detail['name'] }}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Email</td>
                    <td>{{ $training_survey_details['email'] }}</td>
                  </tr>

                  <tr>
                   <td>Please choose the name of your company.</td>
                    <td>
                    	@foreach($company_names as $company_name)

                    		@if($company_name['id']==$training_survey_details['company_name'])
                    		{{ $company_name['name'] }}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  <tr>
                    <td>Please choose your work-location.</td>
                    <td>
                    	@foreach($company_locations as $company_location)

                    		@if($company_location['id']==$training_survey_details['location_name'])
                    		{{ $company_location['name'] }}
                    		@endif
                    	
                    	@endforeach
                    </td>
                  </tr>

                  

                  <tr>
                    <td colspan="2"><strong>Please list down the name of your trainers who took your on-job training.</strong></td>
                  </tr>



                  @if($training_survey_details['trainer_1_name'])
                  <tr>
                    <td><strong>Trainer 1 Name</strong></td>
                    <td>{{ $training_survey_details['trainer_1_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Expertise on the subject-matter</td>
                    <td>{{ $training_survey_details['expertise_on_subject_matter_1'] }} 
                    	@if($training_survey_details['expertise_on_subject_matter_1']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif
                    </td>
                  </tr>

                  <tr>
                    <td>Clear and effective communication skills</td>
                    <td>{{ $training_survey_details['clear_effective_communication_skills_1'] }} @if($training_survey_details['clear_effective_communication_skills_1']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Effective delivery of content</td>
                    <td>{{ $training_survey_details['effective_delivery_content_1'] }} @if($training_survey_details['effective_delivery_content_1']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Timely response to your queries</td>
                    <td>{{ $training_survey_details['timely_response_queries_1'] }} @if($training_survey_details['timely_response_queries_1']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Comfortability in sharing your concerns & doubts</td>
                    <td>{{ $training_survey_details['comfortability_sharing_concerns_doubts_1'] }} @if($training_survey_details['comfortability_sharing_concerns_doubts_1']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional comments for {{ $training_survey_details['trainer_1_name'] }}</strong> : {!! $training_survey_details['additional_feedback_trainer_1'] !!}</td>
                  </tr>
                  @endif

                  @if($training_survey_details['trainer_2_name'])
                  <tr>
                    <td><strong>Trainer 2 Name</strong></td>
                    <td>{{ $training_survey_details['trainer_2_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Expertise on the subject-matter</td>
                    <td>{{ $training_survey_details['expertise_on_subject_matter_2'] }} @if($training_survey_details['expertise_on_subject_matter_2']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Clear and effective communication skills</td>
                    <td>{{ $training_survey_details['clear_effective_communication_skills_2'] }} @if($training_survey_details['clear_effective_communication_skills_2']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Effective delivery of content</td>
                    <td>{{ $training_survey_details['effective_delivery_content_2'] }} @if($training_survey_details['effective_delivery_content_2']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Timely response to your queries</td>
                    <td>{{ $training_survey_details['timely_response_queries_2'] }} @if($training_survey_details['timely_response_queries_2']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Comfortability in sharing your concerns & doubts</td>
                    <td>{{ $training_survey_details['comfortability_sharing_concerns_doubts_2'] }} @if($training_survey_details['comfortability_sharing_concerns_doubts_2']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional comments for {{ $training_survey_details['trainer_2_name'] }}</strong> : {!! $training_survey_details['additional_feedback_trainer_2'] !!}</td>
                  </tr>
                  @endif

                  @if($training_survey_details['trainer_3_name'])
                  <tr>
                    <td><strong>Trainer 3 Name</strong></td>
                    <td>{{ $training_survey_details['trainer_3_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Expertise on the subject-matter</td>
                    <td>{{ $training_survey_details['expertise_on_subject_matter_3'] }} @if($training_survey_details['expertise_on_subject_matter_3']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Clear and effective communication skills</td>
                    <td>{{ $training_survey_details['clear_effective_communication_skills_3'] }} @if($training_survey_details['clear_effective_communication_skills_3']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Effective delivery of content</td>
                    <td>{{ $training_survey_details['effective_delivery_content_3'] }} @if($training_survey_details['effective_delivery_content_3']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Timely response to your queries</td>
                    <td>{{ $training_survey_details['timely_response_queries_3'] }} @if($training_survey_details['timely_response_queries_3']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Comfortability in sharing your concerns & doubts</td>
                    <td>{{ $training_survey_details['comfortability_sharing_concerns_doubts_3'] }} @if($training_survey_details['comfortability_sharing_concerns_doubts_3']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional comments for {{ $training_survey_details['trainer_3_name'] }}</strong> : {!! $training_survey_details['additional_feedback_trainer_3'] !!}</td>
                  </tr>
                  @endif

                  @if($training_survey_details['trainer_4_name'])
                  <tr>
                    <td><strong>Trainer 4 Name</strong></td>
                    <td>{{ $training_survey_details['trainer_4_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Expertise on the subject-matter</td>
                    <td>{{ $training_survey_details['expertise_on_subject_matter_4'] }} @if($training_survey_details['expertise_on_subject_matter_4']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Clear and effective communication skills</td>
                    <td>{{ $training_survey_details['clear_effective_communication_skills_4'] }} @if($training_survey_details['clear_effective_communication_skills_4']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Effective delivery of content</td>
                    <td>{{ $training_survey_details['effective_delivery_content_4'] }} @if($training_survey_details['effective_delivery_content_4']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Timely response to your queries</td>
                    <td>{{ $training_survey_details['timely_response_queries_4'] }} @if($training_survey_details['timely_response_queries_4']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Comfortability in sharing your concerns & doubts</td>
                    <td>{{ $training_survey_details['comfortability_sharing_concerns_doubts_4'] }} @if($training_survey_details['comfortability_sharing_concerns_doubts_4']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional comments for {{ $training_survey_details['trainer_4_name'] }}</strong> : {!! $training_survey_details['additional_feedback_trainer_4'] !!}</td>
                  </tr>
                  @endif

                  @if($training_survey_details['trainer_5_name'])
                  <tr>
                    <td><strong>Trainer 5 Name</strong></td>
                    <td>{{ $training_survey_details['trainer_5_name'] }}</td>
                  </tr>

                  <tr>
                    <td>Expertise on the subject-matter</td>
                    <td>{{ $training_survey_details['expertise_on_subject_matter_5'] }} @if($training_survey_details['expertise_on_subject_matter_5']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Clear and effective communication skills</td>
                    <td>{{ $training_survey_details['clear_effective_communication_skills_5'] }} @if($training_survey_details['clear_effective_communication_skills_5']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Effective delivery of content</td>
                    <td>{{ $training_survey_details['effective_delivery_content_5'] }} @if($training_survey_details['effective_delivery_content_5']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Timely response to your queries</td>
                    <td>{{ $training_survey_details['timely_response_queries_5'] }} @if($training_survey_details['timely_response_queries_5']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr>
                    <td>Comfortability in sharing your concerns & doubts</td>
                    <td>{{ $training_survey_details['comfortability_sharing_concerns_doubts_5'] }} @if($training_survey_details['comfortability_sharing_concerns_doubts_5']!='NA')
                    	<i class="bi bi-star-fill rate-star-color"></i>
                    	@endif</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any additional comments for {{ $training_survey_details['trainer_5_name'] }}</strong> : {!! $training_survey_details['additional_feedback_trainer_5'] !!}</td>
                  </tr>
                  @endif

                 

                  <tr>
                    <td colspan="2"><strong>Please share your experience with the following</strong></td>
                  </tr>

                  <tr>
                    <td>Training plan was shared with me within the first week of joining</td>
                    <td>{{ $training_survey_details['training_first_week_joining'] }} @if($training_survey_details['training_first_week_joining']!='NA')
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endif</td></td>
                  </tr>

                  <tr>
                    <td>The training sessions went as planned</td>
                    <td>{{ $training_survey_details['training_sessions_went_as_planned'] }} @if($training_survey_details['training_sessions_went_as_planned']!='NA')
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endif</td></td>
                  </tr>

                  <tr>
                    <td>Training topics were covered in detail</td>
                    <td>{{ $training_survey_details['training_topics_were_covered_in_detail'] }} @if($training_survey_details['training_topics_were_covered_in_detail']!='NA')
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endif</td></td>
                  </tr>

                  <tr>
                    <td>Training was effective & is helping me do my job well</td>
                    <td>{{ $training_survey_details['training_was_effective_helping'] }} @if($training_survey_details['training_was_effective_helping']!='NA')
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endif</td>
                  </tr>

                  <tr>
                    <td>I have clearly understood all the modules</td>
                    <td>{{ $training_survey_details['clearly_understood_all_modules'] }} @if($training_survey_details['clearly_understood_all_modules']!='NA')
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endif</td>
                  </tr>

                  <tr>
                    <td>Self-study material has been very useful for me</td>
                    <td>{{ $training_survey_details['self_study_material_useful'] }} @if($training_survey_details['self_study_material_useful']!='NA')
                      <i class="bi bi-star-fill rate-star-color"></i>
                      @endif</td>
                  </tr>

                  
                  <tr class="txt_justify">
                    <td colspan="2"><strong>Is there any topic that you still need training on?</strong> : {!! $training_survey_details['is_there_any_topic'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Which part of the training was the most interesting? Please elaborate.</strong> : {!! $training_survey_details['interesting_part_elaborate'] !!}</td>
                  </tr>

                  <tr class="txt_justify">
                    <td colspan="2"><strong>Any suggestion/feedback you would like to give in helping us to improve our training sessions?</strong> : {!! $training_survey_details['any_suggestions_feedback'] !!}</td>
                  </tr>

                </tbody>
              </table>
              <!-- End Bordered Table -->

              
            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
@endsection