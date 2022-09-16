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
                  <div style="clear: both; height: 10px;"></div>
	            @endif


              <!-- filter section, start here -->
              <form method="get" action="{{ route('confirmation-process-mom-email.filter')}}" class="row">
                
                <div class="col-md-3 position-relative filter_div_width">
                  <select class="form-select fontSize12" name="company_id_filter" id="company_id_filter">
                    <option value="">-- Select Company --</option>
                    @foreach($company_names as $company_name_filter)
                    <option value="{{$company_name_filter['id']}}" @if(request()->get('company_id_filter')==$company_name_filter['id']) selected @endif>{{$company_name_filter['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-3 position-relative filter_div_width">
                  <select class="form-select fontSize12" name="department_id_filter" id="department_id_filter">
                    <option value="">-- Select Department --</option>
                    @foreach($department_names as $department_name_filter)
                    <option value="{{$department_name_filter['id']}}" @if(request()->get('department_id_filter')==$department_name_filter['id']) selected @endif>{{$department_name_filter['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-3 position-relative filter_div_width">
                  <select class="form-select fontSize12" name="designation_id_filter" id="designation_id_filter">
                    <option value="">-- Select Designation --</option>
                    @foreach($designation_names as $designation_name_filter)
                    <option value="{{$designation_name_filter['id']}}" @if(request()->get('designation_id_filter')==$designation_name_filter['id']) selected @endif>{{$designation_name_filter['name']}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-3 position-relative filter_div_width">
                  <select class="form-select fontSize12" name="location_id_filter" id="location_id_filter">
                    <option value="">-- Select Location --</option>
                    @foreach($company_locations as $company_location_filter)
                    <option value="{{$company_location_filter['id']}}" @if(request()->get('location_id_filter')==$company_location_filter['id']) selected @endif>{{$company_location_filter['name']}}</option>
                    @endforeach
                  </select>
                </div>

                  <input type="submit" name="submit" value="Filter" class="btn btn-primary filter_submit_btn">

                  <a href="{{ url('/confirmation-process-mom-email') }}" class="filter_clear_btn">
                    <input type="button" name="button" value="Clear" class="btn btn-info filter_clear_btn2">
                  </a>

              </form>
              <!-- filter section, end here -->
              
              <div style="clear: both; height: 10px;"></div>

              <!-- Custom Styled Validation with Tooltips -->
              <table class="table datatable table-striped">
                <thead>
                  <tr>
                    <th scope="col">Member ID</th>
                    <th scope="col">Member Name</th>
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
						<td>{{$all_candidate['department_name']}}</td>
						<td>
              <a href="{{ url('mom-email-view/'.$all_candidate['id'])}}">
  							<button type="button" class="btn btn-primary btn-sm">View</button>
              </a>
						</td>
						<td>
							<a href="{{ url('start-confirmation-process/'.$all_candidate['id'])}}">
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