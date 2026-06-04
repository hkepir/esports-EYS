<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION['kullanici_adi'])) { header("Location: login.php"); exit(); }

require_once "baglanti.php";
$mesaj = "";

// 1. ADIM: Eski verileri bulup formun içine doldurma işlemi
if (isset($_GET['id'])) {
    $guncelle_id = intval($_GET['id']);
    $sorgu = "SELECT * FROM takimlar WHERE id = $guncelle_id";
    $sonuc = mysqli_query($baglanti, $sorgu);
    $takim = mysqli_fetch_assoc($sonuc);
    if (!$takim) { header("Location: dashboard.php"); exit(); }
} else {
    header("Location: dashboard.php");
    exit();
}

// 2. ADIM: Kullanıcı formu değiştirip gönderdiğinde UPDATE çalıştırma
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $takim_adi   = trim($_POST['takim_adi']);
    $oyun_bransi = trim($_POST['oyun_bransi']);
    $kurulus_yili= intval($_POST['kurulus_yili']);
    $koç_adi     = trim($_POST['koç_adi']);

    $sorgu_guncelle = "UPDATE takimlar SET takim_adi='$takim_adi', oyun_bransi='$oyun_bransi', kurulus_yili=$kurulus_yili, koç_adi='$koç_adi' WHERE id = $guncelle_id";
    
    if (mysqli_query($baglanti, $sorgu_guncelle)) {
        header("Location: dashboard.php"); // Başarılıysa doğrudan panele dön
        exit();
    } else {
        $mesaj = "Güncelleme hatası: " . mysqli_error($baglanti);
    }
}

include "header.php";
?>
<div class="row justify-content-center">
    <div class="col-md-8 col-sm-12">
        <div class="card p-4 shadow-lg">
            <h3 class="mb-4 text-warning fw-bold"> E-Spor Takım Bilgilerini Düzenle</h3>
            <?php if(!empty($mesaj)): ?>
                <div class="alert alert-danger text-center"><?php echo $mesaj; ?></div>
            <?php endif; ?>
            <form action="takim_duzenle.php?id=<?php echo $guncelle_id; ?>" method="POST">
                <div class="row g-3">
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Takım Adı</label>
                        <input type="text" name="takim_adi" class="form-control" required value="<?php echo htmlspecialchars($takim['takim_adi']); ?>">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Oyun Branşı</label>
                        <select name="oyun_bransi" class="form-select" required>
                            <option value="Counter-Strike 2" <?php if($takim['oyun_bransi']=='Counter-Strike 2') echo 'selected'; ?>>Counter-Strike 2</option>
                            <option value="League of Legends" <?php if($takim['oyun_bransi']=='League of Legends') echo 'selected'; ?>>League of Legends</option>
                            <option value="Valorant" <?php if($takim['oyun_bransi']=='Valorant') echo 'selected'; ?>>Valorant</option>
                            <option value="Dota 2" <?php if($takim['oyun_bransi']=='Dota 2') echo 'selected'; ?>>Dota 2</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Kuruluş Yılı</label>
                        <input type="number" name="kurulus_yili" class="form-control" required min="1990" max="2026" value="<?php echo htmlspecialchars($takim['kurulus_yili']); ?>">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label class="form-label">Baş Antrenör / Koç</label>
                        <input type="text" name="koç_adi" class="form-control" value="<?php echo htmlspecialchars($takim['koç_adi']); ?>">
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <a href="dashboard.php" class="btn btn-outline-secondary fw-bold">Değişiklikleri İptal Et</a>
                    <button type="submit" class="btn btn-warning px-5 fw-bold text-dark shadow-sm">Bilgileri Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>