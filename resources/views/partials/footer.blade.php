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
  	function role_status_fun(role_id){
			
			console.log(role_id);
			
			var checkBox = document.getElementById('role_'+role_id);
			
			if (checkBox.checked == true){
				var role_status=1;
			} else {
				var role_status=0;
			}
  
			console.log(role_status);
			
			$.ajax({
				url: "{{url('update-role-status')}}", 
				type: "POST",  
				data:{
					role_id:role_id,
					role_status:role_status,
					_token: '{{csrf_token()}}'
				},
				success:function(result){
					
					swal("Poof! Status has been updated!", {
						icon: "success",
					});				
			   }  

			});
				
		}


		function role_delete_fun(role_id){
			
			var checkBox = document.getElementById('role_del_'+role_id);
			
			if (checkBox.checked == true){
				var role_del_status=1;
			} else {
				var role_del_status=0;
			}
  
			console.log(role_del_status);
			
			$.ajax({
				url: "{{url('delete-role')}}", 
				type: "POST",  
				data:{
					role_id:role_id,
					role_del_status:role_del_status,
					_token: '{{csrf_token()}}'
				},
				success:function(result){
					
					swal("Poof! Role has been deleted!", {
						  icon: "success",
					});		
			   }  

			});
				
		}

  </script>