<?php

namespace App\Jobs;

use App\Models\Reply;
use App\Models\User;

class UnlikeReplyJob
{
    private $reply;
    private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Reply $reply, User $user)
    {
        //
        $this->reply = $reply;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->reply->dislikedBy($this->user);
    }
}
