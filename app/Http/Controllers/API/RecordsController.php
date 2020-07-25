<?php

namespace App\Http\Controllers\API;

use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Records as RecordsResource;
use App\Log as Records;

class RecordsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return RecordsResource::collection(Records::whereIn('remarks', ['late', 'absent'])->get());
    }
}
