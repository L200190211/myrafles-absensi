<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Alert;

class UserController extends Controller
{

    public function list()
    {
        $data = DB::table('users')->orderByRaw('id DESC')->paginate(25);
        // dd($data);
        return view('user.list', compact('data'));
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
