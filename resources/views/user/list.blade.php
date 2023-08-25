@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'List User')

@section('mxwidth')

@endsection

@section('titlepage')
<h2>List User</h2>
<div class="title-right">
    <a href="{{ route('home') }}" class="btx btn-third"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
    <a href="{{ route('user.create') }}" class="btx btn-secondary btn-id">+ User Baru</a>
</div>
@endsection

@section('content')
<div class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="jumbotron">
            <h3>List User</h3>
        </div>
    </div>
</div>

<div>
    <table class="table table-hover table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col" style="width:5%;">No</th>
                <th scope="col">Nama User</th>
                <th scope="col">Posisi</th>
                <th scope="col">Kota</th>
                <th scope="col">Login Terakhir</th>
                <th scope="col" style="width:5%;">Action</th>
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
                    @if ($user->hasRole('superadmin'))
                    Superadmin
                    @elseif ($user->hasRole('admin'))
                    Admin
                    @else
                    Staff
                    @endif
                </td>
                <td>
                    {{ $user->city }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($user->lastLogin)->locale('id')->diffForHumans(null, true) . ' lalu' }}
                </td>
                <td>
                    <a href="{{ route('user.edit', $user->id) }}" class="btx btn-prev"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                    <a href="{{ route('user.delete', $user->id) }}" class="btx btn-third del-btn"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.del-btn').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');

            Swal.fire({
                title: 'Hapus User',
                text: "Yakin Hapus User Ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Tidak Jadi',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        });
    })
</script>

@endpush