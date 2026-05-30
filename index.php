<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mini IMDb - Filmler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center text-danger fw-bold mb-4">🎬 Mini IMDb - Film Vitrini</h2>
    
    <div class="d-flex justify-content-center mb-5 gap-2">
        <a href="index.php" class="btn btn-dark fw-bold">Tümü</a>
        <?php
        $turler = $db->query("SELECT * FROM Turler")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($turler as $tur) {
            echo '<a href="index.php?kategori=' . $tur['TurID'] . '" class="btn btn-outline-danger fw-bold">' . $tur['TurAdi'] . '</a>';
        }
        ?>
    </div>

    <div class="row">
        <?php
        $kategori_filtresi = "";
        $parametreler = [];

        if (isset($_GET['kategori']) && is_numeric($_GET['kategori'])) {
            $kategori_filtresi = "WHERE t.TurID = :kategori_id";
            $parametreler['kategori_id'] = $_GET['kategori'];
        }

        $sorgu_metni = "SELECT f.FilmID, f.FilmAdi, f.Yil, f.Aciklama, t.TurAdi, y.AdSoyad as Yonetmen 
                        FROM Filmler f 
                        INNER JOIN Turler t ON f.TurID = t.TurID 
                        INNER JOIN Yonetmenler y ON f.YonetmenID = y.YonetmenID 
                        $kategori_filtresi
                        ORDER BY f.Yil DESC";

        $sorgu = $db->prepare($sorgu_metni);
        $sorgu->execute($parametreler);
        $filmler = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if (count($filmler) > 0) {
            foreach($filmler as $film) {
        ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="card-title fw-bold text-dark mb-0"><?= $film['FilmAdi'] ?></h4>
                            <span class="badge bg-danger fs-6"><?= $film['Yil'] ?></span>
                        </div>
                        <h6 class="card-subtitle mb-3 text-muted">
                            Yönetmen: <strong><?= $film['Yonetmen'] ?></strong> | 
                            Tür: <span class="badge bg-dark"><?= $film['TurAdi'] ?></span>
                        </h6>
                        <p class="card-text"><?= $film['Aciklama'] ?></p>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-3 pt-0">
                        <a href="film_detay.php?id=<?= $film['FilmID'] ?>" class="btn btn-outline-danger w-100 fw-bold">Film Detayı ve Oyuncular</a>
                    </div>
                </div>
            </div>
        <?php 
            }
        } else {
            echo '<div class="col-12"><div class="alert alert-warning text-center">Bu kategoride henüz film bulunmuyor.</div></div>';
        }
        ?>
    </div>
</div>

</body>
</html>