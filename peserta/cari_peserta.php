<?php
require "../auth_koneksi/koneksi.php";

// Inisialisasi variabel
$whereAdmin = "";
$whereUser  = "";

// Filter pencarian Admin
if (!empty($_GET['cari_admin'])) {
    $cariAdmin = mysqli_real_escape_string($koneksi, $_GET['cari_admin']);
    $whereAdmin = "AND username LIKE '%$cariAdmin%'";
}

// Filter pencarian User
if (!empty($_GET['cari_user'])) {
    $cariUser = mysqli_real_escape_string($koneksi, $_GET['cari_user']);
    $whereUser = "AND username LIKE '%$cariUser%'";
}
