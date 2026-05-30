<?php 
require_once 'db.php'; 

$film_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($film_id == 0) {
    die("Film bulunamadı!");
}

$filmSorgu = $db->prepare("SELECT f.FilmAdi, f.Yil, f.Aciklama, t.TurAdi, y.AdSoyad as Yonetmen 
                           FROM Filmler f 
                           INNER JOIN Turler t ON f.TurID = t.TurID 
                           INNER JOIN Yonetmenler y ON f.YonetmenID = y.YonetmenID
                           WHERE f.FilmID = :id");
$filmSorgu->execute(['id' => $film_id]);
$film = $filmSorgu->fetch(PDO::FETCH_ASSOC);

if (!$film) {
    die("Böyle bir film yok!");
}

$oyuncuSorgu = $db->prepare("SELECT o.OyuncuID, o.AdSoyad 
                             FROM Oyuncular o
                             INNER JOIN FilmOyuncu fo ON o.OyuncuID = fo.OyuncuID
                             WHERE fo.FilmID = :id");
$oyuncuSorgu->execute(['id' => $film_id]);
$oyuncular = $oyuncuSorgu->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= $film['FilmAdi'] ?> - Detay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-danger text-white text-center py-3">
            <h2 class="mb-0 fw-bold">🎬 <?= $film['FilmAdi'] ?> (<?= $film['Yil'] ?>)</h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="text-danger border-bottom pb-2">Film Özeti</h4>
                    <p class="lead mt-3"><?= $film['Aciklama'] ?></p>
                    
                    <div class="mt-4">
                        <span class="badge bg-dark fs-6 me-2">Tür: <?= $film['TurAdi'] ?></span>
                        <span class="badge bg-secondary fs-6">Yönetmen: <?= $film['Yonetmen'] ?></span>
                    </div>
                </div>
                
                <div class="col-md-4 border-start">
                    <h4 class="text-danger border-bottom pb-2">Oyuncu Kadrosu</h4>
                    <?php if (count($oyuncular) > 0): ?>
                        <ul class="list-group list-group-flush mt-3">
                            <?php foreach ($oyuncular as $oyuncu): ?>
                                <li class="list-group-item bg-transparent px-0">
                                    <a href="oyuncu_profil.php?id=<?= $oyuncu['OyuncuID'] ?>" class="text-decoration-none text-dark fw-bold">
                                        🎭 <?= $oyuncu['AdSoyad'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mt-3">Kadro bilgisi bulunamadı.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white text-center py-3">
            <a href="index.php" class="btn btn-outline-secondary fw-bold">&larr; Vitrine Dön</a>
        </div>
    </div>
</div>

</body>
</html>