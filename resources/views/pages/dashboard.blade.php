@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Dashboard')

@section('content')


<div class="row">
    <div class="col-lg-7">
        <div class="jumbotron">
            <div class="item_jum">
                <div class="welcome">
                    <h3>Welcome Back, {{ implode(' ', array_slice(explode(' ', auth()->user()->firstname), 0, 1)) }} 👋</h3>
                    <span class="subtitle"><svg width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                     </svg> {{auth()->user()->jabatan}} - PT Rafles Energindo Nusantara</span>
                </div>
                @php
                $showNotif = auth()->user()->unreadNotifications()->latest()->paginate(5);
                @endphp
                
              <a href="{{route('home.notif')}}" class="btx-bell"><svg width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                    <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                 </svg>

                @if (count($showNotif ?? ''> 0))
                    
                <span class="badge badge-danger">{{count($showNotif)}}</span>
                @endif
                
                </a>
            </div>
            @if ($absen->created_at ?? null != null)
            @if ($absen->created_at->format('H:i') <= '11:00' ) <div class="notcheck">Terima kasih telah datang tepat waktu 🥳</div>
                @else
                <div class="notcheck">Kamu Telat 
                @if ($absen->created_at->format('H:i') > '11:00' )
                    @php
                        $start_time = $absen->created_at->format('H:i');
                        $end_time = new Carbon\Carbon('11:00');
                        $time_difference_in_minutes = $end_time->diffInMinutes($start_time);
                    @endphp     
                    {{ $time_difference_in_minutes }} menit
                @endif 
                Hari ini. Besok usahakan tepat waktu yaa 😉</div>
                @endif

                @else
                <div class="notcheck">
                    <span>Sudahkah kamu check-in Hari ini ? ✌️</span>
                <form action="{{route('absen.checkin')}}" method="POST">
                    @csrf
                    <input type="hidden" name="waktu" id="waktu">
                    <button type="submit" class="btx-check">Check-in <svg xmlns="http://www.w3.org/2000/svg" width="52" height="12" viewBox="0 0 52 12" fill="none"><path d="M51.5303 6.53033C51.8232 6.23744 51.8232 5.76256 51.5303 5.46967L46.7574 0.696699C46.4645 0.403806 45.9896 0.403806 45.6967 0.696699C45.4038 0.989593 45.4038 1.46447 45.6967 1.75736L49.9393 6L45.6967 10.2426C45.4038 10.5355 45.4038 11.0104 45.6967 11.3033C45.9896 11.5962 46.4645 11.5962 46.7574 11.3033L51.5303 6.53033ZM0 6.75H51V5.25H0V6.75Z" fill="white"></path></svg></button>
                </form>
                </div>
                @endif

                @if ($absen->created_at ?? null != null)

                @else
                
                @endif


        </div>
    </div>
    <div class="col-lg-5">
        <div class="liveclock">
            <div id="time"><b>16:36:11</b></div>
            <span>{{ Carbon\Carbon::parse(now())->locale('id')->translatedFormat('l') }} , {{now()->format('j F Y');}}</span>
        </div>
    </div>
</div>

<ul class="navigate">
    @role(['superadmin','admin'])
    <li><a href="{{route('absen.history')}}"><img src="{{ asset('assets/img/history.png') }}" /> History Absensi</a></li>
    <li><a href="{{route('cuti.history')}}"><img src="{{ asset('assets/img/cuti.png') }}" /> Kelola Cuti</a></li>
    <li><a href="{{route('user.respass')}}"><img src="{{ asset('assets/img/pass.png') }}" /> Ubah Password</a></li>
    <li><a href="{{route('user.list')}}"><img src="{{ asset('assets/img/user.png') }}" /> List User</a></li>
    <li>
        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link font-weight-bold px-0">
                <img src="{{ asset('assets/img/logout.png') }}" /> <span>Log Out</span>
            </a>
        </form>
        @endrole
        @role(['staff'])
    <li><a class="staff" href="{{route('absen.history')}}"><img src="{{ asset('assets/img/history.png') }}" /> History Absensi</a></li>
    <li><a class="staff" href="{{route('cuti.history')}}"><img src="{{ asset('assets/img/cuti.png') }}" /> Kelola Cuti</a></li>
    <li><a class="staff" href="{{route('user.respass')}}"><img src="{{ asset('assets/img/pass.png') }}" /> Ubah Password</a></li>
    <li>
        <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="{{ route('logout') }}" class="staff" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link font-weight-bold px-0">
                <img src="{{ asset('assets/img/logout.png') }}" /> <span>Log Out</span>
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