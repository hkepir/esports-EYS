<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['kullanici_adi'])) { header("Location: login.php"); exit(); }

require_once "baglanti.php";
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $takim_adi   = trim($_POST['takim_adi']);
    $oyun_bransi = trim($_POST['oyun_bransi']);
    $kurulus_yili= intval($_POST['kurulus_yili']);
    $koç_adi     = trim($_POST['koç_adi']);

    if (!empty($takim_adi) && !empty($oyun_bransi) && $kurulus_yili > 0) {
        $sorgu = "INSERT INTO takimlar (takim_adi, oyun_bransi, kurulus_yili, koç_adi) VALUES ('$takim_adi', '$oyun_bransi', $kurulus_yili, '$koç_adi')";
        if (mysqli_query($baglanti, $sorgu)) {
            $mesaj = "E-Spor takımı sisteme başarıyla kaydedildi!";
        } else {
            $mesaj = "Hata: " . mysqli_error($baglanti);
        }
    }
}
include "header.php";
?>
<div class="row justify-content-center">
    <div class="col-md-8 col-sm-12">
        <div class="card p-4 shadow-lg">
            <h3 class="mb-4 text-primary fw-bold">Yeni E-Spor Takımı Ekle</h3>
            <?php if(!empty($mesaj)): ?>
                <div class="alert alert-success text-center"><?php echo $mesaj; ?></div>
            <?php endif; ?>
            <form action="takim_ekle.php" method="POST">
                <div class="row g-3">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Takım Resmi Adı</label>
                        <input type="text" name="takim_adi" class="form-control" required placeholder="Örn: Galaktik Espor">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Oyun Branşı / Kulvar</label>
                        <select name="oyun_bransi" class="form-select" required>
                            <option value="Counter-Strike 2">Counter-Strike 2</option>
                            <option value="League of Legends">League of Legends</option>
                            <option value="Valorant">Valorant</option>
                            <option value="Dota 2">Dota 2</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Kuruluş Yılı</label>
                        <input type="number" name="kurulus_yili" class="form-control" required min="1990" max="2026" value="2026">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Baş Antrenör / Koç</label>
                        <input type="text" name="koç_adi" class="form-control" placeholder="Örn: MasterCoach">
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <a href="dashboard.php" class="btn btn-outline-secondary fw-bold">Panele Geri Dön</a>
                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">Takımı Veritabanına Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>