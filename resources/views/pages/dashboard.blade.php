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

            <button type="submit" class="btx btn-warning text-dark"><i class="fa fa-door-open" aria-hidden="true"></i> Check IN</button>


        </div>
    </div>
    <div class="col-lg-5">
        <div class="liveclock">
            <div id="time"></div>
            <span>WIB / {{now()->format('j F Y');}}</span>
        </div>
    </div>
</div>

<div class="row mt-7">
    <div class="col-lg-12">
        <ul class="navigate">
            @role(['superadmin','admin'])
            <li><a href="{{route('absen.history')}}"><i class="fa fa-bar-chart"></i> History Absensi</a></li>
            <li><a href="{{route('cuti.history')}}"><i class="fa fa-bar-chart"></i> Kelola Cuti</a></li>
            <li><a href="{{route('user.respass')}}"><i class="fa fa-edit"></i> Ubah Password</a></li>
            <li><a href="{{route('user.list')}}"><i class="fa fa-list"></i> Lists User</a></li>
            <li>
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link font-weight-bold px-0">
                        <i class="fa fa-home"></i> <span>Log Out</span>
                    </a>
                </form>
                @endrole
                @role(['staff'])
            <li><a class="staff" href="{{route('absen.history')}}"><i class="fa fa-bar-chart"></i> History Absensi</a></li>
            <li><a class="staff" href="{{route('cuti.history')}}"><i class="fa fa-bar-chart"></i> Kelola Cuti</a></li>
            <li><a class="staff" href="{{route('user.respass')}}"><i class="fa fa-edit"></i> Ubah Password</a></li>
            <li>
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}" class="staff" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link font-weight-bold px-0">
                        <i class="fa fa-home"></i> <span>Log Out</span>
                    </a>
                </form>
                @endrole
        </ul>
    </div>
</div>
@endsection

@push('js')
<script>
    function showTime() {
        let a = moment().format('H:mm:s')
        document.getElementById('time').innerHTML = "<b>" + a + "</b>";
    }

    setInterval(showTime, 1000);
</script>
@endpush