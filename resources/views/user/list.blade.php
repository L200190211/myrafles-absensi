@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'List User')

@section('mxwidth')

@endsection

@section('titlepage')
<h2>List User</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
    <a href="{{-- route('user.create') --}}" class="btx btn-third btn-id">+ User Baru</a>
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
                <th scope="col">Nama</th>
                <th scope="col">Role</th>
                <th scope="col">Cuti Diambil</th>
                <th scope="col" style="width:5%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            {{-- @forelse ($data as $user) --}}
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td>

                </td>
                <td>

                </td>
                <td>
                    x Hari
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <a href="#">
                        <button type="button" class="btx btn-prev" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{--$user->id--}}"><i class="fa fa-eye" aria-hidden="true"></i> Lihat
                        </button>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade cuti" id="staticBackdrop{{--$user->id--}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true" style="color: #000;"></i>
                                    </button>
                                </div>
                                <div class="modal-body left-text mt-3">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec placerat eros velit, pretium aliquet est pulvinar vel. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris malesuada urna vel lacus molestie finibus. Vivamus non nisi et massa varius malesuada vel a tortor. Maecenas lacus tellus, volutpat non enim id, porttitor egestas sem. Duis consequat nisl massa, vitae feugiat est porttitor vel. Vivamus vestibulum sapien sit amet nunc tempus viverra ultrices nec dui. Curabitur nisi metus, aliquet vitae mollis sit amet, dapibus vitae nibh. </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            {{-- @empty --}}
            <tr>
                <td colspan="6" style="text-align: center;">User Kosong</td>
            </tr>
            {{-- @endforelse --}}
        </tbody>
    </table>
</div>
@endsection

@push('js')
@endpush