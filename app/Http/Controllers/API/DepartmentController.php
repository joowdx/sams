<?php

namespace App\Http\Controllers\API;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Department::all();
    }
}
