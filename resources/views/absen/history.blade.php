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
var calendar = $('#calendar').fullCalendar({
    
    editable:true,
    header:{
        left:'prev,next today',
        center:'title',
        right:'month,agendaWeek,agendaDay'
    },
    dropable:true,
    events:'/full-calender',
    selectable:true,
    selectHelper: true,
    select:function(start, end, allDay)
    {
        var title = prompt('Event Title:');

        if(title)
        {
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');

            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD');

            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    type: 'add'
                },
                success:function(data)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Created Successfully");
                }
            })
        }
    },
    editable:true,
    eventResize: function(event, delta)
    {
        var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD');
        var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD');
        var title = event.title;
        var id = event.id;
        $.ajax({
            url:"/full-calender/action",
            type:"POST",
            data:{
                title: title,
                start: start,
                end: end,
                id: id,
                type: 'update'
            },
            success:function(response)
            {
                calendar.fullCalendar('refetchEvents');
                alert("Event Updated Successfully");
            }
        })
    },
    eventDrop: function(event, delta)
    {

        var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD');
        var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD');
        let draggableEl = document.getElementById('mydraggable');
        var title = event.title;
        var id = event.id;
        $.ajax({
            url:"/full-calender/action",
            type:"POST",
            data:{
                title: title,
                start: start,
                end: end,
                id: id,
                type: 'update'
            },
            success:function(response)
            {
                calendar.fullCalendar('refetchEvents');
                alert("Event Updated Successfully");
            }
        })
    },
    eventClick:function(event)
    {
        if(confirm("Are you sure you want to remove it?"))
        {
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    id:id,
                    type:"delete"
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Deleted Successfully");
                }
            })
        }
    }
});
</script>
@endpush