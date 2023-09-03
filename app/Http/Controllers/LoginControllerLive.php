<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

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

        // $allowedIPRange = '127.0.0.11';
        // ip addr
        // setting for hosting ip jaster
        // if(substr($request->ip(),0,11) == '182.253.90.')

      // user do login
      if (Auth::attempt($credentials)) {

        $user = Auth::user();
        
        // check roles user
        if($user->hasRole(['superadmin','admin'])){

            $request->session()->regenerate();

            // checkin otomatis kalau jam set 9
            if(now()->format('H:i') <= '08:30' ) {
                Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
            } else {

            // cek jika check in tidak kosong
            if($request->check != null ) {
            
                $log = Absen::where('users_id' ,Auth::user()->id)->where('created_at',now())->latest()->first(); 

                // check data ada atau kosong
                if($log != null ) {

                    // prevent double data
                    if ( $log->created_at->format('d m Y') == now()->format('d m Y') ) { 
                        Absen::where('id',$log->id)->update(['tgl_absen' => now()]);
                    } else {
                        Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
                    }

                } else {

                    Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);

                }
            
            } else {}

            }



            return redirect()->intended('dashboard');
            
        } else{
           
           //alamat ip
           if(substr($request->ip(),0,11) == '111.94.147.') {

                // user do login
                if (Auth::attempt($credentials)) {
        
                    $request->session()->regenerate();
    
                            // cek jika check in tidak kosong
                            if($request->check != null ) {
                            
                                $log = Absen::where('users_id' ,Auth::user()->id)->latest()->first(); 
    
                                // check data ada atau kosong
                                if($log != null ) {
    
                                    if ( $log->created_at->format('d m Y') == now()->format('d m Y') ) { 
                                        Absen::where('id',$log->id)->update(['tgl_absen' => now()]);
                                    } else {
                                        Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
                                    }
    
                                } else {
    
                                    Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
    
                                }
                            
                            } else {}
    
                        return redirect()->intended('dashboard');
                    
                }
    
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['ip' => 'Login Gagal, Pastikan kamu terhubung dengan Wi-Fi Kantor']);
            }


        }
            
        
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
