<?php
require "../auth_koneksi/koneksi.php";

$id_rapat = $_POST['id_rapat'];

$query = mysqli_query($koneksi, "
    SELECT p.nama_peserta
    FROM rapat_peserta rp
    JOIN peserta p ON rp.id_peserta = p.id_peserta
    WHERE rp.id_rapat = '$id_rapat'
");

$peserta = [];

while ($row = mysqli_fetch_assoc($query)) {
    $peserta[] = $row['nama_peserta'];
}

echo json_encode($peserta);
