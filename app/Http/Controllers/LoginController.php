<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            
            $request->session()->regenerate();

            // cek jika check in tidak kosong
            if($request->check != null ) {

                User::where('id',Auth::user()->id)->update(['lastLogin' => $request->check]);
                Absen::create(['users_id' => Auth::user()->id ,'tgl_absen' => $request->check,'ip_address' => $request->ip()]);
            
            } else {

                Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => $request->check , 'ip_address' => $request->ip()]);
            
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        User::where('id',Auth::user()->id)->update(['lastLogin' => null]);
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
