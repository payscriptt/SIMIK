<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier - SIMIK</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Khusus Halaman Create -->
    <link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
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
                    <li class="active"><a href="{{ url('/supplier') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-users"></i> Data Supplier</a></li>
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
        
        <div class="content">
            <div class="form-card">
                <h3 class="form-title">Supplier</h3>
                
                <form action="#" method="POST" style="width: 100%; display: flex; flex-direction: column; align-items: center;">
                    @csrf
                    
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" required>
                    </div>
                    
                    <div class="form-group">
                        <label>NO Telepon</label>
                        <input type="text" name="no_telepon" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" required>
                    </div>
                    
                    <div class="form-group">
                        <label>ID Supplier</label>
                        <input type="text" name="id_supplier" required>
                    </div>
                    
                    <button type="submit" class="btn-submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        }
    </script>
</body>
</html>
