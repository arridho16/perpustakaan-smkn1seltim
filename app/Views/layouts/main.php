<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> - SIP Perpustakaan</title>
    <meta name="theme-color" content="#4e73df">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --dark-color: #1a1c23;
            --light-color: #f8f9fc;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--light-color);
            overflow-x: hidden;
        }

        /* Sidebar Style */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            color: white;
            transition: left 0.3s ease;
            z-index: 1050;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 1.5rem 1rem 1rem;
            text-align: center;
        }

        .sidebar-header h3 {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 0;
            letter-spacing: 1px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.7rem 1.5rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.15);
            border-left-color: #fff;
        }

        .nav-link i {
            margin-right: 15px;
            font-size: 1.2rem;
        }

        /* Main Content */
        #content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            transition: all 0.3s;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1rem 2rem;
        }

        .content-body {
            padding: 2rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "\F138";
            font-family: "bootstrap-icons";
            font-size: 0.8rem;
        }

        @media (max-width: 992px) {
            #sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: none;
            }
            #content {
                margin-left: 0;
                width: 100%;
            }
            #sidebar.active {
                left: 0 !important;
                box-shadow: 10px 0 30px rgba(0,0,0,0.2);
            }
            .content-body {
                padding: 1.25rem 1rem;
            }
            .navbar {
                padding: 0.75rem 1rem;
            }
            .table {
                font-size: 0.85rem;
            }
            .table th, .table td {
                padding: 0.6rem 0.4rem;
            }
            .card-body {
                padding: 1rem 0.75rem;
            }
            h1.h3 {
                font-size: 1.25rem;
                margin-bottom: 1rem !important;
            }
            .btn-sm {
                padding: 0.35rem 0.5rem;
                font-size: 0.8rem;
                margin-bottom: 0.25rem;
                margin-top: 0.25rem;
            }
            .d-grid.gap-2 {
                margin-top: 1rem;
            }
            .table td .btn {
                margin-right: 0.25rem !important;
            }
        }

        /* Sidebar overlay – always in DOM, hidden by default */
        #sidebar-overlay {
            display: none;
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
            top: 0;
            left: 0;
        }
        #sidebar-overlay.active {
            display: block;
        }
        /* DataTables Custom Spacing for Mobile */
        .dataTables_length, .dataTables_filter {
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .dataTables_wrapper .row > [class*="col-"] {
                padding-left: 0 !important;
            }
            .dataTables_length, .dataTables_filter {
                text-align: left !important;
                margin-bottom: 0.75rem;
                padding-left: 0 !important;
            }
            .dataTables_filter input {
                width: 100% !important;
                margin-left: 0 !important;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay"></div>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <img src="/assets/img/logo-smkn1seltim.png" alt="Logo" class="mb-2 shadow-sm rounded-circle bg-white p-1" style="width: 50px; height: 50px; object-fit: contain;">
            <h3>SIP PERPUS</h3>
            <small class="opacity-75">SMKN 1 Selakau Timur</small>
        </div>

        <div class="nav flex-column mt-2" style="flex: 1; display: flex; flex-direction: column;">
            <a href="/admin/dashboard" class="nav-link <?= ($uri ?? '') == 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <div class="px-4 py-2 small opacity-50 text-uppercase fw-bold" style="font-size: 0.7rem;">Master Data</div>
            <a href="/admin/buku" class="nav-link <?= ($uri ?? '') == 'buku' ? 'active' : '' ?>">
                <i class="bi bi-journal-text"></i> Data Buku
            </a>
            <a href="/admin/anggota" class="nav-link <?= ($uri ?? '') == 'anggota' ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Data Anggota
            </a>
            <a href="/admin/profile" class="nav-link <?= ($uri ?? '') == 'profile' ? 'active' : '' ?>">
                <i class="bi bi-person-gear"></i> Pengaturan Profil
            </a>
            <div class="px-4 py-1 small opacity-50 text-uppercase fw-bold" style="font-size: 0.7rem;">Transaksi</div>
            <a href="/admin/peminjaman" class="nav-link <?= ($uri ?? '') == 'peminjaman' ? 'active' : '' ?>">
                <i class="bi bi-arrow-right-circle"></i> Peminjaman
            </a>
            <a href="/admin/pengembalian" class="nav-link <?= ($uri ?? '') == 'pengembalian' ? 'active' : '' ?>">
                <i class="bi bi-arrow-left-circle"></i> Pengembalian
            </a>
            <a href="/admin/pengembalian/laporan" class="nav-link <?= ($uri ?? '') == 'laporan' ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-bar-graph"></i> Laporan
            </a>
            <div class="p-3" style="margin-top: auto;">
                <a href="/logout" class="btn btn-light btn-sm w-100 text-primary fw-bold rounded-pill">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-link d-lg-none">
                    <i class="bi bi-list fs-3"></i>
                </button>
                <div class="d-flex align-items-center ms-auto">
                    <div class="text-end me-3 d-none d-sm-block">
                        <div class="fw-bold"><?= session()->get('nama') ?></div>
                        <small class="text-muted text-capitalize"><?= session()->get('role') ?></small>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('nama')) ?>&background=4e73df&color=fff" class="rounded-circle" width="40" alt="Avatar">
                </div>
            </div>
        </nav>

        <div class="content-body">
            <!-- Flash Message -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Page Content -->
            <?= $this->renderSection('content') ?>
        </div>

        <footer class="text-center py-4 mt-auto text-muted small">
            &copy; <?= date('Y') ?> SMKN 1 Selakau Timur - SIP Perpustakaan
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            const sidebar = $('#sidebar');
            const overlay = $('#sidebar-overlay');
            const toggle = $('#sidebarCollapse');

            toggle.on('click', function() {
                sidebar.toggleClass('active');
                overlay.toggleClass('active');
            });

            overlay.on('click', function() {
                sidebar.removeClass('active');
                overlay.removeClass('active');
            });

            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });

            // Inisialisasi DataTables secara global untuk semua tabel dengan class .datatable
            $('.datatable').DataTable({
                "language": {
                    "sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
                    "sProcessing":   "Sedang memproses...",
                    "sLengthMenu":   "Tampilkan _MENU_ entri",
                    "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
                    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Cari:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Pertama",
                        "sPrevious": "Sebelumnya",
                        "sNext":     "Selanjutnya",
                        "sLast":     "Terakhir"
                    }
                },
                "pageLength": 10,
                "responsive": true
            });

            // Inisialisasi Tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
