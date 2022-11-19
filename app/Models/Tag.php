<?php

namespace App\Models;

use App\Traits\HasTags;
use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory;
    use HasTimestamps;
    
    protected $table = 'tags';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function name():string{
        return $this->name;
    }

    public function id():int{
        return $this->id;
    }

    public function slug():string{
        return $this->slug;
    }

    public function threads():MorphToMany{
        return $this->morphedByMany(Thread::class, 'taggable');
    }

}
