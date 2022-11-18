<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  @yield('title')
  

  <!-- Favicons -->
  <link href="{{ asset('assests/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assests/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assests/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assests/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assests/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assests/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assests/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assests/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assests/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assests/assets/css/style.css') }}" rel="stylesheet">


  <!-- Custom CSS File -->
  <link href="{{ asset('assests/assets/css/custom.css') }}" rel="stylesheet">


  <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>


  <!-- select box with search box, start here -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <!-- select box with search box, start here -->

  <!-- tags style and css and js, start here-->
  <style type="text/css">
      .bootstrap-tagsinput{
            width: 100%;
        }
        .label-info{
            background-color: #17a2b8;

        }
        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <!-- tags style and css and js, end here-->


</head>

<body>

  @include('partials.navbar')

  @include('partials.sidebar')
  
  @yield('content')

  @include('partials.footer')  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assests/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assests/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assests/assets/vendor/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('assests/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assests/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assests/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assests/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assests/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assests/assets/js/main.js') }}"></script>

  <!--=== Sweet Alert Js ===-->
  <script src="{{ asset('assests/assets/js/sweetalert.min.js') }}"></script>


  <!-- Template Main JS File -->
  <script src="{{ asset('assests/assets/js/custom.js') }}"></script>

</body>

</html>