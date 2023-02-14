<?php

namespace App\Providers;

use App\Events\ReplyWasCreated;
use App\Events\ThreadWasCreated;
use App\Listeners\AwardPointsForCreatingReply;
use App\Listeners\AwardPointsForCreatingThread;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\sendNewReplyNotification;
use App\Listeners\sendNewThreadNotification;
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
        ],
        ReplyWasCreated::class => [
            sendNewReplyNotification::class,
            AwardPointsForCreatingReply::class,
        ],
        ThreadWasCreated::class => [
            sendNewThreadNotification::class,
            AwardPointsForCreatingThread::class,
        ],
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
