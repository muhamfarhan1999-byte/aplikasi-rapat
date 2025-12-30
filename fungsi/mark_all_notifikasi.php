<?php
require "../auth_koneksi/auth.php";
require "../auth_koneksi/koneksi.php";

$id_peserta = $_SESSION['id_peserta'];

mysqli_query($koneksi, "
  UPDATE notifikasi
  SET status = 'dibaca'
  WHERE status = 'belum'
  AND id_peserta = '$id_peserta'
");

echo json_encode(["success" => true]);
