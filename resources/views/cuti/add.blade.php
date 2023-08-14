@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Add Cuti')

@section('mxwidth')
smallwrap
@endsection

@section('titlepage')
<h2>Ajukan Cuti</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-primary"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
    <a href="{{ route('cuti.history') }}" class="btx btn-primary btn-id">History Cuti</a>
</div>
@endsection

@section('content')
<div class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h3>Add Cuti</h3>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form class="#" method="POST" action="{{-- route('produk.store') --}}">
            @csrf
            <div class="grid grid2">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label mb-3">SKU</label>
                    <input type="text" class="form-control" id="sku" name="sku" placeholder="Masukkan SKU">
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label mb-3">Harga Produk</label>
                    <div class="input-group">
                        <input type="text/" class="form-control rupiah" id="harga" name="harga" placeholder="Masukkan Harga Jual Produk">
                        <span class="input-group-text">Hari</span>
                    </div>
                </div>
            </div>
            <div class="grid grid2">
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label mb-3">Unit</label>
                    <input type="text" class="form-control" name="unit" placeholder="Contoh : pcs, kotak">
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label mb-3">Kategori</label>
                    <select name="kategori" class="form-control select2" autocomplete="off">
                        <option selected="" disabled="">--- Pilih Salah Satu ---</option>
                        <option value="kecantikan">Kecantikan</option>
                        <option value="kesehatan">Kesehatan </option>
                    </select>
                </div>
            </div>
            <div class="formgroup">
                <label for="exampleFormControlInput1" class="form-label mb-3">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Produk">
            </div>
            <button type="submit" class="btn btn-submit mt-4">Tambah Produk</button>
        </form>
    </div>
</div>
@endsection

@push('js')
@endpush