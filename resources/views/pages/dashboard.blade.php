@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Dashboard')

@section('content')


<div class="row">
    <div class="col-lg-7">
        <div class="jumbotron">
            <div class="item_jum">
                <h3>Welcome Back, {{ implode(' ', array_slice(explode(' ', auth()->user()->firstname), 0, 1)) }} 👋</h3>
                <span><button class="btx btn-warning"><i class="fa fa-bell-o" aria-hidden="true"></i></button></span>
            </div>
            @if ($absen->created_at ?? null != null) 
                @if ($absen->created_at->format('H:i') < '10:00' )
                    <p class="text-white">Good Joob ! </p>
                @else
                    <p class="text-white">AGAK TELAT YE ! </p>
                @endif
                   
            @else    
                <p class="text-white">Belum Check in Ya ?</p>
            @endif
            
             @if ($absen->created_at ?? null != null)
                   
             @else
              <form action="{{route('absen.checkin')}}" method="POST">
                        @csrf
                        <input type="hidden" name="waktu" id="waktu">
                        <button type="submit" class="btx btn-warning text-dark"><i class="fa fa-door-open" aria-hidden="true"></i> Check IN</button>
                    </form>
             @endif


        </div>
    </div>
    <div class="col-lg-5">
        <div class="liveclock">
            <div id="time"></div>
            <span style="margin:17px 0;">{{ Carbon\Carbon::parse(now())->locale('id')->translatedFormat('l') }}</span>
            <span style="margin:0">WIB / {{now()->format('j F Y');}}</span>
        </div>
    </div>
</div>

        <ul class="navigate">
            @role(['superadmin','admin'])
            <li><a href="{{route('absen.history')}}"><img src="{{ asset('assets/img/history.png') }}"/> History Absensi</a></li>
            <li><a href="{{route('cuti.history')}}"><img src="{{ asset('assets/img/cuti.png') }}"/> Kelola Cuti</a></li>
            <li><a href="{{route('user.respass')}}"><img src="{{ asset('assets/img/pass.png') }}"/> Ubah Password</a></li>
            <li><a href="{{route('user.list')}}"><img src="{{ asset('assets/img/user.png') }}"/> List User</a></li>
            <li>
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link font-weight-bold px-0">
                        <img src="{{ asset('assets/img/logout.png') }}"/> <span>Log Out</span>
                    </a>
                </form>
                @endrole
                @role(['staff'])
            <li><a class="staff" href="{{route('absen.history')}}"><img src="{{ asset('assets/img/history.png') }}"/> History Absensi</a></li>
            <li><a class="staff" href="{{route('cuti.history')}}"><img src="{{ asset('assets/img/cuti.png') }}"/> Kelola Cuti</a></li>
            <li><a class="staff" href="{{route('user.respass')}}"><img src="{{ asset('assets/img/pass.png') }}"/> Ubah Password</a></li>
            <li>
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}" class="staff" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link font-weight-bold px-0">
                        <img src="{{ asset('assets/img/logout.png') }}"/> <span>Log Out</span>
                    </a>
                </form>
                @endrole
        </ul>
@endsection

@push('js')
<script>
    function showTime() {
        let a = moment().format('H:mm:s')
        let formated = moment().format("YYYY-MM-DD HH:mm:ss")
        document.getElementById('time').innerHTML = "<b>" + a + "</b>";
        document.getElementById('waktu').value = formated;
    }

    setInterval(showTime, 1000);
</script>
@endpush