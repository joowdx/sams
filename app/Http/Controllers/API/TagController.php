<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Faculty;
use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // abort_unless(
        //     $request->isMethod('post') ,
        //     405, 'Method not Allowed'
        // );

        abort_unless(
            Validator::make(
                $request->all() ,
                [
                    'f' => 'nullable|string|in:U,O' ,
                    'i' => 'required|string|numeric' ,
                    'n' => 'required|string|regex:/^[A-Za-z-. ]+$/|max:30' ,
                    'e' => 'required|string|in:S,F' ,
                ]
            )->passes() ,
            400, 'Bad Request'
        );

        // abort_if(
        //     (
        //         $sf =
        //         Student::where(['uid' => $request->i])->first() ?:
        //         Faculty::where(['uid' => $request->i])->first()
        //     ) && ! $request->f ||
        //     ! (
        //         ! $sf ? true : (
        //             get_class($sf) == 'App\Student' && $request->e == 'S'  ||
        //             get_class($sf) == 'App\Faculty' && $request->e == 'F'
        //         )
        //     ) && $request->f == 'U',
        //     409, 'Conflict.'
        // );

        abort_if(
            (
                ! (
                    $sf =
                    Student::where(['uid' => $request->i])->first() ?:
                    Faculty::where(['uid' => $request->i])->first()
                )
            ) && $request->f ||
            (
                ! $sf ? true : (
                    get_class($sf) == 'App\Student' && $request->e == 'S'  ||
                    get_class($sf) == 'App\Faculty' && $request->e == 'F'
                )
            ) && ! $request->f == 'U',
            409, 'Conflict.'
        );

        switch($request->f) {
            case 'U': {
                $sf->update(['name' => $request->n]);
                return ['Class' => get_class($sf), 'Entity' => $sf];
            }
            case 'O': {
                $sf->delete();
            }
            default: {
                switch($request->e) {
                    case 'S': {
                        return Student::create([
                            'uid' => $request->i ,
                            'name' => $request->n ,
                        ]);
                    }
                    case 'F': {
                        return Faculty::create([
                            'uid' => $request->i ,
                            'name' => $request->n ,
                        ]);
                    }
                }
            }
        }

    }
}
