<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BookDoc | Log in</title>
  <meta name="theme-color" content="#1b95a2">
  <meta property="og:image" content="{{ asset('dist/img/icons/icon-512x512.png') }}">

  <link rel="icon" type="image/png" sizes="72x72" href="{{ asset('dist/img/icons/icon-72x72.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('dist/img/icons/icon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('dist/img/icons/icon-128x128.png') }}">
  <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('dist/img/icons/icon-144x144.png') }}">
  <link rel="icon" type="image/png" sizes="152x152" href="{{ asset('dist/img/icons/icon-152x152.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('dist/img/icons/icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="384x384" href="{{ asset('dist/img/icons/icon-384x384.png') }}">
  <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('dist/img/icons/icon-512x512.png') }}">
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('dist/css/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Custom style -->
  <link rel="stylesheet" href="{{ asset('dist/css/custom-style.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="hold-transition login-page">


<div id="login">
@yield('content')
</div>


<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('dist/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script> 
<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("https://docapp.srkptechnologies.com/service-worker.js")
    }
</script>
</body>
</html>