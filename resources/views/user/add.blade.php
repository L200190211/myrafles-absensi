@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Add User')

@section('mxwidth')

@endsection

@section('titlepage')
<h2>Tambah User</h2>
<div class="title-right">
    <a href="{{ route('user.list') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('user.store') }}">
            @csrf
            <div class="grid grid3">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Nama User</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap...">
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="usrn" placeholder="Untuk Akses Log in...">
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Level User</label>
                    <select name="idRole" class="form-control js-example-responsive" autocomplete="off">
                        <option selected disabled>--- Pilih Salah Satu ---</option>
                        {{-- @if (auth()->user()->hasRole('superadmin')) --}}
                        <option value="1">Superadmin</option>
                        {{-- @endif --}}
                        <option value="2">Admin</option>
                        <option value="3">Staff</option>
                    </select>
                </div>
            </div>
            <div class="grid grid3">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Email Aktif</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text/" class="form-control" name="email" placeholder="Email Aktif...">
                    </div>
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Kota User</label>
                    <input type="text" class="form-control" name="kota" placeholder="Asal User...">
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">No Whatsapp</label>
                    <div class="input-group">
                        <span class="input-group-text">+62</span>
                        <input type="text" class="form-control" name="noWa" placeholder="Ketik tanpa +62 / 0...">
                    </div>
                </div>
            </div>
            <div class="grid grid2">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Masukkan Alamat Anda"></textarea>
                </div>
                <div class="formgroup">
                    <label for="exampleInputEmail1" class="form-label">About</label>
                    <textarea class="form-control" id="about" name="about" placeholder="Masukkan Rincian Anda"></textarea>
                </div>
            </div>

            <div class="col-md-12 flex-center m-t-40">
                <button type="submit" class="btn btn-submit btn-lg">Tambah User</button>

                <span class="helptext m-l-20 inline"><b class="red">Note :</b>
                    User bisa melakukan reset password untuk mengganti password baru, Pass Otomatis Terisi : 1234</span>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $(".js-example-responsive").select2({
            width: 'resolve',
        });

    });
</script>
@endpush