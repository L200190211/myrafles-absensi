<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Absen;

use Illuminate\Support\Facades\Response;

class AbsenController extends Controller
{
    
    public function history() {
        
        return view('absen.history');

    }

    public function absensi() {
 
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now();

        $query = Absen::where('users_id',auth()->user()->id)->whereBetween('tgl_absen', [$start, $end])->get();

        foreach($query as $absensi ) {
            $events[]= [
                "title" => Carbon::parse($absensi->tgl_absen)->format('H:s'),
                "start"=> Carbon::parse($absensi->tgl_absen)->format('Y-m-d'),                   
            ]; 
        }

        return Response::make($events, 200, array('Content-Type'=>'application/json; charset=utf-8' ));;
    }

}
