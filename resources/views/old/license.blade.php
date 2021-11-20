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
@endsection