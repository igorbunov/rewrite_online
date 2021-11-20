<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-67999752-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-67999752-2');
    </script>

    <meta name="yandex-verification" content="740e370e82dd3be0" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="Рерайт онлайн, Рерайт, Рерайтинг, Программа для рерайта, Программа для рерайтеров, Начинающим рерайтерам, Рерайтер" />
    <meta name="author" content="igorbunov.ua@gmail.com" />
    <meta name="description" content="Данный сайт содержит информацию для начинающих и продвинутых рерайтеров" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Программа для рерайта') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-highlighttextarea.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawasome.min.css') }}">

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">

    <script src='https://www.google.com/recaptcha/api.js'></script>

    @yield('styles')
</head>
<body>
    <div class="main-container">
        @yield('content')

        <br/>
        <br/>

        <section class="content-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 content-text">
                        <a href="{{ url('/') }}">На главную</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/contacts') }}">Контакты</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/return') }}">Условия возврата</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/about') }}">О компании</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/support') }}">Поддержка</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ url('/license') }}">Пользовательское соглашение</a>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery-highlighttextarea.min.js') }}"></script>
    <script src="{{ asset('js/pre_activate.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        const TOKEN = "{{ csrf_token() }}";

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
