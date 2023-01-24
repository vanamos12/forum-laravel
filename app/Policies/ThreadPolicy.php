<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    const UPDATE = 'update';
    const DELETE = 'delete';
    const SUBSCRIBE = 'subscribe';
    const UNSUBSCRIBE = 'unsubscribe';

    public function update(User $user, Thread $thread): bool{
        return $thread->isAuthoredBy($user) || $user->isModerator() || $user->isAdmin();
    }

    public function delete(User $user, Thread $thread): bool{
        return $thread->isAuthoredBy($user) || $user->isModerator() || $user->isAdmin();
    }

    public function subscribe(User $user, Thread $thread):bool{
        return !$thread->hasSubscriber($user);
    }

    public function unsubscribe(User $user, Thread $thread):bool{
        return $thread->hasSubscriber($user);
    }

}
