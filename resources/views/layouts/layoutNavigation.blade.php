<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
   
    <title>Lara-Vue3 | @yield('title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

     <!-- Link and script start-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">   
     <!-- Link and script end-->

       <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="dist/css/sweetalert2.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="dist/css/custom-style.css">
   

</head>
 <body class="layout-fixed layout-navbar-fixed sidebar-mini text-sm layout-footer-fixed">

      <!-- Dashboard start -->
          <div id="dashboard">
            @yield('dashboard')
          </div>
      <!-- Dashboard end -->
<!-- jQuery -->
<script src="dist/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- SweetAlert2 -->
<script src="dist/js/sweetalert2.min.js"></script>
<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("https://docapp.srkptechnologies.com/service-worker.js")
    }
</script>


    </body>
</html>