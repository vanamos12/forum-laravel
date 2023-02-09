<?php

namespace App\Models;

use App\Traits\HasFollows;
use App\Traits\HasTimestamps;
use App\Traits\ModelHelpers;
use Brick\Math\BigInteger;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasFollows;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use ModelHelpers;
    use HasTimestamps;

    const DEFAULT = 1;
    const MODERATOR = 2;
    const ADMIN = 3;

    const TABLE = 'users';
    protected $table = self::TABLE;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function id(){
        return $this->id;
    }

    public function type():int{
        return (int) $this->type;
    }

    public function name():string{
        return (string) $this->name;
    }

    public function username():string{
        return (string) $this->username;
    }

    public function isModerator():bool {
        return $this->type() === self::MODERATOR;
    }

    public function isAdmin():bool{
        return $this->type() === self::ADMIN;
    }

    public function email():string{
        return $this->email;
    }

    public function emailAddress():string{
        return $this->email;
    }

    public function threads(){
        return $this->threadsRelation;
    }

    public function latestThreads(int $amount = 10){
        return $this->threadsRelation()->latest()->limit($amount)->get();
    }

    public function threadsRelation():HasMany{
        return $this->hasMany(Thread::class, 'author_id');
    }

    public function countThreads():int{
        return $this->threadsRelation()->count();
    }

    public function deleteThreads(){
        foreach($this->threads() as $thread){
            $thread->delete();
        }
    }

    public function latestThreads2()
    {
        return Thread::Where('author_id', $this->id())->orderBy('id', 'desc')->paginate(10);
    }

    public function replies(){
        return $this->replyAble;
    }

    public function replyAble():HasMany{
        return $this->hasMany(Reply::class, 'author_id');
    }

    public function latestReplies(int $amount = 10){
        return $this->replyAble()->latest()->limit($amount)->get();
    }

    public function deleteReplies(){
        foreach($this->replyAble()->get() as $reply){
            $reply->delete();
        }
    }

    public function countReplies() :int{
        return $this->replyAble()->count();
    }
}
