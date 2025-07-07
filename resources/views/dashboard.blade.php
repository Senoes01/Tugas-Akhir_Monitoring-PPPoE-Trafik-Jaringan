<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

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
			{{-- start navbar --}}
            @include('layouts.navbar')
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		@include('layouts.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
                <div class="content">
                    <div class="panel-header bg-primary-gradient">
                        <div class="page-inner py-4">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div>
                                    <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                                    <h5 class="text-white op-7 mb-3">Nama Router : {{ $nama_router }}</h5>
                                </div>
                                <div class="ml-md-auto py-2 py-md-0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-inner mt--5">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <i class="fa fa-server"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">CPU Load:</p>
                                                    <h3 class="card-title" id="cpu">Loading...</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Uptime</p>
                                                    <h3 class="card-title" id="uptime">Loading...</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <a href="" style="text-decoration:none" >
                                    <div class="card card-stats card-round">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-icon">
                                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <div class="col col-stats ml-3 ml-sm-0">
                                                    <div class="numbers">
                                                        <p class="card-category">Date</p>
                                                        <h4 class="card-title">{{ $date }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body ">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                                    <i class="fas fa-info"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Info</p>
                                                    <b> Board Name : </b> {{ $board_name }} <br>
                                                    <b> Model :</b> {{ $model_router }} <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-stats card-round">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-icon">
                                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                                    <i class="fas fa-database"></i>
                                                </div>
                                            </div>
                                            <div class="col col-stats ml-3 ml-sm-0">
                                                <div class="numbers">
                                                    <p class="card-category">Memory</p>
                                                    <h2 class="card-title" style="font-size: medium">Free Hdd : <a id="freeHdd">Loading...</a></h2>
                                                    <h2 class="card-title" style="font-size: medium">Total Hdd : <a id="totalHdd">Loading...</a></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-round">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-icon">
                                                    <div class="icon-big text-center icon-muted bubble-shadow-small">
                                                        <i class="fa fa-users"></i>
                                                    </div>
                                                </div>
                                                <div class="col col-stats ml-3 ml-sm-0">
                                                    <div class="numbers">
                                                        <p class="card-category">Total PPPoE Active</p>
                                                        <h4 class="card-title">{{ $jumlah_active }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-round">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-icon">
                                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                                        <i class="fa fa-lock"></i>
                                                    </div>
                                                </div>
                                                <div class="col col-stats ml-3 ml-sm-0">
                                                    <div class="numbers">
                                                        <p class="card-category">Total PPPoE Secret</p>
                                                        <h4 class="card-title">{{ $jumlah_pppoe }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 col-md-4">
                                <div class="card card-stats">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="defaultSelect">Pilih Interface</label>
                                            <select class="form-control" name="interface" id="interface">
                                                @foreach ($interface as $data)
                                                    <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-head-row">
                                            <div class="card-title">Trafik Jaringan</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="trafikChart" width="400" height="150"></canvas>
                                        <div id="load" class="mt-3"></div>
                                        <button onclick="downloadLog()" class="btn btn-success mt-3">Unduh Log</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
    const ctx = document.getElementById('trafikChart').getContext('2d');
    const trafikChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'TX (Upload / Mbps)',
                    borderColor: 'red',
                    fill: false,
                    data: [],
                },
                {
                    label: 'RX (Download / Mbps)',
                    borderColor: 'blue',
                    fill: false,
                    data: [],
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const interfaceSelect = document.getElementById('interface');
    let labels = [], txData = [], rxData = [];
    let intervalId;

    // Log array untuk menyimpan histori data
    const trafikLog = [];

    function updateChart(interfaceName) {
        fetch(`/trafik-interface/${interfaceName}`)
            .then(response => response.json())
            .then(data => {
                const time = new Date().toLocaleTimeString();
                const txMbps = +(data.tx / 1024 / 1024).toFixed(2);
                const rxMbps = +(data.rx / 1024 / 1024).toFixed(2);

                if (labels.length >= 10) {
                    labels.shift();
                    txData.shift();
                    rxData.shift();
                }
                labels.push(time);
                txData.push(txMbps);
                rxData.push(rxMbps);

                trafikChart.data.labels = labels;
                trafikChart.data.datasets[0].data = txData;
                trafikChart.data.datasets[1].data = rxData;
                trafikChart.update();

                trafikLog.push({
                    time: time,
                    interface: interfaceName,
                    tx: txMbps,
                    rx: rxMbps
                });

                console.log("Log Update:", trafikLog[trafikLog.length - 1]);
            })
            .catch(() => {
                document.getElementById('load').innerText = 'Gagal mengambil data trafik.';
            });
    }

    interfaceSelect.addEventListener('change', function () {
        clearInterval(intervalId);
        resetChart();
        intervalId = setInterval(() => updateChart(this.value), 1000);
    });

    function resetChart() {
        labels = []; txData = []; rxData = [];
        trafikChart.data.labels = labels;
        trafikChart.data.datasets[0].data = txData;
        trafikChart.data.datasets[1].data = rxData;
        trafikChart.update();
    }
    // Mulai dengan interface pertama
    updateChart(interfaceSelect.value);
    intervalId = setInterval(() => updateChart(interfaceSelect.value), 3000);

    // Fungsi download Log ( CSV )
    function downloadLog() {
        if (trafikLog.length === 0) {
            alert("Belum ada data untuk diunduh.");
            return;
        }

        // Buat array data untuk Excel
        const data = trafikLog.map(row => ({
            "Waktu": row.time,
            "Interface": row.interface,
            "Upload ( Mbps )": row.tx,
            "Download ( Mbps )": row.rx
        }));

        // Buat worksheet dan workbook
        const worksheet = XLSX.utils.json_to_sheet(data);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Trafik Log");

        // Unduh sebagai .xlsx
        XLSX.writeFile(workbook, "trafik-log.xlsx");
    }
    </script>
	@include('layouts.script')
</body>
</html>
