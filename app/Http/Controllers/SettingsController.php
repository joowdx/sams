<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(@\Auth::user()->settings()->where(['name' => 'toggle']));
        return view('settings')->with([
            'contentheader' => 'Settings',
            'settings' => [
                'darkmode' => \Auth::user()->settings()->where(['name' => 'darkmode'])->first()->value ?? 'disable',
                'toggle' => \Auth::user()->settings()->where(['name' => 'toggle'])->first()->value ?? 'sidebar-mini',
                'onload' => \Auth::user()->settings()->where(['name' => 'onload'])->first()->value ?? '',
            ],
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_unless(is_numeric($id) && \App\User::find($id), 404);
        $request->validate([
            'name' => 'required_if:action,set|string|in:darkmode,onload,toggle',
            'value' => 'nullable|string'
        ]);

        switch($request->name) {
            case 'darkmode': {
                $request->validate(['value' => 'in:auto,enable,disable']);
                break;
            }
            case 'layout': {
                break;
            }
        }

        if($request->action == 'set') {
            return Settings::updateOrCreate(['user_id' => $id, 'name' => $request->name ], ['value' => $request->value ?? ""]);
        }

        return \App\User::find($id)->settings;

    }
}
