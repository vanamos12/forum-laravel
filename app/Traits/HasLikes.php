<?php 
namespace App\Traits;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLikes
{
    public function likes(){
        return $this->likesRelation;
    }

    public function likesRelation():MorphMany{
        return $this->morphMany(Like::class, 'likesRelations', 'likeable_type', 'likeable_id');
    }

    public static function bootHasLikes(){
        static::deleting(function($model){
            $model->likesRelation()->delete();
            $model->unsetRelation('likesRelations');
        });
    }

    public function isLikedBy(User $user):bool{
        return $this->likesRelation()->where('user_id', $user->id())->exists();
    }

    public function dislikedBy(User $user){
        optional($this->likesRelation()->where('user_id', $user->id()))->delete();
    }

    public function likedBy(User $user){
        $this->likesRelation()->create(['user_id' => $user->id()]);

        $this->unsetRelation('likesRelation');
    }
}