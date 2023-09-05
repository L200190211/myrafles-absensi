<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Notifications\CutiCreated;
use App\Models\Cuti;
use Carbon\Carbon;
use Alert;
use DateTime;
use App\Models\User;
use App\Notifications\CutiAcc;
use App\Notifications\CutiDecline;
use Illuminate\Support\Facades\Notification;

use function Laravel\Prompts\confirm;

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

        // calculate tokencuti
        $token = auth()->user()->tokenCuti;

        if ($token >= 1) {

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
        } else {

            Alert::warning('Token Cutimu Telah Habis');
            return redirect()->back();
        }

        $cuti->save();

        Notification::send($user, new CutiCreated($cuti));

        Alert::success('Request Cuti Sukses Dibuat');
        return redirect()->route('cuti.history');
    }

    // Riwayat Cuti
    public function history()
    {
        $data = Cuti::where('who', auth()->user()->id)->paginate(25);
        $name = User::all();


        $dataSuperadmin = Cuti::join('users', 'users.id', '=', 'cutis.who')
            ->select('cutis.*', 'cutis.created_at AS when', 'users.firstname')
            ->orderByDesc('cutis.created_at')->paginate(25);

        // dd($name);
        return view('cuti.history', compact('data', 'dataSuperadmin', 'name'));
    }
    // Riwayat Cuti
    public function kelola()
    {
        $data = Cuti::where('who', auth()->user()->id)->paginate(25);
        $dataSuperadmin = Cuti::latest()->paginate(25);
        return view('cuti.kelola', compact('data', 'dataSuperadmin'));
    }


    // Tolak Cuti
    public function decline($id, Request $request)
    {
        $now = new DateTime();
        $year = Carbon::parse($now)->format('Y');
        $month = Carbon::parse($now)->format('m');
        $day = Carbon::parse($now)->format('d');
        $hour = now()->format('H');
        $minute = now()->format('i');
        $tz = 'Asia/Jakarta';

        $dateDec = Carbon::create($year, $month, $day, $hour, $minute, $tz);

        $data = Cuti::find($id);
        if ($data->status == "0") {
            $data->status = "2";
            $data->update([
                'whoAcc' => auth()->user()->id,
                'tglAcc' => $dateDec,
            ]);
        };
        $data->save();

        $user = User::where('id', $data->who)->first();
        Notification::send($user, new CutiDecline($data));

        Alert::toast('Request Cuti Ditolak', 'error');
        return redirect()->route('cuti.history');
    }

    // Setujui Cuti
    public function accept(Request $request)
    {
        $now = new DateTime();
        $year = Carbon::parse($now)->format('Y');
        $month = Carbon::parse($now)->format('m');
        $day = Carbon::parse($now)->format('d');
        $hour = now()->format('H');
        $minute = now()->format('i');
        $tz = 'Asia/Jakarta';

        $dateAcc = Carbon::create($year, $month, $day, $hour, $minute, $tz);

        $data = Cuti::find($request->id);
        if ($data->status == "0") {
            $data->status = "1";
            $data->update([
                'whoAcc' => auth()->user()->id,
                'tglAcc' => $dateAcc,
            ]);
        };

        $data->save();

        $who = User::where('id', $data->who)->get();

        // Calculated -1 Token Cutis Where Cutis ACC
        foreach ($who as $whoo) {
            $token = intval($whoo->tokenCuti);
            $calculated = intval($token) - intval($data->total);
            User::where('id', $data->who)->update(['tokenCuti' => $calculated]);
        }

        $user = User::where('id', $request->who)->first();
        Notification::send($user, new CutiAcc($data));

        Alert::success('Berhasil Acc Cuti');
        return redirect()->route('cuti.history');
    }
}
