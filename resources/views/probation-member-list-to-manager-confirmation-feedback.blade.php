@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Confirmation Feedback | {{ env('MY_SITE_NAME') }}</title>

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
            		<h5 class="card-title">Probation Member List For Confirmation Feedback</h5>
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
                        <?php $jk=0;?>

                        @foreach($confirmation_feedback_form_details as $confirmation_feedback_form_detail)
                        
                          @if(($confirmation_feedback_form_detail['user_id']==$all_member['id']) && ($confirmation_feedback_form_detail['manager_id'] == (Auth::user()->id)) )

                          <?php $jk=1;?>
         
                            @if($confirmation_feedback_form_detail['status']=='1')

                              <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/confirmation-feedback-form/".$all_member['id'])}}';">Edit Feedback</button> <?php break; ?>

                            @elseif($confirmation_feedback_form_detail['status']=='2')

                              <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/confirmation-feedback-form-show/".$all_member['id']."/".$confirmation_feedback_form_detail['id'])}}';">Show Feedback</button>

                              <?php break; ?>

                            @endif

                          @else
                            
                          @endif

                        @endforeach



                        @if($jk==0)
                            <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("/confirmation-feedback-form/".$all_member['id'])}}';">Start Feedback</button>
                        @endif

                        <!-- @if($all_member['feedback_id'])

                          @if($all_member['confirmation_feedback_forms_status']=='1')

                            <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/confirmation-feedback-form/".$all_member['id'])}}';">Edit Feedback</button>

                          @elseif($all_member['confirmation_feedback_forms_status']=='2')

                            <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/confirmation-feedback-form-show/".$all_member['id']."/".$all_member['feedback_id'])}}';">Show Feedback</button>

                          @endif

                        @else
                          <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("/confirmation-feedback-form/".$all_member['id'])}}';">Start Feedback</button>
                        @endif -->
          							
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