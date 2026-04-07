<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - SIMIK</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Khusus Dashboard (Menggunakan CSS yang persis dengan Supplier) -->
    <link rel="stylesheet" href="{{ asset('css/supplier_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print_preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar_toggle.css') }}">
    <!-- Custom styling khusus tab Data Barang agar tidak perlu file CSS baru untuk minor change -->
    <style>
        .data-table th, .data-table td {
            text-align: center;
        }
        .data-table th:nth-child(2), .data-table td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="logo">
            <button class="sidebar-toggle-btn" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
            <i class="fa-solid fa-shapes"></i> Logo Perusahaan
        </div>
        <div class="user-menu">
            <i class="fa-solid fa-circle-user" style="font-size: 20px;"></i> User
            <a href="#" style="margin-left: 20px;"><i class="fa-solid fa-arrow-right-from-bracket"></i> LogOut</a>
        </div>
    </div>

    <div class="container">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="menu-section">
                <h4><i class="fa-solid fa-house"></i> Dashboard</h4>
                <ul>
                    <li><a href="{{ url('/dashboard') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-house"></i> Home</a></li>
                </ul>
            </div>
            
            <div class="menu-section">
                <h4><i class="fa-solid fa-database"></i> Master Data</h4>
                <ul>
                    <li class="active"><a href="{{ url('/barang') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-folder"></i> Data Barang</a></li>
                    <li><a href="{{ url('/supplier') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-users"></i> Data Supplier</a></li>
                </ul>
            </div>

            <div class="menu-section">
                <h4><i class="fa-solid fa-file-invoice"></i> Transfer Data</h4>
                <ul>
                    <li><a href="{{ url('/barang_masuk') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-arrow-turn-down"></i> Barang Masuk</a></li>
                    <li><a href="{{ url('/barang_keluar') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-arrow-turn-up"></i> Barang Keluar</a></li>
                </ul>
            </div>
        </div>
        
        <!-- CONTENT -->
        <div class="content">
            <!-- HEADER AREA -->
            <div class="dashboard-header">
                <!-- HERO BANNER -->
                <div class="hero-banner">
                    <div class="hero-icon">
                        <i class="fa-solid fa-folder"></i>
                    </div>
                    <div class="hero-text">
                        <h1>Data Barang</h1>
                        <p>Lihat dan mengelola data barang</p>
                    </div>
                </div>

                <!-- RIGHT ACTIONS (Buttons & Search) -->
                <div class="actions-right">
                    <a href="{{ url('/barang_masuk') }}" style="text-decoration: none;">
                        <button class="btn-add">Tambah Barang <i class="fa-solid fa-plus"></i></button>
                    </a>
                    <button class="btn-print">Cetak PDF <i class="fa-solid fa-file"></i></button>
                    
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Search">
                    </div>
                </div>
            </div>

            <!-- TABLE AREA -->
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th width="25%">NAMA BARANG</th>
                            <th width="20%">KATEGORI</th>
                            <th width="15%">ID BARANG</th>
                            <th width="12%">JUMLAH</th>
                            <th width="15%">KONDISI</th>
                            <th width="8%"></th> <!-- Untuk Actions -->
                        </tr>
                    </thead>
                        @forelse($barangs ?? [] as $index => $b)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $b->nama_barang }}</td>
                            <td>{{ $b->kategori }}</td>
                            <td>{{ $b->id_barang }}</td>
                            <td>{{ $b->jumlah }}</td>
                            <td>{{ $b->kondisi }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn-icon btn-edit"><i class="fa-solid fa-gear"></i></a>
                                    <form action="#" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Yakin hapus?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center;">Data Barang Kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Print Preview Modal -->
    <div id="printPreviewModal" class="print-modal-overlay">
        <div class="print-modal-content">
            <div class="print-modal-header">
                <span><i class="fa-solid fa-triangle-exclamation"></i> Preview</span>
                <button class="close-print-modal" onclick="closePrintPreview()">&times;</button>
            </div>
            <div class="print-modal-body">
                <!-- PDF Preview Area -->
            </div>
            <div class="print-modal-footer">
                <button type="button" class="btn-print-confirm">Cetak PDF <i class="fa-solid fa-file"></i></button>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        }

        function openPrintPreview() {
            document.getElementById('printPreviewModal').style.display = 'flex';
        }
        function closePrintPreview() {
            document.getElementById('printPreviewModal').style.display = 'none';
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            const printBtns = document.querySelectorAll('.btn-print, .btn-pdf');
            printBtns.forEach(btn => {
                btn.addEventListener('click', openPrintPreview);
            });
        });
    </script>
</body>
</html>