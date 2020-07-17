<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', [
            'contentheader' => 'Edit',
            'breadcrumbs' => [
                [
                    'text' => 'Calendar',
                    'link' => route('calendar'),
                ],
                [
                    'text' => 'Edit'
                ]
            ],
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'start' => 'required|date_format:d/m/Y',
            'end' => 'required|date_format:d/m/Y',
        ]);
        $event->update([
            'start' => Carbon::createFromFormat('d/m/Y', $request->start),
            'end' => Carbon::createFromFormat('d/m/Y', $request->end),
            'title' => $request->title,
            'description' => $request->description,
            'remarks' => $request->remarks,
        ]);
        return redirect()->route('calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
