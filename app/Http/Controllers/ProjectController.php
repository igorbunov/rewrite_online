<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\TextService;
use App\Services\KeywordsService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectTextRequest;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        auth()->user()->projects()->create($request->validated());

        return redirect()->route('projects.index')->withStatus('Проект добавлен');
    }

    public function edit(Project $project)
    {
        $project->load('sources');
        $project->load('keywords');

        $doneKeysCount = 0;
        $unusedKeywords = '';

        if (!empty($project->keywords)) {
            $keywordsService = new KeywordsService($project->keywords->toArray(), new TextService($project->text));

            $usedKeys = $keywordsService->calculateUsedKeywords();

            foreach ($project->keywords as $keyword) {
                foreach ($usedKeys as $keyw) {
                    if ($keyword->id == $keyw['id']) {
                        if ($keyword->applied != $keyw['applied']) {
                            $keyword->applied = $keyw['applied'];
                            $keyword->save();
                        }

                        if ($keyw['applied'] >= $keyword->needed) {
                            $doneKeysCount++;
                        }
                    }
                }
            }

            $unusedKeywords = $keywordsService->loadUnusedKeywordsByProjectAsString();
        }

        $keywordsCompletion = $doneKeysCount . ' из ' . $project->keywords->count();


        $allKeywordsAsArray = [];
        $notUniqueWordsAsArray = [];

        if (!empty($project->keywords) and $project->highlight_keys > 0) {
            foreach ($project->keywords as $keyword) {
                $allKeywordsAsArray[] = $keyword->name;
            }
        }

        if ($project->highlight_source > 0) {
            foreach ($project->sources as $source) {
                $subres = (new TextService($source->text))->loadUniqueWordsAsArray();

                foreach ($subres as $word => $v) {
                    if (mb_strlen($word) > 3
                        and !in_array($word, $allKeywordsAsArray)
                    ) {
                        $notUniqueWordsAsArray[$word] = 0;
                    }
                }
            }

            $notUniqueWordsAsArray = array_keys($notUniqueWordsAsArray);
            // $notUniqueWordsAsArray = array_slice($notUniqueWordsAsArray, 20, 50);
            // dump($notUniqueWordsAsArray);
        }

        return view('projects.edit', compact(
            'project',
            'unusedKeywords',
            'keywordsCompletion',
            'allKeywordsAsArray',
            'notUniqueWordsAsArray'
        ));
    }

    public function destroy(Project $project)
    {
        abort_if(auth()->id() != $project->user_id, 401);

        $project->keywords()->delete();
        $project->delete();

        return redirect()->route('projects.index')->withStatus('Проект удален');
    }

    public function updateText(Project $project, UpdateProjectTextRequest $request)
    {
        abort_if(auth()->id() != $project->user_id, 401);

        $project->update($request->validated());

        return redirect()->route('projects.edit', $project); // ->withStatus('Данные сохранены')
    }
}
