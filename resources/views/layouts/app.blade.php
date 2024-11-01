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
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand bg-primary p-1 rounded-lg text-white" href="{{ url('/') }}">
                    <span class="font-weight-lighter">Videos</span> | <span class="font-weight-bold"> App</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ trans('home.home') }}
                            </a>
                        </li>
                    </ul>

                    <form class="navbar-form navbar-left form-inline" role="search" action="{{ route('video.search') }}">

                        <div class="input-group">
                            <input type="text"  name="search" class="form-control" placeholder="{{ trans('home.search_placeholder') }}" aria-label="{{ trans('home.search_placeholder') }}" aria-describedby="search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="search">{{ trans('home.search') }}</button>
                            </div>
                        </div>
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('video.store') }}">{{ trans('home.upload_video') }}</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.edit') }}">My profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1 py-4">
            @yield('content')
        </main>

        <footer class="col-md-12 text-center border-top p-4">

            <p class="text-muted mb-0">{{ trans('home.footer') }} <a href="https://www.linkedin.com/in/maria-cristina-osorio-perez-b205a5187" target="_blank" aria-label="{{ trans('home.linkedin_profile') }}">Cristina Osorio</a>.</p>

        </footer>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('js')

</body>
</html>
