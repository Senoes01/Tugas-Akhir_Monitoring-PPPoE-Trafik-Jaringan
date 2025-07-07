<!--   Core JS Files   -->
<script src="{{ asset('template-dashboard') }}/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="{{ asset('template-dashboard') }}/assets/js/core/popper.min.js"></script>
<script src="{{ asset('template-dashboard') }}/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
{{-- <script src="{{ asset('template-dashboard') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> --}}

<!-- jQuery Vector Maps -->
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Sweet Alert -->
<script src="{{ asset('template-dashboard') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Atlantis JS -->
<script src="{{ asset('template-dashboard') }}/assets/js/atlantis.min.js"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{ asset('template-dashboard') }}/assets/js/setting-demo.js"></script>
<script src="{{ asset('template-dashboard') }}/assets/js/demo.js"></script>
<script>
    Circles.create({
        id:'circles-1',
        radius:45,
        value:60,
        maxValue:100,
        width:7,
        text: 5,
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-2',
        radius:45,
        value:70,
        maxValue:100,
        width:7,
        text: 36,
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-3',
        radius:45,
        value:40,
        maxValue:100,
        width:7,
        text: 12,
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

    var mytotalIncomeChart = new Chart(totalIncomeChart, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
            datasets : [{
                label: "Total Income",
                backgroundColor: '#ff9e27',
                borderColor: 'rgb(23, 125, 255)',
                data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        display: false //this will remove only the label
                    },
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }],
                xAxes : [ {
                    gridLines : {
                        drawBorder: false,
                        display : false
                    }
                }]
            },
        }
    });

    $('#lineChart').sparkline([105,103,123,100,95,105,115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });

</script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    @endif
</script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin hapus client?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    @endif
</script>
<script>
    function removeActive(id) {
        Swal.fire({
            title: 'Putuskan koneksi aktif?',
            text: "User akan terdiskonek dari jaringan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, putuskan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('remove-active-' + id).submit();
            }
        });
    }
</script>
{{-- <script>
    const secrets = @json($pppoeSecrets);

    const userSelect = document.getElementById('userSelect');
    const passwordInput = document.getElementById('password');
    const serviceInput = document.getElementById('service');
    const profileInput = document.getElementById('profile');
    const localInput = document.getElementById('local_address');
    const remoteInput = document.getElementById('remote_address');

    userSelect.addEventListener('change', function () {
        const selectedUser = this.value;

        if (selectedUser === "") {
            // Kosongkan semua input kalau yang dipilih adalah "Pilih user"
            passwordInput.value = '';
            serviceInput.value = '';
            profileInput.value = '';
            localInput.value = '';
            remoteInput.value = '';
            return;
        }

        const userData = secrets.find(user => user.name === selectedUser);

        if (userData) {
            passwordInput.value = userData.password || '';
            serviceInput.value = userData.service || '';
            profileInput.value = userData.profile || '';
            localInput.value = userData['local-address'] || '';
            remoteInput.value = userData['remote-address'] || '';
        }
    });
</script> --}}
<script>
        function fetchCpuLoad() {
        $.get('/cpu-load', function(data) {
            if (data.cpu !== null) {
                $('#cpu').text(data.cpu + '%');
            } else {
                $('#cpu').text('Error');
            }
            if (data.uptime !== null) {
                $('#uptime').text(data.uptime);
            } else {
                $('#uptime').text('Error');
            }
            if (data.free_hdd !== null) {
            $('#freeHdd').text(data.free_hdd);
            } else {
            $('#freeHdd').text('Error');
            }
            if (data.total_hdd !== null) {
            $('#totalHdd').text(data.total_hdd);
            } else {
            $('#totalHdd').text('Error');
            }
        }).fail(function() {
            $('#cpu').text('Error');
            $('#uptime').text('Error');
            $('#freeHdd').text('Error');
            $('#totalHdd').text('Error');

        });
    }
    fetchCpuLoad();
    setInterval(fetchCpuLoad, 1000);
</script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('trafikChart').getContext('2d');
    const trafikChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'TX (Mbps)',
                    borderColor: 'red',
                    fill: false,
                    data: [],
                },
                {
                    label: 'RX (Mbps)',
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

    function updateChart(interfaceName) {
        fetch(`/trafik-interface/${interfaceName}`)
            .then(response => response.json())
            .then(data => {
                const time = new Date().toLocaleTimeString();
                if (labels.length >= 10) {
                    labels.shift();
                    txData.shift();
                    rxData.shift();
                }
                labels.push(time);
                txData.push((data.tx / 1024 / 1024).toFixed(2)); // Mbps
                rxData.push((data.rx / 1024 / 1024).toFixed(2));

                trafikChart.data.labels = labels;
                trafikChart.data.datasets[0].data = txData;
                trafikChart.data.datasets[1].data = rxData;
                trafikChart.update();
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

    // Mulai langsung dengan interface pertama
    updateChart(interfaceSelect.value);
    intervalId = setInterval(() => updateChart(interfaceSelect.value), 1000);
});
</script> --}}
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        var filter = this.value.toLowerCase();
        var table = document.getElementById("pppoeSecretsTable");
        var rows = table.querySelectorAll("tbody tr:not(.no-data-row)");
        var noDataRow = table.querySelector(".no-data-row");

        var visibleRows = 0;
        rows.forEach(function (row) {
            var text = row.textContent.toLowerCase();
            var show = text.includes(filter);
            row.style.display = show ? "" : "none";
            if (show) visibleRows++;
        });

        if (noDataRow) {
            noDataRow.style.display = visibleRows === 0 ? "" : "none";
        }
    });
</script>
<script>
    document.getElementById("searchActive").addEventListener("keyup", function () {
        var filter = this.value.toLowerCase();
        var table = document.getElementById("pppoeActiveTable");
        var rows = table.querySelectorAll("tbody tr:not(.no-data-row)");
        var noDataRow = table.querySelector(".no-data-row");

        var visibleRows = 0;
        rows.forEach(function (row) {
            var text = row.textContent.toLowerCase();
            var show = text.includes(filter);
            row.style.display = show ? "" : "none";
            if (show) visibleRows++;
        });

        if (noDataRow) {
            noDataRow.style.display = visibleRows === 0 ? "" : "none";
        }
    });
</script>
<script>
    // Fungsi polling log tiap 5 detik
    setInterval(() => {
        fetch("/simpan-log")
            .then(response => response.json())
            .then(data => {
                console.log("Log terbaru berhasil disimpan:", data);
            })
            .catch(error => {
                console.error("Gagal ambil log:", error);
            });
    }, 5000); // 5000 ms = 5 detik
</script>











