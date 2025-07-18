<?php
session_start();

// User dan password statis
$valid_user = 'admin';
$valid_pass = 'admin123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Cek kredensial
    if ($username === $valid_user && $password === $valid_pass) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // Redirect setelah login berhasil
        header("Location:../Aplikasi/index.php");
        exit;
    } else {
        // Gagal login
        echo "Login gagal: username atau password salah.";
    }
}
?>
