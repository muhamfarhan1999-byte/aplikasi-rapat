<?php
session_start();
include '../auth_koneksi/koneksi.php';

/* =======================
   VALIDASI SESSION
======================= */
if (!isset($_SESSION['id_peserta'])) {
    header("Location: ../Landing_Login_page/login.php");
    exit;
}

/* =======================
   AMBIL DATA POST
======================= */
$id_rapat  = $_POST['id_rapat'] ?? '';
$judul     = $_POST['judul'] ?? '';
$status    = $_POST['status'] ?? '';
$tanggal   = $_POST['tanggal'] ?? '';
$waktu     = $_POST['waktu'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';
$peserta   = $_POST['peserta'] ?? [];

/* =======================
   TEMPAT / LINK
======================= */
if ($status === 'Online') {
    $tempat = $_POST['link_meeting'] ?? '';
} else {
    $tempat = $_POST['tempat'] ?? '';
}

/* =======================
   VALIDASI WAJIB
======================= */
if (
    $id_rapat === '' ||
    $judul === '' ||
    $status === '' ||
    $tanggal === '' ||
    $waktu === '' ||
    $tempat === '' ||
    empty($peserta)
) {
    header("Location: rapat.php?alert=lengkap");
    exit;
}

/* =======================
   CEK ID DUPLIKAT
======================= */
$cek = mysqli_query(
    $koneksi,
    "SELECT id_rapat FROM rapat WHERE id_rapat = '$id_rapat'"
);

if (mysqli_num_rows($cek) > 0) {
    header("Location: rapat.php?alert=id_duplikat");
    exit;
}

/* =======================
   INSERT RAPAT
======================= */
$queryRapat = "
    INSERT INTO rapat (
        id_rapat,
        judul,
        status,
        tanggal,
        waktu,
        tempat,
        deskripsi
    ) VALUES (
        '$id_rapat',
        '$judul',
        '$status',
        '$tanggal',
        '$waktu',
        '$tempat',
        '$deskripsi'
    )
";

if (!mysqli_query($koneksi, $queryRapat)) {
    header("Location: rapat.php?alert=gagal");
    exit;
}

/* =======================
   SIMPAN PESERTA RAPAT
======================= */
foreach ($peserta as $id_peserta) {
    mysqli_query($koneksi, "
        INSERT INTO rapat_peserta (id_rapat, id_peserta)
        VALUES ('$id_rapat', '$id_peserta')
    ");
}

/* =======================
   NOTIFIKASI (WAJIB PER USER)
======================= */
$pesan_notif = "Anda ditambahkan ke rapat: $judul pada $tanggal pukul $waktu";

foreach ($peserta as $id_peserta) {
    mysqli_query($koneksi, "
        INSERT INTO notifikasi (
            id_peserta,
            pesan,
            status
        ) VALUES (
            '$id_peserta',
            '$pesan_notif',
            'belum'
        )
    ");
}

/* =======================
   REDIRECT SUKSES
======================= */
header("Location: rapat.php?alert=success");
exit;
