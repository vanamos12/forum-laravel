<?php

namespace App\Jobs;

use App\Models\Thread;
use App\Models\User;

class UnlikeThreadJob
{
    private $thread;
    private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Thread $thread, User $user)
    {
        //
        $this->thread = $thread;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->thread->dislikedBy($this->user);
    }
}
