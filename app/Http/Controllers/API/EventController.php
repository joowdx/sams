<?php

namespace App\Http\Controllers\API;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource as Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
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
}
