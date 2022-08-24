<!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>{{ env('MY_SITE_NAME') }}</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://vcommission.com/">VCOne</a>
    </div>
  </footer><!-- End Footer -->



  <script type="text/javascript">

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