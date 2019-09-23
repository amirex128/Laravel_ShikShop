<?php

namespace App\Http\Controllers\panel;

use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.user', [
            'users' => User::latest()->get(),
            'page_name' => 'user',
            'page_title' => 'کاربران',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return \Illuminate\Http\Response
     *
     * public function create()
     * {
     *   //
     * }
     */ 

    /** 
     * Store a newly created user in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     * 
     * public function store(UserRequest $request)
     * {
     *   
     * }
     */

    /**
     * Display the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * 
     * public function show(User $user)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('panel.user', [
            'users' => User::latest()->get(),
            'user' => $user,
            'page_name' => 'user',
            'page_title' => "ویرایش کاربر {$user->title}",
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update( $request->all() );
        return redirect()->back()->with('message', "کاربر {$user->title} با موفقیت بروز رسانی شد");
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect( route('user.index') )->with('message', "کاربر {$user->title} با موفقیت حذف شد");
    }
}
