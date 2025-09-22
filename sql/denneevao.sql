-- ================================
-- Nouvelles Questions (Finance)
-- ================================
INSERT INTO questions (id, qcm_id, question_text, points, statusQCM) VALUES
(5, 1, 'Quelle est la différence entre charges fixes et charges variables ?', 5, 1),
(6, 1, 'Quel est l objectif principal de l audit financier ?', 5, 1),
(7, 1, 'Quel ratio mesure la rentabilité des capitaux propres ?', 5, 1),
(8, 1, 'Quel document fiscal récapitule les obligations d une entreprise ?', 5, 1);

-- Options Finance
INSERT INTO question_options (id, question_id, option_label, option_text, is_correct, points) VALUES
-- Question 5
(18, 5, 'A', 'Les charges fixes varient avec l activité, les variables non', 0,0),
(19, 5, 'B', 'Les charges fixes sont indépendantes du volume d activité', 1,1),
(20, 5, 'C', 'Les charges variables augmentent avec la production', 1,1),
(21, 5, 'D', 'Les charges fixes sont toujours liées aux matières premières', 0,0),

-- Question 6
(22, 6, 'A', 'Optimiser la fiscalité', 0,0),
(23, 6, 'B', 'Vérifier la sincérité et la régularité des comptes', 1,1),
(24, 6, 'C', 'Améliorer le marketing', 0,0),
(25, 6, 'D', 'Augmenter le chiffre d affaires', 0,0),

-- Question 7
(26, 7, 'A', 'ROE (Return on Equity)', 1,1),
(27, 7, 'B', 'ROI (Return on Investment)', 0,0),
(28, 7, 'C', 'Taux de marge brute', 0,0),
(29, 7, 'D', 'BFR (Besoin en Fonds de Roulement)', 0,0),

-- Question 8
(30, 8, 'A', 'Bilan annuel', 0,0),
(31, 8, 'B', 'Compte de résultat', 0,0),
(32, 8, 'C', 'Déclaration fiscale (liasse fiscale)', 1,1),
(33, 8, 'D', 'Plan de financement', 0,0);

-- ================================
-- Nouvelles Questions (Marketing)
-- ================================
INSERT INTO questions (id, qcm_id, question_text, points, statusQCM) VALUES
(9, 2, 'Quel outil permet d analyser les forces et faiblesses d une entreprise ?', 5, 1),
(10, 2, 'Quelle stratégie correspond à la pénétration de marché ?', 5, 1),
(11, 2, 'Quel indicateur mesure la fidélité des clients ?', 5, 1),
(12, 2, 'Quel est l objectif principal d une étude de marché ?', 5, 1);

-- Options Marketing
INSERT INTO question_options (id, question_id, option_label, option_text, is_correct, points) VALUES
-- Question 9
(34, 9, 'A', 'SWOT', 1,1),
(35, 9, 'B', 'PESTEL', 0,0),
(36, 9, 'C', 'Benchmarking', 0,0),
(37, 9, 'D', 'Segmentation', 0,0),

-- Question 10
(38, 10, 'A', 'Introduire un nouveau produit sur un marché existant', 0,0),
(39, 10, 'B', 'Augmenter les parts de marché avec les produits actuels', 1,1),
(40, 10, 'C', 'Diversifier dans un nouveau secteur', 0,0),
(41, 10, 'D', 'Lancer un produit innovant', 0,0),

-- Question 11
(42, 11, 'A', 'NPS (Net Promoter Score)', 1,1),
(43, 11, 'B', 'Taux de clics', 0,0),
(44, 11, 'C', 'Nombre d impressions', 0,0),
(45, 11, 'D', 'Part de marché', 0,0),

-- Question 12
(46, 12, 'A', 'Connaître les besoins et comportements des consommateurs', 1,1),
(47, 12, 'B', 'Augmenter directement les ventes', 0,0),
(48, 12, 'C', 'Créer une publicité', 0,0),
(49, 12, 'D', 'Définir la politique fiscale', 0,0);
