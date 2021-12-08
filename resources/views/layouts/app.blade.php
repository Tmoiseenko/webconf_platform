<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script>
        window.echoConfig = {
            host: {!! json_encode(env('APP_URL')) !!},
            port: {!! json_encode(env('LARAVEL_ECHO_SERVER_PORT')) !!}
        };
    </script>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav mr-auto">
                    <li class="d-flex align-items-center mr-3">
                        <main-menu></main-menu>
                    </li>
                    <li class="logo-type">{{ __('front.title.main_title') }}</li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown d-none d-lg-block">
                            <button class="btn btn-sm btn-light px-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('front.title.logout') }}
                            </button>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @yield('chat')
    </div>

    <footer class="footer py-3 text-center mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="d-flex justify-content-lg-between justify-content-md-center align-items-center px-3">
                        <div class="d-flex align-items-center">
                            <div class="mr-4"><img src="/images/logo.svg" alt="INFODay2021" class="logo"></div>
                            <div class="copyright">{{ __('front.title.all_right_reserved') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 d-md-flex justify-content-lg-end justify-content-md-center">
                    <div class="copyright text-md-left">
                        <a href="mailto:inform@infocell.ru" class="text-white link">{!!  __('front.title.write_on_email') !!} inform@infocell.ru</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

<script src="https://kit.fontawesome.com/65c548e1b6.js" crossorigin="anonymous"></script>
</html>
