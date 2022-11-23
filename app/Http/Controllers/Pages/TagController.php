<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Thread;

class TagController extends Controller
{
    //
    public function index(Tag $tag){
        return view('pages.tags.index', [
            'threads'    => Thread::ForTag($tag->slug())->paginate(10),
        ]);
    }
}
