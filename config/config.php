<?php
// Pengaturan Database
$host     = "localhost"; // Nama host server database (biasanya localhost)
$username = "root";      // Username database (default XAMPP/Laragon biasanya 'root')
$password = "";          // Password database (default XAMPP/Laragon biasanya kosong '')
$database = "db_falak"; // UBAH INI: Sesuaikan dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika gagal, hentikan program dan tampilkan pesan error
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Catatan: Jika tidak ada pesan error yang muncul, berarti koneksi berhasil.
?>