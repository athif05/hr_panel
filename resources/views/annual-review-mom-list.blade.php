@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Annual Review MOM | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
      .dataTable-table {
          max-width: 1300px!important;
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
            		<h5 class="card-title">Annual Review MOM List</h5>
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
                    	<th scope="col">&nbsp;</th>
                    	<th scope="col">Member ID</th>
                    	<th scope="col">Member Name</th>
                    	<th scope="col">Member Email</th>
                    	<th scope="col">Department</th>
                    	<th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $j=1;?>	
                  @foreach($all_members as $all_member)

                  
          					<tr>
          						<td>
			                        @if($all_member['profile_image'])
			                          <img src="{{ str_replace('public/', '', asset('')).$all_member['profile_image'] }}" alt="VCOne" class="annualStakeHolderImage">
			                        @else
			                          <img src="{{ asset('assests/confirmation-process/img/no-user-profile.png') }}" alt="img" class="annualStakeHolderImage">
			                        @endif
			                    </td>
          						<td>{{$all_member['member_id']}}</td>
          						<td>
          							{{$all_member['first_name']}} {{$all_member['last_name']}}
          						</td>
          						<td>{{$all_member['email']}}</td>
          						<td>{{$all_member['department_name']}}</td>
          						<td>
                        <?php $jk=0;?>

                        @foreach($mom_details as $mom_detail)
                        
                          @if(($mom_detail->filled_for==$all_member['id']) && ($mom_detail->filled_by == (Auth::user()->id)) )

                          <?php $jk=1;?>
         
                            @if($mom_detail->status=='1')

                              <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/annual-review-mom-form-edit/".$survey_form_id."/".$all_member['id']."/".$mom_detail->id)}}';">Edit Feedback</button> <?php break; ?>

                            @elseif($mom_detail->status=='2')

                              <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/annual-review-mom-form-show/".$survey_form_id."/".$all_member['id'])."/".$mom_detail->id}}';">Show Feedback</button>

                              <?php break; ?>

                            @endif

                          @else
                            
                          @endif

                        @endforeach



                        @if($jk==0)
                            <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("/annual-review-mom-form/".$survey_form_id."/".$all_member['id'])}}';">Start Feedback</button>
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