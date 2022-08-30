<!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>{{ env('MY_SITE_NAME') }}</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://vcommission.com/">VCOne</a>
    </div>
  </footer><!-- End Footer -->

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
      </script>

  <script type="text/javascript">

		jQuery(document).ready(function(){
	
			/* call trainer name list ajax function, start here */
			$('#trainer_1_name').on('change', function(){
				
				var selected = [];
				var count=0;
				for (var option of document.getElementById('trainer_1_name').options) {
			       if (option.selected) {
			           selected.push(option.value);
						count++;
			       }
				}
		
				//console.log(selected);

				selected=selected.toString();

				console.log(selected);

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

		});


  	/*function trainer_list(){
		var selected = [];
		var count=0;
		for (var option of document.getElementById('trainer_1_name').options) {
	       if (option.selected) {
	           selected.push(option.value);
				count++;
	       }
		}
  	}*/


  	/* Manager MOM form Average Rating of the entire presentation, start here*/
  	function agv_rat_fun(){

  		var rate_content=0;
  		var rate_confidence=0;
  		var rate_communication=0;
  		var rate_data_relevance=0;
  		var rate_overall_growth_individual=0;
  		var avg_rate=0;

  		var val_content = document.getElementsByName('content');
		for(var i = 0; i < val_content.length; i++){
		    if(val_content[i].checked){
		        rate_content = val_content[i].value;
		    }
		}
		//console.log('content '+rate_content);

		var val_confidence = document.getElementsByName('confidence');
		for(var j = 0; j < val_confidence.length; j++){
		    if(val_confidence[j].checked){
		        rate_confidence = val_confidence[j].value;
		    }
		}
		//console.log('confidence '+rate_confidence);


		var val_communication = document.getElementsByName('communication');
		for(var k = 0; k < val_communication.length; k++){
		    if(val_communication[k].checked){
		        rate_communication = val_communication[k].value;
		    }
		}
		//console.log('communication '+rate_communication);

		var val_data_relevance = document.getElementsByName('data_relevance');
		for(var l = 0; l < val_data_relevance.length; l++){
		    if(val_data_relevance[l].checked){
		        rate_data_relevance = val_data_relevance[l].value;
		    }
		}
		//console.log('data_relevance '+rate_data_relevance);


		var val_overall_growth_individual = document.getElementsByName('overall_growth_individual');
		for(var m = 0; m < val_overall_growth_individual.length; m++){
		    if(val_overall_growth_individual[m].checked){
		        rate_overall_growth_individual = val_overall_growth_individual[m].value;
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


  	/* Manager MOM form recommend increment, start here*/
  	function recommend_increment_fun(value){

  		if(value=='No'){
  			document.getElementById('how_much_increment_amount').setAttribute("class", "form-control  disable-text");
  			document.getElementById('how_much_increment_amount').value='0';
  			document.getElementById('how_much_increment_amount').readOnly
                        = true;
  		} else {
  			document.getElementById('how_much_increment_amount').setAttribute("class", "form-control");
  			document.getElementById('how_much_increment_amount').removeAttribute("readonly");
  			document.getElementById('how_much_increment_amount').value='';
  		}
  	}
  	/* Manager MOM form recommend increment, end here*/


  	/*disable and unable PIP textarea in Confirmation Feedback Form, start here*/
  	function open_close_pip(val){
  		
  		if(val=='No, Put under PIP'){
  			document.getElementById('recommend_pip_detailed_plan').setAttribute("class", "form-control");
  			document.getElementById('recommend_pip_detailed_plan').removeAttribute("readonly");
  		} else {
  			document.getElementById('recommend_pip_detailed_plan').setAttribute("class", "form-control  disable-text");
  			document.getElementById('recommend_pip_detailed_plan').value='';
  			document.getElementById('recommend_pip_detailed_plan').readOnly
                        = true;
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

  </script>