@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Edit User')

@section('mxwidth')

@endsection

@section('titlepage')
<h2>Edit User</h2>
<div class="title-right">
    <a href="{{ route('user.list') }}" class="btx btn-third btn-id"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('user.update', $data->id) }}">
            @csrf
            <div class="grid grid3">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Nama User</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap..." value="{{ $data->firstname }}" required>
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="usrn" placeholder="Untuk Akses Log in..." value="{{ $data->username }}" required>
                </div>
                <div class=" formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Level User</label>
                    <select name="idRole" class="form-control js-example-responsive" autocomplete="off" required>
                        <option selected disabled>--- Pilih Salah Satu ---</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == $data->roles->pluck('id')[0] ? 'selected' : '' }}>
                            @if ($role->id == 1)
                            Superadmin
                            @elseif ($role->id == 2)
                            Admin
                            @else
                            Staff
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid3">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" placeholder="Asal User..." value="{{ $data->jabatan }}" required>
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Email Aktif</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="text/" class="form-control" name="email" placeholder="Email Aktif..." value="{{ $data->email }}" required>
                    </div>
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">No Whatsapp</label>
                    <div class="input-group">
                        <span class="input-group-text">+62</span>
                        <input type="text" class="form-control" name="noWa" placeholder="Ketik tanpa +62 / 0..." value="{{ $data->noWa }}" required>
                    </div>
                </div>
            </div>
            <div class="grid grid2">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Masukkan Alamat Anda">{{ $data->alamat }}</textarea>
                </div>
                
            </div>

            <div class="col-md-12 flex-center m-t-40">
                <button type="submit" class="btn btn-submit btn-lg">Ubah Data</button>

               
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