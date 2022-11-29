<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HasTags;
use App\Traits\HasAuthor;
use App\Traits\HasReplies;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory;
    use HasTags;
    use HasAuthor;
    use HasReplies;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'category_id',
        'author_id',
    ];

    protected $with = [
        'authorRelation',
        'category',
        'tagsRelation'
    ];

    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    } 

    public function excerpt(int $limit = 250):string{
        return Str::limit(strip_tags($this->body()), $limit);
    }

    public function title():String{
        return $this->title;
    }

    public function body():string{
        return $this->body;
    }

    public function slug():string{
        return $this->slug;
    }

    public function diffForHumansCreatedAt():string{
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans();
    }

    public function delete(){
        $this->removeTags();
        parent::delete();
    }

    public function scopeForTag(Builder $query, string $tag):Builder{
        return $query->whereHas('tagsRelation', function($query) use($tag){
            $query->where('tags.slug', $tag);
        });
    }

}
