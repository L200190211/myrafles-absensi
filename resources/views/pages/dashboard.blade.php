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
                    <b>10.45</b>
                    <span>10 Agustus 2023</span>
                </div>
            </div>
        </div>
      
        <div class="row mt-7">
            <div class="col-lg-12">
                <ul class="navigate">
                    <li><a href="#"><i class="fa fa-home"></i> History Absensi</a></li>
                    <li><a href="#"><i class="fa fa-home"></i> History Absensi</a></li>
                    <li><a href="#"><i class="fa fa-home"></i> History Absensi</a></li>
                    <li><a href="#"><i class="fa fa-home"></i> History Absensi</a></li>
                    <li><a href="{{route('logout')}}"><i class="fa fa-home"></i> Log Out</a></li>
                </ul>
            </div>
        </div>
@endsection

@push('js')
@endpush
