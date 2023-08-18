<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function list()
    {

        return view('user.list');
    }


    public function add()
    {

        return view('user.add');
    }


    public function store(Request $request)
    {
        //
    }

    public function edit(User $user)
    {

        return view('user.edit');
    }

    public function update(Request $request, User $user)
    {
        //
    }

    // Change Password
    public function change()
    {
        return view('password.change');
    }
}
