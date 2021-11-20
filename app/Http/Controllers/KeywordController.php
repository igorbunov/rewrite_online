<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Project;
use App\Events\KeywordsChangedEvent;
use App\Http\Requests\StoreKeywordRequest;
use App\Http\Requests\UpdateKeywordRequest;

class KeywordController extends Controller
{
    public function index(Project $project)
    {
        abort_if(auth()->id() != $project->user_id, 401);

        $keywords = $project->keywords;

        return view('keywords.index', compact('project', 'keywords'));
    }

    public function create(Project $project)
    {
        abort_if(auth()->id() != $project->user_id, 401);

        return view('keywords.create', compact('project'));
    }

    public function store(StoreKeywordRequest $request, Project $project)
    {
        abort_if(auth()->id() != $project->user_id, 401);
        // TODO: add check for unique keyword in this project
        $project->keywords()->create($request->validated());

        event(new KeywordsChangedEvent($project));

        return redirect()->route('projects.keywords.index', $project)->withStatus('Ключевое слово добавлено');
    }

    public function edit(Project $project, Keyword $keyword)
    {
        abort_if(auth()->id() != $project->user_id, 401);
        abort_if($project->id != $keyword->project_id, 404);

        return view('keywords.edit', compact('project', 'keyword'));
    }

    public function update(UpdateKeywordRequest $request, Project $project, Keyword $keyword)
    {
        abort_if(auth()->id() != $project->user_id, 401);
        abort_if($project->id != $keyword->project_id, 404);

        // TODO: add check for unique keyword in this project

        if ($request->name != $keyword->name) {
            $keyword->update($request->validated() + ['applied' => 0]);
        } else {
            $keyword->update($request->validated());
        }

        event(new KeywordsChangedEvent($project));

        return redirect()->route('projects.keywords.index', $project)->withStatus('Ключевое слово изменено');
    }

    public function destroy(Project $project, Keyword $keyword)
    {
        abort_if(auth()->id() != $project->user_id, 401);
        abort_if($project->id != $keyword->project_id, 404);

        $keyword->delete();

        return redirect()->route('projects.keywords.index', $project)->withStatus('Ключевое слово удалено');
    }
}
