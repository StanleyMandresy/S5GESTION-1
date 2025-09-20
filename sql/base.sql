CREATE TABLE departement(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(40)
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idDepartement INT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(idDepartement) REFERENCES departement(id)
);

CREATE TABLE employees (
    id INT PRIMARY KEY,
    department VARCHAR(100),
    position VARCHAR(100),
    FOREIGN KEY (id) REFERENCES users(id)
);

CREATE TABLE candidates (
    id INT PRIMARY KEY,
    phone VARCHAR(20),
    address TEXT,
    FOREIGN KEY (id) REFERENCES users(id)
);
CREATE TABLE qcms (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    departementProprietaire INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (departementProprietaire) REFERENCES employees(id)
);

CREATE TABLE StatusQCM(
    id INT PRIMARY KEY AUTO_INCREMENT,
    typeStat VARCHAR(20)
);

CREATE TABLE questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    qcm_id INT NOT NULL,
    question_text TEXT NOT NULL,
    points INT DEFAULT 0,
    statusQCM INT,
    FOREIGN KEY (qcm_id) REFERENCES qcms(id) ON DELETE CASCADE,
    FOREIGN KEY (statusQCM) REFERENCES StatusQCM(id)
);

CREATE TABLE question_options (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_id INT NOT NULL,
    option_label CHAR(1),       
    option_text VARCHAR(255),   
    is_correct BOOLEAN DEFAULT 0,
    points INT DEFAULT 0,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

CREATE TABLE qcm_answers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCandidat INT NOT NULL,
    question_id INT NOT NULL,
    option_id INT NOT NULL,  
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
    FOREIGN KEY (idCandidat) REFERENCES candidates(id),
    FOREIGN KEY (option_id) REFERENCES question_options(id) ON DELETE CASCADE
);



CREATE TABLE scoreTotalCandidat(
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCandidat INT,
    totalPoints INT,
    FOREIGN KEY (idCandidat) REFERENCES candidates(id)
);

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

