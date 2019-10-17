<?php

namespace App\Http\Controllers\API;

use App\Events\NewScannedLog;
use App\Student;
use App\Http\Controllers\Controller;
use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['id' => 'required|string|numeric', 'from' => 'required|string']);
        $log = Student::firstOrCreate(
            ['school_id' => $request->input('id')],
            ['name' => $request->input('name')]
        )->logs()->create(['from' => $request->input('from')]);
        event(new NewScannedLog(Log::where(['id' => $log->id])->with('log_by')->first()));
    }
}
