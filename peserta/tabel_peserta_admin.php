<?php
$whereAdmin = $whereAdmin ?? "";
$whereUser  = $whereUser ?? "";

$admin = mysqli_query(
    $koneksi,
    "SELECT * FROM pengguna WHERE role='Admin' $whereAdmin ORDER BY id_peserta DESC"
);

$qUser = mysqli_query(
    $koneksi,
    "SELECT * FROM pengguna WHERE role='User' $whereUser ORDER BY id_peserta DESC"
);
