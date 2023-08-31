<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $absen = Absen::where('users_id',auth()->user()->id)->whereDate('created_at',today())->latest()->first();
    
        return view('pages.dashboard',compact('absen'));
    }

    public function notif(Request $request) {
        return view('pages.notif');
    }

    public function markAsNotification(Request $request)
    {
        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();

        return response()->noContent();
    }
}
