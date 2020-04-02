<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::get();
        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:64',
            'email' => 'required|email|unique:users,email|min:3|max:64',
            'peran' => 'required|in:bidan,kader',
            'password' => 'required|min:3|max:64',
        ]);

        if($request->peran == "kader"){
            $role_id = 3;
        } else {
            $role_id = 2;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $role_id,
            'password' => bcrypt($request->password)
        ]);

        toastr()->success("User berhasil ditambahkan");

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:64',
            'email' => 'required|email|min:3|max:64',
            'peran' => 'required|in:bidan,kader',
        ]);

        if($request->peran == "kader"){
            $role_id = 3;
        } else {
            $role_id = 2;
        }

        if($request->password != ''){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $role_id,
                'password' => bcrypt($request->password)
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $role_id,
            ]);
        }

        toastr()->success("User berhasil diubah");

        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        toastr()->success("User berhasil dihapus");
        return redirect()->route('dashboard.users.index');
    }
}
