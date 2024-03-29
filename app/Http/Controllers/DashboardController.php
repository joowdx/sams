<?php

namespace App\Http\Controllers;

use App\Log;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        $this->authorize('dashview', User::class);
        return view('dashboard')->with([
            'contentheader' => 'Dashboard',
            'logs' => Log::with([
                'log_by:id,name,uid' ,
                'course' ,
            ])->where('remarks', '<>', 'absent')->limit(10)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
