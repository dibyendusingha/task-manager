<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manger </title>
    <meta name="theme-color" content="#1b95a2">
    <meta property="og:image" content="{{ asset('dist/img/icons/icon-512x512.png') }}">
    <meta name="csrf-token" content="{{csrf_token()}}">

    @if (Auth::check()) 
      <meta name="uname" content="{{ Auth::user()->name }}" >
    @endif 

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('dist/css/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('dist/plugins/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/custom-style.css') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
  </head>

 
     <body class="layout-fixed layout-navbar-fixed text-sm">
        <div id="login">
          @yield('login')
        </div>
    </body>
 
    <script src="{{asset('dist/js/jquery.min.js')}}"></script>
    <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dist/js/adminlte.js')}}"></script> 
    <script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register("https://docapp.srkptechnologies.com/service-worker.js")
    }
</script>
  </html>