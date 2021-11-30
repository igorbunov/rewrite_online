@extends('layouts.app_old')

@section('content')
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Программа для рерайта</h1>
                </div>
            </div>
            <div class="row">
                <p>Разработана уникальная программа для рерайтеров, которая подойдет как для новичков, так и для опытных рерайтеров и копирайтеров. Она поможет благополучно втянуться в работу, повысит ее продуктивность и быстроту выполнения. Рерайт программа станет настоящим помощником и будет приносить не только деньги, но и удовольствие. Разработана рерайтерами для рерайтеров.</p>
            </div>
        </div>
    </header>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 content-text">
                    <a class="btn btn-lg btn-primary" href="{{ route('projects.index') }}">НАЧАТЬ ПОЛЬЗОВАТЬСЯ</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 content-text">
                    {{-- <p>Инструкция:</p><iframe width="420" height="315" src="{{ env('ONLINE_VIDEO_LINK') }}" frameborder="0" allowfullscreen></iframe> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 content-text data1">
                    <img src="{{ asset('online_images/projects.png') }}" style="width: 100%;">
                </div>
                <div class="col-lg-6 ml-auto content-text data2">
                    <p>На главной странице вас ждет список проектов</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 content-text data2">
                    <p>Быстрое создание нового проекта</p>
                </div>
                <div class="col-lg-6 content-text data1">
                    <img src="{{ asset('online_images/creation.png') }}" style="width: 100%;">
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 content-text data1">
                    <img src="{{ asset('online_images/buttons.png') }}" style="width: 100%;">
                </div>
                <div class="col-lg-6 ml-auto content-text data2">
                    <p>Следующим шагом нужно будет перейти в редактирование вашего проекта и добавить ключевые слова и источники текстов</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 content-text data2">
                    <p>На странице ключевых слов вы добавляете слова и кол-во необходимых повторений в тексте</p>
                </div>
                <div class="col-lg-6 ml-auto content-text data1">
                    <img src="{{ asset('online_images/keywords.png') }}" style="width: 100%;">
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 content-text data1">
                    <img src="{{ asset('online_images/sources.png') }}" style="width: 100%;">
                </div>
                <div class="col-lg-6 ml-auto content-text data2">
                    <p>На странице источников можно добавить тексты с тех статей откуда вы будете черпать информацию</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 content-text data2">
                    <p>После чего можете приступать к работе. На странице редактирования проекта видны необходимые ключевые слова.
                        Также есть поле для ввода вашего оригинального текста. Все ключевые слова подсвечиваются, также как и слова
                        совпавшие в ваших источниках.<br/>Неиспользуемые ключи обновляются после сохранения проекта
                    </p>
                </div>
                <div class="col-lg-6 ml-auto content-text data1">
                    <img src="{{ asset('online_images/project.png') }}" style="width: 100%;">
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 content-text data1">
                    <img src="{{ asset('online_images/texts.png') }}" style="width: 100%;">
                </div>
                <div class="col-lg-6 ml-auto content-text data2">
                    <p>В любой момент можно посмотреть какой текст есть в ваших источниках</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 content-text data2">
                    <p>Добавлено синонимы для более миллиона русских слов. Пользоваться очень просто, выделяете текст,
                        а потом нажимаете на ссылку <a style="text-decoration: underline;" href="#">синонимы (alt + enter)</a>
                    </p>
                </div>
                <div class="col-lg-6 ml-auto content-text data1">
                    <img src="{{ asset('online_images/synonims.png') }}" style="width: 100%;">
                </div>
            </div>
        </div>
    </section>

    <section class="content-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 content-text">
                    <a class="btn btn-lg btn-primary" href="{{ route('projects.index') }}">НАЧАТЬ ПОЛЬЗОВАТЬСЯ</a>
                </div>
            </div>
        </div>
    </section>
@endsection