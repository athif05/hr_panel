<html>
	<style type="text/css">
		.border_bottom{
			border-bottom: 1px solid #ccc;
			padding: 3px;
		}

		.border_bottom_right{
			border-bottom: 1px solid #ccc;
			border-right: 1px solid #ccc;
			padding: 3px;
		}

		.table_border{
			border-left: 1px solid #e6e9ec;
			border-right: 1px solid #e6e9ec;
			background-color: #f9f9f9;
		}
	</style>
	<body style="margin:0px; padding:0px; ">
		<center>
			<table  cellpadding="0" cellspacing="0" align="center" width="700" border="0" style="font-family: Calibri, sans-serif; color: #666;">
				<tbody>

					<tr><td height="20"></td></tr>

					

					<tr><td height="0"></td></tr>

					<tr>
						<td align="center">

							<table class="table_border" style="" cellpadding="0" cellspacing="0">

								<tr>
									<td colspan="2" bgcolor="#595959" align="center" style="font-family: Calibri, sans-serif;  height: 30px; font-size: 18px; color: #fff; text-transform: uppercase;font-weight: bold;">
										Closure PIP {{ date('Y') }}
									</td>
								</tr>
                
				                <tbody>
				                  <tr>
				                    <td class="border_bottom_right">Member Name</td>
				                    <td class="border_bottom">{{ $user_details['full_name']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Member ID</td>
				                    <td class="border_bottom">{{ $user_details['member_id']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Date of Joining</td>
				                    <td class="border_bottom">{{ $user_details['joining_date']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Department</td>
				                    <td class="border_bottom">{{ $user_details['department_name']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Company</td>
				                    <td class="border_bottom">{{ $user_details['company_name']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Location</td>
				                    <td class="border_bottom">{{ $user_details['location']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Reporting Manager</td>
				                    <td class="border_bottom">{{ $user_details['manager_name']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Department Head</td>
				                    <td class="border_bottom">{{ $user_details['hod_name']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Member Status</td>
				                    <td class="border_bottom">{{ $user_details['employee_type']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Duration of PIP to be Implemented</td>
				                    <td class="border_bottom">{{ $initiating_pip_details['no_of_days']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Start Date of PIP</td>
				                    <td class="border_bottom">{{ $initiating_pip_details['date_initiating_pip']}}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">End Date of PIP</td>
				                    <td class="border_bottom">{{ $initiating_pip_details['closing_date_pip']}}</td>
				                  </tr>

				                  <tr class="txt_justify">
				                    <td colspan="2" class="border_bottom"><strong>Description of the Issue </strong> {!! $initiating_pip_details['issue_description_performance_behaviour'] !!}</td>
				                  </tr>

				                  <tr class="txt_justify">
				                    <td colspan="2" class="border_bottom"><strong>Description of Expected Performance </strong> {!! $initiating_pip_details['description_expected_performance'] !!}</td>
				                  </tr>

				                  <tr class="txt_justify">
				                    <td colspan="2" class="border_bottom"><strong>Plan of action to improve the performance </strong> {!! $initiating_pip_details['plan_of_action_to_improve'] !!}</td>
				                  </tr>

				                  <tr class="txt_justify">
				                    <td colspan="2" class="border_bottom"><strong>Final PIP Review </strong> {!! $initiating_pip_details['final_pip_review'] !!}</td>
				                  </tr>

				                  <tr>
				                    <td class="border_bottom_right">Have you seen considerable improvemnet in the performance, during the PIP period?</td>
				                    <td class="border_bottom">{{ $initiating_pip_details['seen_considerable_improvemnet_performance'] }}</td>
				                  </tr>

				                </tbody>
				              </table>
						</td>
					</tr>

					<tr><td height="20"></td></tr>

				</tbody>

			</table>
		</center>
	</body>
</html>