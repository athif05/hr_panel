@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Manage Designations | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">

            	<div class="col-lg-6" style="float: left;">
            		<h5 class="card-title">Manage Designations</h5>
            	</div>

            	<div class="col-lg-6" style="float: right; text-align: right; padding-top: 12px;">
            		<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("add-new-designation")}}';">Add New Designation</button>		
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
	            @endif
              

              <!-- Custom Styled Validation with Tooltips -->
              <table class="table datatable table-striped ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Designation Name</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $j=1;?>	
                @foreach($all_designations as $all_designation)
					<tr>
						<th scope="row"><?php echo $j;?>.</th>
						<td>
							<a href="{{ url('edit-designation/'.$all_designation['id'])}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
								{{$all_designation['name']}}
							</a>
						</td>
						<td>{{$all_designation['company_name_show']}}</td>
						<td>
							
							<label class="switch">
							  <input type="checkbox" id="id_{{ $all_designation['id']}}" @if($all_designation['status']=='1') checked @endif onclick="status_update_funtion({{ $all_designation['id']}}, 'designations')">
							  <span class="slider round"></span>
							</label>

						</td>
						<td>
							
							<label class="switch">
							  <input type="checkbox" id="del_{{ $all_designation['id']}}" @if($all_designation['is_deleted']=='1') checked @endif onclick="delete_function({{ $all_designation['id']}}, 'designations')">
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