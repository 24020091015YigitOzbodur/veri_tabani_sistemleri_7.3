<?php 
require_once 'db.php'; 

$oyuncu_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($oyuncu_id == 0) {
    die("Aktör bulunamadı!");
}

$oyuncuSorgu = $db->prepare("SELECT * FROM Oyuncular WHERE OyuncuID = :id");
$oyuncuSorgu->execute(['id' => $oyuncu_id]);
$oyuncu = $oyuncuSorgu->fetch(PDO::FETCH_ASSOC);

if (!$oyuncu) {
    die("Böyle bir oyuncu kayıtlı değil!");
}

$filmSorgu = $db->prepare("SELECT f.FilmID, f.FilmAdi, f.Yil 
                           FROM Filmler f
                           INNER JOIN FilmOyuncu fo ON f.FilmID = fo.FilmID
                           WHERE fo.OyuncuID = :id
                           ORDER BY f.Yil DESC");
$filmSorgu->execute(['id' => $oyuncu_id]);
$oynadigi_filmler = $filmSorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= $oyuncu['AdSoyad'] ?> - Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h2 class="mb-0 fw-bold">🎭 <?= $oyuncu['AdSoyad'] ?></h2>
                </div>
                <div class="card-body p-4">
                    <h5 class="text-secondary border-bottom pb-2">Biyografi</h5>
                    <p class="lead mt-3"><?= $oyuncu['Biyografi'] ?></p>

                    <h5 class="text-secondary border-bottom pb-2 mt-5">Oynadığı Filmler</h5>
                    <?php if (count($oynadigi_filmler) > 0): ?>
                        <div class="list-group mt-3">
                            <?php foreach ($oynadigi_filmler as $film): ?>
                                <a href="film_detay.php?id=<?= $film['FilmID'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <span class="fw-bold"><?= $film['FilmAdi'] ?></span>
                                    <span class="badge bg-danger rounded-pill"><?= $film['Yil'] ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mt-3">Sistemde kayıtlı filmi bulunmuyor.</p>
                    <?php endif; ?>
                </div>
                <div class="card-footer bg-white text-center py-3">
                    <button onclick="history.back()" class="btn btn-outline-dark fw-bold">&larr; Geri Dön</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>