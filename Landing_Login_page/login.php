<?php
require 'login_proses.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page</title>

  <!-- Bootstrap CSS -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />

  <!-- CSS Eksternal -->
  <link rel="stylesheet" href="../eksternal_css/login.css?v=<?= time(); ?>">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../foto/icon.png?v=<?= time(); ?>" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

  <div class="main-container shadow-lg">

    <!-- LEFT SIDE -->
    <div class="welcome-container">
      <div class="welcome-wrapper">
        <p class="nice">Nice to see you again</p>
        <h1 class="welcome">WELCOME <span>BACK</span></h1>
        <div class="divider"></div>
        <p class="description">
          Akses kembali dasbor eksklusif Anda. Meeting dan kolaborasi tim telah menanti.
        </p>
      </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="login-container d-flex align-items-center">
      <div class="login-wrapper w-100">

        <h2 class="text-primary fw-semibold">Login Account</h2>
        <p class="intro">Masukkan detail Anda untuk menikmati fitur terbaru dari platform kami.</p>

        <?php if (!empty($error)) : ?>
          <div class="alert alert-danger py-2"><?= $error ?></div>
        <?php endif; ?>

        <form class="login-form" method="POST" action="">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            <div class="error-massage" id="nameerror">Username tidak boleh kosong</div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <div class="error-massage" id="passworderror">Kata sandi minimal 6 karakter</div>
          </div>

          <button type="submit" class="btn btn-primary w-100 py-2">LOGIN</button>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="../Landing_Login_page/login_validation.js"></script>
</body>

</html>