<html>
	
	<body style="margin:0px; padding:0px; ">
		<center>
			<table  cellpadding="0" cellspacing="0" align="center" width="700" border="0" style="font-family: Calibri, sans-serif; color: #666;">
				<tbody>
					<tr>
						<td bgcolor="#595959" align="center" style="font-family: Calibri, sans-serif;  height: 70px; font-size: 40px; color: #fff; text-transform: uppercase;font-weight: bold;">
							Initiating PIP {{ date('Y') }}
						</td>
					</tr>

					<tr>
						<td style="line-height: 10px;">
							<img src="https://vcim.net/evaluation/assets/mailers/grey_1/Border_1.jpg" alt="img" width="700" height="16" />
						</td>
					</tr>

					<tr>
						<td style="line-height: 10px;">
							<img src="https://vcim.net/evaluation/assets/mailers/grey_1/Emp_Details.jpg" alt="img" width="700" height="64" />
						</td>
					</tr>

					<tr>
						<td align="center"  bgcolor="#fcdc00" style="font-size:18px; color: #131313;line-height: 34px;">
							<table width="640" border="0" cellspacing="0" cellpadding="0" >
								<tbody>
									<tr>
										<td>
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tbody>
													<tr>
														<td  height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															<strong>Name:</strong>
														</td>
														<td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															{{ $user_details['full_name'] }}
														</td>
													</tr>
													<tr>
														<td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															<strong>Designation:</strong>
														</td>
														<td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															{{ $user_details['designation_name'] }} 
														</td>
													</tr>
													<tr>
														<td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															<strong>Department:</strong>
														</td>
														<td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															{{ $user_details['department_name'] }} 
														</td>
													</tr>
												</tbody>
											</table>
										</td>

										

										<td style="border-left: 1px solid #ae9322;padding-left: 44px;padding-right: 25px;">
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tbody>
													<tr>
														<td  height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															<strong>Score Card:</strong>
														</td>
														<td  height="30">
															{{ $score_card }}
														</td>
													</tr>
													<tr>
														<td height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															<strong>Avg. Evaluation Score:</strong>
														</td>
														<td  height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															{{ $avg_score }}
														</td>
													</tr>
													<tr>
														<td   height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															<strong>Appraisal Cycle:</strong>
														</td>
														<td  height="30" style="font-family: Calibri, sans-serif; font-size:15px; color: #131313;">
															{{ $user_details['appraisal_cycle'] }}
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td align="center"   style="border-left: 1px solid #ae9322;">
											<img src="{{ 'http://52.66.206.92'.$user_details['profile_image'] }}" alt="img" width="84" height="87" style="border: solid 4px #f9d94a" />
										</td>
									</tr>

									<tr><td height="20"></td></tr>
								</tbody>
							</table>
						</td>
					</tr>

					<tr>
						<td style="line-height: 10px;" >
							<img src="https://vcim.net/evaluation/assets/mailers/grey_1/Border_2.jpg" alt="img" width="700" height="16" />
						</td>
					</tr>
					<tr><td height="20"></td></tr>


					<tr>
						<td align="center">


							<table width="640" border="0" cellspacing="0" cellpadding="0" >
								<tbody>
									<tr>
										<td bgcolor="#fff" align="left" style="font-family: Calibri, sans-serif; font-size: 20px;color: #10131e;">
											<strong>Dear {{ $user_details['full_name'] }},</strong>
										</td>
									</tr>
									<tr><td height="20"></td></tr>
									<tr>
										<td bgcolor="#fff" align="left" style="font-family: Calibri, sans-serif; font-size: 18px;color: #10131e; text-align: justify; line-height: 22px;">

											Hope you are doing great!

											<br><br>
											
											Based on our discussion, your <strong>Performance Improvement Plan</strong> is being initiated w.e.f. <strong>{{ date('d-M-Y', strtotime($initiating_pip_details['date_initiating_pip'])) }}</strong> for a duration of <strong>{{ $initiating_pip_details['no_of_days'] }} days</strong>. The objective of PIP is to help you improve your performance. Please see the attached plan listing areas of improvement along with actions to be taken to overcome your shortfalls & steps to accomplish the goals to reach the next level. We shall revisit the PIP program & evaluate your improvements & accomplishments on <strong>{{date('D', strtotime($initiating_pip_details['closing_date_pip']))}}, {{ date('d-M-Y', strtotime($initiating_pip_details['closing_date_pip']))}}</strong>. A detailed PIP plan is attached in the email. <span style="background-color: #FBDC12; padding: 0px 10px 0px 10px;">Please go through it & share your acknowledgement on this email.</span>

											<br><br>

											<strong>Note:</strong> In case of no notable development, the duration of PIP shall be considered as the notice served to the organisation. However, we certainly hope that you shall overcome all the challenges & outshine as a performer & contributor in the team.

											<br><br>

											Wishing you all the best! Stay positive, stay active!

											<br><br>
											For further queries & clarifications, please feel free to reach out to me.


										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>

					<!--<tr>
						<td bgcolor="#fff" align="center" >
							<table width="640" border="0" cellspacing="0" cellpadding="0" >
								<tbody>
								<tr>
									<td height="10"></td>
								</tr>
								<tr>
									<td height="10"></td>
								</tr>
								<tr>
									<td height="10"></td>
								</tr>
								</tbody>
							</table>
						</td>
					</tr>

					<tr>
						<td align="center"></td>
					</tr>

					<tr><td height="30"></td></tr>
					<tr>
						<td style="line-height: 0px;">
							<img src="https://vcim.net/evaluation/assets/mailers/grey_1/Border_3.jpg" alt="img" width="700" height="17" />
						</td>
					</tr>
					<tr>
						<td style="line-height: 10px;">
							<img src="https://vcim.net/evaluation/assets/mailers/grey_1/NotefromCEO.jpg" alt="img" width="700" height="60" />
						</td>
					</tr>

					<td bgcolor="#fcdc00" align="center" >

						<table width="640" border="0" cellspacing="0" cellpadding="0" >
							<tbody>
								<tr><td height="10"></td></tr>
								<tr>
									<td  align="left" style="font-family: Calibri, sans-serif; font-size: 18px;color: #10131e; text-align: justify; line-height: 22px;">
										I want to extend my heartiest congratulations to you! Your performance, hard work & dedication has brought us to this decision & I’m sure you will continue to give your best. I hope company expectations & demands of your job role are clear, if not, please consult your manager or me. Keep up the good work!

									</td>
								</tr>
								<tr><td height="30"></td></tr>
							</tbody>
						</table>
					</td>
					<tr>
						<td style="line-height: 10px;">
							<img src="https://vcim.net/evaluation/assets/mailers/grey_1/Border_4.jpg" alt="img" width="700" height="17" />
						</td>
					</tr>
					<tr bgcolor="#595959" align="center">
					
						<td>
							<table width="640" border="0" cellspacing="0" cellpadding="0"  >
								<tbody>
									<tr bgcolor="#595959" align="left">
										<td  height="60" style="font-family: Calibri, sans-serif; font-size: 18px; color: #fff;"></td>
										<td  height="60" style="font-family: Calibri, sans-serif; font-size: 18px; color: #fff;"><img src="https://vcim.net/mailer/appraisal-html/footer-logo.png"/></td>
										<td align="right" style="font-family: Calibri, sans-serif; font-size: 18px; color: #fff;"></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>-->
				</tbody>

			</table>
		</center>
	</body>
</html>