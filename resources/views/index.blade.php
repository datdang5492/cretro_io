<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cretro - Fun Retrospective</title>
        <meta content="" name="descriptison">
        <meta content="" name="keywords">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        {{--<script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>--}}
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'is_authenticated' => Auth::check()
        ]) !!};
        </script>

    </head>
    <body>
        <div id="app"></div>
        <input type="hidden" name="login-status" data-login-status ="{{ Auth::check() }}">
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- JavaScript Dependencies -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script src="{{ URL::asset('js/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('js/jquery.easing/jquery.easing.min.js') }}"></script>
        <script src="{{ URL::asset('js/owl.carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ URL::asset('js/venobox/venobox.min.js') }}"></script>
        <script src="{{ URL::asset('js/aos/aos.js') }}"></script>
        <script src="{{ URL::asset('js/main.js') }}"></script>
    </body>
</html>
