<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Session;

trait HasFollows{

    public function follow(User $user){
        return $this->follows()->save($user);
    }

    public function unfollow(User $user){
        return $this->follows()->detach($user);
    }

    public function follows(): BelongsToMany{
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')
                    ->withTimestamps();
    }

    public function isFollowing(User $user){
        return $this->follows()
                    ->where('following_user_id', $user->id())
                    ->exists();
    }

    public function toggleFollow(User $user){
        if ($this->isFollowing($user)){
            Session::flash('success', "you succesfully unfollowed $user->name");
            return $this->unfollow($user);
        }
        
        Session::flash('success', "you succesfully followed $user->name");
        return $this->follow($user);
    }
}