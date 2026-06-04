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



<div class="card p-4 border-0 mb-5">
    <h4 class="text-dark mb-4 fw-bold"> Kayıtlı Admin Listesi</h4>
    <?php 
    // Kullanıcılar tablosundan benzersiz ID, kullanıcı adı ve tarih bilgisini çekiyoruz
    $sorgu = "SELECT id, kullanici_adi, olusturma_tarihi FROM kullanicilar ORDER BY id ASC";
    $sonuc = mysqli_query($baglanti, $sorgu);
    
    if (mysqli_num_rows($sonuc) > 0): 
    ?>
    <div class="table-responsive">
        <table class="table table-hover align-middle table-borderless border-top border-light">
            <thead class="table-light text-secondary">
                <tr>
                    <th style="width: 150px;">Yönetici ID</th> <th>Yönetici Kullanıcı Adı</th>
                    <th>Sisteme Kayıt Tarihi</th>
                    <th class="text-center">Durum</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while($satir = mysqli_fetch_assoc($sonuc)): 
                    // O an listelenen admin, giriş yapmış olan kişi mi kontrolü
                    $oAnkiKullanici_mi = ($satir['kullanici_adi'] == $_SESSION['kullanici_adi']);
                ?>
                <tr>
                    <td class="fw-bold text-secondary">#<?php echo $satir['id']; ?></td>
                    <td class="fw-bold <?php echo $oAnkiKullanici_mi ? 'text-primary' : 'text-dark'; ?>">
                        <?php echo htmlspecialchars($satir['kullanici_adi']); ?>
                        <?php if($oAnkiKullanici_mi): ?>
                            <span class="badge bg-success-subtle text-success ms-2 small">Siz</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-muted">
                        <?php echo date("d.m.Y H:i", strtotime($satir['olusturma_tarihi'])); ?>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-semibold">Aktif Yönetici</span>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <div class="alert alert-light text-center py-4 border border-dashed text-muted">Sistemde kayıtlı admin bulunamadı.</div>
    <?php endif; ?>
</div>

<div class="text-start mb-4">
    <a href="dashboard.php" class="btn btn-primary px-4 fw-bold rounded-3 shadow-sm"> <- Yönetim Paneline Geri Dön</a>
</div>

<?php include "footer.php"; ?>