@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'Notifikasi')

@section('mxwidth')
smallwrap
@endsection

@section('titlepage')
<h2>Notifikasi</h2>
<div class="title-right">
    <a onclick="history.back()" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
</div>
@endsection


@section('style')
<style>
.notifactive {
	background: #f1fbff !important;
	display: block;
	padding: 15px;
	border-radius: 10px;
  margin-bottom:10px;
}
.notif_div p {margin:0;display:flex;justify-content:space-between;align-items:center;}
.badge_notif {
	background: var(--color-main);
	border-radius: 5px;
	padding: 4px 8px;
	inline-size: min-content;
	margin: auto 0;
	color: #fff;
}
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
           @php
                $showNotif = auth()->user()->unreadNotifications()->latest()->paginate(5);
                @endphp
   


     @forelse($showNotif as $key => $notif)
     <div class="notif_div">
          <a class="mark-as-read notifactive" data-id="{{$notif->id}}" >
                  <p>{{ $notif->data['text'] }} {{ $notif->data['pegawai']}} <span class="badge badge_notif">{{ $notif->created_at->diffForHumans(null, false, true) }}</span></p>
              </a>
      </div>
        
      @empty
      <div class="">No notifications</div>
      @endforelse
    @if (count($showNotif) > 0)
    <button id="mark-all" class="btn btn-primary mt-3">Bersihkan Notifikasi</button>
    @endif
    </div>
</div>
@endsection

@push('js')
<script>
 $(function() {
        $('.mark-as-read').click(function() {
            var request = sendRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('.notifactive').remove();
                window.location.href = "{{route('cuti.history')}}";
            });
          
        });
        $('#mark-all').click(function() {
            var request = sendRequest();
            request.done(() => {
                $('.notifactive').remove();
								 location.reload(); 
            })
        });
    });

    function sendRequest(id = null) {
        var _token = "{{ csrf_token() }}";
        return $.ajax("{{ route('markAsNotification') }}", {
            method: 'POST',
            data: {_token, id}
        });
    }
</script>
@endpush