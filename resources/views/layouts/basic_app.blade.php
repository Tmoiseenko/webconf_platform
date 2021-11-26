<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="logo-wrapper"></div>

        <div class="text-center">
            <img src="/images/logo.svg" class="logo">
        </div>

        <main class="py-4">
            @yield('content')
        </main>

        @yield('chat')
    </div>

    <footer class="footer py-5 mt-5">
        <div class="container">
            <div class="row">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore tempore magnam, eum nostrum tenetur recusandae pariatur doloremque ducimus at esse fugiat, quas molestias laborum. Nobis culpa harum ut repellat deserunt!

            <div class="text-center mt-3">
                INFODay © {{ \Carbon\Carbon::now()->format('Y') }}
            </div>
            </div>
        </div>
    </footer>
</body>

<script src="https://kit.fontawesome.com/65c548e1b6.js" crossorigin="anonymous"></script>
</html>
