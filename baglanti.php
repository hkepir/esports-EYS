<?php
// Lokal veya canlı sunucu bilgileri GitHub'a aktarılmadan önce sansürlenmiştir
$server   = "localhost";
$user     = "BURAYA_HOSTING_KULLANICI_ADI_GELECEK"; 
$password = "********";  
$database = "eSporWeb";

$baglanti = mysqli_connect($server, $user, $password, $database);

if(!$baglanti){
    die("Bağlantı kesildi: " . mysqli_connect_error());
}
mysqli_set_charset($baglanti, "utf8mb4");
?>