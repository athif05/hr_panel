<?php $j=1;?>
@foreach($trainer_details as $trainer_detail)
          
            <input type="hidden" name="trainer_{{$j}}_name" id='trainer_{{$j}}_name' value="{{ $trainer_detail->first_name}} {{ $trainer_detail->last_name}}">
            <input type="hidden" name="trainer_{{$j}}_id" id='trainer_{{$j}}_id' value="{{ $trainer_detail->id}}">
            <div style="clear: both; height: 10px;"></div>
            <div class="col-md-12 position-relative" style="margin-bottom: -5px;">
              <label class="form-label"><strong>Please rate {{ $trainer_detail->first_name}} {{ $trainer_detail->last_name}} on the following parameters</strong></label>
            </div>

            <div class="col-md-12 position-relative">
              <label for="expertise_on_subject_matter_{{$j}}" class="form-label rdioBtn">Expertise on the subject-matter  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

              <span id="radioBtn">
                <input class="form-check-input" type="radio" name="expertise_on_subject_matter_{{$j}}" id="expertise_on_subject_matter_{{$j}}" value="NA" @if(old('expertise_on_subject_matter_{{$j}}')=='NA') checked @elseif(old('expertise_on_subject_matter_{{$j}}')=='') checked @endif>
                <label class="form-check-label" for="gridRadios1">NA</label>

                <input class="form-check-input" type="radio" name="expertise_on_subject_matter_{{$j}}" id="expertise_on_subject_matter_{{$j}}" value="1" @if(old('expertise_on_subject_matter_{{$j}}')=='1') checked @endif>
                <label class="form-check-label" for="gridRadios1">1</label>

                <input class="form-check-input" type="radio" name="expertise_on_subject_matter_{{$j}}" id="expertise_on_subject_matter_{{$j}}" value="2" @if(old('expertise_on_subject_matter_{{$j}}')=='2') checked @endif>
                <label class="form-check-label" for="gridRadios1">2</label>

                <input class="form-check-input" type="radio" name="expertise_on_subject_matter_{{$j}}" id="expertise_on_subject_matter_{{$j}}" value="3" @if(old('expertise_on_subject_matter_{{$j}}')=='3') checked @endif>
                <label class="form-check-label" for="gridRadios1">3</label>

                <input class="form-check-input" type="radio" name="expertise_on_subject_matter_{{$j}}" id="expertise_on_subject_matter_{{$j}}" value="4" @if(old('expertise_on_subject_matter_{{$j}}')=='4') checked @endif>
                <label class="form-check-label" for="gridRadios1">4</label>

                <input class="form-check-input" type="radio" name="expertise_on_subject_matter_{{$j}}" id="expertise_on_subject_matter_{{$j}}" value="5" @if(old('expertise_on_subject_matter_{{$j}}')=='5') checked @endif>
                <label class="form-check-label" for="gridRadios1">5</label>
              </span>

              @if ($errors->has('expertise_on_subject_matter_$j'))
                <span class="text-danger">{{ $errors->first('expertise_on_subject_matter_$j') }}</span>
              @endif

            </div>

            <div class="col-md-12 position-relative">
              <label for="clear_effective_communication_skills_{{ $j }}" class="form-label rdioBtn">Clear and effective communication skills <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

              <span id="radioBtn">
                <input class="form-check-input" type="radio" name="clear_effective_communication_skills_{{$j}}" id="clear_effective_communication_skills_{{$j}}" value="NA" @if(old('clear_effective_communication_skills_{{$j}}')=='NA') checked @elseif(old('clear_effective_communication_skills_{{$j}}')=='') checked @endif>
                <label class="form-check-label" for="gridRadios1">NA</label>

                <input class="form-check-input" type="radio" name="clear_effective_communication_skills_{{ $j }}" id="clear_effective_communication_skills_{{ $j }}" value="1" @if(old('clear_effective_communication_skills_{{ $j }}')=='1') checked @endif>
                <label class="form-check-label" for="gridRadios1">1</label>

                <input class="form-check-input" type="radio" name="clear_effective_communication_skills_{{ $j }}" id="clear_effective_communication_skills_{{ $j }}" value="2" @if(old('clear_effective_communication_skills_{{ $j }}')=='2') checked @endif>
                <label class="form-check-label" for="gridRadios1">2</label>

                <input class="form-check-input" type="radio" name="clear_effective_communication_skills_{{ $j }}" id="clear_effective_communication_skills_{{ $j }}" value="3" @if(old('clear_effective_communication_skills_{{ $j }}')=='3') checked @endif>
                <label class="form-check-label" for="gridRadios1">3</label>

                <input class="form-check-input" type="radio" name="clear_effective_communication_skills_{{ $j }}" id="clear_effective_communication_skills_{{ $j }}" value="4" @if(old('clear_effective_communication_skills_{{ $j }}')=='4') checked @endif>
                <label class="form-check-label" for="gridRadios1">4</label>

                <input class="form-check-input" type="radio" name="clear_effective_communication_skills_{{ $j }}" id="clear_effective_communication_skills_{{ $j }}" value="5" @if(old('clear_effective_communication_skills_{{ $j }}')=='5') checked @endif>
                <label class="form-check-label" for="gridRadios1">5</label>
              </span>
              @if ($errors->has('clear_effective_communication_skills_$j'))
                <span class="text-danger">{{ $errors->first('clear_effective_communication_skills_$j') }}</span>
              @endif

            </div>

            <div class="col-md-12 position-relative">
              <label for="effective_delivery_content_{{ $j }}" class="form-label rdioBtn">Effective delivery of content <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

              <span id="radioBtn">
                <input class="form-check-input" type="radio" name="effective_delivery_content_{{$j}}" id="effective_delivery_content_{{$j}}" value="NA" @if(old('effective_delivery_content_{{$j}}')=='NA') checked @elseif(old('effective_delivery_content_{{$j}}')=='') checked @endif>
                <label class="form-check-label" for="gridRadios1">NA</label>

                <input class="form-check-input" type="radio" name="effective_delivery_content_{{ $j }}" id="effective_delivery_content_{{ $j }}" value="1" @if(old('effective_delivery_content_{{ $j }}')=='1') checked @endif>
                <label class="form-check-label" for="gridRadios1">1</label>

                <input class="form-check-input" type="radio" name="effective_delivery_content_{{ $j }}" id="effective_delivery_content_{{ $j }}" value="2" @if(old('effective_delivery_content_{{ $j }}')=='2') checked @endif>
                <label class="form-check-label" for="gridRadios1">2</label>

                <input class="form-check-input" type="radio" name="effective_delivery_content_{{ $j }}" id="effective_delivery_content_{{ $j }}" value="3" @if(old('effective_delivery_content_{{ $j }}')=='3') checked @endif>
                <label class="form-check-label" for="gridRadios1">3</label>

                <input class="form-check-input" type="radio" name="effective_delivery_content_{{ $j }}" id="effective_delivery_content_{{ $j }}" value="4" @if(old('effective_delivery_content_{{ $j }}')=='4') checked @endif>
                <label class="form-check-label" for="gridRadios1">4</label>

                <input class="form-check-input" type="radio" name="effective_delivery_content_{{ $j }}" id="effective_delivery_content_{{ $j }}" value="5" @if(old('effective_delivery_content_{{ $j }}')=='5') checked @endif>
                <label class="form-check-label" for="gridRadios1">5</label>
              </span>
              @if ($errors->has('effective_delivery_content_$j'))
                <span class="text-danger">{{ $errors->first('effective_delivery_content_$j') }}</span>
              @endif

            </div>

            <div class="col-md-12 position-relative">
              <label for="timely_response_queries_{{ $j }}" class="form-label rdioBtn">Timely response to your queries <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

              <span id="radioBtn">
                <input class="form-check-input" type="radio" name="timely_response_queries_{{$j}}" id="timely_response_queries_{{$j}}" value="NA" @if(old('timely_response_queries_{{$j}}')=='NA') checked @elseif(old('timely_response_queries_{{$j}}')=='') checked @endif>
                <label class="form-check-label" for="gridRadios1">NA</label>

                <input class="form-check-input" type="radio" name="timely_response_queries_{{ $j }}" id="timely_response_queries_{{ $j }}" value="1" @if(old('timely_response_queries_{{ $j }}')=='1') checked @endif>
                <label class="form-check-label" for="gridRadios1">1</label>

                <input class="form-check-input" type="radio" name="timely_response_queries_{{ $j }}" id="timely_response_queries_{{ $j }}" value="2" @if(old('timely_response_queries_{{ $j }}')=='2') checked @endif>
                <label class="form-check-label" for="gridRadios1">2</label>

                <input class="form-check-input" type="radio" name="timely_response_queries_{{ $j }}" id="timely_response_queries_{{ $j }}" value="3" @if(old('timely_response_queries_{{ $j }}')=='3') checked @endif>
                <label class="form-check-label" for="gridRadios1">3</label>

                <input class="form-check-input" type="radio" name="timely_response_queries_{{ $j }}" id="timely_response_queries_{{ $j }}" value="4" @if(old('timely_response_queries_{{ $j }}')=='4') checked @endif>
                <label class="form-check-label" for="gridRadios1">4</label>

                <input class="form-check-input" type="radio" name="timely_response_queries_{{ $j }}" id="timely_response_queries_{{ $j }}" value="5" @if(old('timely_response_queries_{{ $j }}')=='5') checked @endif>
                <label class="form-check-label" for="gridRadios1">5</label>
              </span>
              @if ($errors->has('timely_response_queries_$j'))
                <span class="text-danger">{{ $errors->first('timely_response_queries_$j') }}</span>
              @endif

            </div>

            <div class="col-md-12 position-relative">
              <label for="comfortability_sharing_concerns_doubts_{{ $j }}" class="form-label rdioBtn">Comfortability in sharing your concerns & doubts <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>

              <span id="radioBtn">
                <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_{{$j}}" id="comfortability_sharing_concerns_doubts_{{$j}}" value="NA" @if(old('comfortability_sharing_concerns_doubts_{{$j}}')=='NA') checked @elseif(old('comfortability_sharing_concerns_doubts_{{$j}}')=='') checked @endif>
                <label class="form-check-label" for="gridRadios1">NA</label>

                <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_{{ $j }}" id="comfortability_sharing_concerns_doubts_{{ $j }}" value="1" @if(old('comfortability_sharing_concerns_doubts_{{ $j }}')=='1') checked @endif>
                <label class="form-check-label" for="gridRadios1">1</label>

                <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_{{ $j }}" id="comfortability_sharing_concerns_doubts_{{ $j }}" value="2" @if(old('comfortability_sharing_concerns_doubts_{{ $j }}')=='2') checked @endif>
                <label class="form-check-label" for="gridRadios1">2</label>

                <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_{{ $j }}" id="comfortability_sharing_concerns_doubts_{{ $j }}" value="3" @if(old('comfortability_sharing_concerns_doubts_{{ $j }}')=='3') checked @endif>
                <label class="form-check-label" for="gridRadios1">3</label>

                <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_{{ $j }}" id="comfortability_sharing_concerns_doubts_{{ $j }}" value="4" @if(old('comfortability_sharing_concerns_doubts_{{ $j }}')=='4') checked @endif>
                <label class="form-check-label" for="gridRadios1">4</label>

                <input class="form-check-input" type="radio" name="comfortability_sharing_concerns_doubts_{{ $j }}" id="comfortability_sharing_concerns_doubts_{{ $j }}" value="5" @if(old('comfortability_sharing_concerns_doubts_{{ $j }}')=='5') checked @endif>
                <label class="form-check-label" for="gridRadios1">5</label>
              </span>
              @if ($errors->has('comfortability_sharing_concerns_doubts_$j"'))
                <span class="text-danger">{{ $errors->first('comfortability_sharing_concerns_doubts_$j"') }}</span>
              @endif

            </div>

            <div class="col-md-12 position-relative">
              <label for="additional_feedback_trainer_{{ $j }}" class="form-label">Any additional comments for {{ $trainer_detail->first_name}} {{ $trainer_detail->last_name}} <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label>
              <textarea class="form-control" name="additional_feedback_trainer_{{ $j }}" id="additional_feedback_trainer_{{ $j }}" style="height: 100px">{{ old('additional_feedback_trainer_$j')}}</textarea>
              <div class="invalid-feedback">
                Any additional comments.
              </div>
              @if ($errors->has('additional_feedback_trainer_$j'))
                <span class="text-danger">{{ $errors->first('additional_feedback_trainer_$j') }}</span>
              @endif

              <script>
                    CKEDITOR.replace( "additional_feedback_trainer_{{$j}}" );
                  </script>
            </div>


  <?php $j++; ?>
@endforeach
