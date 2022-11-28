$(document).ready(function() {

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



	/*no of section from annual review form 2nd step ajax, start here*
	$('#no_of_section').change(function(){
		var no_of_section=$('#no_of_section').val();
		var ajax_url=$('#ajax_url').val();
		//console.log(no_of_section);


		$.ajax({
			
			url: ajax_url+"/get-no-of-section-road-fy-ajax", 
			type: "POST",  
			data:{
				no_of_section:no_of_section,
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
	*no of section from annual review form 2nd step ajax, end here*/

});