<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function create()
    {

        return view('cuti.add');
    }

    public function store(Request $request)
    {
        $cuti = new Cuti();
        $cuti->who = $request->who;
        $cuti->asal = $request->asalBeli;
        $cuti->total = $request->total;
        $cuti->rincian = $request->rincian;
        $cuti->perihal = $request->perihal;
        $cuti->tglCuti = $request->tglCuti;

        $year = Carbon::parse($cuti->tglCuti)->format('Y');
        $month = Carbon::parse($cuti->tglCuti)->format('m');
        $day = Carbon::parse($cuti->tglCuti)->format('d');
        $hour = now()->format('H');
        $minute = now()->format('i');
        $tz = 'Asia/Jakarta';

        $cuti->tglCuti = Carbon::create($year, $month, $day, $hour, $minute, $tz);

        $cuti->save();

        // Notification::send($users, new AdjustmentCreated($adjustment));
        Alert::success('Request Cuti Sukses Dibuat');
        return redirect()->route('adjustment.history', $request->tujuan);
    }

    public function history()
    {

        return view('cuti.history');
    }
}
