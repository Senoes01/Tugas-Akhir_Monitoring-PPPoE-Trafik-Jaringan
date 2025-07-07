<!DOCTYPE html>
<html lang="en">

@include('layouts.head_client')

<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header" data-background-color="blue">
				<a href="#" class="logo">
					<img src="{{ asset('template-dashboard') }}/assets/img/mikrotik.png" style="width: 150px" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
            {{-- Start Navbar --}}
            @include('layouts.navbar')
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		@include('layouts.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
                <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('pppoe.client.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: blue">
                                    <h5 class="modal-title" id="addClientModalLabel">Tambah Secret PPPoE</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label label>Password</label>
                                        <input type="text" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Service</label>
                                        <select name="service" class="form-control" required>
                                            <option value="pppoe">PPPoE</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Profile</label>
                                        <select name="profile" class="form-control" required>
                                            @foreach($pppoeProfil as $profile)
                                                <option value="{{ $profile['name'] }}">{{ $profile['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Local Address</label>
                                        <input type="text" name="local_address" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Remote Address</label>
                                        <input type="text" name="remote_address" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="content">
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-4">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-5">
                    <!-- Manajemen Client PPPoE -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: blue">
                            <strong>Manajemen Client PPPoE</strong>
                            <button class="btn btn-success btn-sm font-weight-bold" data-toggle="modal" data-target="#addClientModal"> + Secret</button>
                        </div>
                        <div class="card-body bg-light">
                            <form action="{{ route('pppoe.client.simpan') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <!-- Pilihan user -->
                                    <div class="col-md-4 mb-2">
                                        <select name="name" class="form-control" id="select-user">
                                            <option value="" class="font-weight-bold">Pilih user</option>
                                            @foreach ($pppoeSecrets as $user)
                                                <option value="{{ $user['name'] }}">{{ $user['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Password -->
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="password" class="form-control" id="password" placeholder="Masukkan password">
                                    </div>
                                    <!-- Service -->
                                    <div class="col-md-4 mb-2">
                                        <select name="service" class="form-control">
                                            @foreach ($services as $service)
                                                <option value="{{ $service }}">{{ strtoupper($service) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Profil -->
                                    <div class="col-md-4 mb-2">
                                        <select name="profile" class="form-control" id="profile">
                                            <option value="">Pilih Profil</option>
                                            @foreach ($pppoeProfil as $profil)
                                                <option value="{{ $profil['name'] }}">{{ $profil['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Local Address -->
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="local_address" class="form-control" id="local-address" placeholder="Local Address">
                                    </div>
                                    <!-- Remote Address -->
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="remote_address" class="form-control" id="remote-address" placeholder="Remote Address">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                    <!-- Manajemen Profil PPPoE -->
                    <div class="card shadow-sm">
                        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: blue">
                            <strong>Manajemen Profil PPPoE</strong>
                        </div>
                        <div class="card-body bg-light">
                            <form method="POST" action="{{ route('pppoe.profile.store') }}">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="name" class="form-control" placeholder="Masukkan Nama">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="local_address" class="form-control" placeholder="Masukkan Local Address">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="remote_address" class="form-control" placeholder="Masukkan Remote Address">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <input type="text" name="rate_limit" class="form-control" placeholder="Limit (tx/rx)">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <select name="only_one" class="form-control">
                                            <option value="" disabled selected>Only One</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="default">Default</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto">
						2025, made by <a href="https://www.instagram.com/senosatrio_05/">Seno Satrio Nugroho</a>
					</div>
				</div>
			</footer>
		</div>
        @include('layouts.custom-template')
	</div>
	@include('layouts.script')
</body>
</html>


