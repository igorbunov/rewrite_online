<?php

namespace App\Listeners;

use App\Services\TextService;
use App\Services\KeywordsService;
use App\Events\KeywordsChangedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateKeywordsAppliedCountListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\KeywordsChangedEvent  $event
     * @return void
     */
    public function handle(KeywordsChangedEvent $event)
    {
        $project = $event->project;

        $project->load('keywords');

        if (!empty($project->keywords) and !empty($project->text)) {
            $keywordsService = new KeywordsService($project->keywords->toArray(), new TextService($project->text));

            $usedKeys = $keywordsService->calculateUsedKeywords();

            foreach ($project->keywords as $keyword) {
                foreach ($usedKeys as $keyw) {
                    if ($keyword->id == $keyw['id']) {
                        if ($keyword->applied != $keyw['applied']) {
                            $keyword->applied = $keyw['applied'];
                            $keyword->save();
                        }
                    }
                }
            }
        }
    }
}
