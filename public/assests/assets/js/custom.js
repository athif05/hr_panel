jQuery(document).ready(function(){

	/*show company name in fresh eye form, start here*
	$('#company_name').on('change', function(){
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

				//$('#reporting_manager_name_ajax').val(result);

		   },
            error: function (error) {
                console.log(error);
            } 

	   });

	});
	*show company name in fresh eye form, end here*/

});