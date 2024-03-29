<?php

namespace App\Http\Controllers;

use App\Student;
use App\Faculty;
use App\User;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('admin_view', User::class);
        return view('tags.index', [
            'contentheader' => 'Tags',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('admin_view', User::class);
        $validator = Validator::make($request->all(), [
            'uid' => 'required|string',
            'type' => 'required|in:s,f',
            'id' => 'required|numeric',
        ]);

        abort_unless($validator->passes(), 400);

        if($request->type == 'f') {
            $sf = Faculty::find($request->id);
        } else {
            $sf = Student::find($request->id);
        }

        abort_unless($sf, 404);

        $ex = Student::where('uid', $request->uid)->first() ?? Faculty::where('uid', $request->uid)->first();

        if($ex) {
            $ex->update(['uid' => null]);
        }

        $sf->update(['uid' => $request->uid]);

        return $sf;

    }
}
