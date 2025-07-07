@extends('layouts.head_login')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-3">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <img src="{{ asset('images/mikro.png') }}" alt="Logo" width="80">
                    </div>
                    <h5 class="text-center mb-3"style="font-family: Verdana; font-weight: bold;">LOGIN</h5>
                    <p class="text-center text-muted" style="font-family: Verdana; font-weight: bold;">Monitoring PPPoE dan
                    Trafik Jaringan</p>
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="ip" placeholder="IP Address" required>
                            <label>IP Address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                            <label>Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <label>Password</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" style="font-size: 20px" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->has('login'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: @json($errors->first('login')),
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
