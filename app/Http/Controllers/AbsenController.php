<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Absen;
use App\Models\User;
use Alert;
use Illuminate\Support\Facades\Response;

class AbsenController extends Controller
{
    
    public function history() {
        
        $month = array_map(fn($month) => Carbon::create(null, $month)->format('F'), range(1, 12));
        $user = User::all();
        return view('absen.history',compact('month','user'));

    }

    public function absensi() {
 
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now();

        $query = Absen::where('users_id',auth()->user()->id)->whereBetween('tgl_absen', [$start, $end])->get();
        $events = [];
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
        $user = User::all();
        $month = array_map(fn($month) => Carbon::create(null, $month)->format('F'), range(1, 12));

        $filters = Absen::where('users_id',$request->userID)->whereMonth('created_at', $m)->whereYear('created_at', $y)->get();
        $events = [];
        foreach($filters as $absensi ) {
            $events[]= [
                "title" => Carbon::parse($absensi->created_at)->format('H:i'),
                "start"=> Carbon::parse($absensi->created_at)->format('Y-m-d'),                   
            ]; 
        }

    //    $data =  Response::make($events, 200, array('Content-Type'=>'application/json; charset=utf-8'));
       $data =  response()->json($events);
        return view('absen.filter',compact('filters','user','month','data'));

    }


    public function checkin(Request $request) {

        Absen::create(['users_id' => auth()->user()->id , 'tgl_absen' => $request->waktu , 'ip_address' => $request->ip()]);
        Alert::success('Check in berhasil');
        return redirect()->back();
        
    }

}
