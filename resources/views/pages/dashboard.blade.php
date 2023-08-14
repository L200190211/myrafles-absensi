@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Dashboard')

@section('content')
    
       
        <div class="row">
            <div class="col-lg-7">
                <div class="jumbotron">
                    <h3>Welcome Back, John Doe 👋</h3>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="liveclock">
                   <div id="time"></div>
                    <span>{{now()->format('j F Y');}}</span>
                </div>
            </div>
        </div>
      
        <div class="row mt-7">
            <div class="col-lg-12">
                <ul class="navigate">
                    <li><a href="{{route('absen.history')}}"><i class="fa fa-home"></i> History Absensi</a></li>
                    <li><a href="{{route('cuti.history')}}"><i class="fa fa-home"></i>  Kelola Cuti</a></li>
                    <li><a href="#"><i class="fa fa-home"></i> Ubah Password</a></li>
                    <li><a href="{{route('user.list')}}"><i class="fa fa-home"></i> Lists User</a></li>
                    <li> <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-link font-weight-bold px-0">
                            <i class="fa fa-home"></i> <span>Log Out</span>
                        </a>
                    </form>
                </ul>
            </div>
        </div>
@endsection

@push('js')
<script>
  function showTime() {
    let a = moment().format('H:m:s')
    document.getElementById('time').innerHTML = "<b>"+a+"</b>";
  }

  setInterval(showTime, 1000);

</script>
@endpush
