<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIMIK</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar_toggle.css') }}">
</head>
<body>
    <!-- TOPBAR -->
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

    <!-- MAIN CONTAINER -->
    <div class="container">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="menu-section">
                <h4><i class="fa-solid fa-house"></i> Dashboard</h4>
                <ul>
                    <li class="active"><a href="{{ url('/dashboard') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-house"></i> Home</a></li>
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
                    <li><a href="{{ url('/barang_keluar') }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;"><i class="fa-solid fa-arrow-turn-up"></i> Barang Keluar</a></li>
                </ul>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">
            <!-- WELCOME HEADER -->
            <div class="welcome-banner">
                <i class="fa-solid fa-house welcome-icon"></i>
                <div class="welcome-text">
                    <h2>Dashboard Admin</h2>
                    <p>Selamat Datang di Sistem Informasi Manajemen Inventaris Kantor</p>
                </div>
            </div>

            <!-- CARDS GRID SECTION -->
            <div class="cards-grid">
                
                <!-- Card Barang Masuk -->
                <div class="stat-card card-masuk">
                    <i class="fa-solid fa-arrow-turn-down bg-icon"></i>
                    <div class="card-content">
                        <h1>{{ $total_barang_masuk ?? 0 }}</h1>
                        <p>Barang<br>Masuk</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/barang_masuk') }}">More Info <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Card Supplier -->
                <div class="stat-card card-supplier">
                    <i class="fa-solid fa-cart-flatbed bg-icon"></i>
                    <div class="card-content">
                        <h1>{{ $total_supplier ?? 0 }}</h1>
                        <p>Supplier</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/supplier') }}">More Info <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Card Total Barang -->
                <div class="stat-card card-total">
                    <i class="fa-solid fa-folder bg-icon"></i>
                    <div class="card-content">
                        <h1>{{ $total_barang ?? 0 }}</h1>
                        <p>Total<br>Barang</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/barang') }}">More Info <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <!-- Card Barang Keluar -->
                <div class="stat-card card-keluar">
                    <i class="fa-solid fa-arrow-turn-up bg-icon"></i>
                    <div class="card-content">
                        <h1>{{ $total_barang_keluar ?? 0 }}</h1>
                        <p>Barang<br>Keluar</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/barang_keluar') }}">More Info <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                
            </div>

            <!-- PROFILE BOX (Read Only style) -->
            <div class="profile-section">
                <div class="profile-grid">
                    <div class="profile-item">
                        <label>Nama</label>
                        <div class="profile-item-box">Rifqi Hakim</div>
                    </div>
                    
                    <div class="profile-item">
                        <label>Username</label>
                        <div class="profile-item-box">rifqi</div>
                    </div>
                    
                    <div class="profile-item">
                        <label>Hak Akses</label>
                        <div class="profile-item-box">Admin</div>
                    </div>
                    
                    <div class="profile-item">
                        <label>ID Admin</label>
                        <div class="profile-item-box">2303015098</div>
                    </div>
                </div>
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