<?php
require "../auth_koneksi/koneksi.php";

$id_peserta = $_SESSION['id_peserta'];

/* =========================
   AMBIL NOTIFIKASI USER
========================= */
$qNotif = mysqli_query($koneksi, "
  SELECT *
  FROM notifikasi
  WHERE id_peserta = '$id_peserta'
  ORDER BY created_at DESC
");

/* =========================
   HITUNG BELUM DIBACA
========================= */
$qJumlah = mysqli_query($koneksi, "
  SELECT COUNT(*) AS total
  FROM notifikasi
  WHERE status = 'belum'
  AND id_peserta = '$id_peserta'
");

$jumlah_notifikasi = mysqli_fetch_assoc($qJumlah)['total'];
