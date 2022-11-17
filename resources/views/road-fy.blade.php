@extends('layouts.master')

@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>ROAD FY | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
          <h1>ROAD FY</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">ROAD FY</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->


        
        <section class="section dashboard">
          <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
              <div class="row">


                <!-- For individual, start here -->
                <div class="col-12">
                  <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                      <h5 class="card-title">For Individual</h5>

                      <table class="table table-border">
                        <thead>
                          <tr>
                            <th scope="col">Task</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td>
                            	Quarterly Survey - Oct-22
                            </td>
                            <td>
                            	<span class="badge bg-success"> + Completed</span>
                            </td>
                            <td>
                            	<!-- <span class="badge bg-success"> + View Survey</span> -->
                            	
                            	<span class="badge bg-warning" onclick="location.href = '{{ url("multistep-form")}}';" style="cursor: pointer;"> + Fill Survey</span>
                            	
                            </td>
                          </tr>

                          <tr>
                            <td>
                            	Quarterly HR 1:1 - Oct-22
                            </td>
                            <td>
                            	&nbsp;
                            </td>
                            <td>
                            	<span class="badge bg-success"> + View HR 1:1</span>
                            </td>
                          </tr>


                          <tr>
                            <td>
                            	Review Presentation
                            </td>
                            <td>
                            	<span class="badge bg-success"> <i class="bi bi-download"></i> Download</span>
                            </td>
                            <td>
                            	<span class="badge bg-warning"> <i class="bi bi-upload"></i> Upload</span>
                            </td>
                          </tr>



                          <tr>
                            <td>
                            	Stakeholder Feedback Form
                            </td>
                            <td>
                            	&nbsp;
                            </td>
                            <td>
                            	<span class="badge bg-success"> Fill Feedback + </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>

                    </div>

                  </div>
                </div>
                <!-- For individual, end here -->



                @if((Auth::user()->role_id=='3') || (Auth::user()->role_id=='5') || (Auth::user()->role_id=='6'))
                <!-- For manager/head, start here -->
                <div class="col-12">
                  <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                      <h5 class="card-title">For Manager/Head</h5>

                      <table class="table table-border">
                        <thead>
                          <tr>
                            <th scope="col">Task</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td>
                            	Manager Feedback Form
                            </td>
                            <td>
                            	<span class="badge bg-success"> + Pending</span>
                            </td>
                            <td>
                            	<!-- <span class="badge bg-success"> + View Survey</span> -->
                            	<span class="badge bg-warning"> Fill Feedbacks +</span>
                            </td>
                          </tr>

                          <tr>
                            <td>
                            	MOM Review
                            </td>
                            <td>
                            	&nbsp;
                            </td>
                            <td>
                            	<span class="badge bg-warning"> Fill MOM +</span>
                            </td>
                          </tr>

                        </tbody>
                      </table>

                    </div>

                  </div>
                </div>
                <!-- For manager/head, end here -->
                @endif


                @if((Auth::user()->role_id=='5') || (Auth::user()->role_id=='6'))
                <!-- For hr, start here -->
                <div class="col-12">
                  <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                      <h5 class="card-title">For HR</h5>

                      <table class="table table-border">
                        <thead>
                          <tr>
                            <th scope="col">Task</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td>
                            	HR 1:1 Form
                            </td>
                            <td>
                            	<span class="badge bg-success"> + Pending</span>
                            </td>
                            <td>
                            	<!-- <span class="badge bg-success"> + View Survey</span> -->
                            	<span class="badge bg-warning"> Fill Feedbacks +</span>
                            </td>
                          </tr>

                        </tbody>
                      </table>

                    </div>

                  </div>
                </div>
                <!-- For hr, end here -->
                @endif


              </div>
            </div><!-- End Left side columns -->

           

          </div>
        </section>
        

    </main><!-- End #main -->
@endsection
