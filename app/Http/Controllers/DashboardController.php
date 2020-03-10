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
                'log_by:id,name,uid' ,
                'course' ,
            ])->where('remarks', '<>', 'absent')->limit(10)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
