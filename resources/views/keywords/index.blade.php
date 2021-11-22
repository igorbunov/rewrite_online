@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Ключевые слова') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary"><i class="fas fa-reply"></i></a>
                    <a href="{{ route('projects.keywords.create', $project) }}" class="btn btn-primary">Добавить ключевое слово</a>

                    <br/>
                    <br/>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Слово</th>
                                <th>Необходимое кол-во</th>
                                <th>Совпадений в проекте</th>
                                <th style="width: 90px;"></th>
                            </tr>
                            @forelse ($keywords as $keyword)
                                <tr>
                                    <td>{{ $keyword->name }}</td>
                                    <td>{{ $keyword->needed }}</td>
                                    <td>{{ $keyword->applied }}</td>
                                    <td>
                                        <a href="{{ route('projects.keywords.edit', ['project' => $project, 'keyword' => $keyword]) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form
                                            class="d-inline-flex"
                                            onsubmit="return confirm('Вы уверены?');"
                                            method="POST"
                                            action="{{ route('projects.keywords.destroy', ['project' => $project, 'keyword' => $keyword]) }}">
                                            @csrf
                                            @method('DELETE')

                                            <a href="#" onclick="$(this).parent().submit();" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Нет записей</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection