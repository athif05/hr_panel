@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Check-In Form | {{ env('MY_SITE_NAME') }}</title>

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

            	<div class="col-lg-12">
            		<h5 class="card-title">Probation Member List for Check-In Form</h5>
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
	            @endif
              

              <div style="float: left; width: 860px; overflow-x: scroll;">
                <table class="table datatable table-striped display nowrap" id="datatable-id" style="width:100%">
                  <thead>
                    <tr>
                      <th scope="col">Member ID</th>
                      <th scope="col">Member Name</th>
                      <th scope="col">Member Email</th>
                      <th scope="col">Designation</th>
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
          						<td>{{$all_member['designation_name']}}</td>
          						<td>
          						 <?php $j=0;?>
                        @foreach($check_in_manager_details as $check_in_manager_detail)


                            @if(($check_in_manager_detail->member_id == $all_member['id']) && ($check_in_manager_detail->manager_id == (Auth::user()->id)) )

                            
                          <?php $j=1; ?>
                          
                            @if($check_in_manager_detail->status=='1')

                              <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/manager-check-in-form/".$all_member['id'])}}';">Edit MOM</button> <?php break; ?>

                            @elseif($check_in_manager_detail->status=='2')

                              <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/manager-check-in-form/".$all_member['id'])}}';">Show Check-In</button> <?php break; ?>

                            @endif

                                                     
                          @endif
                        
                        @endforeach

                        @if($j==0)
          								<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("/manager-check-in-form/".$all_member['id'])}}';">Start Check-In</button>
                        @endif

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