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
CREATE TABLE candidates_recus (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCandidat INT,
    dateRecus TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCandidat) REFERENCES candidates(id)
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

CREATE TABLE contracts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCandidatRecu INT NOT NULL,
    idEmploye INT, 
    contract_type VARCHAR(50),
    start_date DATE NOT NULL,
    end_date DATE, 
    probation_duration INT,
    probation_renewable BOOLEAN DEFAULT 0,
    remuneration DECIMAL(10,2),
    remuneration_hourly DECIMAL(10,2),
    work_hours_per_week INT DEFAULT 35,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idStatut INT,
    idType INT,
    FOREIGN KEY (idType) REFERENCES contract_types(id), 
FOREIGN KEY (idCandidatRecu) REFERENCES candidates_recus(id);
    FOREIGN KEY (idEmploye) REFERENCES employees(id),
    FOREIGN KEY (idStatut) REFERENCES contract_statut(id)
);

CREATE TABLE missions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idContract INT NOT NULL,
    description TEXT NOT NULL,
    FOREIGN KEY (idContract) REFERENCES contracts(id) ON DELETE CASCADE
);
CREATE TABLE contract_clauses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    clause_title VARCHAR(255),
    clause_text TEXT
  
);
CREATE TABLE contract_statut (
    id INT PRIMARY KEY AUTO_INCREMENT,
    status_name VARCHAR(50) UNIQUE NOT NULL
);
CREATE TABLE contract_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type_name VARCHAR(50) UNIQUE NOT NULL
);
CREATE TABLE contract_clause_assignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idContract INT NOT NULL,
    idClause INT NOT NULL,
    FOREIGN KEY (idContract) REFERENCES contracts(id) ON DELETE CASCADE,
    FOREIGN KEY (idClause) REFERENCES contract_clauses(id) ON DELETE CASCADE
);

CREATE TABLE societe(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    address TEXT,
    phone VARCHAR(20),
    email VARCHAR(100),
    NumSiret VARCHAR(20)
);

CREATE TABLE candidates_recus (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCandidat INT,
    dateRecus TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCandidat) REFERENCES candidates(id)
);
INSERT INTO candidates_recus(idCandidat) VALUES (3);