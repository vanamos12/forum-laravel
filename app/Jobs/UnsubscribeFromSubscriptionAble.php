<?php

namespace App\Jobs;

use App\Models\SubscriptionAble;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UnsubscribeFromSubscriptionAble implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $subsctiptionAble;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, SubscriptionAble $subscriptionAble)
    {
        //
        $this->user = $user;
        $this->subsctiptionAble = $subscriptionAble;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->subsctiptionAble->subscriptionsRelation()
            ->where('user_id', $this->user->id())
            ->delete();
    }
}
