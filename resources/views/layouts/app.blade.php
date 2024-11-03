<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('css')

</head>
<body>
    <div class="min-vh-100 d-flex flex-column " id="app">
        @include('components.navbar')

        <main class="flex-grow-1 py-4">
            @yield('content')
        </main>

        <footer class="col-md-12 text-center border-top p-4">

            <p class="text-muted mb-0">{{ trans('home.footer') }} <a href="https://www.linkedin.com/in/maria-cristina-osorio-perez-b205a5187" target="_blank" aria-label="{{ trans('home.linkedin_profile') }}">Cristina Osorio</a>.</p>

        </footer>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}?v={{ time() }}"></script>
    @yield('js')

</body>
</html>
