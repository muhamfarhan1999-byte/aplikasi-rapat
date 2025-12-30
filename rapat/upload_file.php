<?php
require "../auth_koneksi/koneksi.php";

if (isset($_POST['id_rapat']) && isset($_FILES['file'])) {
    $id_rapat = $_POST['id_rapat'];
    $file = $_FILES['file'];

    // Tentukan folder tujuan (otomatis buat kalau belum ada)
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // buat folder dan subfolder jika perlu
    }

    // Amankan nama file: ganti spasi dengan underscore dan hapus karakter aneh
    $fileName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', basename($file['name']));
    $targetFile = $uploadDir . $fileName;

    // Pindahkan file
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Update nama file di database
        $sql = "UPDATE rapat SET file='$fileName' WHERE id_rapat='$id_rapat'";
        if (mysqli_query($koneksi, $sql)) {
            // Redirect ke halaman rapat
            header("Location: rapat.php?upload=success");
            exit;
        } else {
            echo "Gagal update database: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal upload file!";
    }
} else {
    echo "Tidak ada file yang diupload.";
}
