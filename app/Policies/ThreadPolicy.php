<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    const UPDATE = 'update';
    const DELETE = 'delete';

    public function update(User $user, Thread $thread): bool{
        return $thread->isAuthoredBy($user) || $user->isModerator() || $user->isAdmin();
    }

    public function delete(User $user, Thread $thread): bool{
        return $thread->isAuthoredBy($user) || $user->isModerator() || $user->isAdmin();
    }
}
