<?php
require "../auth_koneksi/auth.php";
require "../auth_koneksi/koneksi.php";
include "../fungsi/cari_rapat.php";
include '../rapat/alert_rapat.php';
include '../fungsi/fitur_notifikasi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rapat</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../foto/icon.png?v=<?= time(); ?>" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../eksternal_css/custom.css?v=<?= time(); ?>">

    <!-- Boostrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body class="bg-light-subtle" style="font-family: inter, sans-serif">
    <!-- Navbar Start -->
    <div class="justify-content-between d-flex bg-blue-custom p-3 ps-4 position-relative" style="height: 60px; z-index: 1000;">
        <!-- Left side -->
        <div>
            <a class="navbar-brand text-white fw-bold fs-5" href="#">
                Aplikasi Pengelolaan Rapat
            </a>
        </div>

        <!-- Right side -->
        <div class="d-flex align-items-center gap-4 fw-bold text-white">

            <!-- Notifikasi -->
            <div class="position-relative">

                <button id="notifToggle"
                    type="button"
                    class="btn btn-link text-white p-0"
                    style="text-decoration:none;">
                    <i class="fas fa-bell fs-5"></i>
                </button>

                <?php if ($jumlah_notifikasi > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= $jumlah_notifikasi; ?>
                    </span>
                <?php endif; ?>

                <!-- Dropdown Notifikasi -->
                <div class="notif-dropdown shadow" id="notifDropdown">
                    <div class="notif-header d-flex justify-content-between align-items-center">
                        <a>Notifications</a>
                        <div class="notif-actions">

                            <!-- Tombol -->
                            <button class="btn-delete-all" title="Hapus Semua Notifikasi">
                                <i class="fas fa-trash"></i>
                            </button>

                            <button class="btn-mark-all" title="Tandai Semua Dibaca">
                                <i class="fas fa-check"></i>
                            </button>

                            <button class="btn-close-notif" title="Tutup">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="notif-body">
                        <?php if (mysqli_num_rows($qNotif) > 0): ?>
                            <?php while ($n = mysqli_fetch_assoc($qNotif)): ?>
                                <div
                                    class="notif-item c-custom-2 fs-6 <?= $n['status'] === 'belum' ? 'unread' : 'read' ?>"
                                    data-id="<?= $n['id']; ?>">
                                    <?= htmlspecialchars($n['pesan']); ?>
                                    <div class="notif-time">
                                        <?= date('d M Y H:i', strtotime($n['created_at'])); ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="notif-empty">Tidak ada notifikasi</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Role -->
            <span><?= ucwords(strtolower(htmlspecialchars($_SESSION['role']))); ?></span>

            <!-- Logout -->
            <button onclick="logout()"
                class="logout-btn fs-6 text-white bg-danger rounded px-2 pb-1 border-0">
                Logout
            </button>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Layout Wrapper start-->
    <div class="d-flex " style="height: calc(100vh - 60px)">
        <!-- Sidebar start-->
        <div class="bg-sidebar-custom text-white p-3" style="width: 20%">
            <h4 class="mb-4 text-center fw-bold">Menu</h4>
            <ul class="nav flex-column">

                <?php if ($role === 'Admin' || $role === 'User'): ?>
                    <li class="nav-item"><a href="../dashboard/dashboard.php" class="nav-link text-white fs-6 hover-bg-custom ">Dashboard</a></li>
                <?php endif; ?>

                <?php if ($role === 'Admin' || $role === 'User'): ?>
                    <li class="nav-item"><a href="../rapat/rapat.php" class="nav-link text-white fs-6 hover-bg-custom active-custom">Rapat</a></li>
                <?php endif; ?>

                <?php if ($role === 'Admin'): ?>
                    <li class="nav-item"><a href="../peserta/peserta.php" class="nav-link text-white fs-6 hover-bg-custom">Peserta</a></li>
                <?php endif; ?>

            </ul>
        </div>
        <!-- Sidebar End-->

        <!-- Main Content -->
        <main class="p-4 overflow-x-hidden d-flex flex-column w-80 overflow-y-auto">

            <!-- HEADER SECTION Start-->
            <?php if ($role === 'Admin'): ?>
                <div class="rounded bg-white shadow p-3">
                    <h3 class="fs-4 c-custom-1 fw-bold">Manajemen Rapat</h3>
                    <hr class="mt-0 mb-2">
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Rapat
                    </button>
                </div>
            <?php endif; ?>
            <!-- HEADER SECTION End-->

            <!-- Pencarian Start-->
            <div class="mt-4 rounded bg-white shadow p-3">
                <h2 class="fs-5 fw-bold c-custom-1 mb-3">Temukan Rapat Anda</h2>
                <form method="GET" class="d-flex gap-2 mb-2">
                    <input
                        type="text"
                        class="form-control"
                        name="cari"
                        placeholder="Cari Judul Rapat"
                        value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
            <!-- Pencarian End-->

            <!-- Table Rapat Start-->
            <table class="table bg-white rounded shadow text-center table-hover mt-4">
                <thead>
                    <tr class="th-color">
                        <th>Judul Rapat</th>
                        <th>ID Rapat</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Tempat/Link Rapat</th>
                        <th>File</th>
                        <?php if ($role === 'Admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    $no = 1;

                    while ($data = mysqli_fetch_assoc($query)) :
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($data['judul']); ?></td>
                            <td><?= htmlspecialchars($data['id_rapat']); ?></td>
                            <td><?= $data['status']; ?></td>
                            <td><?= $data['tanggal']; ?></td>
                            <td><?= date('H:i', strtotime($data['waktu'])); ?></td>

                            <td>
                                <?php
                                if (filter_var($data['tempat'], FILTER_VALIDATE_URL)) {
                                    echo '<a href="' . $data['tempat'] . '" target="_blank">' . $data['tempat'] . '</a>';
                                } else {
                                    echo $data['tempat'];
                                }
                                ?>
                            </td>

                            <td>
                                <?= !empty($data['file'])
                                    ? '<a href="uploads/' . $data['file'] . '" target="_blank">Lihat File</a>'
                                    : '-'; ?>
                            </td>
                            <?php if ($role === 'Admin'): ?>
                                <td>
                                    <button
                                        class="btn btn-success btn-sm edit-button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editDataModal"
                                        data-judul="<?= $data['judul']; ?>"
                                        data-id="<?= $data['id_rapat']; ?>"
                                        data-status="<?= $data['status']; ?>"
                                        data-tanggal="<?= $data['tanggal']; ?>"
                                        data-waktu="<?= $data['waktu']; ?>"
                                        data-tempat="<?= $data['tempat']; ?>"
                                        data-deskripsi="<?= htmlspecialchars($data['deskripsi']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>


                                    <a href="hapus_rapat.php?id=<?= $data['id_rapat']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus rapat ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>


                                    <button
                                        class="btn btn-primary btn-sm upload-button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#uploadFileModal"
                                        data-id="<?= $data['id_rapat']; ?>">
                                        <i class="fas fa-upload"></i>
                                    </button>

                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <!-- Table Rapat End-->
        </main>
    </div>
    <!-- Layout Wrapper End-->

    <!-- Modal tambah rapat start-->
    <!-- Modal Tambah Rapat -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius:10px; overflow:hidden;">

                <!-- Header -->
                <div class="modal-header text-white" style="background:#1677ff;">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-calendar-plus me-2"></i> Tambah Rapat
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="tambah_rapat.php" method="POST">
                    <div class="modal-body">

                        <!-- Informasi Rapat -->
                        <h6 class="fw-bold mb-2">Informasi Rapat</h6>

                        <label>Judul Rapat</label>
                        <input type="text" name="judul" class="form-control mb-3" required>

                        <div class="row">
                            <div class="col-md-6">
                                <label>ID Rapat</label>
                                <input type="number" name="id_rapat" class="form-control mb-3" required>
                            </div>

                            <div class="col-md-6">
                                <label>Status Rapat</label>
                                <select name="status" id="statusTambah" class="form-select mb-3" required>
                                    <option disabled selected>-- Pilih Status --</option>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>
                        </div>

                        <!-- FIELD DINAMIS (DI BAWAH JUDUL) -->
                        <div id="field_tempat_tambah" style="display:none;">
                            <label>Tempat Rapat (Offline)</label>
                            <input type="text" name="tempat" class="form-control mb-3">
                        </div>

                        <div id="field_link_tambah" style="display:none;">
                            <label>Link Meeting (Online)</label>
                            <input type="url" name="link_meeting" class="form-control mb-3">
                        </div>

                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control mb-4" rows="3" required></textarea>

                        <!-- Waktu -->
                        <h6 class="fw-bold mb-2">Waktu Pelaksanaan</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control mb-3" required>
                            </div>
                            <div class="col-md-6">
                                <label>Waktu</label>
                                <input type="time" name="waktu" class="form-control mb-3" required>
                            </div>
                        </div>

                        <!-- Peserta Rapat -->
                        <?php
                        $queryPeserta = mysqli_query($koneksi, "SELECT id_peserta, username FROM pengguna WHERE role = 'User'");
                        ?>

                        <div class="mb-3">
                            <label class="form-label">Peserta Rapat</label>

                            <?php while ($p = mysqli_fetch_assoc($queryPeserta)) { ?>
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="peserta[]"
                                        value="<?= $p['id_peserta'] ?>">
                                    <label class="form-check-label">
                                        <?= $p['username'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">
                            <i class="me-1"></i> Simpan Rapat
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Modal tambah rapat End-->

    <!-- Modal Edit rapat start-->
    <div class="modal fade" id="editDataModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius:10px; overflow:hidden;">

                <!-- HEADER -->
                <div class="modal-header text-white" style="background:#1677ff;">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-edit me-2"></i> Edit Rapat
                    </h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="ubah_rapat.php" method="POST">
                    <div class="modal-body">

                        <!-- hidden id -->
                        <input type="hidden" id="edit-id-rapat" name="id_rapat">

                        <!-- INFORMASI RAPAT -->
                        <h6 class="fw-bold mb-2">Informasi Rapat</h6>
                        <label>Judul Rapat</label>
                        <input type="text" id="edit-judul" name="judul" class="form-control mb-3" required>

                        <div class="row">
                            <div class="col-md-6">
                                <label>ID Rapat</label>
                                <input type="number" id="edit-id-view" class="form-control mb-3" disabled>
                            </div>

                            <div class="col-md-6">
                                <label>Status Rapat</label>
                                <select name="status" id="edit-status" class="form-select mb-3" required>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>
                        </div>

                        <!-- Field tempat / link meeting -->
                        <label>Tempat / Link Meeting</label>
                        <input type="text" id="edit-tempat" name="tempat" class="form-control mb-3" required>

                        <label>Deskripsi</label>
                        <textarea id="edit-deskripsi" name="deskripsi" class="form-control mb-4" rows="3"></textarea>

                        <!-- Waktu -->
                        <h6 class="fw-bold mb-2">Waktu Pelaksanaan</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Tanggal</label>
                                <input type="date" id="edit-tanggal" name="tanggal" class="form-control mb-3" required>
                            </div>
                            <div class="col-md-6">
                                <label>Waktu</label>
                                <input type="time" id="edit-waktu" name="waktu" class="form-control mb-3" required>
                            </div>
                        </div>

                        <?php
                        $queryPeserta = mysqli_query($koneksi, "SELECT id_peserta, username FROM pengguna WHERE role = 'User'");
                        ?>

                        <div class="mb-3">
                            <label class="form-label">Peserta Rapat</label>

                            <?php while ($p = mysqli_fetch_assoc($queryPeserta)) { ?>
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="peserta[]"
                                        value="<?= $p['id_peserta'] ?>">
                                    <label class="form-check-label">
                                        <?= $p['username'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal Edit rapat End-->

    <!-- Modal Upload File rapat start-->
    <div class="modal fade" id="uploadFileModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Upload File Rapat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="upload_file.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="upload-id" name="id_rapat">

                        <div class="mb-3">
                            <label class="form-label">Pilih File</label>
                            <input type="file" class="form-control" name="file" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal Upload File rapat End-->

    <!-- Javascript -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fungsi/logout_proses.js"></script>
    <script src="../rapat/pilih_status_rapat.js"></script>
    <script src="../rapat/edit_rapat_modal.js"></script>
    <script src="../rapat/upload_modal.js"></script>
    <script src="../fungsi/toggle_notifikasi.js"></script>
</body>

</html>