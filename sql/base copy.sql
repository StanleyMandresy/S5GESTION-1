
-- Table des offres d'emploi
CREATE TABLE job_offers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    requirements TEXT,
    department VARCHAR(100),
    position VARCHAR(100),
    deadline DATE,
    created_by INT, -- Référence à l'employé qui a créé l'offre
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (created_by) REFERENCES employees(id)
);

-- Table des candidatures
CREATE TABLE applications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    candidate_id INT NOT NULL,
    job_offer_id INT NOT NULL,
    status ENUM('pending', 'cv_review', 'qcm_pending', 'qcm_completed', 
                'interview_pending', 'interview_completed', 'accepted', 'rejected') DEFAULT 'pending',
    application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cv_path VARCHAR(255),
    qcm_score INT,
    interview_score INT,
    final_score INT,
    notes TEXT,
    FOREIGN KEY (candidate_id) REFERENCES candidates(id),
    FOREIGN KEY (job_offer_id) REFERENCES job_offers(id)
);
--table pour stocker donnee cv de chaque candidat

-- Table des utilisateurs
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

CREATE TABLE departement(
    id INT PRIMARY KEY AUTO_INCREMENT,
    departement VARCHAR(40)
);
-- Table des candidats (extension de users)
CREATE TABLE candidates (
    id INT PRIMARY KEY,
    phone VARCHAR(20),
    address TEXT,
    FOREIGN KEY (id) REFERENCES users(id)
);

-- Table des employés (extension de users)
CREATE TABLE employees (
    id INT PRIMARY KEY,
    department VARCHAR(100),
    position VARCHAR(100),
    FOREIGN KEY (id) REFERENCES users(id)
);

-- Table des QCM
CREATE TABLE qcms (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    departementProprietaire INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (departementProprietaire) REFERENCES employees(id)
);
--ao @ ilay create by no hojerena hoe QCM pour entrer dans quel departement
/* liste de tout des questions correspondant de chaque departement
    Tout d'abord on regarde dans le departement correspondant
    et apres on join ces tables pour avoir la liste des questions pour un departement specifique 
*/
-- Table des questions
CREATE TABLE questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    qcm_id INT NOT NULL,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255),
    option_b VARCHAR(255),
    option_c VARCHAR(255),
    option_d VARCHAR(255),
    correct_answer CHAR(1), 
    points INT DEFAULT 0,
    statusQCM INT,
    FOREIGN KEY (qcm_id) REFERENCES qcms(id) ON DELETE CASCADE,
    FOREIGN KEY (statusQCM) REFERENCES StatusQCM(id)
);
/* verification si les reponses sont correct
    
*/
CREATE TABLE StatusQCM(
    id INT PRIMARY KEY AUTO_INCREMENT,
    typeStat VARCHAR(20),
    id_Question INT,
    FOREIGN KEY(id_Question) REFERENCES questions(id)
);
-- Table des réponses aux QCM
CREATE TABLE qcm_answers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCandidat INT NOT NULL,
    question_id INT NOT NULL,
    answer CHAR(10), -- Réponse du candidat (a, b, c ou d)
    is_correct BOOLEAN,
    FOREIGN KEY (question_id) REFERENCES questions(id),
    FOREIGN KEY (idCandidat) REFERENCES candidates(id)
);


