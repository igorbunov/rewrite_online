@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Поддержка') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('support.send') }}" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="message" class="col-md-2 col-form-label text-md-left">{{ __('Сообщение') }}</label>

                            <div class="col-md-10">
                                <textarea id="message" name="message" cols="30" rows="10"
                                    class="form-control" required autofocus autocomplete="false"></textarea>
                            </div>
                        </div>

                        <br/>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Отправить') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection