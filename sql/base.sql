CREATE TABLE departement(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(40)
);
CREATE TABLE diploma (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);
-- Insertion dans department
INSERT INTO departement (name) VALUES
('Informatique'),
('Ressources Humaines'),
('Marketing');

-- Insertion dans diploma
INSERT INTO diploma (name) VALUES
('Licence en Informatique'),
('Master en Gestion des Ressources Humaines'),
('Doctorat en Marketing Digital');

CREATE TABLE job_offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    locations VARCHAR(100) NOT NULL,
    deadline DATE NOT NULL,

    diploma_id INT NOT NULL,
    level INT,
    experience_year INT,
    benefits TEXT,
    is_active BOOLEAN DEFAULT FALSE,
    is_approved BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (department_id) REFERENCES departement(id) ON DELETE CASCADE,
    FOREIGN KEY (diploma_id) REFERENCES diploma(id) ON DELETE CASCADE
);


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('candidate', 'employee', 'admin') NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE employees (
    id INT PRIMARY KEY, -- même id que dans users
    department_id INT NOT NULL,
    position VARCHAR(100),
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (department_id) REFERENCES departement(id) ON DELETE CASCADE
);

CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- si tu veux garder la liaison avec users
    Nom VARCHAR(100),
    Prenom VARCHAR(100),
    Mail VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address TEXT,
    resume_path VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE candidate_cv_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT NOT NULL,
    job_offer_id INT NOT NULL,

    date_depot DATE NOT NULL,
    diploma_id INT,
    level INT,                -- niveau d’étude (bac+3, bac+5, …) cohérent avec job_offers
    experience_year INT,      -- années d’expérience
    languages VARCHAR(255),   -- langues parlées
    avantages TEXT,           -- avantages souhaités
    atout text,
    salaire_souhaite DECIMAL(10,2),
    horaires VARCHAR(100),    -- préférences horaires

    FOREIGN KEY (candidate_id) REFERENCES candidates(id) ON DELETE CASCADE,
    FOREIGN KEY (job_offer_id) REFERENCES job_offers(id) ON DELETE CASCADE,
    FOREIGN KEY (diploma_id) REFERENCES diploma(id) ON DELETE SET NULL
);

CREATE TABLE candidat_avance (
    idcandidat INT NOT NULL,
    job_offer_id INT NOT NULL,
    stade TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY (idcandidat),
    FOREIGN KEY (job_offer_id) REFERENCES job_offers(id) ON DELETE CASCADE,
    FOREIGN KEY (idcandidat) REFERENCES candidates(id)
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



CREATE TABLE Notification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idCandidat INT,
    Date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP,
    Messages TEXT,
    Motif ENUM('succes', 'rejet'),
    Status ENUM('lu','non lu') DEFAULT 'non lu',
    FOREIGN KEY (idCandidat) REFERENCES candidates(id)
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
    FOREIGN KEY (idCandidat) REFERENCES candidates(id)
);


insert into candidat(Nom,Prenom,Mail) VALUES
('stan','stanley','mandresystanley@gmail.com');

