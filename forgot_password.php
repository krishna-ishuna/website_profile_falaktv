<?php
include 'koneksi.php';
$pesan = "";

if (isset($_POST['reset'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $cek = mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email'");
    
    if (mysqli_num_rows($cek) > 0) {
        // Pada implementasi nyata, kirim token reset via email disini.
        $pesan = "Instruksi pemulihan password telah dikirim ke email Anda.";
    } else {
        $pesan = "Email tidak terdaftar di sistem kami.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); width: 320px; }
        input { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007BFF; border: none; color: white; border-radius: 4px; cursor: pointer; }
        .back { text-align: center; margin-top: 10px; font-size: 13px; }
        .back a { color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>
<div class="card">
    <h3>Reset Password</h3>
    <?php if($pesan) echo "<p style='font-size:13px; color:green;'>$pesan</p>"; ?>
    <form method="POST">
        <label>Masukkan Email Anda:</label>
        <input type="email" name="email" required placeholder="email@example.com">
        <button type="submit" name="reset">Kirim Permintaan</button>
    </form>
    <div class="back">
        <a href="login.php">Kembali ke Login</a>
    </div>
</div>
</body>
</html>