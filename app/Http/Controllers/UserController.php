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
            'password' => bcrypt('myrafles'),
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
        $data = User::with('roles')->find($user->id);
        $roles = Role::get();
        return view('user.edit', compact('data', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'firstname' => $request->nama,
            'username' => $request->usrn,
            'email' => $request->email,
            'noWa' => $request->noWa,
            'city' => $request->kota,
            'alamat' => $request->address,
            'about' => $request->about,
        ]);

        $user->syncRoles($request->idRole);

        Alert::success('User Telah Diperbarui');
        return redirect()->route('user.list');
    }

    // Change Password
    public function resetView()
    {
        return view('password.change');
    }

    public function change(Request $request)
    {
        $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => $request->new_password]);
        // Alert::success('Berhasil', 'Password telah berubah');
        return redirect()->route('user.list');
    }
}
