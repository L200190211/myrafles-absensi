<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Carbon\Carbon;
use Alert;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    use AuthenticatesUsers;
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


        $jamawal = '07.30';
        $jamakhir = '08.30';
        $ipnya = '127.0.0.1';

        // $ipnya = '111.94.147.' RFLS
        // $ipnya = '182.253.90.' JSTR
        // $ipnya = '127.0.0.' LOCAL

      // user do login
      if (Auth::attempt($credentials)) {

        $user = Auth::user();
        
        // check roles user
        if($user->hasRole(['superadmin','admin'])){

            User::where('id',Auth::user()->id)->update(['lastLogin' => Carbon::now()]);
            return redirect()->intended('dashboard');
            
        } else {

            if(now()->format('H:i') >= $jamawal && now()->format('H:i') < $jamakhir && substr($request->ip(),0,11) == $ipnya) {

                
                $log = Absen::where('users_id' ,Auth::user()->id)
                ->whereRaw('DATE_FORMAT(created_at, "%d %m %Y") = ?', [now()->format('d m Y')])
                ->latest()->first();
                if($log != null ) {
                    // lanjut absen
                    if ( $log->created_at->format('d m Y') == now()->format('d m Y') ) { 

                    } else {
                        Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
                    }
                    // First absen
                }else{
                    Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
                    Alert::success('Check in berhasil');
                }

            }else if(now()->format('H:i') >= $jamawal && now()->format('H:i') < $jamakhir && substr($request->ip(),0,11) !== $ipnya){
                Auth::logout();
                return redirect()->back()->withErrors(['ip' => 'Login Gagal, Pastikan kamu terhubung dengan Wi-Fi Kantor']);
            }else{

            }
            
            User::where('id',Auth::user()->id)->update(['lastLogin' => Carbon::now()]);
            return redirect()->intended('dashboard');

        }
        
    }else{

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    }

    public function logout(Request $request) {
        User::where('id',Auth::user()->id)->update(['lastLogin' => Carbon::now()]);
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}