-- ================================
-- Départements
-- ================================
INSERT INTO departement (id, name) VALUES
(1, 'Finance'),
(2, 'Marketing');

-- ================================
-- Users (employés + candidats)
-- ================================
INSERT INTO users (id, idDepartement, email, password, first_name, last_name) VALUES
(1, 1, 'emp1@finance.com', 'pass123', 'Alice', 'Dupont'), -- employée Finance
(2, 2, 'emp2@marketing.com', 'pass123', 'Bob', 'Martin'), -- employé Marketing
(3, 1, 'cand1@finance.com', 'pass123', 'Charlie', 'Doe'), -- candidat Finance
(4, 2, 'cand2@marketing.com', 'pass123', 'Diana', 'Smith'); -- candidat Marketing

-- ================================
-- Employees
-- ================================
INSERT INTO employees (id, department, position) VALUES
(1, 'Finance', 'Manager'),
(2, 'Marketing', 'Team Lead');

-- ================================
-- Candidates
-- ================================
INSERT INTO candidates (id, phone, address) VALUES
(3, '0341234567', 'Antananarivo'),
(4, '0349876543', 'Toamasina');

-- ================================
-- StatusQCM
-- ================================
INSERT INTO StatusQCM (id, typeStat) VALUES
(1, 'Active'),
(2, 'Inactive');

-- ================================
-- QCMs
-- ================================
INSERT INTO qcms (id, title, departementProprietaire) VALUES
(1, 'QCM Finance - Comptabilité', 2),
(2, 'QCM Marketing - Publicité', 2);

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

-- -- ================================
-- -- Réponses des candidats
-- -- ================================
-- -- Candidat 3 (Finance) répond à Question 1 et 2
-- INSERT INTO qcm_answers (id, idCandidat, question_id, option_id) VALUES
-- (1, 3, 1, 1), -- a choisi Bilan (correct)
-- (2, 3, 1, 2), -- a choisi Compte de résultat (correct)
-- (3, 3, 2, 5), -- a choisi Produits - Charges (correct)

-- -- Candidat 4 (Marketing) répond à Question 3 et 4
-- (4, 4, 3, 9), -- a choisi Produit (correct)
-- (5, 4, 3, 11), -- a choisi Publicité (incorrect)
-- (6, 4, 3, 13), -- a choisi Promotion (correct)
-- (7, 4, 4, 16); -- a choisi Taux de notoriété spontanée (correct)
-- INSERT INTO correct_answer (idQuestion, option_id) VALUES
-- -- Question 1
-- (1, 1),
-- (1, 2),
-- (1, 4),

-- -- Question 2
-- (2, 5),

-- -- Question 3
-- (3, 9),
-- (3, 10),
-- (3, 12),
-- (3, 13),

-- -- Question 4
-- (4, 16);
INSERT INTO job_offers
(department_id, title, description, locations, deadline, diploma_id, benefits, is_active, experience_level)
VALUES
-- Offre Informatique
(1, 'Développeur Full-Stack',
 'Nous recherchons un développeur Full-Stack pour concevoir, développer et maintenir des applications web modernes.',
 'Paris', '2025-12-31', 1,
 'Tickets restaurant, télétravail partiel, mutuelle santé',
 TRUE, '2-3 ans d expérience');

-- Offre Ressources Humaines
(2, 'Chargé de Recrutement',
 'Responsable du processus de recrutement, de la rédaction des offres à l’intégration des candidats.',
 'Lyon', '2025-11-30', 2,
 'Formation continue, primes sur objectifs, RTT',
 TRUE, 'Débutant à intermédiaire'),

(3, 'Consultant Marketing Digital',
 'Développement de stratégies digitales innovantes pour accroître la visibilité et la notoriété de nos clients.',
 'Marseille', '2025-10-31', 3,
 'Participation à des conférences, voyages d"affaires, primes de performance',
 TRUE, '5 ans et plus');


