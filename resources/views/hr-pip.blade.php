@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>PIP | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
      .dataTable-table {
          max-width: 2200px!important;
          width: 2200px!important;
          border-spacing: 0;
          border-collapse: separate;
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

            	<div class="col-lg-12">
            		<h5 class="card-title">Probation Member List For PIP</h5>
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
                  <div style="clear: both; height: 10px;"></div>
	            @endif
              

              <!-- filter section, start here -->
              <form method="get" action="{{ route('hr-pip.filter')}}" class="row">
                
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

                  <a href="{{ url('/hr-pip') }}" class="filter_clear_btn">
                    <input type="button" name="button" value="Clear" class="btn btn-info filter_clear_btn2">
                  </a>

              </form>
              <!-- filter section, end here -->
              
              <div style="clear: both; height: 10px;"></div>

              
              <div style="float: left; width: 860px; overflow-x: scroll;">
                <table class="table datatable table-striped display nowrap" id="datatable-id" >
                <thead>
                  <tr>
                    <th >Member ID</th>
                    <th >Member Name</th>
                    <th >Member Email</th>
                    <th >Designation</th>
                    <th >Department</th>
                    <th >Company Name</th>
                    <th >Company Location</th>
                    <th >Manager Name</th>
                    <th >Gender</th>
                    <th >Joining Date</th>
                    <th >View</th>
                    <th >Approved</th>
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
                    <td>{{$all_member['designation_name']}}</td>
                    <td>{{$all_member['department_name']}}</td>
                    <td>{{$all_member['company_name']}}</td>
                    <td>{{$all_member['location_name']}}</td>
                    <td>{{$all_member['manager_name']}}</td>
                    <td>{{$all_member['gender']}} {{ $all_member['mom_user_id']}}</td>
                    <td>{{date('d-M-y',strtotime($all_member['joining_date']))}}</td>
                    <td>
                      
                      <a href='{{ url("/hr-pip-view/$all_member->id")}}' target="_blank">
                      	<button type="button" class="btn btn-info btn-sm">View</button>
                      </a>

                    </td>
                    <td>

                      <!-- <button type="button" class="btn btn-primary btn-sm" onclick="approved_member_pip_by_hr({{$all_member['id']}})">Approved</button> -->

                      <label class="switch">
                      <input type="checkbox" id="id_{{ $all_member['id']}}" @if($all_member['is_approved_by_hr']=='1') checked @endif onclick="approved_member_pip_by_hr({{ $all_member['id']}})">
							         <span class="slider round"></span>
                      </label>

                    </td>
                  </tr>
                <?php $j++;?>
                @endforeach
                </tbody>
              </table>
              </div>
              
             

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection