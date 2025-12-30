<?php
require "../auth_koneksi/koneksi.php";

$username = $_GET['username'];

mysqli_query($koneksi, "DELETE FROM pengguna WHERE username='$username'");

header("location:peserta.php");
