<?php
include 'config/config.php';
$pesan = "";
$error = "";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // Validasi apakah password dan konfirmasi password sama
    if ($password !== $confirm) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username atau email sudah terdaftar
        $cek_data = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$username' OR email = '$email'");
        
        if (mysqli_num_rows($cek_data) > 0) {
            $error = "Username atau Email sudah digunakan!";
        } else {
            // Enkripsi password menggunakan password_hash() agar aman
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan data ke database
            $query = "INSERT INTO admins (username, email, password) VALUES ('$username', '$email', '$password_hashed')";
            
            if (mysqli_query($conn, $query)) {
                $pesan = "Registrasi berhasil! Silakan <a href='login.php'>Login</a>.";
            } else {
                $error = "Terjadi kesalahan, coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin - Panel Islami</title>
    <!-- Google Fonts untuk kesan elegan -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #0d1f18 0%, #007a04 100%); 
            color: #222;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
            position: relative;
            overflow: hidden; /* Menghilangkan scrollbar secara total */
        }

        /* Aksen dekoratif latar belakang ala Islami/Geometris tipis */
        body::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, rgba(0, 0, 0, 0) 70%);
            top: -150px;
            right: -150px;
            border-radius: 50%;
            z-index: 0;
        }

        .register-card { 
            background: #ffffff; 
            padding: 25px 30px; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); 
            width: 380px; 
            position: relative;
            z-index: 1;
            border-top: 5px solid #d4af37; /* Aksen kuning emas */
        }

        .register-header {
            text-align: center;
            margin-bottom: 18px;
        }

        .register-header h2 {
            margin: 0 0 3px 0;
            color: #0f2a20;
            font-size: 22px;
            font-weight: 700;
        }

        .register-header p {
            margin: 0;
            color: #666;
            font-size: 12px;
        }

        .form-group { 
            margin-bottom: 12px; 
        }

        .form-group label { 
            display: block; 
            margin-bottom: 4px; 
            font-weight: 600; 
            font-size: 12px;
            color: #1b3b2f;
        }

        .form-group input { 
            width: 100%; 
            padding: 9px 12px; 
            box-sizing: border-box; 
            border: 1px solid #d1d8d4; 
            border-radius: 8px; 
            font-size: 13px;
            background-color: #fafbfc;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #1b3b2f;
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(27, 59, 47, 0.1);
        }

        .password-container { 
            position: relative; 
        }

        .password-container input { 
            width: 100%; 
            padding-right: 45px; 
        }

        /* Styling untuk container ikon mata */
        .password-container span { 
            position: absolute; 
            right: 12px; 
            top: 50%; 
            transform: translateY(-50%); 
            cursor: pointer; 
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1b3b2f; 
            padding: 4px;
            transition: opacity 0.2s;
        }

        .password-container span:hover {
            opacity: 0.7;
        }

        .password-container svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: #1b3b2f;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .btn-register { 
            width: 100%; 
            padding: 10px; 
            background-color: #1b3b2f; /* Hijau tua Islami */
            border: none; 
            color: white; 
            border-radius: 8px; 
            font-weight: 700; 
            font-size: 14px;
            cursor: pointer; 
            transition: background 0.3s ease, transform 0.1s ease;
            box-shadow: 0 4px 12px rgba(27, 59, 47, 0.2);
            margin-top: 4px;
        }

        .btn-register:hover { 
            background-color: #1ec54aff; 
        }

        .btn-register:active {
            transform: scale(0.98);
        }

        .error { 
            background-color: #fdf2f2;
            border: 1px solid #f8d7da;
            color: #c82333; 
            padding: 8px;
            border-radius: 6px;
            font-size: 12px; 
            margin-bottom: 12px; 
            text-align: center; 
            font-weight: 500;
        }

        .success { 
            background-color: #f2fdf4;
            border: 1px solid #d4edda;
            color: #28a745; 
            padding: 8px;
            border-radius: 6px;
            font-size: 12px; 
            margin-bottom: 12px; 
            text-align: center; 
            font-weight: 500;
        }

        .success a {
            color: #1b3b2f;
            font-weight: bold;
            text-decoration: underline;
        }

        .links { 
            text-align: center; 
            margin-top: 15px; 
            font-size: 12px; 
            color: #666;
        }

        .links a { 
            color: #1b3b2f; 
            text-decoration: none; 
            font-weight: 600;
            transition: color 0.2s;
        }

        .links a:hover { 
            color: #d4af37; /* Aksen kuning emas saat di-hover */
            text-decoration: underline; 
        }
    </style>
</head>
<body>

<div class="register-card">
    <div class="register-header">
        <h2>Register Admin</h2>
        <h2 style="color: #158533ff; font-size: 28px;">FalakTV.id</h2>
        <p>Buat akun pengelola baru</p>
    </div>
    
    <?php if (!empty($error)) : ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (!empty($pesan)) : ?>
        <div class="success"><?php echo $pesan; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Masukkan username">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Masukkan email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="password-container">
                <input type="password" name="password" id="password" required placeholder="Buat password">
                <span onclick="togglePass('password', this)" title="Lihat/Sembunyikan Password">
                    <svg class="eyeIcon" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <div class="password-container">
                <input type="password" name="confirm_password" id="confirm_password" required placeholder="Ulangi password">
                <span onclick="togglePass('confirm_password', this)" title="Lihat/Sembunyikan Password">
                    <svg class="eyeIcon" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </span>
            </div>
        </div>

        <button type="submit" name="register" class="btn-register">Daftar</button>
    </form>

    <div class="links">
        Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
</div>

<script>
    function togglePass(id, el) {
        const inputField = document.getElementById(id);
        const eyeIcon = el.querySelector('.eyeIcon');
        
        if (inputField.type === 'password') {
            inputField.type = 'text';
            // Ubah ke ikon mata tercoret (Sembunyikan)
            eyeIcon.innerHTML = `
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                <line x1="1" y1="1" x2="23" y2="23"></line>
            `;
        } else {
            inputField.type = 'password';
            // Kembalikan ke ikon mata terbuka (Lihat)
            eyeIcon.innerHTML = `
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            `;
        }
    }
</script>

</body>
</html>