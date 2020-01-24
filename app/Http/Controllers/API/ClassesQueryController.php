<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OngoingClasses;

class ClassesQueryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return OngoingClasses::collection(Course::where()->all());
    }
}
