@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Manage Departments | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">

            	<div class="col-lg-6" style="float: left;">
            		<h5 class="card-title">Manage Departments</h5>
            	</div>

            	<div class="col-lg-6" style="float: right; text-align: right; padding-top: 12px;">
            		<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("add-new-department")}}';">Add New Department</button>		
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
                    <th scope="col">Department Name</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $j=1;?>	
                @foreach($all_departments as $all_department)
					<tr>
						<th scope="row"><?php echo $j;?>.</th>
						<td>
							<a href="{{ url('edit-department/'.$all_department['id'])}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
								{{$all_department['name']}}
							</a>
						</td>
						<td>{{$all_department['company_name_show']}}</td>
						<td>
							
							<label class="switch">
							  <input type="checkbox" id="id_{{ $all_department['id']}}" @if($all_department['status']=='1') checked @endif onclick="status_update_funtion({{ $all_department['id']}}, 'departments')">
							  <span class="slider round"></span>
							</label>

						</td>
						<td>
							
							<label class="switch">
							  <input type="checkbox" id="del_{{ $all_department['id']}}" @if($all_department['is_deleted']=='1') checked @endif onclick="delete_function({{ $all_department['id']}}, 'departments')">
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