@extends('layouts.master-login')

@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Reset Password | {{ env('MY_SITE_NAME') }}</title>

@endsection

@section('content')

<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assests/assets/img/logo.png')}}" alt="">
                  <span class="d-none d-lg-block">{{ env('MY_SITE_NAME') }}</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Reset My Password</h5>
                  </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="row g-3 needs-validation" novalidate>
                        @csrf

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username/Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                      </div>

                    </div>

                    
                    <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Send Password Reset Link</button>
                      
                        @if (Route::has('password.request'))
                            <a class="small mb-0" href="{{ route('login') }}">
                                {{ __('Login Here') }}
                            </a>
                        @endif

                    </div>

                    <!-- <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                    </div> -->
                  </form>

                </div>
              </div>

              

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset My Password') }}</div>

                <div class="card-body">
                    

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
