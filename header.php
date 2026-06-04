<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Spor Ekosistem Yönetim Sistemi (EYS)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f0f4f8; 
            color: #2c3e50; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-dark { 
            background-color: #1a2a3a !important; 
        }
        .card { 
            background-color: #ffffff; 
            border: none; 
            border-radius: 12px; 
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05); 
        }
        .form-control, .form-select { 
            border-radius: 8px; 
            border: 1px solid #cbd5e1; 
            padding: 10px 12px;
        }
        .form-control:focus, .form-select:focus { 
            border-color: #3b82f6; 
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15); 
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark mb-5 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-info" href="dashboard.php"> E-SPOR EYS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
            <?php if (isset($_SESSION['kullanici_adi'])): ?>
                <!-- 
                    <li class="nav-item">
                    <a class="btn btn-sm btn-outline-light me-2 fw-semibold" href="dashboard.php">Yönetim Paneli</a>
                </li> 
                
                -->
                <li class="nav-item">
                    <a class="btn btn-sm btn-outline-info text-info border-info me-2 fw-semibold" href="adminler.php"> Sistem Adminleri</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm btn-info text-white fw-semibold" href="takim_ekle.php">+ Yeni Takım Ekle</a>
                </li>
            <?php endif; ?>
            </ul>
            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['kullanici_adi'])): ?>
                    <span class="text-light me-3">Yönetici: <strong class="text-info"><?php echo htmlspecialchars($_SESSION['kullanici_adi']); ?></strong></span>
                    <a href="logout.php" class="btn btn-sm btn-danger px-3 rounded-pill fw-bold shadow-sm">Güvenli Çıkış</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-sm btn-outline-info me-2 px-3 fw-bold">Giriş Yap</a>
                    <a href="register.php" class="btn btn-sm btn-info text-white px-3 fw-bold shadow-sm">Kayıt Ol</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div class="container">