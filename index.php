<?php
// index.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kullanıcı daha önce giriş yapmış mı kontrol et (Oturum kalkanı)
if (isset($_SESSION['kullanici_adi'])) {
    // Giriş yapmışsa doğrudan yönetim paneline fırlat
    header("Location: dashboard.php");
    exit();
} else {
    // Giriş yapmamışsa kapıdaki giriş formuna yönlendir
    header("Location: login.php");
    exit();
}
?>