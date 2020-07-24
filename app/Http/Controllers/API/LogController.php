<?php

namespace App\Http\Controllers\API;

use App\Log;
use App\Reader;
use App\Course;
use App\Faculty;
use App\Student;

use App\UnknownLog;
use App\Events\NewScannedLog;

use App\Events\NewTag;

use App\Http\Middleware\ReaderVerification;
use App\Http\Middleware\TagVerification;
use App\Http\Middleware\InSchoolPremises;
use App\Http\Middleware\HasClass;

use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Illuminate\Http\Request;

class LogController extends Controller
{

    private $sf, $gr, $cc;

    public function __construct()
    {
        event(
            new NewTag(UnknownLog::create([
                'uid' => request()->i,
                'from' => request()->f ?? 'unknown',
                'method' => request()->method(),
                'ip' => request()->ip(),
                'data' => request()->all(),
                'remarks' => 'register'
            ]))
        );
        $this->middleware([
            ReaderVerification::class,
            TagVerification::class,
            InSchoolPremises::class,
            HasClass::class,
        ]);
    }

    public function __invoke(Request $request)
    {
        $this->sf = Student::findbyuid($request->i) ?? Faculty::findbyuid($request->i);
        $this->gr = Reader::findbyname($request->f);
        switch($this->gr->type) {
            case 'gate': return $this->sendlogevent($this->newlog());
            case 'room': {
                switch(get_class($this->sf)) {
                    case Student::class: return $this->handlestudent();
                    case Faculty::class: return $this->handlefaculty();
                }
            }
        }
    }

    private function handlefaculty()
    {
        $this->cc = Course::findonsession($this->gr->name);
        abort_unless($this->cc && ($this->cc->forattendance() || $this->cc->facultyloggedontime()), 403, 'Attendance is now disabled!');
        abort_unless(request()->t == '1', 403);
        // abort_unless($this->cc->faculty->uid == $this->sf->uid, 403, "You ain't this class' teacher!");
        abort_unless($this->cc->facultylateststamp() != now()->seconds()->microseconds(), 409, 'Stamp for this minute exists.');
        return $this->sendlogevent($this->cc->logs()->save($this->newlog('stamp', true)));
    }

    private function handlefaculty_2()
    {
        $this->cc = Course::findonsession($this->gr->name);
        abort_unless($this->cc && ($this->cc->forattendance() || $this->cc->facultyloggedontime()), 403, 'Attendance is now disabled!');
        abort_unless($this->cc->faculty->uid == $this->sf->uid, 403, "You ain't this class' teacher!");

    }

    private function handlestudent()
    {
        $this->cc = Course::findforattendance($this->gr->name);
        abort_unless($this->cc, 403, 'Attendance is now disabled!');
        abort_unless(request()->t == '0', 403);
        abort_unless($this->cc->students->contains($this->sf) && $this->deny(), 403, 'Student not enrolled!');
        abort_unless($this->cc->students->find($this->sf)->pivot->status != 'dropped', 403, 'Student is dropped!');
        abort_unless($this->cc->nolog($this->sf), 409, 'Already logged in!');
        return $this->sendlogevent($this->cc->logs()->save($this->newlog()));
    }

    private function deny()
    {
        return $this->newlog('denied');
    }

    private function newlog($remarks = null, $trimseconds = false)
    {
        if($remarks) {
            $log = $this->sf->logs()->create(['remarks' => $remarks, 'date' => today()]);
        } else {
            switch($this->gr->type) {
                case 'room': $rk = now()->diffInMinutes(Carbon::createFromTimeString($this->cc->time_from), false) < 1 ? 'late' : 'ok'; break;
                case 'gate': $rk = $this->sf->entered() ? 'exit' : 'entry'; break;
            }
            $log = $this->sf->logs()->create(['remarks' => $rk, 'date' => today()]);
        }
        if($trimseconds) {
            $time = now()->seconds()->microseconds();
            $log->created_at = $time;
            $log->updated_at = $time;
            $log->save(['timestamps' => false]);
        }
        return $this->gr->logs()->save($log);
    }

    private function sendlogevent(Log $log)
    {
        event(
            new NewScannedLog(
                $log->loadMissing([
                    'reader:id,name',
                    'log_by:id,name,uid',
                    'course',
                ])
            )
        );
        return $log;
    }

}
