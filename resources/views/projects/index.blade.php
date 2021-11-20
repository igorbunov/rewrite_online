@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Мои проекты') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('projects.create') }}" class="btn btn-primary">Добавить проект</a>

                    <br/>
                    <br/>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Название</th>
                                <th>Текст</th>
                                <th style="width: 90px;"></th>
                            </tr>
                            @forelse ($projects as $project)
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ Str::limit($project->text, 260) }}</td>
                                    <td>
                                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form
                                            class="d-inline-flex"
                                            onsubmit="return confirm('Вы уверены?');"
                                            method="POST"
                                            action="{{ route('projects.destroy', $project->id) }}">
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
                                    <td colspan="3">No records</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection