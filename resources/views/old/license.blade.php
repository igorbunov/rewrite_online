@extends('layouts.app_old')

@section('content')
    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 content-text">
                    @include('old.license_part')
                    @yield('license')
                </div>
            </div>
        </div>
    </section>


    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9224550511530884"
        crossorigin="anonymous"></script>
    <!-- Шапка на рерайте -->
    <ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-9224550511530884"
        data-ad-slot="9527998559"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

@endsection