<?php

namespace App\Http\Controllers;

use App\gate;
Use App\Log;
use Illuminate\Http\Request;

class GateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gates.index')->with([
            'logs' => Log::with([
                'from_by:id,name' ,
                'log_by:id,name,uid' ,
                'course' ,
            ])->where('remarks', '<>', 'absent')->limit(1)->orderBy('created_at', 'desc')->get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\gate  $gate
     * @return \Illuminate\Http\Response
     */
    public function show(gate $gate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\gate  $gate
     * @return \Illuminate\Http\Response
     */
    public function edit(gate $gate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\gate  $gate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gate $gate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\gate  $gate
     * @return \Illuminate\Http\Response
     */
    public function destroy(gate $gate)
    {
        //
    }
}
