<?php
require "../auth_koneksi/auth.php";
require "../auth_koneksi/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: rapat.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = mysqli_prepare($koneksi, "DELETE FROM rapat WHERE id_rapat = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header("Location: rapat.php");
exit;
