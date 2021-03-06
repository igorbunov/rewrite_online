<?php

namespace App\Providers;

use App\Events\KeywordsChangedEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\UpdateKeywordsAppliedCountListener;
use App\Listeners\NotifyAdminAfterUserRegisteredNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            NotifyAdminAfterUserRegisteredNotification::class
        ],
        KeywordsChangedEvent::class => [
            UpdateKeywordsAppliedCountListener::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
