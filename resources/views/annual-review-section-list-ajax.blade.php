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
		</div>
	</div>

@endfor
</div>