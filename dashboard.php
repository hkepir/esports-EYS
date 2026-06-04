<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['kullanici_adi'])) {
    header("Location: login.php");
    exit();
}

require_once "baglanti.php";
include "header.php";
?>

<div class="p-5 mb-4 bg-white rounded-4 shadow-sm border-0 position-relative overflow-hidden">
    <div class="row align-items-center">
        <div class="col-md-12">
            <h1 class="display-6 fw-bold text-dark">
                 Hoş geldiniz, <span class="text-dark"><?php echo htmlspecialchars($_SESSION['kullanici_adi']); ?></span>!
            </h1>
            <p class="fs-6 text-muted mb-0 mt-2">E-Spor Ekosistem Yönetim Paneline başarıyla giriş yaptınız.</p>
        </div>
    </div>
</div>

<div class="card p-4 border-0 mb-4">
    <h4 class="text-dark mb-4 fw-bold"> Sistemde Kayıtlı E-Spor Takımları</h4>
    <?php 
    $sorgu = "SELECT * FROM takimlar ORDER BY id DESC";
    $sonuc = mysqli_query($baglanti, $sorgu);
    
    if (mysqli_num_rows($sonuc) > 0): 
    ?>
    <div class="table-responsive">
        <table class="table table-hover align-middle table-borderless border-top border-light">
            <thead class="table-light text-secondary">
                <tr>
                    <th style="width: 80px;">Sıra</th>
                    <th>Takım Resmi Adı</th>
                    <th>Oyun Branşı</th>
                    <th>Kuruluş Yılı</th>
                    <th>Baş Antrenör (Koç)</th>
                    <th class="text-center" style="width: 180px;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sira = 1; 
                while($satir = mysqli_fetch_assoc($sonuc)): 
                ?>
                <tr>
                    <td class="fw-bold text-secondary">#<?php echo $sira++; ?></td>
                    <td class="fw-bold text-dark"><?php echo htmlspecialchars($satir['takim_adi']); ?></td>
                    <td><span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill"><?php echo htmlspecialchars($satir['oyun_bransi']); ?></span></td>
                    <td class="text-muted"><?php echo htmlspecialchars($satir['kurulus_yili']); ?></td>
                    <td class="fw-semibold"><?php echo htmlspecialchars($satir['koç_adi']); ?></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="takim_duzenle.php?id=<?php echo $satir['id']; ?>" class="btn btn-warning fw-bold px-3">Düzenle</a>
                            <a href="takim_sil.php?id=<?php echo $satir['id']; ?>" class="btn btn-danger fw-bold px-3" onclick="return confirm('Bu e-spor takımını silmek istediğinize emin misiniz?');">Sil</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <div class="alert alert-light text-center py-4 border border-dashed text-muted">Sistemde henüz kayıtlı bir e-spor takımı bulunamadı.</div>
    <?php endif; ?>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4 col-sm-12">
        <div class="card p-3 border-0 text-center shadow-sm">
            <h6 class="text-uppercase text-muted fw-bold small mb-1">Bağlı Veritabanı</h6>
            <h4 class="text-primary fw-bold mb-0">eSporWeb</h4>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card p-3 border-0 text-center shadow-sm">
            <h6 class="text-uppercase text-muted fw-bold small mb-1">Mimarî Yapı</h6>
            <h4 class="text-success fw-bold mb-0">Pure PHP & BS5</h4>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="card p-3 border-0 text-center shadow-sm">
            <h6 class="text-uppercase text-muted fw-bold small mb-1">Oturum Güvenliği</h6>
            <h4 class="text-warning fw-bold mb-0">PHP Sessions</h4>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>