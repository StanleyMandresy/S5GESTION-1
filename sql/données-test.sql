--departement
INSERT INTO departement (name) VALUES
('Informatique'),
('Ressources Humaines'),
('Marketing');

-- Insertion dans diploma
INSERT INTO diploma (name) VALUES
('Licence en Informatique'),
('Master en Gestion des Ressources Humaines'),
('Doctorat en Marketing Digital');




--users : password=pass123
INSERT INTO users (id, email, password, role, first_name, last_name, phone, address) VALUES
(1,  'emp1@company.com', '$2b$12$E4DKp.ZGBK8L0cO5M.jMj.4U2X0BGP9PMUH5O1sJtGjFsTkfs4MNO', 'employee', 'Jean',  'Durand', '0340000001', 'Adresse 1'),
(2,  'emp2@company.com', '$2b$12$CTx4raLlwKdDuFo8PuiNeOB9Aktp0N9WsBMhyTTaLtQzfOm.gXmr.', 'employee', 'Marie', 'Dupont', '0340000002', 'Adresse 2'),
(3,  'emp3@company.com', '$2b$12$OabskH6UMNYK69yct6UPGuwmm0YiIWvbJNoaadEtxrJcylW6HQhiO', 'employee', 'Paul',  'Martin', '0340000003', 'Adresse 3'),
(4,  'cand1@mail.com',    '$2b$12$hQWpzqxg8E/DOuwWvjQT1OMu2RfPTecm5pUKMrr9x1cmr3UoRVa8i', 'candidate', 'Alice', 'Randria', '0341000001', 'Adresse A'),
(5,  'cand2@mail.com',    '$2b$12$fSYf8yXuePDvsIoU.n3i6.I5YfMEOyRk1nmlegyiiXqXqp3jbbnhG', 'candidate', 'Bruno', 'Rakoto', '0341000002', 'Adresse B'),
(6,  'cand3@mail.com',    '$2b$12$NGnKrCFSEdJx4RsegapvhuYr1OAGZez7N1Z/jiR/2YyGp.cIfqcca', 'candidate', 'Clara', 'Rasoa', '0341000003', 'Adresse C'),
(7,  'cand4@mail.com',    '$2b$12$x9WjEkeXXo25qikTjZlho.spKXcFg9iDkFW3tGZoWf6GMv1Yr4YjW', 'candidate', 'David', 'Rabe', '0341000004', 'Adresse D'),
(8,  'cand5@mail.com',    '$2b$12$UP/n3Gl3sjSVomswYAEXZeJ2ZFskL.eN8MuylY5dRrG3YCJDAc6qC', 'candidate', 'Emma',  'Andria', '0341000005', 'Adresse E'),
(9,  'cand6@mail.com',    '$2b$12$PY1blUcWQen8yNzEWOY/lO5mJWGGOIBL809.3v3LRCqGnwImDpDFu', 'candidate', 'Franck','Rami', '0341000006', 'Adresse F'),
(10, 'cand7@mail.com',    '$2b$12$a41tTwNJcRU6ZdzvsWkFmuMGMMrFSyVdWORxB9WfdyqrsESdSAN1q', 'candidate', 'Gina',  'Rala', '0341000007', 'Adresse G');

-- Insert employees
INSERT INTO employees (id, department_id, position) VALUES
(1, 1, 'Développeur'),
(2, 2, 'RH'),
(3, 3, 'Comptable');

-- Insert candidates (liés aux users 4..10)
INSERT INTO candidates (user_id, Nom, Prenom, Mail, phone, address, resume_path) VALUES
(4,  'Randria', 'Alice', 'cand1@mail.com', '0341000001', 'Adresse A', 'cv/alice.pdf'),
(5,  'Rakoto', 'Bruno', 'cand2@mail.com', '0341000002', 'Adresse B', 'cv/bruno.pdf'),
(6,  'Rasoa',  'Clara', 'cand3@mail.com', '0341000003', 'Adresse C', 'cv/clara.pdf'),
(7,  'Rabe',   'David', 'cand4@mail.com', '0341000004', 'Adresse D', 'cv/david.pdf'),
(8,  'Andria', 'Emma',  'cand5@mail.com', '0341000005', 'Adresse E', 'cv/emma.pdf'),
(9,  'Rami',   'Franck','cand6@mail.com', '0341000006', 'Adresse F', 'cv/franck.pdf'),
(10, 'Rala',   'Gina',  'cand7@mail.com', '0341000007', 'Adresse G', 'cv/gina.pdf');




INSERT INTO StatusQCM (id, typeStat) VALUES
(1, 'Active'),
(2, 'Inactive');

-- ================================
-- QCMs
-- ================================
INSERT INTO qcms (id, title, departementProprietaire) VALUES
(1, 'QCM Finance - Comptabilité', 3),
(2, 'QCM Marketing - Publicité', 3);

-- ================================
-- Questions (Finance)
-- ================================
INSERT INTO questions (id, qcm_id, question_text, points, statusQCM) VALUES
(1, 1, 'Quels sont les états financiers obligatoires ?', 5, 1),
(2, 1, 'Quelle formule calcule le résultat net ?', 5, 1);

-- ================================
-- Question Options (Finance)
-- Question 1 : plusieurs bonnes réponses
-- ================================
INSERT INTO question_options (id, question_id, option_label, option_text, is_correct,points) VALUES
(1, 1, 'A', 'Bilan', 1,1),
(2, 1, 'B', 'Compte de résultat', 1,1),
(3, 1, 'C', 'Plan marketing', 0,0),
(4, 1, 'D', 'Tableau de flux de trésorerie', 1,1),

-- Question 2 : une seule bonne réponse
(5, 2, 'A', 'Produits - Charges', 1,1),
(6, 2, 'B', 'Actif - Passif', 0,0),
(7, 2, 'C', 'Recettes - TVA', 0,0),
(8, 2, 'D', 'Stocks - Amortissements', 0,0);

-- ================================
-- Questions (Marketing)
-- ================================
INSERT INTO questions (id, qcm_id, question_text, points, statusQCM) VALUES
(3, 2, 'Quels sont les 4P du marketing ?', 5, 1),
(4, 2, 'Quel indicateur mesure la notoriété d une marque ?', 5, 1);

-- ================================
-- Question Options (Marketing)
-- Question 3 : plusieurs bonnes réponses
-- ================================
INSERT INTO question_options (id, question_id, option_label, option_text, is_correct,points) VALUES
(9, 3, 'A', 'Produit', 1,1),
(10, 3, 'B', 'Prix', 1,1),
(11, 3, 'C', 'Publicité', 0,0),
(12, 3, 'D', 'Place (Distribution)',1, 1),
(13, 3, 'E', 'Promotion',1, 1),

-- Question 4 : une seule bonne réponse
(14, 4, 'A', 'Taux de conversion',0,0),
(15, 4, 'B', 'Parts de marché',0,0),
(16, 4, 'C', 'Taux de notoriété spontanée',1, 1),
(17, 4, 'D', 'Taux de clics', 0,0);

--WARNING/ Données de test pour candidate_cv_data inserer apres avoir créer un job dans le departement Marketing (id=3)
INSERT INTO candidate_cv_data (
    candidate_id, job_offer_id, date_depot, diploma_id, level, experience_year,
    languages, avantages, atout, salaire_souhaite, horaires, photo_path
) VALUES
(1, 1, CURDATE(), 1, 3, 2, 'Français, Anglais', 'Tickets restaurant, Mutuelle', 'Rigoureuse, organisée', 1200.00, 'Temps plein', 'photos/cand1.jpg'),
(2, 1, CURDATE(), 3, 5, 4, 'Français, Anglais, Allemand', 'Télétravail partiel', 'Travail en équipe', 1500.00, 'Temps plein', 'photos/cand2.jpg'),
(3, 1, CURDATE(), 3, 3, 1, 'Français', 'Formation continue', 'Créative, adaptable', 1000.00, 'Mi-temps', 'photos/cand3.jpg'),
(4, 1, CURDATE(), 3, 5, 5, 'Français, Anglais', 'Tickets restaurant', 'Leadership, gestion de projets', 1800.00, 'Temps plein', 'photos/cand4.jpg'),
(5, 1, CURDATE(), 2, 4, 3, 'Français, Espagnol', 'Télétravail', 'Autonome, polyvalente', 1400.00, 'Temps plein', 'photos/cand5.jpg'),
(6, 1, CURDATE(), 3, 2, 1, 'Français', 'Mutuelle', 'Esprit d analyse', 1100.00, 'Temps partiel', 'photos/cand6.jpg'),
(7, 1, CURDATE(), 3, 5, 6, 'Français, Anglais', 'Tickets restaurant, Télétravail', 'Motivée, dynamique', 2000.00, 'Temps plein', 'photos/cand7.jpg');


