<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware([Authenticate::class, EnsureEmailIsVerified::class]);
    }
}
