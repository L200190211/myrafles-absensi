<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Alert;

class UserController extends Controller
{

    public function list()
    {
        $data = User::with('roles')->orderByRaw('id DESC')->paginate(25);
        // dd($data);
        return view('user.list', compact('data'));
    }


    public function add()
    {

        return view('user.add');
    }


    public function store(Request $request)
    {
        $user = User::firstOrCreate([
            'firstname' => $request->nama,
            'username' => $request->usrn,
            'email' => $request->email,
            'password' => bcrypt('jacoidn'),
            'noWa' => $request->noWa,
            'lastLogin' => now(),
            'city' => $request->kota,
            'alamat' => $request->address,
            'about' => $request->about,
        ]);

        $user->assignRole($request->idRole);
        return redirect()->route('user.list');
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
