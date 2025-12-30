<?php
if (!isset($_GET['alert'])) return;

$alert = $_GET['alert'];

$pesan = match ($alert) {
    'id_duplikat' => 'ID rapat sudah digunakan!',
    'lengkap'     => 'Semua field wajib diisi!',
    'gagal'       => 'Gagal menyimpan rapat!',
    'success'     => 'Rapat berhasil ditambahkan!',
    default       => null
};

if ($pesan):
?>
    <script>
        alert("<?= $pesan ?>");
    </script>
<?php endif; ?>