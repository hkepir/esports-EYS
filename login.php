<?php
require_once "baglanti.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = trim($_POST['kullanici_adi']);
    $sifre         = trim($_POST['sifre']);

    if (!empty($kullanici_adi) && !empty($sifre)) {
        $sorgu  = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$kullanici_adi'";
        $sonuc  = mysqli_query($baglanti, $sorgu);
        $kullanici = mysqli_fetch_assoc($sonuc);

        if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
            $_SESSION['kullanici_id']  = $kullanici['id'];
            $_SESSION['kullanici_adi'] = $kullanici['kullanici_adi'];
            
            header("Location: dashboard.php");
            exit();
        } else {
            $mesaj = "Hatalı kullanıcı adı veya şifre!";
        }
    } else {
        $mesaj = "Lütfen tüm alanları doldurunuz!";
    }
}

include "header.php";
?>

<div class="row justify-content-center my-5">
    <div class="col-md-5 col-sm-12">
        <div class="card p-4 shadow-lg border-0">
            <div class="text-center mb-4">
                <span style="font-size: 3rem;">🔐</span>
                <h3 class="mt-2 fw-bold text-dark">Yönetici Girişi</h3>
                <p class="text-muted small">E-Spor Ekosistemine erişmek için bilgilerinizi giriniz.</p>
            </div>
            
            <?php if (!empty($mesaj)): ?>
                <div class="alert alert-danger text-center py-2 rounded-3 small"><?php echo $mesaj; ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-secondary">Kullanıcı Adı</label>
                    <input type="text" name="kullanici_adi" class="form-control" placeholder="Örn:admin" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold text-secondary">Şifre</label>
                    <input type="password" name="sifre" class="form-control" >
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2.5 fw-bold rounded-3 shadow-sm">Sisteme Güvenli Giriş Yap</button>
            </form>
            
            <div class="text-center mt-4 pt-3 border-top border-light">
                <span class="text-muted small">Henüz hesabınız yok mu?</span>
                <a href="register.php" class="btn btn-link btn-sm text-info fw-bold p-0 ms-1 text-decoration-none">Şimdi Kayıt Ol</a>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>