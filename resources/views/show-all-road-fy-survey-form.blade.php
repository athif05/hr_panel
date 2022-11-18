@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Manage ROAD Survey Question| {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        

        <div class="col-lg-12">

          

          <div class="card">
            <div class="card-body">

            	<div class="col-lg-6" style="float: left;">
            		<h5 class="card-title">Manage ROAD Survey Question</h5>
            	</div>

            	<div class="col-lg-6" style="float: right; text-align: right; padding-top: 12px;">
            		<button type="button" class="btn btn-primary btn-sm" onclick="location.href = '{{ url("add-new-road-fy-survey-form")}}';">Add New Survey Question</button>		
            	</div>

            	<div style="clear: both;"></div>

            	@if(session()->has('success_msg'))
	              <div class="alert alert-success alert-dismissible" style="text-align: left; padding: 5px 15px 5px 10px;">
	                {{ session()->get('success_msg') }}
	                </div>
	            @endif
              

              <!-- Custom Styled Validation with Tooltips -->
              <table class="table datatable table-striped ">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Appraisal Cycle</th>
                    <th scope="col">No of Section</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $j=1;?> 
                @foreach($roadfys as $roadfy)
                    <tr>
                      <th scope="row"><?php echo $j;?>.</th>
                      <td>
                        <a href="{{ url('edit-road-fy-survey-form/'.$roadfy->id)}}" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
                          {{ $roadfy->appraisal_cycle }}
                        </a>
                      </td>
                      <td>
                          {{ $roadfy->no_of_section }}
                      </td>
                      <td>
                          {{ $roadfy->role_name }}
                      </td>
                      <td>
                        
                        <label class="switch">
                          <input type="checkbox" id="id_{{ $roadfy->id }}" @if($roadfy->status=='1') checked @endif onclick="status_update_funtion({{ $roadfy->id }}, 'road_fys')">
                          <span class="slider round"></span>
                        </label>

                        
                      </td>
                      <td>
                        
                        <label class="switch">
                          <input type="checkbox" id="del_{{ $roadfy->id }}" @if($roadfy->is_deleted=='1') checked @endif onclick="delete_function({{ $roadfy->id }}, 'road_fys')">
                          <span class="slider round"></span>
                        </label>

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