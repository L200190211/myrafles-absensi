@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Ubah Password')

@section('mxwidth')
smallwrap
@endsection

@section('titlepage')
<h2>Ubah Password</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('user.pass') }}">
            @csrf
            <div class="grid">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label mb-3">Password Baru</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="new_password" autocomplete="current-password" required="" placeholder="*********">
                    </div>
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label mb-3">Ketik Ulang Password Baru</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" required="" placeholder="*********">
                    </div>
                </div>
            </div>
            <button type="submit" class="btx btn-submit mt-1">Ubah</button>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>

</script>
@endpush