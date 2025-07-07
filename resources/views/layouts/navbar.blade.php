<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:void(0)" id="notifDropdown" role="button">
                    <i class="fa fa-bell"></i>
                    <span class="badge bg-danger" id="notif-count" style="display: none;">0</span>
                </a>
            </li>
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{ asset('template-dashboard') }}/assets/img/profile2.jpg" alt="{{ asset('template-dashboard') }}." class="avatar-img rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="{{ asset('template-dashboard') }}/assets/img/profile2.jpg" alt="image profile" class="avatar-img rounded">
                                </div>
                                <div class="u-text">
                                    <h3>Gilga Syahid</h3>
                                    <h5>Administrator Jaringan</h5>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            {{-- <a class="dropdown-item" href="#">My Profile</a> --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
{{-- Script Notifikasi --}}
<script>
    function fetchNotifLog() {
        fetch('/get-pppoe-notif')
            .then(res => res.json())
            .then(data => {
                const notifCount = document.getElementById('notif-count');

                if (!notifCount) return;

                if (data.length === 0) {
                    notifCount.style.display = 'none';
                    return;
                }

                notifCount.style.display = 'inline-block';
                notifCount.innerText = data.length;
            })
            .catch(err => console.error('Gagal ambil jumlah notifikasi:', err));
    }

    function showNotifModal() {
        const modalBody = document.getElementById('notifModalBody');
        modalBody.innerHTML = '<div class="text-muted text-center">Memuat notifikasi...</div>';

        fetch('/get-pppoe-notif')
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    modalBody.innerHTML = '<div class="text-muted text-center">Tidak ada notifikasi ditemukan.</div>';
                    return;
                }

                modalBody.innerHTML = '';
                data.forEach(item => {
                    modalBody.innerHTML += `
                        <div class="border-bottom py-2">
                            <div class="small text-secondary mb-1"><b>${item.time}</b> • <span class="text-danger">[${item.topics}]</span></div>
                            <div class="text-dark small">${item.message}</div>
                        </div>
                    `;
                });
            })
            .catch(err => {
                modalBody.innerHTML = '<div class="text-danger text-center">Gagal memuat notifikasi</div>';
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        fetchNotifLog();
        setInterval(fetchNotifLog, 5000);

        const lihatNotif = document.getElementById('lihatNotif');
        if (lihatNotif) {
            lihatNotif.addEventListener('click', function (e) {
                e.preventDefault();
                showNotifModal();
                const notifModal = new bootstrap.Modal(document.getElementById('notifModal'));
                notifModal.show();
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notifIcon = document.getElementById('notifDropdown');

        notifIcon.addEventListener('click', function (e) {
            e.preventDefault(); // Cegah reload atau default href
            Swal.fire({
                title: 'Perhatian',
                text: 'Silakan cek pada halaman Log History untuk melihat detail notifikasi PPPoE.',
                icon: 'info',
                confirmButtonText: 'Lihat Log History',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "pppoe/log"; // Ganti dengan route kamu
                }
            });
        });
    });
</script>








