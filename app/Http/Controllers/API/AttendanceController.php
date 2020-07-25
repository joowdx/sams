<?php

namespace App\Http\Controllers\API;

use App\Log;
use App\Course;
use App\Faculty;
use App\Student;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        abort_unless(
            Validator::make($request->all(), [
                'action' => 'required|in:i,u',
                'entity' => 'required|in:f,s',
                'id' => 'required_if:action,u|numeric',
                'entityid' => 'required_if:action,i|numeric',
                'date' => 'required_if:action,i|date_format:Y-m-d',
                'remarks' => 'required|string|in:ok,late,absent,excuse,leave',
                'course' => 'required|numeric',
            ])->passes(),
            403, 'Unknown'
        );

        switch ($request->action) {
            case 'u': {
                abort_unless($log = Log::find($request->id), 404, 'Not Found');
                abort_unless($cc = Course::find($request->course), 404, 'Not Found');
                abort_unless($cc->logs->contains($log), 403, 'Not Allowed');
                $log->update(['remarks' => $request->remarks, 'process' => 'overwritten']);
                $student = $log->log_by;
                $status = $cc->students->find($student)->pivot->status;
                $absences = $log->log_by->logs()->where([
                    'course_id' => $cc->id,
                    'remarks' => 'absent',
                ])->count();
                if($absences >= $cc->getdroprate() && $status != 'dropped') {
                    $cc->students->find($student)->pivot->update(['status' => 'dropped']);
                } else if($absences < $cc->getdroprate() && $status == 'dropped') {
                    $cc->students->find($student)->pivot->update(['status' => null]);
                } else if($absences > ($cc->getdroprate() * 0.75) && $status != 'dropped') {
                    $student->pivot->update(['status' => 'warning']);
                }
                return $log->loadMissing(['log_by', 'course']);
                break;
            }
            default: {
                switch ($request->entity) {
                    case 's': abort_unless($sf = Student::find($request->entityid), 404, 'Not Found');
                    case 'f': abort_unless($sf = Faculty::find($request->entityid), 404, 'Not Found');
                    default: {
                        abort_unless($cc = Course::find($request->course), 404, 'Not Found');
                        $nl = $sf->logs()->updateOrCreate(['date' => $request->date], ['remarks' => $request->remarks, 'process' => 'manual']);
                        $cc->logs()->save($nl);
                        $request->remarks != 'absent' ? $cc->room->logs()->save($nl) : null;
                        return $nl->loadMissing(['log_by', 'course']);
                    }
                }
            }
        }

    }

}
