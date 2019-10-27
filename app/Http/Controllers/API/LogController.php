<?php

namespace App\Http\Controllers\API;

use App\Log;
use App\Gate;
use App\Room;
use App\Course;
use App\Faculty;
use App\Student;
use App\Events\NewScannedLog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __invoke(Request $request)
    {
        // abort_unless(
        //     $request->isMethod('post') ,
        //     405
        // );

        abort_unless(
            Validator::make(
                $request->all() ,
                [
                    'f' => 'required|string' ,
                    'i' => 'required|string|numeric' ,
                    't' => 'required|string|in:G,R' ,
                ]
            )->passes() ,
            400, 'Bad Request'
        );

        abort_unless(
            $sf =
            Student::where(['uid' => $request->i])->first() ?:
            Faculty::where(['uid' => $request->i])->first() ,
            403, 'Forbidden'
        );

        abort_unless(
            strtolower($request->type) == 'G' ?
            ($gr = Gate::where(['name' => $request->f])->first()) :
            ($gr = Room::where(['name' => $request->f])->first()) ,
            403, 'Forbidden'
        );

        abort_unless(
            $cc = Course::where(['room_id' => $gr->id])->first() ,
            403, 'Forbidden'
        );

        $nl = $gr->logs()->save($sf->logs()->create(['remarks' => 'ok']));
        $cc->logs()->save($nl);

        event(
            new NewScannedLog(
                Log::with([
                    'from_by:id,name' ,
                    'log_by:id,name,uid' ,
                    'course' ,
                ])->where('id', $nl->id)->first()
            )
        );

    }
}
