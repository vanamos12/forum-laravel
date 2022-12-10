<?php

namespace App\Listeners;

use App\Events\ReplyWasCreated;
use App\Models\Thread;
use App\Notifications\NewReplyNotification;

class sendNewReplyNotification
{
    
    public function handle(ReplyWasCreated $event)
    {
        //
        $thread = $event->reply->replyAble();

        $thread->author()->notify(new NewReplyNotification($event->reply));
    }
}
