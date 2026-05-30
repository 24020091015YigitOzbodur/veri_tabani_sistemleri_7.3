CREATE TABLE Turler (
    TurID INT AUTO_INCREMENT PRIMARY KEY,
    TurAdi VARCHAR(50) NOT NULL
);

CREATE TABLE Yonetmenler (
    YonetmenID INT AUTO_INCREMENT PRIMARY KEY,
    AdSoyad VARCHAR(100) NOT NULL
);

CREATE TABLE Filmler (
    FilmID INT AUTO_INCREMENT PRIMARY KEY,
    FilmAdi VARCHAR(150) NOT NULL,
    Yil INT,
    Aciklama TEXT,
    TurID INT,
    YonetmenID INT,
    FOREIGN KEY (TurID) REFERENCES Turler(TurID),
    FOREIGN KEY (YonetmenID) REFERENCES Yonetmenler(YonetmenID)
);

CREATE TABLE Oyuncular (
    OyuncuID INT AUTO_INCREMENT PRIMARY KEY,
    AdSoyad VARCHAR(100) NOT NULL,
    Biyografi TEXT
);

CREATE TABLE FilmOyuncu (
    FilmID INT,
    OyuncuID INT,
    FOREIGN KEY (FilmID) REFERENCES Filmler(FilmID),
    FOREIGN KEY (OyuncuID) REFERENCES Oyuncular(OyuncuID),
    PRIMARY KEY (FilmID, OyuncuID)
);

INSERT INTO Turler (TurAdi) VALUES ('Aksiyon'), ('Bilim Kurgu'), ('Suç');
INSERT INTO Yonetmenler (AdSoyad) VALUES ('Christopher Nolan'), ('Quentin Tarantino');

INSERT INTO Filmler (FilmAdi, Yil, Aciklama, TurID, YonetmenID) VALUES 
('Inception', 2010, 'Rüya içinde rüya konulu akıl yakan bir film.', 2, 1),
('Django Unchained', 2012, 'Eski bir kölenin intikam hikayesi.', 1, 2);

INSERT INTO Oyuncular (AdSoyad, Biyografi) VALUES 
('Leonardo DiCaprio', 'Oscar ödüllü efsane aktör.'), 
('Jamie Foxx', 'Hem aktör hem müzisyen.'), 
('Joseph Gordon-Levitt', 'Yetenekli bir Hollywood yıldızı.');

INSERT INTO FilmOyuncu (FilmID, OyuncuID) VALUES 
(1, 1), -- Inception'da Leonardo DiCaprio oynadı
(1, 3), -- Inception'da Joseph Gordon-Levitt oynadı
(2, 1), -- Django Unchained'de Leonardo DiCaprio oynadı
(2, 2); -- Django Unchained'de Jamie Foxx oynadı