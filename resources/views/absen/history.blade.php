@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'History Absensi')

@section('mxwidth')

@endsection

@section('titlepage')
<h2>History Absensi</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
    <a href="{{-- route('absen.create') --}}" class="btx btn-third btn-id">+ Absensi Baru</a>
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

<div class="card">
                    <div class="card-body">
                        <div class="container-calendar">
                         <div id='calendar'></div>
                        </div>
                  </div>
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
        console.log(events)
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
      }
    });
</script>
@endpush