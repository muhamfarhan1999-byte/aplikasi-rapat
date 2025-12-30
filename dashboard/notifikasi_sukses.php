<?php
// Catatan: session_start() harus sudah dipanggil di file utama (misal dashboard.php)

$pesan_html = '';

// 1. Cek apakah ada pesan sukses (flash_message)
if (isset($_SESSION['pesan_sukses'])) {

    $pesan = htmlspecialchars($_SESSION['pesan_sukses']);

    // 2. Buat output HTML untuk pesan
    $pesan_html = '
        <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 20px;">
            ' . $pesan . '
        </div>';

    // 3. Hapus pesan dari session setelah diambil
    unset($_SESSION['pesan_sukses']);
}

// 4. Output HTML
echo $pesan_html;
