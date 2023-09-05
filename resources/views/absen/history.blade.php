@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Riwayat Absensi')

@section('mxwidth')

@endsection

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
            <h3>History Absen</h3>
        </div>
    </div>
</div>


<div class="container-calendar">
    <div id='calendar'></div>
    <div id='calendarfilter'></div>
   </div>
@endsection

@push('js')
<script>

    var event = '';
    $.ajax({
      url: '/absen/absensi',
      dataType: 'json',
      type: 'GET',
      success: function(data) {
        events= JSON.stringify(data);
        console.log(data);
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: '',
                right: 'title'
            },
            locale:'id',
            editable: false,
            displayEventTime: true,
            selectable: false,
            droppable: false,
            events: JSON.parse(events),
            eventRender: function(event, eventElement) {
                if (event.title > "08:00") {
                eventElement.css('background-color', '#DA3540');
                } else {
                eventElement.css('background-color', '#0077a2');
                }
            },
        });
      }
    });


    $('.filter_form').on( 'submit', function(e) {
     var events = '';
        e.preventDefault();
    $.ajax({
      url: '/absen/absensi/filter',
      dataType: 'json',
      type: 'GET',
      data: { 'userID': $("#userID").val() , 'bulan': $("#bulan").val() ,'tahun': $("#tahun").val() },
      success: function(data) {
        events = JSON.stringify(data);
        $('#calendar').fullCalendar('destroy');
        $('#calendar').fullCalendar({
            defaultDate: new Date($("#tahun").val(), $("#bulan").val() - 1),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            locale:'id',
            editable: false,
            displayEventTime: true,
            selectable: false,
            droppable: false,
            events: JSON.parse(events),
            eventRender: function(event, eventElement) {
                if (event.title > "08:00") {
                eventElement.css('background-color', '#DA3540');
                } else {
                eventElement.css('background-color', '#0077a2');
                }
            },
        });

        Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Data telah diubah',
        })

      } ,error: function(xhr, status, error) {
        },
    });
    });
</script>
@endpush