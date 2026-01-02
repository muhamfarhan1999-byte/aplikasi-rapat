<?php
require "../auth_koneksi/auth.php";
require "../auth_koneksi/koneksi.php";
include "../peserta/cari_peserta.php";
include "../peserta/tabel_peserta_admin.php";
include '../fungsi/fitur_notifikasi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Peserta</title>

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
    <div class="justify-content-between d-flex bg-blue-custom p-3 ps-4 fixed-top" style="height: 60px; z-index: 1000;">
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

    <div class="d-flex" style="height: calc(100vh - 60px)">

        <!-- Sidebar start-->
        <div class="bg-sidebar-custom text-white p-3 position-fixed"style="width: 20%; height: 100vh; top: 60px; left: 0; overflow-y: auto;">
            <h4 class="mb-4 text-center fw-bold">Menu</h4>
            <ul class="nav flex-column">

                <?php if ($role === 'Admin' || $role === 'User'): ?>
                    <li class="nav-item"><a href="../dashboard/dashboard.php" class="nav-link text-white fs-6 hover-bg-custom">Dashboard</a></li>
                <?php endif; ?>

                <?php if ($role === 'Admin'): ?>
                    <li class="nav-item"><a href="../rapat/rapat.php" class="nav-link text-white fs-6 hover-bg-custom">Rapat</a></li>
                <?php endif; ?>

                <?php if ($role === 'Admin'): ?>
                    <li class="nav-item"><a href="../peserta/peserta.php" class="nav-link text-white fs-6 hover-bg-custom active-custom">Peserta</a></li>
                <?php endif; ?>

            </ul>
        </div>
        <!-- Sidebar End-->

        <!-- Main Content Start-->
        <div class="p-4 overflow-y-auto overflow-x-hidden d-flex flex-column" style="margin-left: 20%; width: 85%; margin-top: 3%;">

            <div class="bg-white p-3 rounded shadow mb-4">
                <h3 class="fw-bold c-custom-1">Daftar Peserta</h3>
                <p class="c-custom-2">Data peserta rapat</p>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPesertaModal">
                    <i class="fas fa-plus-circle"></i> Tambah Peserta
                </button>
            </div>

            <!-- Cari Admin Start -->
            <form method="GET" class="d-flex gap-2 mb-2 mt-5">
                <input type="text" class="form-control" name="cari_admin" placeholder="Cari Admin"
                    value="<?= isset($_GET['cari_admin']) ? htmlspecialchars($_GET['cari_admin']) : '' ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <!-- Cari Admin End -->

            <!--  Admin Table start-->
            <h4 class="fw-bold text-primary">ADMIN</h4>
            <table class="table table-hover bg-white shadow rounded text-center">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($a = mysqli_fetch_assoc($admin)) { ?>
                        <tr>
                            <td><?= $a['id_peserta']; ?></td>
                            <td><?= htmlspecialchars($a['username']); ?></td>
                            <td><?= $a['role']; ?></td>
                            <td>
                                <button class="btn btn-success btn-sm edit-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editPesertaModal"
                                    data-id="<?= $a['id_peserta']; ?>"
                                    data-username="<?= htmlspecialchars($a['username']); ?>"
                                    data-password="<?= htmlspecialchars($a['password']); ?>"
                                    data-role="<?= $a['role']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="hapus_peserta.php?username=<?= urlencode($a['username']); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus peserta?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!--  Admin Table End-->

            <!-- Cari User Start -->
            <form method="GET" class="d-flex gap-2 mb-2 mt-5">
                <input type="text" class="form-control" name="cari_user" placeholder="Cari User"
                    value="<?= isset($_GET['cari_user']) ? htmlspecialchars($_GET['cari_user']) : '' ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <!-- Cari User End -->

            <!-- User Table Start-->
            <h4 class="fw-bold text-success">USER</h4>
            <table class="table table-hover bg-white shadow rounded text-center">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($u = mysqli_fetch_assoc($qUser)) { ?>
                        <tr>
                            <td><?= $u['id_peserta']; ?></td>
                            <td><?= htmlspecialchars($u['username']); ?></td>
                            </td>
                            <td><?= $u['role']; ?></td>
                            <td>
                                <button class="btn btn-success btn-sm edit-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editPesertaModal"
                                    data-id="<?= $u['id_peserta']; ?>"
                                    data-username="<?= htmlspecialchars($u['username']); ?>"
                                    data-password="<?= htmlspecialchars($u['password']); ?>"
                                    data-role="<?= $u['role']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="hapus_peserta.php?username=<?= urlencode($u['username']); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus peserta?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- User Table Start-->

    <!-- Modal Tambah Peserta Start-->
    <div class="modal fade" id="tambahPesertaModal">
        <div class="modal-dialog">
            <form action="tambah_peserta.php" method="POST" class="modal-content">
                <div class="modal-header text-white" style="background:#1677ff;">
                    <h5 class="modal-title">Tambah Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_peserta" class="form-label">ID Peserta</label>
                        <input type="number"
                            id="id_peserta"
                            class="form-control"
                            name="id_peserta"
                            placeholder="Masukkan ID Peserta"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" class="form-control" name="username" placeholder="Masukkan username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Masukkan password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Tambah Peserta End-->

    <!-- Modal Edit Peserta Start-->
    <div class="modal fade" id="editPesertaModal">
        <div class="modal-dialog">
            <form action="ubah_peserta.php" method="POST" class="modal-content">
                <div class="modal-header text-white" style="background:#1677ff;">
                    <h5 class="modal-title">Edit Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">ID Peserta</label>
                        <input type="text"
                            id="edit_id"
                            name="id_peserta"
                            class="form-control"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username</label>
                        <input id="edit_username" class="form-control" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password</label>
                        <input id="edit_password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select id="edit_role" name="role" class="form-select" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Edit Peserta End-->
    <!-- Main Content End-->

    <!-- SCRIPTS -->
    <!-- Javascript -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fungsi/logout_proses.js"></script>
    <script src="../peserta/edit_peserta_modal.js"></script>
    <script src="../fungsi/toggle_notifikasi.js"></script>
    <script src="../peserta/show_password.js"></script>

</body>

</html>