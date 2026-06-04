<?php
// takim_sil.php
session_start();
if (!isset($_SESSION['kullanici_adi'])) { header("Location: login.php"); exit(); }

require_once "baglanti.php";

if (isset($_GET['id'])) {
    $silinecek_id = intval($_GET['id']);
    
    // Ölümcül WHERE kısıtını ekleyerek sadece seçilen takımı siliyoruz!
    $sorgu = "DELETE FROM takimlar WHERE id = $silinecek_id";
    mysqli_query($baglanti, $sorgu);
}

// Kullanıcıyı hemen listeleme sayfasına (panel) geri postalıyoruz
header("Location: dashboard.php");
exit();
?>