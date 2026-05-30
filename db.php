<?php
$host = 'localhost';
$dbname = 'mini_imdb';
$username = 'root';
$password = '2331548y'; 

try {
    // Veritabanına bağlanıyoruz ve Türkçe karakter sorunu olmasın diye utf8mb4 ekliyoruz
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Hoca patladık, veritabanı bağlantı hatası: " . $e->getMessage();
    exit;
}
?>