@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>MOM | {{ env('MY_SITE_NAME') }}</title>

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
            		<h5 class="card-title">Probation Member List For MOM</h5>
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
	            @endif
              

              
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
                    <th >Action</th>
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
                    <td>{{$all_member['department']}}</td>
                    <td>{{$all_member['company_name']}}</td>
                    <td>{{$all_member['location_name']}}</td>
                    <td>{{$all_member['manager_name']}}</td>
                    <td>{{$all_member['gender']}}</td>
                    <td>{{date('d-M-y',strtotime($all_member['joining_date']))}}</td>
                    <td>
                      <a href="#">
                        <button type="button" class="btn btn-primary btn-sm">Start MOM</button>
                      </a>
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