<!doctype html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
	</head>

	<body style="margin:auto; padding:0px; width: 800px; font-family: 'Open Sans';">
		<center>
			<div style="float:left; width:100%; border:1px solid #e6abab;">
                  
                  <div style="float:left; width:100%; height: 20px; background-color: #6565c6;">&nbsp;</div>

                  <div style="clear: both;"></div>

                  <div style="float:left; width:100%; padding: 10px 0px 10px 0px; font-size: 14px;">
                    <div style="float:left; width:50%; text-align: center;">
                      <strong> Name of Member </strong><br>
                      {{ $user_dtl['first_name'] }} {{ $user_dtl['last_name'] }}
                    </div>
                    <div style="float:left; width:50%; text-align: center;">
                      <strong> Date of Review Meeting </strong><br>
                      {{ date('Y-m-d',strtotime($review_meeting_date['submitted_date'])) }}
                    </div>
                  </div>

                  <div style="clear: both;"></div>

                  <div style="float:left; width:100%; background-color: antiquewhite; font-size: 14px;">
                    
                    <div style="float:left; width:100%; text-align: center; line-height: 30px; font-size: 15px;">
                      <strong>MINUTES OF MEETING</strong>
                    </div>
                    <?php $avg_score=0; $counter=0;?>
                    
                    @foreach($confirmation_mom_details as $confirmation_mom_detail)
                    <div style="margin:auto; width:98%; border:1px solid bisque;">
                      <div style="float: left; width: 100%; background-color: bisque; line-height: 35px; font-size: 14px; text-align: left;">
                        &nbsp; <strong>Feedbacks by {{ $confirmation_mom_detail['f_name'] }} {{ $confirmation_mom_detail['l_name'] }}</strong>
                        <span style="float: right; text-align: right;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
							  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
							  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
							</svg>
                        &nbsp;</span>

                      </div>

                      <div style="float: left; width: 100%;">
                        
                        <div style="float: left; width: 100%; text-align: center;">
                          <div style="float: left; width: 20%; background-color: #fff;padding: 5px 0px 2px 0px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
							  <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
							  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
							</svg><br>
                            Content
                          </div>
                          <div style="float: left; width: 20%; background-color: #fff;padding: 5px 0px 2px 0px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
							  <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
							</svg><br>
                            Confidence
                          </div>
                          <div style="float: left; width: 20%; background-color: #fff;padding: 5px 0px 2px 0px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16">
							  <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/>
							</svg><br>
                            Communication 
                          </div>
                          <div style="float: left; width: 20%; background-color: #fff;padding: 5px 0px 2px 0px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-diff" viewBox="0 0 16 16">
							  <path d="M8 5a.5.5 0 0 1 .5.5V7H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V8H6a.5.5 0 0 1 0-1h1.5V5.5A.5.5 0 0 1 8 5zm-2.5 6.5A.5.5 0 0 1 6 11h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
							  <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
							</svg><br>
                            Data Relevance
                          </div>
                          <div style="float: left; width: 20%; background-color: #fff;padding: 5px 0px 2px 0px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
							  <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
							</svg><br>
                            Overall growth
                          </div>
                        </div>
                      </div>

                      <div style="float: left; width: 100%;">
                        
                        <div style="float: left; width: 100%; text-align: center; line-height: 25px;">
                          <div style="float: left; width: 20%; background-color: #fcdada;">
                            {{ $confirmation_mom_detail['content'] }}
                          </div>
                          <div style="float: left; width: 20%; background-color: #fcdada;">
                            {{ $confirmation_mom_detail['confidence'] }}
                          </div>
                          <div style="float: left; width: 20%; background-color: #fcdada;">
                           {{ $confirmation_mom_detail['communication'] }}
                          </div>
                          <div style="float: left; width: 20%; background-color: #fcdada;">
                            {{ $confirmation_mom_detail['data_relevance'] }}
                          </div>
                          <div style="float: left; width: 20%; background-color: #fcdada;">
                            {{ $confirmation_mom_detail['overall_growth_individual'] }}
                          </div>
                        </div>
                      </div>
                      <?php $avg_score=($avg_score+$confirmation_mom_detail['average_rating_entire_presentation']);
                      $counter++;
                      ?>
                      <div style="float: left; width: 100%; background-color: #fff; text-align: left;">
                        <div style="clear: both; height: 10px;"></div>
                        <div style="margin:auto; width: 97%;">
                        	{!! $confirmation_mom_detail['minutes_of_meeting'] !!}
                        </div>
                        <div style="clear: both; height: 10px;"></div>
                      </div>

                    </div>
                    @endforeach
                    
                    <div style="clear: both; height: 10px;"></div>
                    
                      
                      <?php if($avg_score>0) { $avg_score=$avg_score/$counter; }?>

                      <div style="clear: both; height: 15px;"></div>

                      <div style="float: left; width: 100%; text-align: center;">

                        <div style="clear: both; height: 15px;"></div>

                        <div style="margin:auto; width: 200px; position: absolute; margin-top: -15px; margin-left: 24%; line-height: 30px; font-size: 15px; background-color: #deb887;">
                          <strong>Score Card : {{ $avg_score }}</strong>
                        </div>
                      </div>



                      <div style="float: left; width: 100%; text-align: center; background-color: #fff; font-size: 14px;">
                        <div style="clear: both; height: 20px;"></div>
                        <div style="margin:auto; width: 97%;">
                        	Looking forward to seeing you rise & shine in vCommission! Let's work towards becoming better versions of ourselves with every passing day. Feel free to share the status of the targets in Annual Review.
	                        <br>
	                        All the best for the year!
                        </div>
                        <div style="clear: both; height: 15px;"></div>
                      </div>

                      <div style="float: left; width: 100%; background-color: #6565c6!important; text-align: center; line-height: 30px; color: #fff;">
                        For detailed view of your review, please visit <a href="" class="fontColorWhite">Collection Link</a>
                      </div>

                  </div>

                </div>
		</center>
	</body>
</html>