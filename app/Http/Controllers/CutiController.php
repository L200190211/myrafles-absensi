<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function create() {

        return view('cuti.add');

    }

    public function store(Request $request) {
        //
    }

    public function history() {

        return view('cuti.history');

    }
}
