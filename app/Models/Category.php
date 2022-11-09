<?php

namespace App\Models;

use App\Traits\HasTimestamps;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use HasTimestamps;

    protected $fillable = ['name', 'slug'];
/*
    public function getCreatedAtAttribute($date){
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }
*/
    public function threads(): HasMany 
    {
        return $this->hasMany(Thread::class);
    }

}
