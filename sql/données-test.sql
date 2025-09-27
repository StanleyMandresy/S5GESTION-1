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

-- Insert employees (les id reprennent les users 1,2,3)
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

-- Données de test pour candidate_cv_data
INSERT INTO candidate_cv_data (
    candidate_id, job_offer_id, date_depot, diploma_id, level, experience_year,
    languages, avantages, atout, salaire_souhaite, horaires, photo_path
) VALUES
(8, 1, CURDATE(), 1, 3, 2, 'Français, Anglais', 'Tickets restaurant, Mutuelle', 'Rigoureuse, organisée', 1200.00, 'Temps plein', 'photos/cand1.jpg'),
(9, 1, CURDATE(), 2, 5, 4, 'Français, Anglais, Allemand', 'Télétravail partiel', 'Travail en équipe', 1500.00, 'Temps plein', 'photos/cand2.jpg'),
(10, 1, CURDATE(), 3, 3, 1, 'Français', 'Formation continue', 'Créative, adaptable', 1000.00, 'Mi-temps', 'photos/cand3.jpg'),
(11, 1, CURDATE(), 1, 5, 5, 'Français, Anglais', 'Tickets restaurant', 'Leadership, gestion de projets', 1800.00, 'Temps plein', 'photos/cand4.jpg'),
(12, 1, CURDATE(), 2, 4, 3, 'Français, Espagnol', 'Télétravail', 'Autonome, polyvalente', 1400.00, 'Temps plein', 'photos/cand5.jpg'),
(13, 1, CURDATE(), 3, 2, 1, 'Français', 'Mutuelle', 'Esprit d analyse', 1100.00, 'Temps partiel', 'photos/cand6.jpg'),
(14, 1, CURDATE(), 1, 5, 6, 'Français, Anglais', 'Tickets restaurant, Télétravail', 'Motivée, dynamique', 2000.00, 'Temps plein', 'photos/cand7.jpg');

