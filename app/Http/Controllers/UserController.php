<?php

namespace App\Http\Controllers;

use App\User;
use App\Faculty;
use App\Http\Requests\UpdateValidation;
use App\Http\Requests\StoreValidation;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('users_data', User::class);
        return view('users.index', [
            'contentheader' => 'Users',
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('users_data', User::class);
        $user = new User();
        return view('users.create', compact('user'),[
            'faculties' => Faculty::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidation $request)
    {
        $this->authorize('users_data', User::class);
        $user = User::create($request->all());
        $user->update(['password' => Hash::make($request->input('password'))]);

        // if(request()->has('avatar'))
        // {
        //     $user->update([
        //         'avatar' => request()->avatar->store('avatars','public', '' .''. request()->avatar->getClientOriginalName()),
        //     ]);
        // }

        if(request()->hasFile('avatar'))
        {
            $avatar = request()->file('avatar')->getClientOriginalExtension();
            $file = $user->name.".".$avatar;
            request()->file('avatar')->storeAs('public/avatars', '' . '/' . $file, '');
            $user->update(['avatar' => $file]);
        }

        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('users_data', User::class);
        return $this->edit($user);
        return view('users.show', compact('user'))->with([
            'contentheader' => 'User Info',
            'breadcrumbs' => [
                [
                    'text' => 'Users',
                    'link' => route('users.index'),
                ],
                [
                    'text' => 'Info'
                ]
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('users_data', User::class);
        return view('users.edit', compact('user'))->with([
            'contentheader' => 'Update user',
            'breadcrumbs' => [
                [
                    'text' => 'Users',
                    'link' => route('users.index'),
                ],
                [
                    'text' => 'Edit'
                ]
            ],
            'faculties' => Faculty::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateValidation $request, $id)
    {
        $this->authorize('users_data', User::class);
        // $user = User::findOrFail($id);
        $user = User::findOrFail($id);
        $user->update($request->except(['password', 'avatar']));

        if(!empty($request->input('password'))){
            $user->password =   Hash::make($request->password);
        }
        if(request()->hasFile('avatar'))
        {
            $avatar = request()->file('avatar')->getClientOriginalExtension();
            $file = $user->name.".".$avatar;
            request()->file('avatar')->storeAs('public/avatars', '' . '/' . $file, '');
            $user->update(['avatar' => $file]);
        }



        return view('users.show',compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('users_data', User::class);
        $user->delete();

        return redirect('users');
    }

}
