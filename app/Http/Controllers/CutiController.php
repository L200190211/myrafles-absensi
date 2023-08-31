<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Notifications\CutiCreated;
use App\Models\Cuti;
use Carbon\Carbon;
use Alert;
use App\Models\User;
use App\Notifications\CutiAcc;
use App\Notifications\CutiDecline;
use Illuminate\Support\Facades\Notification;

class CutiController extends Controller
{
    // Tambah Ajuan Cuti
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

        $user = User::role('superadmin')->get();

         // calculate tokencuti
         $token = auth()->user()->tokenCuti;

         if($token == 0) {
             Alert::warning('Token Cutimu Telah Habis');
             return redirect()->back();
         } else {
             $calculated = intval($token) - intval($request->total);
             User::where('id',auth()->user()->id)->update(['tokenCuti' => $calculated]);
         }
        
        $cuti->save();

       
       

        Notification::send($user, new CutiCreated($cuti));

        Alert::success('Request Cuti Sukses Dibuat');
        return redirect()->route('cuti.history');
    }

    // Riwayat Cuti
    public function history()
    {
        $data = Cuti::where('who',auth()->user()->id)->paginate(25);
        $dataSuperadmin = Cuti::latest()->paginate(25);
        return view('cuti.history', compact('data','dataSuperadmin'));
    }


    // Tolak Cuti
    public function decline($id)
    {
        $data = Cuti::find($id);
        if ($data->status == "0") {
            $data->status = "2";
        };
        $data->save();

        $user = User::where('id',$data->who)->first();
        Notification::send($user, new CutiDecline($data));

        Alert::toast('Request Cuti Ditolak', 'error');
        return redirect()->route('cuti.history');
    }

    // Setujui Cuti
    public function accept($id)
    {
        $data = Cuti::find($id);
        if ($data->status == "0") {
            $data->status = "1";
        };
        $data->save();

        $user = User::where('id',$data->who)->first();
        Notification::send($user, new CutiAcc($data));

        Alert::success('Request Cuti Diterima');
        return redirect()->route('cuti.history');
    }
}
