@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Add Company Name | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              	<h5 class="card-title">MOM Feedbacks</h5>
                

                @if($confirmation_mom_details)

                <div class="col-lg-12" style="border:1px solid #e6abab;">
                  
                  <div class="col-lg-12 backgrndBlue" style="height: 20px;">&nbsp;</div>

                  <div style="clear: both;"></div>

                  <div class="col-lg-12 padding10_0 fontSize14">
                    <div class="div50 text-center">
                      <strong> Name of Member </strong><br>
                      {{ $user_dtl['first_name'] }} {{ $user_dtl['last_name'] }}
                    </div>
                    <div class="div50 text-center">
                      <strong> Date of Review Meeting </strong><br>
                      2023-Oct-23
                    </div>
                  </div>

                  <div style="clear: both;"></div>

                  <div class="col-lg-12 fontSize14" style="background-color: antiquewhite;">
                    
                    <div class="col-lg-12 text-center line_height30 fontSize15">
                      <strong>MINUTES OF MEETING</strong>
                    </div>
                    <?php $avg_score=0; $counter=0;?>
                    @foreach($confirmation_mom_details as $confirmation_mom_detail)
                    <div class="col-md-12" style="margin:auto; width:98%; border:1px solid bisque;">
                      <div class="line_height35 fontSize14" style="float: left; width: 100%; background-color: bisque; ">
                        &nbsp; <strong>Feedbacks by {{ $confirmation_mom_detail['f_name'] }} {{ $confirmation_mom_detail['l_name'] }}</strong>
                        <span style="float: right; text-align: right;">
                          <i class="bi-person-circle"></i>
                        &nbsp;</span>
                      </div>

                      <div class="col-lg-12">
                        
                        <div class="col-lg-12 text-center">
                          <div class="div20 backgrndWhite">
                            <i class="bi bi-file-text"></i><br>
                            Content
                          </div>
                          <div class="div20 backgrndWhite">
                            <i class="bi bi-hand-thumbs-up"></i><br>
                            Confidence
                          </div>
                          <div class="div20 backgrndWhite">
                            <i class="bi bi-chat-text"></i><br>
                            Communication 
                          </div>
                          <div class="div20 backgrndWhite">
                            <i class="bi bi-file-earmark-diff"></i><br>
                            Data Relevance
                          </div>
                          <div class="div20 backgrndWhite">
                            <i class="bi bi-graph-up-arrow"></i><br>
                            Overall growth
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        
                        <div class="col-lg-12 text-center line_height25">
                          <div class="div20 ratingbackgrnd">
                            {{ $confirmation_mom_detail['content'] }}
                          </div>
                          <div class="div20 ratingbackgrnd">
                            {{ $confirmation_mom_detail['confidence'] }}
                          </div>
                          <div class="div20 ratingbackgrnd">
                           {{ $confirmation_mom_detail['communication'] }} 
                          </div>
                          <div class="div20 ratingbackgrnd">
                            {{ $confirmation_mom_detail['data_relevance'] }}
                          </div>
                          <div class="div20 ratingbackgrnd">
                            {{ $confirmation_mom_detail['overall_growth_individual'] }}
                          </div>
                        </div>
                      </div>
                      <?php $avg_score=($avg_score+$confirmation_mom_detail['average_rating_entire_presentation']);
                      $counter++;
                      ?>
                      <div class="col-lg-12 backgrndWhite padding10">
                        <div style="clear: both; height: 15px;"></div>
                        {!! $confirmation_mom_detail['minutes_of_meeting'] !!}

                      </div>

                    </div>
                    
                    <div class="clearBoth10"></div>
                    @endforeach
                      
                      <?php if($avg_score>0) { $avg_score=$avg_score/$counter; }?>

                      <div class="clearBoth15"></div>

                      <div class="col-lg-12 text-center">

                        <div class="clearBoth15"></div>

                        <div class="avgBackGrd line_height30 fontSize15" style="margin:auto; width: 200px; position: absolute; margin-top: -15px; margin-left: 37%;">
                          <strong>Score Card : {{ $avg_score }}</strong>
                        </div>
                      </div>



                      <div class="col-lg-12 text-justify backgrndWhite fontSize14 padding10">
                        <div class="clearBoth15"></div>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                      </div>

                      <div class="col-lg-12 backgrndBlue text-center line_height30 fontColorWhite">
                        For detailed view of your review, please visit <a href="" class="fontColorWhite">Collection Link</a>
                      </div>

                  </div>

                </div>
              
                @else 
                <h5 class="card-title">No MOM Feedbacks data.</h5>
                @endif
              
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection