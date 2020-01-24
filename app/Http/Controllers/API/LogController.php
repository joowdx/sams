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
use Carbon\Carbon;
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
            403, 'Record Not Found'
        );

        abort_unless(
            strtolower($request->type) == 'G' ?
            ($gr = Gate::where(['name' => $request->f])->first()) :
            ($gr = Room::where(['name' => $request->f])->first()) ,
            403, 'Unknown Location'
        );

        // abort_unless(
        //     ($cc = Course::where(['room_id' => $gr->id])->first()) &&
        //     ($tm = Carbon::now()) &&
        //     ($fr = Carbon::create($tm->year, $tm->month, $tm->day, explode(':', $cc->time_from)[0], explode(':', $cc->time_from)[1], 0)) &&
        //     ($to = Carbon::create($tm->year, $tm->month, $tm->day, explode(':', $cc->time_to)[0], explode(':', $cc->time_to)[1], 0)) &&
        //     ($tm->between($fr, $to)),
        //     403, 'No Class Found'
        // );


        ///

        // abort_unless(
        //     ($cc = $gr->session()) && ($fr = Carbon::now()->setTime(explode(':', $cc->time_from)[0], explode(':', $cc->time_from)[1])),
        //     403, 'No Class Found'
        // );

        // abort_unless(
        //     $cc->students->contains($sf),
        //     403, 'Student Not Enrolled'
        // );

        // abort_unless(
        //     $cc->nolog($sf),
        //     403, 'Already Logged In'
        // );

        $nl = $gr->logs()->save($sf->logs()->create(['remarks' => 'ok']));
        Course::first()->logs()->save($nl);
        // $nl = $gr->logs()->save($sf->logs()->create(['remarks' => $fr->diffInMinutes(Carbon::now()) > 15 ? 'late' : 'ok']));
        // $cc->logs()->save($nl);

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
