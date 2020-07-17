<?php

namespace App\Http\Controllers;

use App\Log;
use App\Reader;
use Illuminate\Http\Request;

class GateController extends Controller
{
    public function gate1()
    {
        return view('gates0.index')->with([
            'logs' => Log::with([
                'reader:id,name',
                'log_by:avatar,id,name,uid',
                'course' ,
            ])->where('remarks', '<>', 'absent')->limit(1)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function gate2()
    {
        return view('gates1.index')->with([
            'logs' => Log::with([
                'reader:id,name',
                'log_by:avatar,id,name,uid',
                'course' ,
            ])->where('remarks', '<>', 'absent')->limit(1)->orderBy('created_at', 'desc')->get(),
        ]);
    }
}
