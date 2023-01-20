<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Reply;
use App\Exceptions\CannotLikeItem;

class LikeReplyJob 
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
        //
        if ($this->reply->isLikedBy($this->user)){
            throw CannotLikeItem::alreadyLiked('reply');
        }

        $this->reply->likedBy($this->user);
    }
}
