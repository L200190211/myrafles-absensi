@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'History Absen')


@section('mxwidth')

@endsection

@section('titlepage')
<h2>History Absen</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
</div>
@endsection

@section('content')
<div class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h3>History Absen</h3>
        </div>
    </div>
</div>

<div>
    <table class="table table-hover table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col" style="width:5%;">No</th>
                <th scope="col">Nama User</th>
                <th scope="col">Tanggal Cuti</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($filters as $filter)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td scope="row">{{ $filter->users->firstname}}</td>
                <td>
                    {{ Carbon\Carbon::parse($filter->created_at)->locale('id')->translatedFormat('d F Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Cuti Kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('js')
@endpush