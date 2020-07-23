<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Student;
use App\Faculty;
use App\Http\Resources\Search as SearchResource;


class Search extends Controller
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
            'entity' => 'required|string|in:s,f',
            'search' => 'string',
        ]);

        abort_unless($validator->passes(), 400);

        switch ($request->entity) {
            case 's':
                return response()->json(['results' => SearchResource::collection(
                    Student::where('name', env('DB_CONNECTION') == 'pgsql' ? 'ilike' : 'like', "%$request->search%")
                    ->orWhere('schoolid', env('DB_CONNECTION') == 'pgsql' ? 'ilike' : 'like', "%$request->search%")
                    ->take(12)
                    ->get()
                )]);
            case 'f':
                return  response()->json(['results' => SearchResource::collection(
                    Faculty::where('name', env('DB_CONNECTION') == 'pgsql' ? 'ilike' : 'like', "%$request->search%")
                    ->orWhere('schoolid', env('DB_CONNECTION') == 'pgsql' ? 'ilike' : 'like', "%$request->search%")
                    ->take(12)
                    ->get()
                )]);
        }

    }
}
