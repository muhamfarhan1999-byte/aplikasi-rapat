<?php
require "../auth_koneksi/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id       = $_POST['id_peserta'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role     = $_POST['role'];
  $password_acak = $_POST['password'];

  // Hash password
  $password_hash = password_hash($password_acak, PASSWORD_DEFAULT);

  // 🔒 Cek ID sudah ada atau belum
  $cek = mysqli_query($koneksi, "SELECT id_peserta FROM pengguna WHERE id_peserta='$id'");

  if (mysqli_num_rows($cek) > 0) {
    echo "<script>
                alert('ID Peserta sudah digunakan!');
                window.location='peserta.php';
              </script>";
    exit;
  }

  // ✅ Insert data
  $query = "INSERT INTO pengguna (id_peserta, username, password, role)
          VALUES ('$id', '$username', '$password_hash', '$role')";

  if (mysqli_query($koneksi, $query)) {
    echo "<script>
                alert('Data peserta berhasil ditambahkan!');
                window.location='peserta.php';
              </script>";
  } else {
    echo "<script>
                alert('Gagal menambahkan peserta!');
                window.location='peserta.php';
              </script>";
  }
}
