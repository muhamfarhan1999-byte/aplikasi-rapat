<?php
require '../auth_koneksi/koneksi.php';
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';
$status = isset($_GET['status']) ? mysqli_real_escape_string($koneksi, $_GET['status']) : '';

$sql = "SELECT * FROM rapat WHERE 1=1";

if ($cari != '') {
    $sql .= " AND judul LIKE '%$cari%'";
}

if ($status != '') {
    $sql .= " AND status='$status'";
}

$sql .= " ORDER BY tanggal ASC, waktu ASC";

$query = mysqli_query($koneksi, $sql);
