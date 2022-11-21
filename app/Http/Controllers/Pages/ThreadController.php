<?php

namespace App\Http\Controllers\Pages;

use App\Models\Tag;
use App\Models\Thread;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\ThreadStoreRequest;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

class ThreadController extends Controller
{
    public function __construct(){
        return $this->middleware([Authenticate::class, EnsureEmailIsVerified::class])->except(['index', 'show']);

        //return $this->middleware(['auth', 'verified'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.threads.index', [
            'threads' => Thread::orderBy('id', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.threads.create', [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadStoreRequest $request)
    {
        //
        $thread           = new Thread;
        $thread->title    = $request->title;
        $thread->body     = Purifier::clean($request->body);
        $thread->slug     = Str::slug($request->title);
        $thread->category_id = $request->category;
        $thread->author_id = Auth::id();
        $thread->save();
        //$thread->tags()->sync($request->tags);
        $thread->syncTags($request->tags);

        return redirect()->route('threads.index')->with('success', 'Thread created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Thread $thread)
    {
        //
        return view('pages.threads.show', compact('thread', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
