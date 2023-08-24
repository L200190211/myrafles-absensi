<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Absen;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Response;

class AbsenController extends Controller
{
    
    public function history() {
        
        $month = array_map(fn($month) => Carbon::create(null, $month)->format('F'), range(1, 12));
        return view('absen.history',compact('month'));

    }

    public function absensi() {
 
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now();

        $query = Absen::where('users_id',auth()->user()->id)->whereBetween('tgl_absen', [$start, $end])->get();

        foreach($query as $absensi ) {
            $events[]= [
                "title" => Carbon::parse($absensi->created_at)->format('H:i'),
                "start"=> Carbon::parse($absensi->created_at)->format('Y-m-d'),                   
            ]; 
        }

        return Response::make($events, 200, array('Content-Type'=>'application/json; charset=utf-8' ));
    }


    public function filter(Request $request) {

        $m = $request->bulan;
        $y = $request->tahun;
        $filters = Absen::with('users')->whereMonth('created_at', $m)
            ->whereYear('created_at', $y)
            ->get();
        
        return view('absen.filter',compact('filters'));

    }

}
