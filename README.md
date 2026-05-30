# 🎬 PHP & MySQL - Mini IMDb (Film ve Oyuncu Veritabanı)

Bu proje, Sistem Tasarımı ve Yazılım Mühendisliği (SSTE) dersi Çoklu Veritabanı Uygulamaları ödevinin **2. Aşamasıdır**. PHP ve MySQL kullanılarak, ilişkisel veritabanı (RDBMS) mantığıyla geliştirilmiş bir mini sinema/oyuncu bilgi sistemidir.

Projede hocanın özellikle belirttiği **JOIN sorguları** aktif olarak kullanılmış olup, "Çoka Çok" (Many-to-Many) veritabanı ilişkileri (Örn: Bir filmde birden fazla oyuncunun oynaması) başarıyla koda dökülmüştür.

## 🚀 Proje Özellikleri

* **Film Vitrini ve Filtreleme:** Anasayfada filmlerin listelenmesi ve üst menüden dinamik olarak kategori (tür) bazlı filtreleme yapılması.
* **Film Detay Sayfası:** Seçilen filmin özetini, yılını, türünü, yönetmenini ve o filmde oynayan **Oyuncu Kadrosunu** (`INNER JOIN` ile) gösterme.
* **Oyuncu Profil Ekranı:** Oyuncunun biyografisi ve bugüne kadar rol aldığı filmlerin listelenmesi.
* **Güvenli Veri Erişimi:** Veritabanı bağlantısı ve SQL sorguları için güvenli **PDO (PHP Data Objects)** mimarisi kullanılmıştır.
* **Modern Arayüz:** Bootstrap 5 ile tam uyumlu, şık ve responsive tasarım.

## 📂 Kurulum ve Çalıştırma

Projeyi kendi bilgisayarınızda çalıştırmak için aşağıdaki adımları izleyin:

**1. Veritabanı Kurulumu:**
* WampServer veya XAMPP kontrol panelinden **Apache** ve **MySQL** servislerini başlatın.
* Tarayıcıdan `http://localhost/phpmyadmin` adresine gidin.
* `mini_imdb` adında yeni bir veritabanı (Karşılaştırma: `utf8mb4_general_ci` seçilerek) oluşturun.
* Veritabanı oluşturulduktan sonra, proje klasöründe bulunan SQL kodlarını (veya `.sql` dosyasını) **SQL** sekmesine yapıştırıp çalıştırın. Bu işlem tabloları, ilişkileri (Foreign Keys) ve test verilerini sisteme ekleyecektir.

**2. Projeyi Çalıştırma:**
* Proje dosyalarını (`index.php`, `db.php` vb.) WampServer kullanıyorsanız `C:\wamp64\www\odev7_php`, XAMPP kullanıyorsanız `C:\xampp\htdocs\odev7_php` dizinine kopyalayın.
* `db.php` dosyasındaki veritabanı kullanıcı adı ve şifresinin kendi lokal sunucunuzla eşleştiğinden emin olun (Varsayılan olarak kullanıcı adı: `root`, şifre: boş).
* Tarayıcıdan `http://localhost/odev7_php` adresine giderek projeyi test edebilirsiniz.

## 📸 Ekran Görüntüleri
<img width="1455" height="566" alt="SS1" src="https://github.com/user-attachments/assets/45277c92-6503-43ae-a11d-729f8b1bb605" />
<img width="1271" height="504" alt="SS2" src="https://github.com/user-attachments/assets/571a5166-546e-4a01-b155-de365507f64a" />
<img width="1037" height="622" alt="SS3" src="https://github.com/user-attachments/assets/56a1e238-5fda-4bc1-a4aa-cc961218adea" />


