<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Http\Request;

class MapController extends Controller
{

    public function index() {
        $this->authorize('map_view', User::class);
        return view('map', [
            'departments' => Department::all('shortname'),
        ]);
    }
}
