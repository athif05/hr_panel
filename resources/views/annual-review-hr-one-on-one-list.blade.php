@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Annual Review HR 1:1 Member List | {{ env('MY_SITE_NAME') }}</title>

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
            		<h5 class="card-title">Annual Review HR 1:1 Member List</h5>
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
                  <div style="clear: both; height: 10px;"></div>
	            @endif

              
              <div style="clear: both; height: 10px;"></div>

              <!-- Custom Styled Validation with Tooltips -->
              <div style="float: left; width: 860px; overflow-x: scroll;">
              <table class="table datatable table-striped display nowrap" id="datatable-id" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">Member ID</th>
                    <th scope="col">Member Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Appraisal Cycle</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Department</th>
                    <th scope="col">Feedback</th>
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
						<td>
							{{ date('M-Y',strtotime($all_member['appraisal_cycle']))}}
						</td>
						<td>{{$all_member['designation_name']}}</td>
						<td>{{$all_member['department_name']}}</td>
						<td>

							<?php $j=0; $edit_id='';?>
                  @foreach($hr_one_on_one_details as $hr_one_on_one_detail)
                      
                      <?php $j=0; $edit_id='';?>

                      @if(($hr_one_on_one_detail['filled_for']==$all_member['id']) && ($hr_one_on_one_detail['filled_by']==(Auth::user()->id)))
                          
                          @if(($hr_one_on_one_detail['filled_for']==$all_member['id']) && ($hr_one_on_one_detail['filled_by']==(Auth::user()->id)) && ($hr_one_on_one_detail['status']=='2'))

                            <?php $j=2; $edit_id=$hr_one_on_one_detail['id']; break;?>

                          @else
                            <?php $j=1; $edit_id=$hr_one_on_one_detail['id']; break;?>
                          @endif

                      @else
                          
                          <?php $j=0;?>

                      @endif

                  @endforeach


                  @if($j==0)
                    <a href="{{ url('/annual-review-hr-one-on-one-form/'.$annual_review_form_id.'/'.$all_member['id'])}}">
                      <button type="button" class="btn btn-primary btn-sm">Start</button>
                    </a>
                  @elseif($j==1)
                    <a href="{{ url('/annual-review-hr-one-on-one-form-edit/'.$annual_review_form_id.'/'.$all_member['id'].'/'.$edit_id)}}">
                      <button type="button" class="btn btn-info btn-sm">Edit</button>
                    </a>
                  @elseif($j==2)
                    <a href="{{ url('/annual-review-hr-one-on-one-form-show/'.$annual_review_form_id.'/'.$all_member['id'].'/'.$edit_id)}}">
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