@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>MOM | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
      .dataTable-table {
          max-width: 1300px!important;
          width: 950px!important;
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
                        @foreach($mom_form_details as $mom_form_detail)
                        
                          @if(($mom_form_detail['user_id']==$all_member['id']) )

                          <?php $jk=1;?>
         
                            @if($mom_form_detail['status']=='1')

                              <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/manager-mom/".$all_member['id'])}}';">Edit MOM</button>

                            @elseif($mom_form_detail['status']=='2')

                              <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/manager-mom-form-show/".$all_member['id']."/".$mom_form_detail['id'])}}';">Show MOM</button>

                            @endif

                          @else
                            
                          @endif

                        @endforeach

                        @if($jk==0)
                        <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("/manager-mom/".$all_member['id'])}}';">Start MOM</button>
                        @endif

                        <!-- @if($all_member['mom_id'])

                          @if($all_member['confirmation_mom_status']=='1')

                            <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/manager-mom/".$all_member['id'])}}';">Edit MOM</button>

                          @elseif($all_member['confirmation_mom_status']=='2')

                            <button type="button" class="btn btn-info btn-sm" onclick="location.href = '{{ url("/manager-mom-form-show/".$all_member['id']."/".$all_member['mom_id'])}}';">Show MOM</button>

                          @endif

                          
                        @else
                          <button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("/manager-mom/".$all_member['id'])}}';">Start MOM</button>
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