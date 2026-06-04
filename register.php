<?php
require_once "baglanti.php";

$mesaj = "";
$mesaj_turu = "";
//form bilgisi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = trim($_POST['kullanici_adi']);
    $sifre         = trim($_POST['sifre']);

    if (!empty($kullanici_adi) && !empty($sifre)) {
        // Şifreyi hash'liyoruz
        $hashli_sifre = password_hash($sifre, PASSWORD_DEFAULT);

        // SQL komutu
        $sorgu = "INSERT INTO kullanicilar (kullanici_adi, sifre) VALUES ('$kullanici_adi', '$hashli_sifre')";
        
        if (mysqli_query($baglanti, $sorgu)) {
            $mesaj = "Kayıt başarıyla tamamlandı! Giriş yapabilirsiniz.";
            $mesaj_turu = "success";
        } else {
            $mesaj = "Hata: Kullanıcı adı zaten alınmış olabilir.";
            $mesaj_turu = "danger";
        }
    } else {
        $mesaj = "Lütfen tüm alanları doldurunuz!";
        $mesaj_turu = "warning";
    }
}

include "header.php"; // Ortak arayüz
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-sm-12"> <div class="card p-4 shadow-lg mt-4">
            <h3 class="text-center mb-4 text-primary fw-bold"> Menajer Kayıt Formu</h3>
            
            <?php if (!empty($mesaj)): ?>
                <div class="alert alert-<?php echo $mesaj_turu; ?> text-center"><?php echo $mesaj; ?></div>
            <?php endif; ?>

            <form action="register.php" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label class="form-label">Kullanıcı Adı</label>
                    <input type="text" name="kullanici_adi" class="form-control" required placeholder="Örn: Xantares">
                </div>
                <div class="mb-4">
                    <label class="form-label">Şifre</label>
                    <input type="password" name="sifre" class="form-control" required placeholder="••••••">
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold">Sisteme Kayıt Ol</button>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>