<!DOCTYPE html>
<html lang="en">

@include('layouts.head_monitor')

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

        {{-- start content --}}
        <div class="main-panel">
			<div class="content">
                <div class="content">
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-4">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div class="ml-md-auto py-2 py-md-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data Secret Client PPPoE</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="col-md-4 px-0"  style="border: 2px solid grey;">
                                            <input type="text" id="searchInput" class="form-control" placeholder="Cari secret client PPPoE...">
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="pppoeSecretsTable" class="table table-bordered table-striped">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Service</th>
                                                    <th>Profile</th>
                                                    <th>Local Address</th>
                                                    <th>Remote Address</th>
                                                    <th>Terakhir Logout</th>
                                                    <th>MAC address terakhir</th>
                                                    <th>Comment</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pppoeSecrets as $index => $client)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $client['name'] ?? '-' }}</td>
                                                        <td>{{ $client['password'] ?? '-' }}</td>
                                                        <td>{{ $client['service'] ?? '-' }}</td>
                                                        <td>{{ $client['profile'] ?? '-' }}</td>
                                                        <td>{{ $client['local-address'] ?? '-' }}</td>
                                                        <td>{{ $client['remote-address'] ?? '-' }}</td>
                                                        <td>{{ $client['last-logged-out'] ?? '-' }}</td>
                                                        <td>{{ $client['last-caller-id'] ?? '-' }}</td>
                                                        <td>{{ $client['comment'] ?? '-' }}</td>
                                                        <td>
                                                            <form id="delete-form-{{ $client['.id'] }}" action="{{ route('pppoe.monitoring.destroy', $client['.id']) }}"
                                                            method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-sm btn-danger text-white" onclick="confirmDelete('{{ $client['.id'] }}') ">
                                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </td>
                                                        </tr>
                                                            @empty
                                                        <tr>
                                                        <td colspan="11" class="text-center">Tidak Ada Data PPPoE Secret</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Data PPPoE Client Aktif</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="col-md-4 px-0"  style="border: 2px solid grey;">
                                            <input type="text" id="searchActive" class="form-control" placeholder="Cari aktif client PPPoE...">
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="pppoeActiveTable" class="table table-bordered table-striped">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Service</th>
                                                    <th>Mac Address</th>
                                                    <th>IP Address</th>
                                                    <th>Uptime</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pppoeActive as $index => $client)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $client['name'] ?? '-' }}</td>
                                                        <td>{{ $client['service'] ?? '-' }}</td>
                                                        <td>{{ $client['caller-id'] ?? '-' }}</td>
                                                        <td>{{ $client['address'] ?? '-' }}</td>
                                                        <td>{{ $client['uptime'] ?? '-' }}</td>
                                                        <td>
                                                            <button onclick="removeActive('{{ $client['.id'] }}')" class="btn btn-sm btn-danger text-white">
                                                                <i class="fas fa-trash-alt"></i> Hapus
                                                            </button>

                                                            <form id="remove-active-{{ $client['.id'] }}" action="{{ route('pppoe.active.remove') }}" method="POST" style="display: none;">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $client['.id'] }}">
                                                            </form>
                                                        </td>
                                                        </tr>
                                                            @empty
                                                        <tr>
                                                        <td colspan="8" class="text-center">Tidak ada data PPPoE aktif</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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

