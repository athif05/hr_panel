<div class="container">
@for($n=1;$n<=$no_of_section;$n++)

	<div class='road_fy_element' id="roadFyDiv_{{ $n }}">
		<div style="float: left; width: 100%; margin-bottom: 10px; border: 1px solid #ccc; padding: 5px;">
			<div class="section_div_padding13" style="float: left; width: 5%;">{{ $n }}.</div>
			<div style="float: left; width: 60%;">
				Section Name <input type="text" class="form-control" name="section_name[]" id="section_name_{{$n}}" value="" style="width: 95%;" required>
			</div>

			<div style="float: left; width: 35%;">
				Visible For 
				<select class="form-select" name="visible_for[]" id="visible_for" style="width: 95%;">
                	<option value="Member" @if(old('question_type')=='Member') selected @endif>Member</option>
                	<option value="Manager" @if(old('question_type')=='Manager') selected @endif>Manager</option>
                	<option value="HR" @if(old('question_type')=='HR') selected @endif>HR</option>
                	<option value="All" @if(old('question_type')=='All') selected @endif>All</option>
                </select>
			</div>
			<!-- <div class="section_div_padding4" style="float: left; width: 20%; font-size: 14px; color: green; cursor: pointer; text-align: center; ">
				
				<a href="#" data-bs-toggle="modal" data-bs-target="#sectionFYQuestionModal">
					<input type="button" name="add_question" value="Add Question" class="btn btn-primary road_fy_add">
				</a>
				
				
			</div> -->
		</div>
	</div>

@endfor
</div>




<!-- <div class="modal fade" id="sectionFYQuestionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Question</h5>
          <button type="button" class="btn-close" id="education_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <div class="modal-body">
            
            <div class="container">
             
                  <div class='road_fy_element' id="roadFyDiv_1">
                    
                      <div style="float: left; width: 100%; margin-top:5px;">
                        <div style="float: left; width: 45%;">
                          <input type='text' placeholder='Question Title' name='course_name[]' id='txt_1' value="" class="form-control" style="width: 98%;">
                        </div>
                        <div style="float: left; width: 24%;">
                          <select class="form-select" name="question_type[]" id="txt_2" style="width: 98%;">
                        <option value="textbox" @if(old('question_type')=='textbox') selected @endif>Text Box</option>
                        <option value="textarea" @if(old('question_type')=='textarea') selected @endif>Text Area</option>
                        <option value="radiobutton" @if(old('question_type')=='radiobutton') selected @endif>Radio Button</option>
                        <option value="checkbox" @if(old('question_type')=='checkbox') selected @endif>Check Box</option>
                        <option value="dropdown" @if(old('question_type')=='dropdown') selected @endif>Drop Down</option>
                      </select>
                        </div>
                        <div style="float: left; width: 25%;">
                          <input type='text' name='question_value[]' id='txt_3' value="" class="form-control" style="width: 98%;">
                        </div>
                        
                        <div style="float: left; width: 6%; font-size: 31px; color: green; cursor: pointer; text-align: center; ">
                          <span class='road_fy_add'><i class="bi bi-plus"></i></span>
                        </div>

                      </div>
                      
                  </div>

            </div>
    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save_member_education">Save</button>
          </div>

      </div>


    </div>
  </div>





  <script type="text/javascript">
  	jQuery(document).ready(function(){


  		/* addmore road fy questions, start here */
		$(".road_fy_add").click(function(){

	        //var total_step = $("#no_of_section").val();
	        //console.log('total_step: '+total_step);

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

  	}
  </script> -->