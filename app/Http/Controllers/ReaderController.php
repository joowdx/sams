<?php

namespace App\Http\Controllers;

use App\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('readers.index', [
            'contentheader' => 'Readers',
            'readers' => Reader::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('readers.create', [
            'contentheader' => 'Create',
            'breadcrumbs' => [
                [
                    'text' => 'Readers',
                    'link' => route('readers.index'),
                ],
                [
                    'text' => 'Create'
                ]
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
        $request->validate([
            'name' => 'required|string|unique:readers,name',
            'ip' => 'nullable|string|ip|unique:readers,ip',
            'type' => 'required|string|in:gate,room'
        ]);
        Reader::create($request->all());
        return redirect(route('readers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reader  $reader
     * @return \Illuminate\Http\Response
     */
    public function show(Reader $reader)
    {
        return $this->edit($reader->id);
        return view('readers.show', [
            'contentheader' => $reader->name,
            'breadcrumbs' => [
                [
                    'text' => 'Readers',
                    'link' => route('readers.index'),
                ],
                [
                    'text' => $reader->name
                ]
            ],
            'reader' => $reader,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($reader = Reader::find($id), 404);
        return view('readers.edit', [
            'contentheader' => 'Edit',
            'breadcrumbs' => [
                [
                    'text' => 'Reader',
                    'link' => route('readers.index'),
                ],
                [
                    'text' => $reader->name,
                    'link' => route('readers.show', $reader->id),
                ],
                [
                    'text' => 'Edit',
                ]
            ],
            'reader' => $reader,
        ]);
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
        abort_unless(is_numeric($id), 404);
        abort_unless($reader = Reader::find($id), 404);
        $request->validate([
            'name' => 'required|string|unique:readers,name,' . $reader->id,
            'ip' => 'nullable|string|ip|unique:readers,ip,' . $reader->id,
            'type' => 'required|string|in:gate,room'
        ]);
        $reader->update($request->all());
        return redirect(route('readers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(is_numeric($id), 404);
        abort_unless($reader = Reader::find($id), 404);
        $reader->delete();
        return redirect(route('readers.index'));
    }
}
