<?php

namespace App\Listeners;

use App\Events\ThreadWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendDeleteThread
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ThreadWasDeleted $event)
    {
        //
        $amount = config('points.rewards.delete_thread');
        $message = 'User created a thread';

        $author = $event->thread->author();

        $author->addPoints($amount, $message);

    }
}
