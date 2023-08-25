<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $absen = Absen::where('users_id',auth()->user()->id)->latest()->first();
        return view('pages.dashboard',compact('absen'));
    }
}
