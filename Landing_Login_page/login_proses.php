<?php
session_start();
include '../auth_koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Query untuk mendapatkan user berdasarkan username
    $query  = "SELECT * FROM pengguna WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);
    $user   = mysqli_fetch_assoc($result);

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {

        // NORMALISASI ROLE
        $role = strtolower(trim($user['role']));

        // SIMPAN SESSION
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Simpan role di session
        $_SESSION['id_peserta'] = $user['id_peserta'];

        // Alert Login berhasil
        $_SESSION['success'] = "Login berhasil. Selamat datang!";

        // Redirect ke dashboard    
        header("Location: ../dashboard/dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
