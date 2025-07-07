<!DOCTYPE html>
<html lang="en">

@include('layouts.head_log')

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
            @include('layouts.navbar_log')
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
                                <div>
                                    <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                                    {{-- <h5 class="text-white op-7 mb-2">Router Board Name : {{ $identity }}</h5> --}}
                                </div>
                                <div class="ml-md-auto py-2 py-md-0">
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
                                    <h4 class="card-title">Data Gangguan Client PPPoE</h4>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Perhatian!</strong> Jika permasalahan pada client sudah ditangani hapus log untuk mengosongkan notifikasi dan jika ingin
                                        menyimpan log silahkan tekan tombol download pdf di bawah ini.
                                    </div>
                                    <div class="table-responsive">
                                        <form method="POST" action="{{ route('log.bulkDelete') }}" id="bulkDeleteForm">
                                            @csrf
                                            <div class="d-flex justify-content-between mb-3">
                                                <a href="{{ route('log.download') }}" class="btn btn-success">
                                                    Download PDF
                                                </a>
                                                <button type="button" id="btnHapusDipilih" class="btn btn-danger">
                                                    Hapus yang Dipilih
                                                </button>
                                            </div>
                                            <table class="table table-bordered table-striped" style="table-layout: fixed;">
                                                <thead class="bg-primary text-white">
                                                    <tr class="text-center">
                                                        <th style="width: 50px;">No</th>
                                                        <th style="width: 300px;">Data Gangguan PPPoE</th>
                                                        <th style="width: 150px;">Waktu & Tanggal</th>
                                                        <th style="width: 80px;">
                                                            <input type="checkbox" id="checkAll"> Klik checkbox untuk hapus semua
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="log-table-body">
                                                    @forelse ($logs as $index => $log)
                                                        <tr class="text-center">
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $log->message }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($log->time)->format('Y-m-d H:i') }}</td>
                                                            <td>
                                                                <input type="checkbox" name="log_ids[]" value="{{ $log->id }}">
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center text-muted">Tidak ada data gangguan PPPoE</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </form>
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
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkAll = document.getElementById('checkAll');
        checkAll.addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('input[name="log_ids[]"]');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.getElementById('btnHapusDipilih').addEventListener('click', function () {
        const selected = document.querySelectorAll('input[name="log_ids[]"]:checked');

        if (selected.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Tidak ada data dipilih',
                text: 'Silakan centang log yang ingin dihapus.'
            });
            return;
        }

        Swal.fire({
            title: 'Yakin ingin menghapus log terpilih?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('bulkDeleteForm').submit();
            }
        });
    });
    </script>
</body>
</html>

