<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Keluar - SIMIK</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Khusus Barang Keluar -->
    <link rel="stylesheet" href="{{ asset('css/barang_keluar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print_preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar_toggle.css') }}">
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
                    <li><a href="{{ url('/barang') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-folder"></i> Data Barang</a></li>
                    <li><a href="{{ url('/supplier') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-users"></i> Data Supplier</a></li>
                </ul>
            </div>

            <div class="menu-section">
                <h4><i class="fa-solid fa-file-invoice"></i> Transfer Data</h4>
                <ul>
                    <li><a href="{{ url('/barang_masuk') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-arrow-turn-down"></i> Barang Masuk</a></li>
                    <li class="active"><i class="fa-solid fa-arrow-turn-up"></i> Barang Keluar</li>
                </ul>
            </div>
        </div>
        
        <div class="content">
            <div class="form-table-container">
                <div class="form-card-wrapper">
                    <div class="form-card">
                        <h3 class="form-title">Input barang Keluar</h3>
                        
                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" required>
                            </div>
                            
                            <div class="form-group">
                                <label>ID Barang</label>
                                <input type="text" name="id_barang" required>
                            </div>
                            
                            <div class="form-group">
                                <label>ID Keluar</label>
                                <input type="text" name="id_keluar" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="text" name="tanggal" placeholder="DD/MM/YYYY" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" required>
                            </div>
                        </form>
                    </div>
                    
                    <button type="submit" class="btn-submit">SUBMIT</button>
                    <button type="button" class="btn-print">Cetak PDF <i class="fa-solid fa-file"></i></button>
                </div>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="30%">NAMA BARANG</th>
                                <th width="20%">ID BARANG</th>
                                <th width="25%">TANGGAL</th>
                                <th width="20%">JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barang_keluars ?? [] as $index => $bk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $bk->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                                <td>{{ $bk->id_barang }}</td>
                                <td>{{ \Carbon\Carbon::parse($bk->tanggal_keluar)->format('d/m/Y') }}</td>
                                <td>{{ $bk->jumlah_barang_keluar }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align:center;">Data Barang Keluar Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
