<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../foto/icon.png?v=<?= time(); ?>" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../eksternal_css/custom.css?v=<?= time(); ?>">

  <!-- Boostrap Icon and css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />

</head>

<body class="bg-light">

  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
        <i class="bi bi-people-fill"></i> APLIKASI RAPAT
      </a>

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-lg-center">
          <li class="nav-item">
            <a class="nav-link" href="#fitur">
              <i class="bi bi-grid-fill me-1"></i>Fitur
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tentang">
              <i class="bi bi-info-circle-fill me-1"></i>Tentang
            </a>
          </li>
          <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
            <a class="btn btn-login" href="login.php">
              <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <!-- Hero Start -->
  <section class="hero">
    <div class="container hero-content">

      <h1 class="fw-bold display-5">
        Kelola Rapat Lebih <span class="text-info">Mudah</span><br />
        & <span class="text-info">Profesional</span>
      </h1>

      <p class="lead mt-3">
        Satu platform untuk pencatatan, dokumentasi, dan evaluasi hasil rapat
      </p>

      <a href="login.php" class="btn btn-info btn-lg mt-4 px-5">
        Mulai Sekarang <i class="bi bi-arrow-right ms-2"></i>
      </a>
    </div>
  </section>
  <!-- Hero End -->

  <!-- Fitur Start -->
  <section id="fitur" class="py-5 bg-white">
    <div class="container text-center">
      <h2 class="fw-bold mb-3">Fitur Utama</h2>
      <p class="text-secondary mb-5">
        Semua yang dibutuhkan untuk mengelola rapat secara profesional
      </p>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-card border">
            <i class="bi bi-info-circle-fill"></i>
            <h5>Informasi Detail Rapat</h5>
            <p class="text-secondary">
              Informasi rapat lengkap meliputi waktu, lokasi, dan deskripsi.
            </p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="feature-card border">
            <i class="bi bi-calendar-check-fill"></i>
            <h5>Manajemen Agenda</h5>
            <p class="text-secondary">
              Penjadwalan dan pengelolaan agenda rapat secara terstruktur.
            </p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="feature-card border">
            <i class="bi bi-people-fill"></i>
            <h5>Manajemen Peserta</h5>
            <p class="text-secondary">
              Data peserta rapat dikelola secara terpusat dan rapi.
            </p>
          </div>
        </div>

        <div class="col-md-4 mx-auto">
          <div class="feature-card border">
            <i class="bi bi-file-earmark-text-fill"></i>
            <h5>Notulensi Rapat</h5>
            <p class="text-secondary">
              Notulensi rapat tersimpan aman sebagai dokumentasi resmi.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Fitur End -->

  <!-- Tentang Start -->
  <section id="tentang" class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="bg-white p-5 rounded-4 shadow-lg">
            <div class="row align-items-center">

              <div class="col-md-7">
                <h2 class="fw-bold mb-3">Tentang Aplikasi</h2>
                <p class="fs-5 text-secondary">
                  Aplikasi Pengelolaan Rapat membantu organisasi dalam mencatat,
                  mengelola, dan mendokumentasikan rapat secara transparan dan
                  profesional.
                </p>

                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-check-circle-fill text-primary fs-4 me-3"></i>
                  Transparansi data rapat
                </div>

                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-lightning-charge-fill text-primary fs-4 me-3"></i>
                  Proses lebih cepat & efisien
                </div>

                <div class="d-flex align-items-center mt-3">
                  <i class="bi bi-shield-lock-fill text-primary fs-4 me-3"></i>
                  Dokumentasi tersimpan aman
                </div>
              </div>

              <div class="col-md-5 text-center">
                <i class="bi bi-people-fill text-primary" style="font-size: 6rem;"></i>
                <p class="text-secondary mt-3">
                  Mendukung kolaborasi dan profesionalitas rapat
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Tentang End -->

  <!-- Footer Start -->
  <footer class="text-white text-center p-3 navbar-custom">
    <p class="mb-0">© 2025 <strong>Aplikasi Rapat</strong>. Semua hak dilindungi.</p>
  </footer>
  <!-- Footer End-->

  <!-- Bootstrap JS -->
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>