<?php
require "../auth_koneksi/auth.php";
require "../auth_koneksi/koneksi.php";
include "../dashboard/statistik_rapat.php";
include "../dashboard/fungsi_random_gambar.php";
include "../fungsi/cari_rapat.php";
include '../dashboard/notifikasi_sukses.php';
include '../fungsi/fitur_notifikasi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

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

  <!-- Layout Wrapper start-->
  <div class="d-flex " style="height: calc(100vh - 60px);">
    <!-- Sidebar start-->
     <div class="bg-sidebar-custom text-white p-3 position-fixed"style="width: 20%; height: 100vh; top: 60px; left: 0; overflow-y: auto;">
      <h4 class="mb-4 text-center fw-bold">Menu</h4>
      <ul class="nav flex-column">

        <?php if ($role === 'Admin' || $role === 'User'): ?>
          <li class="nav-item"><a href="../dashboard/dashboard.php" class="nav-link text-white fs-6 hover-bg-custom active-custom">Dashboard</a></li>
        <?php endif; ?>

        <?php if ($role === 'Admin' || $role === 'User'): ?>
          <li class="nav-item"><a href="../rapat/rapat.php" class="nav-link text-white fs-6 hover-bg-custom">Rapat</a></li>
        <?php endif; ?>

        <?php if ($role === 'Admin'): ?>
          <li class="nav-item"><a href="../peserta/peserta.php" class="nav-link text-white fs-6 hover-bg-custom">Peserta</a></li>
        <?php endif; ?>

      </ul>
    </div>

    <!--Sidebar end-->

    <!-- Main Content -->
    <!-- Greeting card start -->
      <div class="p-4 overflow-y-auto overflow-x-hidden d-flex flex-column" style="margin-left: 20%; width: 85%; margin-top: 3%;">
      <div class="h-16 rounded bg-white justify-content-center shadow p-3">
        <h3 class="fs-4 c-custom-1 fw-bold">Selamat Datang, <?= ucwords(strtolower(htmlspecialchars($_SESSION['username']))); ?> 👋</h3>
        <p class="c-custom-2">Berikut daftar rapat anda hari ini dan yang akan datang.</p>
      </div>

      <!-- Greeting card End -->

      <!-- Statistik Start -->
      <div class="d-flex gap-3 mt-4 text-center">
        <div class="card h-14 shadow flex-fill card-hover">
          <h4 class="fw-bold fs-5 c-custom-1 pt-3">Total Rapat</h4>
          <p class="fw-bold fs-5"><?= $total; ?></p>
        </div>

        <div class="card h-14 shadow flex-fill card-hover">
          <h4 class="fw-bold fs-5 c-custom-1 pt-3">Online</h4>
          <p class="fw-bold fs-5"><?= $online; ?></p>
        </div>

        <div class="card h-14 shadow flex-fill card-hover">
          <h4 class="fw-bold fs-5 c-custom-1 pt-3">Offline</h4>
          <p class="fw-bold fs-5"><?= $offline; ?></p>
        </div>
      </div>
      <!-- Statistik End -->

      <!-- Filter online/offline start -->
      <div class="d-flex gap-2 mb-3 mt-4">
        <a href="dashboard.php?status=Online" class="btn btn-success">Online</a>
        <a href="dashboard.php?status=Offline" class="btn btn-warning">Offline</a>
        <a href="dashboard.php" class="btn btn-secondary">Semua</a>
      </div>
      <!-- Filter online/offline End -->

      <!-- Pencarian Start-->
      <div class="h-12  rounded bg-white justify-content-center shadow ps-3 pe-3 mb-4">
        <h2 class="fs-5 fw-bold mt-4 c-custom-1">Temukan Rapat Anda</h2>
        <form method="GET" class="d-flex gap-2 mb-4">
          <input type="text" class="form-control" name="cari" placeholder="Cari Judul Rapat" value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>" />
          <button type="submit" class="btn btn-primary">Cari</button>
        </form>
      </div>
      <!-- Pencarian End-->

      <!-- Card rapat start-->
      <div class="row">
        <?php
        while ($data = mysqli_fetch_assoc($query)) {
          $icon = getRandomIcon();
        ?>

          <div class="col-md-4 mb-4">
            <div class="card shadow border-0 rounded-3 card-hover" style="overflow: hidden;">

              <div class="d-flex justify-content-center align-items-center pt-4">
                <img src="<?= htmlspecialchars($icon); ?>" width="80" />
              </div>

              <div class="card-body" style="height: 270px">

                <h5 class="fw-bold c-custom-1"><?= htmlspecialchars($data['judul']); ?></h5>

                <div class="d-inline-flex align-items-center px-3 py-1 rounded-pill 
                <?php
                if ($data['status'] == 'Online') echo 'bg-success text-white';
                else if ($data['status'] == 'Offline') echo 'bg-warning text-dark';
                else echo 'bg-warning text-dark';
                ?>
                fw-semibold shadow-sm"
                  style="font-size: 14px;">
                  <i class="fas fa-circle me-2" style="font-size: 10px;"></i>
                  <?= htmlspecialchars($data['status']); ?>
                </div>

                <div class="mt-3 mb-3 text-secondary" style="font-size: 15px;">
                  <p class="mb-1">
                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                    <strong><?= htmlspecialchars($data['tanggal']); ?></strong>
                  </p>

                  <p class="mb-1">
                    <i class="fas fa-clock text-primary me-2"></i>
                    <strong><?= htmlspecialchars(date('H:i', strtotime($data['waktu']))); ?></strong>
                  </p>

                  <p class="mb-1 text-secondary d-flex align-items-center">
                    <i class="fas fa-map-marker-alt text-primary me-2 flex-shrink-0"></i>
                    <strong class="truncate">
                      <?= htmlspecialchars($data['tempat']); ?>
                    </strong>
                  </p>

                  <p class="mb-1 text-secondary d-flex align-items-center">
                    <i class="fas fa-align-left text-primary me-2 flex-shrink-0"></i>
                    <strong class="truncate">
                      <?= htmlspecialchars($data['deskripsi']); ?>
                    </strong>
                  </p>
                </div>

                <button
                  class="btn w-100 text-white fw-semibold py-2"
                  style="background: linear-gradient(90deg, #005eff, #0d6efd); border-radius: 8px;"
                  data-bs-toggle="modal"
                  data-bs-target="#modalDetailRapat"
                  data-id="<?= htmlspecialchars($data['id_rapat']); ?>"
                  data-judul="<?= htmlspecialchars($data['judul']); ?>"
                  data-status="<?= htmlspecialchars($data['status']); ?>"
                  data-tanggal="<?= htmlspecialchars($data['tanggal']); ?>"
                  data-waktu="<?= htmlspecialchars(date('H:i', strtotime($data['waktu']))); ?>"
                  data-tempat="<?= htmlspecialchars($data['tempat']); ?>"
                  data-deskripsi="<?= htmlspecialchars($data['deskripsi']); ?>">
                  <i class="fas fa-eye me-2"></i> Lihat Detail Rapat
                </button>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <!-- Card rapat end-->

    <!-- Modal Detail start -->
    <!-- Modal Detail Rapat -->
    <div class="modal fade" id="modalDetailRapat" tabindex="-1" aria-labelledby="modalDetailRapatLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg rounded-4 border-0">

          <!-- Header Modal -->
          <div class="modal-header text-white" style="background: linear-gradient(135deg, #0062ff, #00c6ff);">
            <h5 class="modal-title" id="modalDetailRapatLabel">
              <i class="bi bi-info-circle-fill me-2"></i> Detail Rapat
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Body Modal -->
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                  <tr>
                    <th scope="col"><i class="bi bi-tag-fill"></i> Aspek</th>
                    <th scope="col"><i class="bi bi-info-circle-fill"></i> Detail</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>Judul Rapat</strong></td>
                    <td id="detailJudul">-</td>
                  </tr>
                  <tr>
                    <td><strong>ID Rapat</strong></td>
                    <td id="detailId">-</td>
                  </tr>
                  <tr>
                    <td><strong>Status</strong></td>
                    <td><span class="badge" id="detailStatus">Aktif</span></td>
                  </tr>
                  <tr>
                    <td><strong>Tanggal</strong></td>
                    <td id="detailTanggal">-</td>
                  </tr>
                  <tr>
                    <td><strong>Waktu</strong></td>
                    <td id="detailWaktu">-</td>
                  </tr>
                  <tr>
                    <td><strong>Tempat/Link Rapat</strong></td>
                    <td id="detailTempat">-</td>
                  </tr>
                  <tr>
                    <td><strong>Peserta</strong></td>
                    <td id="detailPeserta">-</td>
                  </tr>
                  <tr>
                    <td><strong>Deskripsi</strong></td>
                    <td id="detailDeskripsi">-</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Footer Modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">
              <i class="bi bi-x-circle me-1"></i> Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Detail End -->
  </div>
  <!-- Layout Wrapper End-->

  <!-- Javascript -->
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../fungsi/logout_proses.js"></script>
  <script src="../dashboard/modal_detail_rapat.js"></script>
  <script src="../fungsi/toggle_notifikasi.js"></script>

</body>

</html>