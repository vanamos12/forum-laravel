<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\IsAdmin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        return $this->middleware([IsAdmin::class, 'auth']);
    }

    public function index(){
        return view('admin.dasboard.index');
    }
}
