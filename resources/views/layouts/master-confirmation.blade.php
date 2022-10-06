<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- Favicons -->
<link href="{{ asset('assests/assets/img/favicon.png') }}" rel="icon">

  @yield('title')
  
<!-- Bootstrap -->
<link href="{{ str_replace('public/', '', asset('resources/views/confirmation-process/css/bootstrap.min.css')) }}" rel="stylesheet">
<link href="{{ str_replace('public/', '', asset('resources/views/confirmation-process/css/font-awesome.min.css')) }}" rel="stylesheet">
<!-- custom scrollbar stylesheet -->
<link href="{{ str_replace('public/', '', asset('resources/views/confirmation-process/css/jquery.mCustomScrollbar.css')) }}" rel="stylesheet">
<link href="{{ str_replace('public/', '', asset('resources/views/confirmation-process/css/style.css')) }}" rel="stylesheet">

</head>

<body background="{{ str_replace('public/', '', asset('resources/views/confirmation-process/img/bg.jpg')) }}">

  @include('confirmation-process.partials.header')
  
  @yield('content')

  @include('confirmation-process.partials.footer')  

  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  <!-- Include all compiled plugins (below), or include individual files as needed --> 
  <script src="{{ str_replace('public/', '', asset('resources/views/confirmation-process/js/bootstrap.min.js')) }}"></script> 
  <script src="{{ str_replace('public/', '', asset('resources/views/confirmation-process/js/timer.js')) }}"></script> 
  <!-- custom scrollbar plugin --> 
  <script src="{{ str_replace('public/', '', asset('resources/views/confirmation-process/js/jquery.mCustomScrollbar.concat.min.js')) }}"></script>

</body>

</html>