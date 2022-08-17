@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Manage Locations | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
    	.form-check-input[type=radio] {
		  margin-left: 30px;
		  border-radius: 50%;
		}

    .text-danger{
      font-size: 13px!important;
    }

    .disable-text{
      background-color: #ddd!important;
    }
    </style>

    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 48px;
  height: 20px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 1px;
  bottom: 1px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">

            	<div class="col-lg-6" style="float: left;">
            		<h5 class="card-title">Manage Locations</h5>
            	</div>

            	<div class="col-lg-6" style="float: right; text-align: right; padding-top: 12px;">
            		<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("add-new-location")}}';">Add New Location</button>		
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
	            @endif
              

              <!-- Custom Styled Validation with Tooltips -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Location Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $j=1;?>	
                @foreach($all_locations as $all_location)
					<tr>
						<th scope="row"><?php echo $j;?>.</th>
						<td>
							<a href="{{ url('edit-company-location/'.$all_location['id'])}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
								{{$all_location['name']}}
							</a>
						</td>
						<td>
							
							<label class="switch">
							  <input type="checkbox" id="id_{{ $all_location['id']}}" @if($all_location['status']=='1') checked @endif onclick="status_update_funtion({{ $all_location['id']}}, 'company_locations')">
							  <span class="slider round"></span>
							</label>

							
						</td>
						<td>
							
							<label class="switch">
							  <input type="checkbox" id="del_{{ $all_location['id']}}" @if($all_location['is_deleted']=='1') checked @endif onclick="delete_function({{ $all_location['id']}}, 'company_locations')">
							  <span class="slider round"></span>
							</label>

						</td>
					</tr>
				<?php $j++;?>
                @endforeach
                </tbody>
              </table>
              <!-- End Custom Styled Validation with Tooltips -->
             

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection