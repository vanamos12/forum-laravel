<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Models\SubscriptionAble;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SubscribeToSubscriptionAble implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $subscriptionAble;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, SubscriptionAble $subscriptionAble)
    {
        //
        $this->user = $user;
        $this->subscriptionAble = $subscriptionAble;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $subscription = new Subscription();
        $subscription->userRelation()->associate($this->user);
        $this->subscriptionAble->subscriptionsRelation()->save($subscription);
    }
}
