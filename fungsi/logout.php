<?php
session_start();
// Hapus semua session 
session_unset();
// Hancurkan session 
session_destroy();

// Redirect ke halaman login 
header("Location: ../Landing_Login_page/landing.php");
exit();
