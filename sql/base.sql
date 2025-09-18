create database Recrutement;
use Recrutement;

CREATE TABLE Candidat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(100),
    Prenom VARCHAR(100),
    Mail VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE Notification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCandidat INT,
    Date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP,
    Messages TEXT,
    Motif ENUM('succes', 'rejet'),
    Status ENUM('lu','non lu') DEFAULT 'non lu',
    FOREIGN KEY (idCandidat) REFERENCES Candidat(id)
);

CREATE TABLE Entretien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idOffre INT,
    idCandidat INT,
    Date_heure_debut DATETIME,
    Date_heure_fin DATETIME,
    Notes TEXT,
    Presence ENUM('presents','absents'),
    Remarques TEXT,
    FOREIGN KEY (idCandidat) REFERENCES Candidat(id)
);


insert into Candidat(Nom,Prenom,Mail) VALUES
('stan','stanley','mandresystanley@gmail.com');
