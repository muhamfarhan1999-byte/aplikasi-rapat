<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../auth_koneksi/koneksi.php';

$id_rapat = $_GET['id_rapat'] ?? '';

$query = mysqli_query($koneksi, "
    SELECT pengguna.username
    FROM rapat_peserta
    JOIN pengguna ON rapat_peserta.id_peserta = pengguna.id_peserta
    WHERE rapat_peserta.id_rapat = '$id_rapat'
");

if (!$query) {
    echo json_encode(["error" => mysqli_error($koneksi)]);
    exit;
}

$peserta = [];

while ($row = mysqli_fetch_assoc($query)) {
    $peserta[] = $row['username'];
}

echo json_encode($peserta);
