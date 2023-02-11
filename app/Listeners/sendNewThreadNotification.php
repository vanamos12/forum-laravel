<?php

namespace App\Listeners;

use App\Events\ThreadWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewThreadNotification;

class sendNewThreadNotification
{
    

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ThreadWasCreated $event)
    {
        //
        $author = $event->thread->author();

        foreach($author->followers() as $follower){
            $follower->notify(new NewThreadNotification($event->thread));
        }

    }
}
