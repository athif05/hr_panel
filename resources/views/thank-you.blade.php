@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Interview Survey | {{ env('MY_SITE_NAME') }}</title>

    <style type="text/css">
    	.form-check-input[type=radio] {
		  margin-left: 30px;
		  border-radius: 50%;
		}

    .text-danger{
      font-size: 13px!important;
    }
    </style>
@endsection


@section('content')
<main id="main" class="main">

    <!-- <div class="pagetitle">
      <h1>Blank Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div> --><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12" style="height: 420px;">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Thank you...</h5>
              <!-- <p>
              	Thanks, for giving your valuable time for us.
              </p> -->
              @if(session()->has('thank_you'))
              <P>{{ session()->get('thank_you') }}</P>
              @endif
            </div>
          </div>

        </div>

      </div>
    </section>

  </main>
@endsection