<?php

namespace App\Http\Controllers;

use App\User;
use App\Faculty;
use App\Http\Requests\UpdateValidation;
use App\Http\Requests\StoreValidation;
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
        $this->authorize('aview', User::class);

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
        $this->authorize('create', User::class);
        User::create($request->all())->update(['password' => Hash::make($request->input('password'))]);
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
        // $this->authorize('show', User::class);
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
        $this->authorize('show', User::class);
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
        $this->authorize('update', User::class);
        $user = User::findOrFail($id);
        $user->type     =   $request->type;
        $user->name     =   $request->name;
        $user->username =   $request->username;
        $user->phone    =   $request->phone;
        $user->email    =   $request->email;
        if(!empty($request->input('password'))){
            $user->password =   Hash::make($request->password);
        }
        $user->save();

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
        $this->authorize('delete', User::class);
        $user->delete();

        return redirect('users');
    }

}
