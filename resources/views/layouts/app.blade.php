<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">


    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css" rel="stylesheet">
    {{-- toaster --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- Custome CSS -->
    <link type="text/css" href="{{ asset('css/custom.css') }}" rel="stylesheet">
    {{--    stack css --}}
    @stack('css')
</head>

<body class="{{ $class ?? '' }}">
@auth()
    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          style="display: none;">
        @csrf
    </form>
    @include('layouts.navbars.sidebar')
@endauth

<div class="main-content">
    @include('layouts.navbars.navbar')
    @yield('content')
</div>

@guest()
    @include('layouts.footers.guest')
@endguest

<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')

<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>


<!-- Argon JS -->
<script src="{{ asset('argon') }}/js/argon.js"></script>
{{-- toaster --}}
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"> </script>
<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true,
            "timeOut": "1000"
        }
    toastr.{{ session('type') }}("{{ session('message') }}");
    @endif

</script>
</body>

</html>
