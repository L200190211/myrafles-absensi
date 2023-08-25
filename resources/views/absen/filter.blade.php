@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'History Absensi')

@section('mxwidth')

@endsection

@section('titlepage')
<h2>History Absensi</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
</div>


@endsection

@section('content')
@role('superadmin')
<div class="filter">
<form method="GET" action="{{route('absen.filter')}}" class="filter_form">
            <div class="formgroup_filter m-0">
                <label for="exampleFormControlInput1" class="form-label m-0">User</label>
                <select class="form-control" name="userID">
                @foreach ($user as $users)
                    <option value="{{$users->id}}">{{$users->firstname}}</option>
                @endforeach
                </select>
            </div>
        <div class="formgroup_filter m-0">
                <label for="exampleFormControlInput1" class="form-label m-0">Bulan</label>
                <select class="form-control" name="bulan">
                @foreach ($month as $key => $mont)
                    <option value="{{$key+1}}">{{$mont}}</option>
                @endforeach
                </select>
            </div>
            <div class="formgroup_filter m-0">
                <label for="exampleFormControlInput1" class="form-label m-0">Tahun</label>
                <select class="form-control" name="tahun">
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
            </div>
        <button type="submit" class="btn-submit btn-lg" id="submit">Submit</button>
   </form>
</div>
@endrole
<div class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h3>History Cuti</h3>
        </div>
    </div>
</div>

<div class="card">
                    <div class="card-body">
                        <div class="container-calendar">
                         <div id='calendar'></div>
                        </div>
                       {{json_encode($data)}}
                  </div>
</div>
@endsection

@push('js')
<script>
    var events = '';
    let dataView = "{{json_encode($data)}}";
    console.log(dataView)
    $.ajax({
      url: '/absen/absensi/filter',
      dataType: 'json',
      type: 'GET',
      success: function(data) {
        events = JSON.stringify(dataView);
        console.log(data)
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            locale:'id',
            editable: false,
            displayEventTime: true,
            selectable: false,
            droppable: false,
            events: JSON.parse(events)
        });
      } ,error: function(xhr, status, error) {
        },
    });
</script>
@endpush