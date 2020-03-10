<?php

namespace App\Http\Controllers;

use App\AcademicPeriod as Period;
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
            'contentheader' => 'Academic Periods',
            'periods' => Period::all(),
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($period = Period::find($id), 404);
        return view('academicperiods.edit', [
            'contentheader' => 'Edit',
            'breadcrumbs' => [
                [
                    'text' => 'Periods',
                    'link' => route('academicperiods.index'),
                ],
                [
                    'text' => $period->name(),
                    'link' => route('academicperiods.show', $period->id),
                ],
                [
                    'text' => 'Edit',
                ]
            ],
            'period' => $period,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
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
