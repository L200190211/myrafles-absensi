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
            @forelse ($data as $produk)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td>
                    {{ Carbon\Carbon::parse($produk->tglCuti)->locale('id')->translatedFormat('d F Y') }}
                </td>
                <td>
                    {{ $produk->perihal }}
                </td>
                <td>
                    @if ($produk->status == 0)
                    Menunggu
                    @elseif ($produk->status == 1)
                    Diterima
                    @else
                    Ditolak
                    @endif
                </td>
                <td>
                    {{ $produk->total }} Hari
                </td>
                <td>
                    <!-- <a href="{{ url()->previous() }}" class="btx btn-third"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</a> -->
                    <!-- Button trigger modal -->
                    <a href="#">
                        <button type="button" class="btx btn-third" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$produk->id}}"><i class="fa fa-eye" aria-hidden="true"></i> Lihat
                        </button>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{$produk->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">{{ $produk->perihal }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true" style="color: #000;"></i>
                                    </button>
                                </div>
                                <div class="modal-body left-text">
                                    {{ $produk->rincian }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Understood</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Produk Kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('js')
@endpush