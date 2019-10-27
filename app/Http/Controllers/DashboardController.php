<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        return view('dashboard')->with([
            'contentheader' => 'Dashboard',
            'logs' => Log::with([
                'from_by:id,name' ,
                'log_by:id,name,uid' ,
                'course' ,
            ])->limit(5)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
