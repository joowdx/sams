<?php

namespace App\Http\Controllers\API;

use App\Log;
use App\Student;
use App\Events\NewScannedLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __invoke(Request $request)
    {
        abort_if(Validator::make($request->all(),['id'=>'required|string|numeric','from'=>'required|string'])->fails(), 404);
        $log = Student::firstOrCreate(
            ['school_id' => $request->input('id')],
            ['name' => $request->input('name')]
        )->logs()->create(['from' => $request->input('from')]);
        event(new NewScannedLog(Log::where(['id' => $log->id])->with('log_by')->first()));
    }
}
