<?php
session_start();
session_unset();
session_destroy();

// Hapus cookie ingat saya jika ada
if (isset($_COOKIE['login_id'])) {
    setcookie('login_id', '', time() - 3600, "/");
}

header("Location: login.php");
exit;
?>