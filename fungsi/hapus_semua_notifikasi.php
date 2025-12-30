<?php
require "../auth_koneksi/auth.php";
require "../auth_koneksi/koneksi.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit;
}

$id_peserta = $_SESSION['id_peserta'];

/* =========================
   HAPUS SEMUA NOTIF USER
========================= */
$hapus = mysqli_query($koneksi, "
  DELETE FROM notifikasi
  WHERE id_peserta = '$id_peserta'
");

if (!$hapus) {
    echo json_encode([
        "success" => false,
        "error" => mysqli_error($koneksi)
    ]);
    exit;
}

echo json_encode([
    "success" => true
]);
