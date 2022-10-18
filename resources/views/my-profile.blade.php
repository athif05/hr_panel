@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>My Profile | {{ env('MY_SITE_NAME') }}</title>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

	            @if($user_details['profile_image'])
	            	<!-- <img src="{{ str_replace('public/', '', asset('')).$user_details['profile_image'] }}" alt="Profile" class="rounded-circle"> -->

                <img src="{{ asset($user_details['profile_image']) }}" alt="Profile" class="rounded-circle">

                <!-- <img src="{{ asset('storage/all-profile-images/4SjwBKbRgqo3HSdXIvcRWOl2MW4ovtD95GEne44F.jpg') }}" alt="Profile" class="rounded-circle"> -->

	            @else
	            	<img src="{{ asset('assests/assets/img/no-user-profile.png') }}" alt="Profile" class="rounded-circle">
	            @endif

              
              <h2>{{ $user_details['first_name'].' '.$user_details['last_name']}}</h2>
              <h3>{{ $user_details['designation_name'] }}</h3>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->

              @if(session()->has('success_msg'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              @if(session()->has('error_msg'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error_msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif


              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile Image</button>
                </li>

               <!--  <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li> -->

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <!-- <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['first_name'].' '.$user_details['last_name']}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['email'] }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Joining Date</div>
                    <div class="col-lg-9 col-md-8">
                      @if($user_details['joining_date'])
                        {{ date('Y-m-d', strtotime($user_details['joining_date']))}}
                      @endif
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Manager Name</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['manager_name']}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Member ID</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['member_id']}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['designation_name']}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company Name</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['company_name']}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company Location</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['location_name']}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Member Type</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['employee_type']}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{ $user_details['gender']}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" action="{{ route('upload-profile-image')}}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                	@csrf
                	<input type="hidden" name="user_id" id="user_id" value="{{ $user_details['id'] }}">

                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">

                        <input type="file" class="form-control" name="image" id="image" accept="image/png, image/jpeg, image/jpg" required>

                        <!-- <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div> -->
                      </div>
                    </div>

                    
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Update Image</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection