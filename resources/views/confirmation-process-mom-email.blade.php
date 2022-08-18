@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Confirmation Process & MOM Email | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">

            	<div class="col-lg-6" style="float: left;">
            		<h5 class="card-title">Confirmation Process & MOM Email</h5>
            	</div>

            	<!-- <div class="col-lg-6" style="float: right; text-align: right; padding-top: 12px;">
            		<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("add-new-location")}}';">Add New Location</button>		
            	</div> -->

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
	            @endif
              

              <!-- Custom Styled Validation with Tooltips -->
              <table class="table datatable table-striped">
                <thead>
                  <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">MOM Email</th>
                    <th scope="col">Start Confirmation</th>
                  </tr>
                </thead>
                <tbody>
                <?php $j=1;?>	
                @foreach($all_candidates as $all_candidate)
					<tr>
						<td>{{$all_candidate['member_id']}}</td>
						<td>
							{{$all_candidate['first_name']}} {{$all_candidate['last_name']}}
						</td>
						<td>{{$all_candidate['department']}}</td>
						<td>
							<button type="button" class="btn btn-primary btn-sm">View</button>
						</td>
						<td>
							<a href="{{ url('start-confirmation-process/'.$all_candidate['id'])}}"  target="_blank">
								<button type="button" class="btn btn-primary btn-sm">Start Confirmation</button>
							</a>
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