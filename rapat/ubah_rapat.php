<?php
// include database connection file
include '../auth_koneksi/koneksi.php';

$id_rapat = $_POST['id_rapat'];
$judul = $_POST['judul'];
$status = $_POST['status'];
$tanggal = $_POST['tanggal'];
$waktu = $_POST['waktu'];
$tempat = $_POST['tempat'];
$deskripsi = $_POST['deskripsi'];

$result = mysqli_query(
    $koneksi,
    "UPDATE rapat SET judul='$judul', status='$status', tanggal='$tanggal', waktu='$waktu', tempat='$tempat',deskripsi='$deskripsi' WHERE id_rapat='$id_rapat'"
);

// Redirect to homepage to display updated user in list
header("Location: rapat.php");
