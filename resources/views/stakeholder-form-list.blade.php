@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Stakeholder Member List | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
      .dataTable-table {
          max-width: 1400px!important;
          width: 1000px!important;
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

            	<div class="col-lg-6" style="float: left;">
            		<h5 class="card-title">Stakeholder Member List</h5>
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
                  <div style="clear: both; height: 10px;"></div>
	            @endif


              <!-- filter section, start here -->
              <form method="get" action="{{ route('stakeholder-form-list.filter')}}" class="row">
                
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

                  <a href="{{ url('/stakeholder-form-list') }}" class="filter_clear_btn">
                    <input type="button" name="button" value="Clear" class="btn btn-info filter_clear_btn2">
                  </a>

              </form>
              <!-- filter section, end here -->
              
              <div style="clear: both; height: 10px;"></div>

              <!-- Custom Styled Validation with Tooltips -->
              <div style="float: left; width: 860px; overflow-x: scroll;">
              <table class="table datatable table-striped display nowrap" id="datatable-id" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">Member ID</th>
                    <th scope="col">Member Name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Department</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Location</th>
                    <!-- <th scope="col">Confirmation Email</th> -->
                    <th scope="col">Fill Form</th>
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
						<td>{{$all_member['company_name']}}</td>
						<td>{{$all_member['department_name']}}</td>
						<td>{{$all_member['designation_name']}}</td>
						<td>{{$all_member['location_name']}}</td>
						<td>

							
                  @foreach($stackholder_feedback_details as $stackholder_feedback_detail)
                      
                      <?php $j=0;?>

                      @if(($stackholder_feedback_detail['member_id']==$all_member['id']) && ($stackholder_feedback_detail['manager_id']==(Auth::user()->id)))
                          
                          <?php $j=1; break;?>

                      @else
                          
                          <?php $j=0;?>

                      @endif

                  @endforeach


                  @if($j==0)
                    <a href="{{ url('/stake-holder-feedback-form/'.$all_member['id'])}}">
                      <button type="button" class="btn btn-primary btn-sm">Start</button>
                    </a>
                  @else
                    <a href="{{ url('/stake-holder-feedback-form/'.$all_member['id'])}}">
                      <button type="button" class="btn btn-info btn-sm">Show</button>
                    </a>
                  @endif
                  
                
						</td>
					</tr>
				<?php $j++;?>
                @endforeach
                </tbody>
              </table>
          </div>
              <!-- End Custom Styled Validation with Tooltips -->
             

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection