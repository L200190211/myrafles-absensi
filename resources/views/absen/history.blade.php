@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Riwayat Absensi')

@section('mxwidth')

@endsection

@push('style')
@section('titlepage')
<h2>Riwayat Absensi</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
</div>


@endsection

@section('content')
@role('superadmin')
<div class="filter">
    <form method="GET" class="filter_form">
        <div class="formgroup_filter">
            <label for="exampleFormControlInput1" class="form-label m-0">Nama Staff</label>
            <select class="form-control" name="userID" id="userID">
                @foreach ($user as $users)
                <option value="{{$users->id}}">{{$users->firstname}}</option>
                @endforeach
            </select>
        </div>
        <div class="formgroup_filter">
            <label for="exampleFormControlInput1" class="form-label m-0">Bulan</label>
            <select class="form-control" name="bulan" id="bulan">
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>
        <div class="formgroup_filter">
            <label for="exampleFormControlInput1" class="form-label m-0">Tahun</label>
            <select class="form-control" name="tahun" id="tahun">
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023" selected>2023</option>
            </select>
        </div>
        <button type="submit" class="btn btn-white btn-lg" id="submit">Submit</button>
    </form>
</div>
@endrole
<div class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h3>Riwayat Absen</h3>
        </div>
    </div>
</div>


<div class="absen-table">
    <table id="example" class="table absen-table table-hover table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col" style="width:5%;" rowspan="2">No</th>
                <th scope="col" rowspan="2">Nama User</th>
                <th scope="col" colspan="7" style="text-align: center;">Bulan September</th>
            </tr>
            <tr>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">3</th>
                <th scope="col">4</th>
                <th scope="col">5</th>
                <th scope="col">6</th>
                <th scope="col">...</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($data as $key => $user)
            <tr>
                <td scope="row" style="padding: 1.75rem 2rem !important;">{{ $data->firstItem() + $key }}</td>
                <td>
                    {{ $user->firstname }}
                </td>
                <td>
                    <span class="absen-success">08.00</span>
                </td>
                <td>
                    <span class="absen-danger">09.10</span>
                </td>
                <td>
                    <span>-</span>
                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">User Kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{$data->links()}}
</div>

@endsection

@push('js')

@endpush