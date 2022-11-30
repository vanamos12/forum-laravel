<?php

namespace App\Http\Controllers\Pages;

use App\Models\Reply;
use App\Jobs\CreateReply;
use Illuminate\Http\Request;
use App\Policies\ReplyPolicy;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\CreateReplyRequest;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

class ReplyController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware([Authenticate::class, EnsureEmailIsVerified::class]);
    }

    public function store(CreateReplyRequest $request){
        $this->authorize(ReplyPolicy::CREATE, Reply::class);

        $this->dispatchSync(CreateReply::fromRequest($request));
        
    }
}
