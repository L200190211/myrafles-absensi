<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Absen;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Alert;
use Illuminate\Support\Facades\Response;

class AbsenController extends Controller
{
    
    public function history() {
        
        $month = array_map(fn($month) => Carbon::create(null, $month)->format('F'), range(1, 12));
        $user = User::role('staff')->where('status',1)->get();
        return view('absen.history',compact('month','user'));

    }

    public function absensi() {
 
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

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

       
        if($request->ajax()){
            $m = $request->bulan;
            $y = $request->tahun;
            $month = array_map(fn($month) => Carbon::create(null, $month)->format('F'), range(1, 12));

            $filters = Absen::where('users_id',$request->userID)->whereMonth('created_at', $m)->whereYear('created_at', $y)->get();
            $events = [];
            foreach($filters as $absensi ) {
                $events[]= [
                    "title" => Carbon::parse($absensi->created_at)->format('H:i'),
                    "start"=> Carbon::parse($absensi->created_at)->format('Y-m-d'),                   
                ]; 
            }
            return Response::make($events, 200, array('Content-Type'=>'application/json; charset=utf-8'));
        }
        

    //    $data = response()->json($events);
    //     return view('absen.filter',compact('filters','user','month','data'));

    }


    public function checkin(Request $request) {
 
 
        $ipnya = '127.0.0.1';

        // $ipnya = '111.94.147.' RFLS
        // $ipnya = '182.253.90.' JSTR
        // $ipnya = '127.0.0.' LOCAL
        
        if (substr($request->ip(),0,11) == $ipnya){
            Absen::create(['users_id' => auth()->user()->id , 'tgl_absen' => $request->waktu , 'ip_address' => $request->ip()]);
            Alert::success('Check in berhasil');
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors(['ip' => 'Absen Gagal, Pastikan kamu terhubung dengan Wi-Fi Kantor']);
        }
        
    }

}
