@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Add Cuti')

@section('mxwidth')
smallwrap
@endsection

@section('titlepage')
<h2>Ajukan Cuti</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
    <a href="{{ route('cuti.history') }}" class="btx btn-third btn-id">History Cuti</a>
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
                    <label for="exampleFormControlInput1" class="form-label mb-3">Tanggal Cuti</label>
                    <input type="date" class="form-control" id="tglCuti" name="tglCuti" placeholder="Masukkan Tgl Cuti">
                </div>
                <div class="formgroup">
                    <label for="exampleFormControlInput1" class="form-label mb-3">Berapa Hari Kerja</label>
                    <div class="input-group">
                        <input type="text/" class="form-control" id="total" name="total" placeholder="Masukkan Total Hari">
                        <span class="input-group-text" style="border-right: 1px solid #d2d6da !important">Hari</span>
                    </div>
                </div>
            </div>
            <div class="grid grid2">
                <div class="formgroup w60">
                    <label for="exampleFormControlInput1" class="form-label mb-3">Perihal Cuti</label>
                    <select name="perihal" class="form-control select2" autocomplete="off" id="perihal">
                        <option selected="" disabled="">--- Pilih Salah Satu ---</option>
                        @foreach ($perihal as $perihals)
                        <option value="{{$perihals}}" selected="">{{$perihals}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="formgroup">

                </div>
            </div>
            <div class="formgroup">
                <label for="exampleFormControlInput1" class="form-label mb-3">Rincian Cuti</label>
                <textarea class="form-control" id="rincian" name="rincian" placeholder="Masukkan Rincian Cuti"></textarea>
            </div>
            <input type="hidden" name="who" value="{{auth()->user()->id}}" />
            <button type="submit" class="btx btn-submit mt-1">Submit</button>
        </form>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        //select2
        $("#perihal").select2();
    });
</script>
@endpush