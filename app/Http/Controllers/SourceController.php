<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Project;
use App\Http\Requests\StoreSourceRequest;
use App\Http\Requests\UpdateSourceRequest;

class SourceController extends Controller
{
    public function index(Project $project)
    {
        abort_if(auth()->id() != $project->user_id, 401);

        $sources = $project->sources;

        return view('sources.index', compact('project', 'sources'));
    }

    public function create(Project $project)
    {
        abort_if(auth()->id() != $project->user_id, 401);

        return view('sources.create', compact('project'));
    }

    public function store(StoreSourceRequest $request, Project $project)
    {
        abort_if(auth()->id() != $project->user_id, 401);

        $project->sources()->create($request->validated());

        return redirect()->route('projects.sources.index', $project)->withStatus('Источник добавлен');
    }

    public function edit(Project $project, Source $source)
    {
        abort_if(auth()->id() != $project->user_id, 401);
        abort_if($project->id != $source->project_id, 404);

        return view('sources.edit', compact('project', 'source'));
    }

    public function update(UpdateSourceRequest $request, Project $project, Source $source)
    {
        abort_if(auth()->id() != $project->user_id, 401);
        abort_if($project->id != $source->project_id, 404);

        $source->update($request->validated());

        return redirect()->route('projects.sources.index', $project)->withStatus('Источник изменен');
    }

    public function destroy(Project $project, Source $source)
    {
        abort_if(auth()->id() != $project->user_id, 401);
        abort_if($project->id != $source->project_id, 404);

        $source->delete();

        return redirect()->route('projects.sources.index', $project)->withStatus('Источник удален');
    }
}
