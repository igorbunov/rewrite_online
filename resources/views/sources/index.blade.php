@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Источники текста') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary"><i class="fas fa-reply"></i></a>
                    <a href="{{ route('projects.sources.create', $project) }}" class="btn btn-primary">Добавить источник текста</a>

                    <br/>
                    <br/>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Название</th>
                                <th>Текст с источника</th>
                                <th style="width: 90px;"></th>
                            </tr>
                            @forelse ($sources as $sources)
                                <tr>
                                    <td>{{ $sources->name }}</td>
                                    <td>{{ Str::limit($sources->text, 260) }}</td>
                                    <td>
                                        <a href="{{ route('projects.sources.edit', ['project' => $project, 'source' => $sources]) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form
                                            class="d-inline-flex"
                                            onsubmit="return confirm('Вы уверены?');"
                                            method="POST"
                                            action="{{ route('projects.sources.destroy', ['project' => $project, 'source' => $sources]) }}">
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