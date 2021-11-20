@extends('layouts.app_old')

@section('content')
    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 content-text">
                    <h2>Написать в поддержку</h2>

                    <div style="text-align: left;">
                        <form action="support/send" method="POST">
                            @csrf

                        <label for="inputInfo">Введите ваш email</label><br/>

                        <input type="text" id="inputInfo" name="email" required><br/><br/>

                        <label for="inputText">Ваше сообщение</label><br/>
                        <textarea rows="3" id="inputText" name="message" required></textarea>

                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITE_KEY') }}"></div>

                        <br/>
                        <button type="submit" class="btn btn-success">Послать сообщение</button>


                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection