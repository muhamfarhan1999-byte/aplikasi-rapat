<?php
$total = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM rapat"))['total'];
$online = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) AS online FROM rapat WHERE status = 'Online'"))['online'];
$offline = mysqli_fetch_array(mysqli_query($koneksi, "SELECT COUNT(*) AS offline FROM rapat WHERE status = 'Offline'"))['offline'];
