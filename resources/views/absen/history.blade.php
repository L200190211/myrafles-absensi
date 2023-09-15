@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Riwayat Absensi')

@section('mxwidth')

@endsection

@push('style')
<style>
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('titlepage')
<h2>Riwayat Absensi</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
</div>


@endsection

@section('content')
<div class="filter">
    <form method="GET" action="{{route('absen.search')}}" class="filter_form">
        @role(['superadmin', 'admin'])
        <div class="formgroup_filter">
            <label for="exampleFormControlInput1" class="form-label m-0">Nama Staff</label>
            <select class="form-control" name="userID" id="userID">
                @foreach ($user as $users)
                <option value="{{ $users->id }}" data-id='{{ $users->id }}' @if($request != NULL) @if($users->id == $request->query('userID')) selected @endif @endif>{{ $users->firstname }}</option>
                @endforeach
            </select>
        </div>
        @endrole
        @role('staff')
        <input type="hidden" id="userID" name="userID" value="{{ auth()->user()->id }}"/>
        @endrole
        <div class="formgroup_filter">
            <label for="exampleFormControlInput1" class="form-label m-0">Bulan</label>
            <select class="form-control" name="bulan" id="bulan">
                <option value="01" @if($request != NULL) @if('01' == $request->query('bulan')) selected @endif @endif>Januari</option>
                <option value="02" @if($request != NULL) @if('02' == $request->query('bulan')) selected @endif @endif>Februari</option>
                <option value="03" @if($request != NULL) @if('03' == $request->query('bulan')) selected @endif @endif>Maret</option>
                <option value="04" @if($request != NULL) @if('04' == $request->query('bulan')) selected @endif @endif>April</option>
                <option value="05" @if($request != NULL) @if('05' == $request->query('bulan')) selected @endif @endif>Mei</option>
                <option value="06" @if($request != NULL) @if('06' == $request->query('bulan')) selected @endif @endif>Juni</option>
                <option value="07" @if($request != NULL) @if('07' == $request->query('bulan')) selected @endif @endif>Juli</option>
                <option value="08" @if($request != NULL) @if('08' == $request->query('bulan')) selected @endif @endif>Agustus</option>
                <option value="09" @if($request != NULL) @if('09' == $request->query('bulan')) selected @endif @endif>September</option>
                <option value="10" @if($request != NULL) @if('10' == $request->query('bulan')) selected @endif @endif>Oktober</option>
                <option value="11" @if($request != NULL) @if('11' == $request->query('bulan')) selected @endif @endif>November</option>
                <option value="12" @if($request != NULL) @if('12' == $request->query('bulan')) selected @endif @endif>Desember</option>
            </select>
        </div>
        <div class="formgroup_filter">
            <label for="exampleFormControlInput1" class="form-label m-0">Tahun</label>
            <select class="form-control" name="tahun" id="tahun">
                <option value="2020" @if($request != NULL) @if('2020' == $request->query('tahun')) selected @endif @endif>2020</option>
                <option value="2021" @if($request != NULL) @if('2021' == $request->query('tahun')) selected @endif @endif>2021</option>
                <option value="2022" @if($request != NULL) @if('2022' == $request->query('tahun')) selected @endif @endif>2022</option>
                <option value="2023" @if($request != NULL) @if('2023' == $request->query('tahun')) selected @endif @endif>2023</option>
                <option value="2024" @if($request != NULL) @if('2024' == $request->query('tahun')) selected @endif @endif>2024</option>
            </select>
        </div>
        <button type="submit" class="btn btn-white btn-lg" id="submit">Submit</button>
    </form>
</div>
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
                <th scope="col" colspan="{{$countday}}" style="text-align: center;">Bulan {{ $monthNow }} / {{$yearNownum}}</th>
            </tr>
            <tr>
                @for ($i = 1; $i <= $countday; $i++) 
                    <th scope="col" style="text-align:center;">{{ $i}}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($data as $key => $user)
            <tr>
                <td scope="row" style="padding: 1.75rem 2rem !important;">{{ $key+1 }}</td>
                <td>
                    {{ $user->firstname }}
                </td>
                {{--<span class="absen-success">08.00</span>
                    <span class="absen-danger">09.10</span> --}}

                @for ($i = 1; $i <= $countday; $i++) <td>
                    @forelse ($absen as $key)
                        <!-- Condition if absen.users_id == users.id -->
                        @if ($key->users_id == $user->id)
                            <!-- Condition if $i == date and $monthNownum == month and $yearNownum == year-->
                            @if ($i == Carbon\Carbon::parse($key->tgl_absen)->translatedFormat('d') AND $monthNownum == Carbon\Carbon::parse($key->tgl_absen)->translatedFormat('m') AND $yearNownum == Carbon\Carbon::parse($key->tgl_absen)->translatedFormat('Y'))
                                <!-- Condition if absen hours > 08.00 -->
                                @if (Carbon\Carbon::parse($key->tgl_absen)->translatedFormat('H:i') > '08:10' )
                                    <span class="absen-danger">{{Carbon\Carbon::parse($key->tgl_absen)->translatedFormat('H:i')}}</span>
                                <!-- Condition if absen hours < 08.00 -->
                                @else
                                    <span class="absen-success">{{Carbon\Carbon::parse($key->tgl_absen)->translatedFormat('H:i')}}</span>
                                @endif
                            @else

                            @endif
                        @else

                        @endif

                    @empty
                    @endforelse
                    </td>
                    @endfor
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">User Kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{--$data->links()--}}
</div>

@endsection

@push('js')
<script>
    // $("#tahun").select2({tags: true});
    // $("#userID").select2({});
    // $("#bulan").select2({});
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush