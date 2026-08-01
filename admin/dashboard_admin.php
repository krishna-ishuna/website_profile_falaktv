<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Panel Islami</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f4f7f5; 
            color: #222;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Menu */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0d1f18 0%, #132e25 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            border-right: 3px solid #d4af37; /* Aksen kuning emas */
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            color: #d4af37;
            font-size: 20px;
            font-weight: 700;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 15px;
            flex-grow: 1;
        }

        .sidebar-menu li {
            margin-bottom: 8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: #1b3b2f;
            color: #ffffff;
            border-left: 4px solid #d4af37;
        }

        /* Main Content Area */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .topbar {
            background: #ffffff;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e2e8f0;
        }

        .topbar h2 {
            color: #0f2a20;
            font-size: 20px;
            font-weight: 700;
        }

        .admin-profile {
            font-size: 14px;
            color: #475569;
            font-weight: 500;
        }

        .admin-profile span {
            color: #1b3b2f;
            font-weight: 700;
        }

        .content-body {
            padding: 30px;
            flex-grow: 1;
        }

        .welcome-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-top: 4px solid #1b3b2f;
        }

        .welcome-card h3 {
            color: #0f2a20;
            margin-bottom: 10px;
            font-size: 22px;
        }

        .welcome-card p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .btn-logout { 
            display: inline-block;
            padding: 10px 20px; 
            background-color: #991b1b; 
            color: white; 
            text-decoration: none; 
            border-radius: 8px; 
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-logout:hover { 
            background-color: #7f1d1d; 
        }
    </style>
</head>
<body>

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active">📊 Dashboard</a></li>
            <li><a href="#">👥 Kelola Admin</a></li>
            <li><a href="#">📁 Data & Konten</a></li>
            <li><a href="#">⚙️ Pengaturan</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <h2>Dashboard Utama</h2>
            <div class="admin-profile">
                Masuk sebagai: <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            </div>
        </div>

        <!-- Body Content -->
        <div class="content-body">
            <div class="welcome-card">
                <h3>Selamat Datang, Admin!</h3>
                <p>Anda berhasil masuk ke dalam sistem manajemen panel Islami.</p>
                <br>
                <a href="../logout.php" class="btn-logout">Logout</a>
            </div>
        </div>
    </div>

</body>
</html>