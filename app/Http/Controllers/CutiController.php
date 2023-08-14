<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cuti;
use Carbon\Carbon;
use Alert;

class CutiController extends Controller
{
    public function create()
    {
        $perihal = ['Kurang Fit', 'Sakit', 'Acara Keluarga', 'Acara Lainnya', 'Lainnya'];
        return view('cuti.add', compact('perihal'));
    }

    public function store(Request $request)
    {
        $cuti = new Cuti();
        $cuti->who = $request->who;
        $cuti->perihal = $request->perihal;
        $cuti->total = $request->total;
        $cuti->tglCuti = $request->tglCuti;
        $cuti->rincian = $request->rincian;

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
        return redirect()->route('cuti.history');
    }

    public function history()
    {
        $data = DB::table('cutis')->orderByDesc('created_at')->paginate(25);
        return view('cuti.history', compact('data'));
    }
}
