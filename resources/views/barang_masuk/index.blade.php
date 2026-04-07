<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Masuk - SIMIK</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Khusus Barang Masuk -->
    <link rel="stylesheet" href="{{ asset('css/barang_masuk.css') }}">
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
                    <li class="active"><i class="fa-solid fa-arrow-turn-down"></i> Barang Masuk</li>
                    <li><a href="{{ url('/barang_keluar') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-arrow-turn-up"></i> Barang Keluar</a></li>
                </ul>
            </div>
        </div>
        
        <div class="content">
            <div class="form-table-container">
                <div class="form-card-wrapper">
                    <div class="form-card">
                        <h3 class="form-title">Input barang Masuk</h3>
                        
                        @if(session('success'))
                            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ url('/barang_masuk') }}" method="POST" id="form-barang-masuk">
                            @csrf
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" required>
                            </div>
                            
                            <div class="form-group">
                                <label>ID Barang</label>
                                <input type="number" name="id_barang" required>
                            </div>
                            
                            <div class="form-group">
                                <label>ID Masuk</label>
                                <!-- Kita buat disabled karena ini otomatis by database (Auto Increment) -->
                                <input type="text" name="id_masuk" placeholder="Otomatis" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" required>
                            </div>

                            <div class="form-group">
                                <label>Kondisi</label>
                                <input type="text" name="kondisi" placeholder="Contoh: Baru/Baik" required>
                            </div>
                        </form>
                    </div>
                    
                    <button type="submit" form="form-barang-masuk" class="btn-submit">SUBMIT</button>
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
                            @forelse($barang_masuks ?? [] as $index => $bm)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $bm->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                                <td>{{ $bm->id_barang }}</td>
                                <td>{{ \Carbon\Carbon::parse($bm->tanggal_masuk)->format('d/m/Y') }}</td>
                                <td>{{ $bm->jumlah_barang_masuk }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align:center;">Data Barang Masuk Kosong</td>
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
