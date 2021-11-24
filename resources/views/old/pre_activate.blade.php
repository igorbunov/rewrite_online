@extends('layouts.app_old')

@section('content')
    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 content-text activation">
                    <h2>Активация</h2>

                    <label for="key-field" style="font-weight: bold;color: blue; font-size: 16px;">Сумма оплаты: {{ env('LIQ_PAY_PAY_AMOUNT') }} руб.</label>
                    <br/>
                    <span style="font-size: 18px;">Введите ваш ключ:</span>
                    <input style="padding: 13px;vertical-align: top;" type="text" name="key" id="pre-activate-key" />
                    <button type="button" class="btn btn-primary btn-small" id="pre-activate-next-btn">Далее</button>

                    <br/>
                    <br/>
                    <img src="{{ asset('images/cards.jpeg') }}" style="width: 170px;" />
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