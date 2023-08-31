@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Cuti')


@section('mxwidth')

@endsection

@section('titlepage')
@role(['superadmin','admin'])
<h2>Kelola Cuti</h2>
@endrole
@role('staff')
<h2>History Cuti</h2>
@endrole
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
    @role('staff')
    <a href="{{ route('cuti.create') }}" class="btx btn-secondary btn-id">+ Buat Cuti</a>
    @endrole
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
            
            @role(['superadmin','admin'])
            @forelse ($dataSuperadmin as $cuti)
                        <tr>
                <td scope="row">{{ $i++ }}</td>
                <td>
                    {{ Carbon\Carbon::parse($cuti->tglCuti)->locale('id')->translatedFormat('d F Y') }}
                </td>
                <td>
                    {{ $cuti->perihal }}
                </td>
                <td>
                    @if ($cuti->status == 0)
                    <p class="badge-primary">Pending</p>
                    @elseif ($cuti->status == 1)
                    <p class="badge-success">Diterima</p>
                    @else
                    <p class="badge-danger">Ditolak</p>
                    @endif
                </td>
                <td>
                    {{ $cuti->total }} Hari
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <a href="#">
                        <button type="button" class="btx btn-prev" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$cuti->id}}"><i class="fa fa-eye" aria-hidden="true"></i> Lihat
                        </button>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade cuti" id="staticBackdrop{{$cuti->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">{{ $cuti->perihal }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true" style="color: #000;"></i>
                                    </button>
                                </div>
                                <div class="modal-body left-text">
                                    <p>{{ $cuti->rincian }}</p>
                                </div>
                                @role(['superadmin','admin'])
                                @if ($cuti->status == 0)
                                <div class="modal-footer mb-3">
                                    <a href="{{ route('cuti.decline', $cuti->id) }}" type="button" class="btn btn-third w25">Decline </a>
                                    <a href="{{ route('cuti.accept', $cuti->id) }}" type="button" class="btn btn-main w70">Accept </a>
                                </div>
                                @else
                                @endif
                                @endrole
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Cuti Kosong</td>
            </tr>
            @endforelse
            @endrole

            @role('staff')
            @forelse ($data as $cuti)
                        <tr>
                <td scope="row">{{ $i++ }}</td>
                <td>
                    {{ Carbon\Carbon::parse($cuti->tglCuti)->locale('id')->translatedFormat('d F Y') }}
                </td>
                <td>
                    {{ $cuti->perihal }}
                </td>
                <td>
                    @if ($cuti->status == 0)
                    <p class="badge-primary">Pending</p>
                    @elseif ($cuti->status == 1)
                    <p class="badge-success">Diterima</p>
                    @else
                    <p class="badge-danger">Ditolak</p>
                    @endif
                </td>
                <td>
                    {{ $cuti->total }} Hari
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <a href="#">
                        <button type="button" class="btx btn-prev" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$cuti->id}}"><i class="fa fa-eye" aria-hidden="true"></i> Lihat
                        </button>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade cuti" id="staticBackdrop{{$cuti->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">{{ $cuti->perihal }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true" style="color: #000;"></i>
                                    </button>
                                </div>
                                <div class="modal-body left-text">
                                    <p>{{ $cuti->rincian }}</p>
                                </div>
                                @role(['superadmin','admin'])
                                @if ($cuti->status == 0)
                                <div class="modal-footer mb-3">
                                    <a href="{{ route('cuti.decline', $cuti->id) }}" type="button" class="btn btn-third w25">Decline </a>
                                    <a href="{{ route('cuti.accept', $cuti->id) }}" type="button" class="btn btn-main w70">Accept </a>
                                </div>
                                @else
                                @endif
                                @endrole
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Cuti Kosong</td>
            </tr>
            @endforelse
            @endrole
            

        </tbody>
    </table>
</div>
@endsection

@push('js')
@endpush