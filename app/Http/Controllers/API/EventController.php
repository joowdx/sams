<?php

namespace App\Http\Controllers\API;

use App\Event;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource as Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'start' => 'required|date_format:d/m/Y',
            'end' => 'required|date_format:d/m/Y',
        ]);
        switch($validator->fails()) {
            case false: {
                return Event::create(array_merge([
                    'start' => Carbon::createFromFormat('d/m/Y', $request->start),
                    'end' => Carbon::createFromFormat('d/m/Y', $request->end),
                ], $request->except(['_token', 'start', 'end'])));
            }
            case true: {
                abort(400, $validator->errors());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = 0)
    {
        $validator = Validator::make($request->all(), [
            'remarks' => 'sometimes|in:national holiday,local holiday,institutional event,class suspension,break,info',
            'start' => 'sometimes|date',
            'end' => 'sometimes|date',
        ])->fails();
        switch($validator) {
            case true: {
                abort(400, 'Bad request');
                break;
            }
            default: {
                return Events::collection(Event::where('remarks', 'like', "%$request->remarks%")->get());
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
    }

}
