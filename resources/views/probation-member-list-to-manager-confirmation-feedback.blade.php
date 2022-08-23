@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Confirmation Feedback | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">

            	<div class="col-lg-12">
            		<h5 class="card-title">Probation Member List For Confirmation Feedback</h5>
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
	            @endif
              

              <!-- Custom Styled Validation with Tooltips -->
              <table class="table datatable table-striped display nowrap" id="datatable-id" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">Member ID</th>
                    <th scope="col">Member Name</th>
                    <th scope="col">Member Email</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Joining Date</th>
                    <th scope="col">Company Location</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $j=1;?>	
                @foreach($all_members as $all_member)
					<tr>
						<td>{{$all_member['member_id']}}</td>
						<td>
							{{$all_member['first_name']}} {{$all_member['last_name']}}
						</td>
						<td>{{$all_member['email']}}</td>
						<td>{{$all_member['designation']}}</td>
						<td>{{date('d-M-y',strtotime($all_member['joining_date']))}}</td>
						<td>{{$all_member['location_name']}}</td>
						<td>{{$all_member['gender']}}</td>
						<td>
							<a href="#">
								<button type="button" class="btn btn-primary btn-sm">Start Confirmation Feedback</button>
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