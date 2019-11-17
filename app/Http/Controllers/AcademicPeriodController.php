<?php

namespace App\Http\Controllers;

use App\AcademicPeriod;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcademicPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('academicperiods.index')->with([
            'academicperiods' => AcademicPeriod::all(),
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
     * @param  \App\AcademicPeriod  $academicPeriod
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicPeriod $academicPeriod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcademicPeriod  $academicPeriod
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicPeriod $academicperiod)
    {
        return view('academicperiods.edit', compact('academicperiod'))->with([

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AcademicPeriod  $academicperiod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicPeriod $academicperiod)
    {
        $request->validate([
            'school_year' => '',
            'semester' => 'required_if:type,info|string|in:1ST,2ND,SUMMER',
            'term' => 'required_if:type,info|string|in:1ST,2ND,SEMESTER,SUMMER',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $academicperiod->update($request->except(['start', 'end']));
        $academicperiod->update([
            'start' => Carbon::createFromFormat('d-m-Y', $request->start),
            'end' => Carbon::createFromFormat('d-m-Y', $request->end),
        ]);

        return redirect(route('academicperiods.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcademicPeriod  $academicPeriod
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicPeriod $academicPeriod)
    {
        //
    }
}
