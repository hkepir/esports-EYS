<?php
// logout.php
session_start();
session_unset();   // Tüm session değişkenlerini boşaltıyoruz
session_destroy(); // Oturumu sunucudan tamamen imha ediyoruz
header("Location: login.php");
exit();
?>