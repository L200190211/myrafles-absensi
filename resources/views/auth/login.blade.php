@extends('layouts.app-auth')
@section('title', 'Login Dulu')
@section('content')
<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 mx-lg-0 mx-auto">
                        <div class="formlogin">
                        <img src="{{ asset('assets/img/logo.png') }}"/>
                        <div class="card">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder">Sign In</h4>
                                <p class="mb-0">Masukkan User dan Password</p>
                            </div>
                            <div class="card-body">
                                <form role="form" method="POST" action="{{ route('login.perform') }}">
                                    @csrf
                                    @method('post')
                                    <div class="flex flex-col mb-3">
                                        <input type="text" name="username" class="form-control form-control-lg" value="{{ old('username')}}" aria-label="username" placeholder="Username...">
                                        @error('username') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg" aria-label="Password" placeholder="Password...">
                                        @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                    <div class="withcheckin">
                                        <input type="checkbox" id="time" name="check">
                                        <label> Check in </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('js')
<script>
  function showTime() {
    let a = moment().format('Y-MM-D H:m:s')
    document.getElementById('time').value = a;
  }

  setInterval(showTime, 1000);

</script>
@endpush