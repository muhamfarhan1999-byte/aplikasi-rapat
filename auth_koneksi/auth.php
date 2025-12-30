<?php
session_start();
// Session check
if (!isset($_SESSION['username'])) {
    header("Location: ../Landing_Login_page/login.php");
    exit();
}
// Ambil role dari session
$role = $_SESSION['role'];

// Tampilkan alert  login berhasil
if (isset($_SESSION['success'])) : ?>
    <script>
        alert('Login berhasil!');
    </script>
<?php unset($_SESSION['success']);
endif; ?>