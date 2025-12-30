<?php
require "../auth_koneksi/auth.php";
require "../auth_koneksi/koneksi.php";

$id       = $_POST['id_peserta'];
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role     = $_POST['role'] ?? '';
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

// 1. Cek apakah username sudah digunakan user lain
$cek = mysqli_query(
    $koneksi,
    "SELECT id_peserta FROM pengguna 
     WHERE username='$username' 
     AND id_peserta != '$id'"
);

if (mysqli_num_rows($cek) > 0) {
    // Username sudah dipakai
    echo "<script>
            alert('Username sudah digunakan, silakan pilih username lain!');
            window.history.back();
          </script>";
    exit;
}

// 2. Jika aman, lakukan update
$query = "
    UPDATE pengguna 
    SET 
        username='$username',
        password='$password_hash',
        role='$role'
    WHERE id_peserta='$id'
";

mysqli_query($koneksi, $query);

header("Location: peserta.php");
exit();
