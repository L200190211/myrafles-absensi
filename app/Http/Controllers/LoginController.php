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
        $allowedIPRange = '127.0.0.1';
        
        if($allowedIPRange == $request->ip()) {

            if (Auth::attempt($credentials)) {
    
                $request->session()->regenerate();

            
                    
                    // cek jika check in tidak kosong
                        if($request->check != null ) {
                        
                            $log = Absen::where('users_id' ,Auth::user()->id)->latest()->first(); 

                            if($log != null ) {

                                if($log->created_at->format('d m Y') == now()->format('d m Y')) { 

                                    Absen::where('id',$log->id)->update(['tgl_absen' => now()]);

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

                                    Absen::where('id',$log->id)->update(['tgl_absen' => now()]);

                                } else {
                                    Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);
                                }

                            } else {

                                Absen::create(['users_id' => Auth::user()->id , 'tgl_absen' => now() , 'ip_address' => $request->ip()]);

                            }
                            
                        
                        }

                    return redirect()->intended('dashboard');
                
            }

        } else {
            return redirect()->back()->withErrors(['ip' => 'You are not allowed to login from this IP.']);
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


    protected function authenticated(Request $request, $user)
    {
        // Replace these values with the IP range of your office Wi-Fi network
        $allowedIPRange = [
            '182.253.90.1062', // Example IP range
        ];
        
        $userIP = $request->ip();

        foreach ($allowedIPRange as $ipRange) {
            if (strpos($userIP, $ipRange) === 0) {
                return redirect()->intended($this->redirectPath());
            }
        }

        Auth::logout();
        return redirect()->back()->withErrors(['ip' => 'You are not allowed to login from this IP.']);
    }
}
