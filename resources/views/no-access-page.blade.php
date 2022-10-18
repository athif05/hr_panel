@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>No Access | {{ env('MY_SITE_NAME') }}</title>

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
            		<h5 class="card-title">No Access</h5>
            	</div>

            	<div style="clear: both;"></div>


              
              	<div style="clear: both; height: 10px;"></div>

            	<p>You can't see data of this member...</p>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection