@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'History Cuti')


@section('mxwidth')

@endsection

@section('titlepage')
<h2>History Cuti</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-primary"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
    <a href="{{ route('cuti.create') }}" class="btx btn-primary btn-id">+ Buat Cuti</a>
</div>
@endsection

@section('content')
<div class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h3>History Cuti</h3>
        </div>
    </div>
</div>

<div>
    <table class="table table-hover table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col" style="width:5%;">No</th>
                <th scope="col">Tanggal Cuti</th>
                <th scope="col">Alasan</th>
                <th scope="col">Status</th>
                <th scope="col">Durasi</th>
                <th scope="col" style="width:5%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            {{-- @forelse ($data as $produk) --}}
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td>try
                    {{-- $produk->sku --}}
                </td>
                <td>try
                    {{-- $produk->name --}}
                </td>
                <td>try
                    {{-- @if (is_null( $produk->harga ))
                    -
                    @else
                    Rp {{number_format($produk->harga, 0, ".", ".")}}
                    @endif --}}
                </td>
                <td>try
                    {{-- $produk->name --}}
                </td>
                <td>
                    <a href="{{ url()->previous() }}" class="btx btn-third"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a>
                </td>
            </tr>
            {{-- @empty --}}
            <tr>
                <td colspan="6" style="text-align: center;">Produk Kosong</td>
            </tr>
            {{-- @endforelse --}}
        </tbody>
    </table>
</div>
@endsection

@push('js')
@endpush