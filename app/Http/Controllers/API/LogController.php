<?php

namespace App\Http\Controllers\API;

use App\Log;
use App\Gate;
use App\Room;
use App\Faculty;
use App\Student;
use App\Events\NewScannedLog;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{
    public function __invoke(Request $request)
    {

        abort_unless(
            Validator::make(
                $request->all() ,
                [
                    'f' => 'required|string' ,
                    'i' => 'required|string|numeric' ,
                ]
            )->passes() ,
            403, 'Unknown'
        );

        abort_unless(
            $sf = Student::where(['uid' => $request->i])->first() ?? Faculty::where(['uid' => $request->i])->first() ,
            403, 'Unknown Entity'
        );

        abort_unless(
            $gr = Room::where(['name' => $request->f])->first() ?? Gate::where(['name' => $request->f])->first(),
            403, 'Unknown Location'
        );

        abort_unless(
            ($gt = get_class($gr) == 'App\Gate') || ($cc = $gr->session()) && ($fr = today()->setTime(explode(':', $cc->time_from)[0], explode(':', $cc->time_from)[1])),
            403, 'No Class Found'
        );

        abort_unless(
            $gt || $cc->students->contains($sf),
            403, 'Student Not Enrolled'
        );

        abort_unless(
            $gt || $cc->allowed($sf),
            403, 'Not Allowed'
        );

        abort_unless(
            $gt || $cc->nolog($sf),
            403, 'Already Logged In'
        );

        $rk = $gt ? ($sf->exited() ? 'entry' : 'exit') : ($fr->diffInMinutes(Carbon::now()) > 15 ? 'late' : 'ok');
        $nl = $gr->logs()->save($sf->logs()->create(['remarks' => $rk, 'date' => today()]));
        $gt ?: $cc->logs()->save($nl);

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
