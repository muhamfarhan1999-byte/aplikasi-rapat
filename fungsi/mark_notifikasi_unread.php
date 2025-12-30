<?php
require "../auth_koneksi/auth.php";
require "../auth_koneksi/koneksi.php";

$id = $_POST['id'] ?? null;
$id_peserta = $_SESSION['id_peserta'];

if (!$id) {
    http_response_code(400);
    exit;
}

mysqli_query($koneksi, "
  UPDATE notifikasi
  SET status = 'dibaca'
  WHERE id = '$id'
  AND id_peserta = '$id_peserta'
");

echo "OK";
