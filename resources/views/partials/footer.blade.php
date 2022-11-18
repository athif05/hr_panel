

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
      </script>

  <script type="text/javascript">

		jQuery(document).ready(function(){

		/* addmore road fy questions, start here */
		$(".road_fy_add").click(function(){

	        // Finding total number of elements added
	        var total_element = $(".road_fy_element").length;
	                    
	        // last <div> with element class id
	        var lastid = $(".road_fy_element:last").attr("id");
	        var split_id = lastid.split("_");
	        var nextindex = Number(split_id[1]) + 1;

	        var max = 5;
	        // Check total number elements
	        if(total_element < max ){
	            // Adding new div container after last occurance of element class
	            $(".road_fy_element:last").after("<div class='road_fy_element' id='roadFyDiv_"+ nextindex +"'></div>");
	                        
	            // Adding element to <div>
	            /*$("#div_" + nextindex).append("<input type='text' placeholder='Enter your skill' id='txt_"+ nextindex +"'>&nbsp;<span id='remove_" + nextindex + "' class='remove'>X</span>");*/
	            $("#roadFyDiv_" + nextindex).append("<div style='float: left; width: 100%; margin-top:5px;'><div style='float: left; width: 45%;'><input type='text' placeholder='Question' name='question_title[]' id='txt_1' value='' class='form-control' style='width: 98%;'></div><div style='float: left; width: 24%;'><select class='form-select' name='question_type[]' id='txt_2' style='width: 98%;'><option value='textbox'>Text Box</option><option value='textarea'>Text Area</option><option value='radiobutton'>Radio Button</option><option value='checkbox'>Check Box</option><option value='dropdown'>Drop Down</option></select></div><div style='float: left; width: 25%;'><input type='text' name='question_value[]' id='txt_3' value='' class='form-control' style='width: 98%;'></div><div style='float: left; width: 6%; font-size: 18px; color:red; cursor: pointer; text-align: center;line-height: 46px;'><span id='roadFyRemove_" + nextindex + "' class='roadFyRemove'>X</span></div></div>");
	                    
	        }
	                    
	    });


	    // Remove element
	    $('.container').on('click','.roadFyRemove',function(){
	                
	        var id = this.id;
	        var split_id = id.split("_");
	        var deleteindex = split_id[1];

	        // Remove <div> with id
	        $("#roadFyDiv_" + deleteindex).remove();
	    }); 
		/* add more education div, end here */

		/* addmore road fy questions, end here */


		/* add more education div, start here */
		// Add new element
    $(".add").click(function(){

        // Finding total number of elements added
        var total_element = $(".element").length;
                    
        // last <div> with element class id
        var lastid = $(".element:last").attr("id");
        var split_id = lastid.split("_");
        var nextindex = Number(split_id[1]) + 1;

        var max = 5;
        // Check total number elements
        if(total_element < max ){
            // Adding new div container after last occurance of element class
            $(".element:last").after("<div class='element' id='div_"+ nextindex +"'></div>");
                        
            // Adding element to <div>
            /*$("#div_" + nextindex).append("<input type='text' placeholder='Enter your skill' id='txt_"+ nextindex +"'>&nbsp;<span id='remove_" + nextindex + "' class='remove'>X</span>");*/
            $("#div_" + nextindex).append("<div style='float: left; width: 100%; margin-top:5px;'><div style='float: left; width: 20%;'><input type='text' placeholder='Course' name='course_name[]' id='txt_1' class='form-control' style='width: 98%;'></div><div style='float: left; width: 34%;'><input type='text' placeholder='University' name='university_name[]' id='txt_2' class='form-control' style='width: 98%;'></div><div style='float: left; width: 25%;'><input type='text' placeholder='Year' name='passing_year[]' id='txt_3' class='form-control' style='width: 98%;'></div><div style='float: left; width: 15%;'><input type='text' placeholder='Marks' name='percentage[]' id='txt_4' class='form-control'></div><div style='float: left; width: 6%; font-size: 18px; color:red; cursor: pointer; text-align: center;line-height: 46px;'><span id='remove_" + nextindex + "' class='remove'>X</span></div></div>");
                    
        }
                    
    });

    // Remove element
    $('.container').on('click','.remove',function(){
                
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];

        // Remove <div> with id
        $("#div_" + deleteindex).remove();
    }); 
		/* add more education div, end here */



		/* save member education, start heere */
		$('#save_member_education').on('click', function(){
			var ajax_user_id = $('#ajax_user_id').val();
			//var course_name = $('#course_name').val();
			var course_name = $("input[name='course_name[]']").map(function(){return $(this).val();}).get();
			var university_name = $("input[name='university_name[]']").map(function(){return $(this).val();}).get();
			var passing_year = $("input[name='passing_year[]']").map(function(){return $(this).val();}).get();
			var percentage = $("input[name='percentage[]']").map(function(){return $(this).val();}).get();
			console.log(course_name);

			$.ajax({
				url: "{{url('save-member-education-ajax')}}", 
				type: "POST",  
				data:{
					ajax_user_id:ajax_user_id,
					course_name:course_name,
					university_name:university_name,
					passing_year:passing_year,
					percentage:percentage,
					_token: '{{csrf_token()}}'
				},  
				dataType : 'json',
				success:function(result) {

					console.log(result);
					$('#education_close_id').click();
			   },
                error: function (error) {
                    console.log(error);
                } 

		   });

		});
		/* save member education, end heere */


		/*show and hide amount/percentage box in Appraisals in dashboard, start here*/
		$('#appraisal_type').on('change', function(){
			var val=$('#appraisal_type').val();
			if(val=='INR') {
	  			$('#appraisal_amount_div').show();
	  			$('#appraisal_percentage_div').hide();
	  			$('#appraisal_percentage').val('');
	  		} else if(val=='%') {
	  			$('#appraisal_percentage_div').show();
	  			$('#appraisal_amount_div').hide();
	  			$('#appraisal_amount').val('');
	  		} else {
	  			$('#appraisal_percentage_div').hide();
	  			$('#appraisal_amount_div').hide();
	  			$('#appraisal_percentage').val('');
	  			$('#appraisal_amount').val('');
	  		}
		});
		/*show and hide amount/percentage box in Appraisals in dashboard, end here*/


		/* save member Promotions, start heere */
		$('#save_member_promotions').on('click', function(){
			
			var old_designation_id = $('#old_designation_id').val();
			var new_designation_id = $('#new_designation_id').val();
			var promotion_date = $('#promotion_date').val();
			console.log(old_designation_id);

			if(old_designation_id == "" || old_designation_id == null || new_designation_id == "" || new_designation_id == null || promotion_date == "" || promotion_date == null) {
		          
		            if(old_designation_id == "" || old_designation_id == null) {
				      $("#old_designation_idError").html("Required.");
				    }  else {
				      $("#old_designation_idError").html('');
				    }

				    if(new_designation_id == "" || new_designation_id == null) {
				      $("#new_designation_idError").html("Required.");
				    }  else {
				      $("#new_designation_idError").html('');
				    }

				    if(promotion_date == "" || promotion_date == null) {
				      $("#promotion_dateError").html("Date required.");
				    }  else {
				      $("#promotion_dateError").html('');
				    }
		    
		    } else {

		    	$.ajax({
					url: "{{url('save-member-promotions-ajax')}}", 
					type: "POST",  
					data:{
						old_designation_id:old_designation_id,
						new_designation_id:new_designation_id,
						promotion_date:promotion_date,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						$('#new_designation_id').val('');
						$('#promotion_date').val('');
						
						$('#promotions_close_id').click();
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });

		    }


		});
		/* save member Promotions, end heere */



		/* save member Appraisals, start heere */
		$('#save_member_appraisals').on('click', function(){
			
			var appraisal_type = $('#appraisal_type').val();
			var appraisal_date = $('#appraisal_date').val();
			var appraisal_amount = $('#appraisal_amount').val();
			var appraisal_percentage = $('#appraisal_percentage').val();
			console.log(appraisal_type);

			if(appraisal_type == "" || appraisal_type == null || appraisal_date == "" || appraisal_date == null) {
		          
		            if(appraisal_type == "" || appraisal_type == null) {
				      $("#appraisal_typeError").html("Required.");
				    }  else {
				      $("#appraisal_typeError").html('');
				    }

				    if((appraisal_type == "INR") && (appraisal_amount == "" || appraisal_amount == null)) {
				      $("#appraisal_amountError").html("Amount Required.");
				    }  else {
				      $("#appraisal_amountError").html('');
				    }

				    if((appraisal_type == "%") && (appraisal_percentage == "" || appraisal_percentage == null)) {
				      $("#appraisal_percentageError").html("Percentage Required.");
				    }  else {
				      $("#appraisal_percentageError").html('');
				    }

				    if(appraisal_date == "" || appraisal_date == null) {
				      $("#appraisal_dateError").html("Date required.");
				    }  else {
				      $("#appraisal_dateError").html('');
				    }
		    
		    } else {

		    	$.ajax({
					url: "{{url('save-member-appraisals-ajax')}}", 
					type: "POST",  
					data:{
						appraisal_type:appraisal_type,
						appraisal_amount:appraisal_amount,
						appraisal_percentage:appraisal_percentage,
						appraisal_date:appraisal_date,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						$('#appraisal_type').val('');
						$('#appraisal_amount').val('');
						$('#appraisal_percentage').val('');
						$('#appraisal_date').val('');
						
						$('#appraisals_close_id').click();
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });

		    }


		});
		/* save member Appraisals, end heere */



		/* save member achievements, start heere */
		$('#save_member_achievements').on('click', function(){
			var achievement_id = $('#achievement_id').val();
			var achievement_year_month = $('#achievement_year_month').val();
			console.log(achievement_id);

			if(achievement_id == "" || achievement_id == null || achievement_year_month == "" || achievement_year_month == null) {
		          
		            if(achievement_id == "" || achievement_id == null) {
				      $("#achievement_idError").html("Category name required.");
				    }  else {
				      $("#achievement_idError").html('');
				    }

				    if(achievement_year_month == "" || achievement_year_month == null) {
				      $("#achievement_year_monthError").html("Date required.");
				    }  else {
				      $("#achievement_year_monthError").html('');
				    }
		    
		    } else {

		    	$.ajax({
					url: "{{url('save-member-achievements-ajax')}}", 
					type: "POST",  
					data:{
						achievement_id:achievement_id,
						achievement_year_month:achievement_year_month,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						$('#achievement_id').val('');
						$('#achievement_year_month').val('');
						
						$('#achievements_close_id').click();
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });

		    }


		});
		/* save member achievements, end heere */




		/* save member appreciation, start heere */
		$('#save_member_appreciation').on('click', function(){
			var appreciation_to = $('#appreciation_to').val();
			//var appreciation_comment = $('#appreciation_comment').val();
			var appreciation_comment = CKEDITOR.instances.appreciation_comment.getData();
			console.log(appreciation_to+' / '+appreciation_comment);

			if(appreciation_to == "" || appreciation_to == null || appreciation_comment == "" || appreciation_comment == null) {
		          
		            if(appreciation_to == "" || appreciation_to == null) {
				      $("#appreciation_toError").html("Name required.");
				    }  else {
				      $("#appreciation_toError").html('');
				    }

				    if(appreciation_comment == "" || appreciation_comment == null) {
				      $("#commentError").html("Comment required.");
				    }  else {
				      $("#commentError").html('');
				    }
		    
		    } else {

		    	$.ajax({
					url: "{{url('save-member-appreciation-ajax')}}", 
					type: "POST",  
					data:{
						appreciation_to:appreciation_to,
						appreciation_comment:appreciation_comment,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						if(result=='1') {

							$('#appreciation_to').val('');
							//$('#appreciation_comment').val('');
							CKEDITOR.instances.appreciation_comment.setData('');
							
							$('#appreciation_close_id').click();

							swal("Poof! Appreciation submitted!", {
								icon: "success",
							});	

						} else if(result=='2') {

							$('#appreciation_to').val('');
							//$('#appreciation_comment').val('');
							CKEDITOR.instances.appreciation_comment.setData('');

							$('#appreciation_close_id').click();

							swal("Oops..., You don't have enough energy for give appreciation!", {
								icon: "error",
							});

						}

						
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });

		    }


		});
		/* save member appreciation, end heere */




		/* save member birthday, start heere */
		$('#save_member_birthday').on('click', function(){
			var birthday_date = $('#birthday_date').val();
			console.log(birthday_date);

			$.ajax({
				url: "{{url('save-member-birthday-ajax')}}", 
				type: "POST",  
				data:{
					birthday_date:birthday_date,
					_token: '{{csrf_token()}}'
				},  
				dataType : 'json',
				success:function(result) {

					console.log(result);
					$('#birthday_close_id').click();
			   },
                error: function (error) {
                    console.log(error);
                } 

		   });

		});
		/* save member birthday, end heere */


		/* save member skills, start heere */
		$('#save_member_skills').on('click', function(){
			var member_skills = $('#member_skills').val();
			console.log(member_skills);

			$.ajax({
				url: "{{url('save-member-skills-ajax')}}", 
				type: "POST",  
				data:{
					member_skills:member_skills,
					_token: '{{csrf_token()}}'
				},  
				dataType : 'json',
				success:function(result) {

					console.log(result);
					$('#skills_close_id').click();
			   },
                error: function (error) {
                    console.log(error);
                } 

		   });

		});
		/* save member skills, end heere */
		


		/* save member address, start heere */
		$('#save_member_address').on('click', function(){
			var permanent_address = $('#permanent_address').val();
			var current_address = $('#current_address').val();

			$.ajax({
				url: "{{url('save-member-address-ajax')}}", 
				type: "POST",  
				data:{
					permanent_address:permanent_address,
					current_address:current_address,
					_token: '{{csrf_token()}}'
				},  
				dataType : 'json',
				success:function(result) {

					console.log(result);
					$('#address_close_id').click();
			   },
                error: function (error) {
                    console.log(error);
                } 

		   });

		});
		/* save member address, end heere */


		/*fetch mentor name in fresh eye journal form, start here*/
			$('#mentor_id').on('change', function(){

				console.log('mentor');

				var mentor_id=this.value;
				console.log(mentor_id);

				$.ajax({
					url: "{{url('get-mentor-name-ajax')}}", 
					type: "POST",  
					data:{
						mentor_id:mentor_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						$('#mentor_name_ajax').val(result);
						$('.mentor_name_ajax_class').html(result);
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });
				

			});
			/*fetch mentor name in fresh eye journal form, end here*/

		/* confirmation email letter form, start here */
		$('#letter_type').on('change', function(){
			var letter_type_id=this.value;
			console.log(letter_type_id);

			$('#increment_amount_div').hide();
			$('#promotion_div').hide();
			$('#appraisal_effect_date_div').show();
			$('#pip_month_div').hide();
			$('#final_confirmation_date_div').hide();
			$('#revised_appraisl_cycle_div').hide();

			if(letter_type_id=='2') {

				$('#increment_amount_div').show();

			} else if(letter_type_id=='3') {

				$('#promotion_div').show();

			} else if(letter_type_id=='4') {

				$('#appraisal_effect_date_div').hide();
				$('#pip_month_div').show();
				$('#final_confirmation_date_div').show()
				$('#revised_appraisl_cycle_div').show();

			} else if(letter_type_id=='5') {

				$('#increment_amount_div').show();
				$('#promotion_div').show();
			}

		});
		/* confirmation email letter form, end here */

/*			CKEDITOR.editorConfig = function( config ) {
	config.toolbar = [
		
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
		{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] }
	];
};*/
			/*send initiating pip email from hr role, generate emails(view) menu, start here*/
			$('#send_initiating_pip_email').on('click', function(){

				var id=$('#id').val();
				var user_id=$('#user_id').val();

				console.log(id+' / '+user_id);

				$('#send_initiating_pip_email').html('Sending...');
				$('#send_initiating_pip_email').prop('disabled', true);

				$.ajax({
					url: "{{url('/send-initiating-pip-email-ajax')}}", 
					type: "POST",  
					data:{
						id:id,
						user_id:user_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						swal("Poof! Mail sent!", {
							icon: "success",
						});	

						$('#send_initiating_pip_email').html('Sent');
						$('#send_initiating_pip_email').prop('disabled', true);
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });
				

			});
			/*send initiating pip email from hr role, generate emails(view) menu, end here*/



			/*send closure pip email from hr role, generate emails(view) menu, start here*/
			$('#send_closure_pip_email').on('click', function(){

				var id=$('#id').val();
				var user_id=$('#user_id').val();

				console.log(id+' / '+user_id);

				$('#send_closure_pip_email').html('Sending...');
				$('#send_closure_pip_email').prop('disabled', true);

				$.ajax({
					url: "{{url('/send-closure-pip-email-ajax')}}", 
					type: "POST",  
					data:{
						id:id,
						user_id:user_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						swal("Poof! Mail sent!", {
							icon: "success",
						});	

						$('#send_closure_pip_email').html('Sent');
						$('#send_closure_pip_email').prop('disabled', true);
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });
				

			});
			/*send closure pip email from hr role, generate emails(view) menu, end here*/



			/*send mom-email-view from hr role, generate emails(view) menu, start here*/
			$('#send_generate_confirmation_email').on('click', function(){

				var id=$('#id').val();
				var user_id=$('#user_id').val();

				console.log(id+' / '+user_id);

				$('#send_generate_confirmation_email').html('Sending...');
				$('#send_generate_confirmation_email').prop('disabled', true);

				$.ajax({
					url: "{{url('/send-generate-confirmation-email')}}", 
					type: "POST",  
					data:{
						id:id,
						user_id:user_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						swal("Poof! Mail sent!", {
							icon: "success",
						});	

						$('#send_generate_confirmation_email').html('Sent');
						$('#send_generate_confirmation_email').prop('disabled', true);
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });
				

			});
			/*send mom-email-view from hr role, generate emails(view) menu, end here*/



			/*send mom-email-view from hr role, confirmation process(view) menu, start here*/
			$('#send_mail').on('click', function(){
				var user_id=$('#user_id').val();
				console.log(user_id);

				$('#send_mail').html('Sending...');
				$('#send_mail').prop('disabled', true);

				$.ajax({
					url: "{{url('send-confirmation-mom-email-view')}}", 
					type: "POST",  
					data:{
						user_id:user_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						swal("Poof! Mail sent!", {
							icon: "success",
						});	

						$('#send_mail').html('Sent');
						$('#send_mail').prop('disabled', true);
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });
				

			});
			/*send mom-email-view from hr role, confirmation process(view) menu, end here*/




			/*show currentTime in html in Confirmation generate email form, start here */
			var date = new Date();
			var currentTime = date.getHours() + ':' + date.getMinutes();
			$('#session_time').val(currentTime);
			/*show currentTime in html in Confirmation generate email form, start here */


			/*show HOD name in fresh eye form, start here*/
			$('#head_of_department').on('change', function(){
				var hod_id=this.value;
				console.log(hod_id);

				$.ajax({
					url: "{{url('get-hod-name-ajax')}}", 
					type: "POST",  
					data:{
						hod_id:hod_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						$('#head_of_department_name_ajax').val(result);
						$('.rate_5_hod_name_ajax_class').html(result);
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });

			});
			/*show HOD name in fresh eye form, end here*/


			/*show reporting manager name in fresh eye form, start here*/
			$('#reporting_manager_fresh').on('change', function(){
				var reporting_manager_id=this.value;
				console.log(reporting_manager_id);

				$.ajax({
					url: "{{url('get-reporting-manager-name-ajax')}}", 
					type: "POST",  
					data:{
						reporting_manager_id:reporting_manager_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						$('#reporting_manager_name_ajax').val(result);
						$('#rate_5_reporting_manager_name_ajax').html(result);
						$('.rate_5_reporting_manager_name_ajax_class').html(result);
						$('#how_transparent_reporting_manager_name_ajax').html(result);
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });

			});
			/*show reporting manager name in fresh eye form, end here*/


			/*show company name in fresh eye form, start here*/
			$('#company_name_fresh').on('change', function(){
				var company_name_id=this.value;
				console.log(company_name_id);

				$.ajax({
					url: "{{url('get-company-name-fresh-eye-ajax')}}", 
					type: "POST",  
					data:{
						company_name_id:company_name_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						$('#company_name_ajax').val(result);
						$('#any_additional_feedback_manager_company_name').html(result);
						$('#what_do_you_like_about_company_name').html(result);
						$('#what_do_you_dislike_about_company_name').html(result);
						$('#satisfied_employee_benefits_offered_company_name').html(result);
				   },
		            error: function (error) {
		                console.log(error);
		            } 

			   });

			});
			/*show company name in fresh eye form, end here*/


			/*show reporting manager name in check-in form member, start here*/
			$('#reporting_manager').on('change', function(){
				var reporting_manager_id=this.value;
				console.log(reporting_manager_id);

				$.ajax({
					url: "{{url('get-reporting-manager-name-ajax')}}", 
					type: "POST",  
					data:{
						reporting_manager_id:reporting_manager_id,
						_token: '{{csrf_token()}}'
					},  
					dataType : 'json',
					success:function(result) {

						console.log(result);

						$('#reporting_manager_name_ajax').val(result);
						$('#great_relationship_id').html(result);
						$('#openly_share_id').html(result);
						$('#adequate_guidance_id').html(result);
						$('#timely_feedback_id').html(result);
						$('#quick_resolution_id').html(result);
						$('#any_additional_feedback_manager_id').html(result);
						$('#1_on_1_id').html(result);
				   },
	                error: function (error) {
	                    console.log(error);
	                } 

			   });

			});
			/*show reporting manager name in check-in form member, end here*/


	
			/* call hr name ajax function in interview survey form, start here */
			$('#company_hr_name').on('change', function(){
				
				var hr_id=this.value;

				console.log(hr_id);


				if(hr_id){
					$.ajax({
						url: "{{url('get-hr-name-ajax-for-interview-survey-form')}}", 
						type: "POST",  
						data:{
							hr_id:hr_id,
							_token: '{{csrf_token()}}'
						},  
						dataType : 'json',
						success:function(result) {

							$('#hr_name_ajax').val(result);
							$('#hr_name_ajax_span').html(result);
							$('.hr_name_ajax_span').html(result);

							
					   },
		                error: function (error) {
		                    console.log(error);
		                } 

				   });
				} else {
					$('#hr_name_ajax').val('');
					$('#hr_name_ajax_span').html('');
				}
			   
			});
			/* call hr name ajax function in interview survey form, end here */



			/* hide and show others define the overall Interview Process, start here*/
		  	$('#define_overall_interview_process').on('change', function(){

		  		var define_overall_value=this.value;

		  		if(define_overall_value=='Others'){
		  			
		  			$('#define_overall_interview_process_others_div').show();

		  		} else {
		  			$('#define_overall_interview_process_others_div').hide();
		  		}
		  	});
		  	/* hide and show others define the overall Interview Process, end here*/



			/* call trainer name list ajax function, start here */
			$('#trainer_list_name').on('change', function(){
				
				var selected = [];
				var count=0;
				for (var option of document.getElementById('trainer_list_name').options) {
			       if (option.selected) {
			           selected.push(option.value);
						count++;
			       }
				}
		
				/*var user_id=$('#user_id').val();
				var edit_ajax=$('#edit_ajax').val();*/

				//console.log(user_id);
				//console.log(edit_ajax);

				selected=selected.toString();

				//console.log(selected);

				if(count>0 && count<=5) {
				
					$.ajax({
						url: "{{url('get-all-trainers-name-ajax')}}", 
						type: "POST",  
						data:{
							all_ids:selected,
							_token: '{{csrf_token()}}'
						},  
						dataType : 'json',
						success:function(result) {

							//console.log(result);

							$('#all_trainer_list').html(result);

							
					   },
		                error: function (error) {
		                    console.log(error);
		                } 

				   });
				} else {
					alert('You can choose Maximum 5 trainer.');
				}
			   
			});
			/* call trainer name list ajax function, end here */


			/*show and hide amount box in Confirmation feedback form, start here*/
			$('#increment_on_confirmation').on('change', function(){
				var val=$('#increment_on_confirmation').val();
				if(val=='No'){
		  			document.getElementById('mention_the_amount').setAttribute("class", "form-control  disable-text");
		  			document.getElementById('mention_the_amount').value='0';
		  			document.getElementById('mention_the_amount').readOnly
		                        = true;
		            document.getElementById('mention_the_amount_div_hide').style.display='none';
		  		} else {
		  			document.getElementById('mention_the_amount').setAttribute("class", "form-control");
		  			document.getElementById('mention_the_amount').removeAttribute("readonly");
		  			document.getElementById('mention_the_amount').value='';
		  			document.getElementById('mention_the_amount_div_hide').style.display='block';
		  		}
			});
			/*show and hide amount box in Confirmation feedback form, end here*/



			/*show and hide promotion designation in manager mom form, start here*/
			$('#recommend_for_promotion').on('change', function(){
				var val=$('#recommend_for_promotion').val();
				console.log(val);
				if(val=='No'){
		  			$('#mention_the_amount').val('0');
		            $('#recommend_for_promotion_id_div').hide();
		  		} else {
		  			$('#mention_the_amount').val('');
		  			$('#recommend_for_promotion_id_div').show();
		  		}
			});
			/*show and hide promotion designation in manager mom form, end here*/


		});

	
	/* Manager MOM form recommend increment, start here*/
  	function recommend_increment_fun(value){

  		if(value=='No'){
  			document.getElementById('recommend_increment_div').style.display='none';
  			document.getElementById('how_much_increment').setAttribute("class", "form-control  disable-text");
  			document.getElementById("how_much_increment").setAttribute("disabled", "disabled");

  			document.getElementById('how_much_increment_amount').setAttribute("class", "form-control  disable-text");
  			document.getElementById('how_much_increment_amount').value='0';
  			document.getElementById('how_much_increment_amount').readOnly
                        = true;
  		} else {
  			document.getElementById('recommend_increment_div').style.display='block';
  			document.getElementById('how_much_increment').setAttribute("class", "form-control");
  			document.getElementById("how_much_increment").removeAttribute("disabled", "disabled");
  			
  			document.getElementById('how_much_increment_amount').setAttribute("class", "form-control");
  			document.getElementById('how_much_increment_amount').removeAttribute("readonly");
  			document.getElementById('how_much_increment_amount').value='';
  		}
  	}
  	/* Manager MOM form recommend increment, end here*/



  	/* Manager MOM form Average Rating of the entire presentation, start here*/
  	function agv_rat_fun(){

  		var rate_content=0;
  		var rate_confidence=0;
  		var rate_communication=0;
  		var rate_data_relevance=0;
  		var rate_overall_growth_individual=0;
  		var avg_rate=0;

  		var val_content = document.getElementsByName('content');
  		//console.log(val_content);
		for(var i = 0; i < val_content.length; i++){
		    if(val_content[i].checked){
		        rate_content = val_content[i].value;

		        if(rate_content == 'NA'){
		        	rate_content=0;
		        }
		    }
		}
		//console.log('content '+rate_content);

		var val_confidence = document.getElementsByName('confidence');
		for(var j = 0; j < val_confidence.length; j++){
		    if(val_confidence[j].checked){
		        rate_confidence = val_confidence[j].value;
		        if(rate_confidence == 'NA'){
		        	rate_confidence=0;
		        }
		    }
		}
		//console.log('confidence '+rate_confidence);


		var val_communication = document.getElementsByName('communication');
		for(var k = 0; k < val_communication.length; k++){
		    if(val_communication[k].checked){
		        rate_communication = val_communication[k].value;
		        if(rate_communication == 'NA'){
		        	rate_communication=0;
		        }
		    }
		}
		//console.log('communication '+rate_communication);

		var val_data_relevance = document.getElementsByName('data_relevance');
		for(var l = 0; l < val_data_relevance.length; l++){
		    if(val_data_relevance[l].checked){
		        rate_data_relevance = val_data_relevance[l].value;
		        if(rate_data_relevance == 'NA'){
		        	rate_data_relevance=0;
		        }
		    }
		}
		//console.log('data_relevance '+rate_data_relevance);


		var val_overall_growth_individual = document.getElementsByName('overall_growth_individual');
		for(var m = 0; m < val_overall_growth_individual.length; m++){
		    if(val_overall_growth_individual[m].checked){
		        rate_overall_growth_individual = val_overall_growth_individual[m].value;
		        if(rate_overall_growth_individual == 'NA'){
		        	rate_overall_growth_individual=0;
		        }
		    }
		}
		//console.log('overall_growth_individual '+rate_overall_growth_individual);


		avg_rate=(parseInt(rate_content)+parseInt(rate_confidence)+parseInt(rate_communication)+parseInt(rate_data_relevance)+parseInt(rate_overall_growth_individual));
		
		avg_rate=avg_rate/5;
		//avg_rate=Math.round(avg_rate);

  		document.getElementById('average_rating_entire_presentation').value=avg_rate;
  		document.getElementById('avg_rating_span').innerHTML=avg_rate;
  		
  	}
  	/* Manager MOM form Average Rating of the entire presentation, end here*/


  	/*disable and unable PIP textarea in Confirmation Feedback Form, start here*/
  	function open_close_pip(val){
  		
  		if(val=='No, Put under PIP'){
  			document.getElementById('recommend_pip_detailed_plan').setAttribute("class", "form-control");
  			document.getElementById('recommend_pip_detailed_plan').removeAttribute("readonly");
  			document.getElementById('pip_div_hide').style.display='block';
  		} else {
  			document.getElementById('recommend_pip_detailed_plan').setAttribute("class", "form-control  disable-text");
  			document.getElementById('recommend_pip_detailed_plan').value='';
  			document.getElementById('recommend_pip_detailed_plan').readOnly
                        = true;
            document.getElementById('pip_div_hide').style.display='none';
  		}
  	}
  	/*disable and unable PIP textarea in Confirmation Feedback Form, end here*/


  	/*update generic status in table, start here*/
  	function status_update_funtion(id, table_name){
			
			//console.log(id);
			
			var checkBox = document.getElementById('id_'+id);
			
			if (checkBox.checked == true){
				var status=1;
			} else {
				var status=0;
			}
  
			//console.log(status+' / '+table_name);
			
			$.ajax({
				url: "{{url('update-status')}}", 
				type: "POST",  
				data:{
					id:id,
					status:status,
					table_name:table_name,
					_token: '{{csrf_token()}}'
				},
				success:function(result){
					console.log(result);
					swal("Poof! Status has been updated!", {
						icon: "success",
					});				
			   }  

			});
				
		}
		/*update generic status in table, end here*/

		/*soft delete generic status in table, start here*/
		function delete_function(id, table_name){
			
			var checkBox = document.getElementById('del_'+id);
			
			if (checkBox.checked == true){
				var del_status=1;
			} else {
				var del_status=0;
			}
  
			console.log(del_status);
			
			$.ajax({
				url: "{{url('delete-row-value')}}", 
				type: "POST",  
				data:{
					id:id,
					del_status:del_status,
					table_name:table_name,
					_token: '{{csrf_token()}}'
				},
				success:function(result){
					
					swal("Poof! Successfully deleted!", {
						  icon: "success",
					});		
			   }  

			});
				
		}
		/*soft delete generic status in table, end here*/


		/* approved pip by hr, start here */
		function approved_member_pip_by_hr(user_id){
						
			var checkBox = document.getElementById('id_'+user_id);
			
			if (checkBox.checked == true){
				var status=1;
			} else {
				var status=0;
			}

			$.ajax({
				url: "{{url('approved-pip-by-hr')}}", 
				type: "POST",  
				data:{
					user_id:user_id,
					status:status,
					_token: '{{csrf_token()}}'
				},
				success:function(result){
					
					swal("Poof! Successfully updated!", {
						  icon: "success",
					});		
			   }  

			});
		}
		/* approved pip by hr, end here */

  </script>