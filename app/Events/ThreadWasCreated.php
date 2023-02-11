<?php

namespace App\Events;

use App\Models\Thread;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

class ThreadWasCreated
{
    use SerializesModels;

    public $thread;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Thread $thread)
    {
        //
        $this->thread = $thread;
    }

    
}
