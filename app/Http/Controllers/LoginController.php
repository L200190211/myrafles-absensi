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
               
                $log = Absen::where('users_id' ,Auth::user()->id)->latest()->first(); 

                if($log != null ) {

                    if($log->created_at->format('d m Y') == now()->format('d m Y')) { 

                        Absen::where('users_id',$log->id)->update(['tgl_absen' => now()]);

                    } else {
                        Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
                    }

                } else {

                    Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);

                }
            
            } else {
                $log = Absen::where('users_id' ,Auth::user()->id)->latest()->first(); 

                if($log != null ) {

                    if($log->created_at->format('d m Y') == now()->format('d m Y')) { 

                        Absen::where('users_id',$log->id)->update(['tgl_absen' => now()]);

                    } else {
                        Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
                    }

                } else {

                    Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);

                }
                
            
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
