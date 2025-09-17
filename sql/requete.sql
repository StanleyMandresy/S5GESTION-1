--requete pour avoir les questions qcm pour un departement specifique
-- Requête pour avoir les questions QCM pour un département spécifique par son ID
SELECT 
    d.id AS departement_id,
    qcm.title AS qcm_title,
    qs.id AS question_id,
    qs.question_text,
    qs.points,
    qo.option_label,
    qo.option_text,
    qo.is_correct
FROM departement d
JOIN users u ON d.id = u.idDepartement
JOIN employees e ON e.id = u.id
JOIN qcms qcm ON qcm.departementProprietaire = e.id
JOIN questions qs ON qs.qcm_id = qcm.id
JOIN question_options qo ON qo.question_id = qs.id
WHERE d.id = 2 
ORDER BY qcm.id, qs.id, qo.option_label;


SELECT 
            d.id AS departement_id,
            d.name AS departement_name,
            qcm.id AS qcm_id,
            qcm.title AS qcm_title,
            qs.id AS question_id,
            qs.question_text,
            qs.points,
            qo.id AS option_id,
            qo.option_label,
            qo.option_text,
            qo.is_correct
        FROM candidates c
        JOIN users u ON c.id = u.id
        JOIN departement d ON u.idDepartement = d.id
        JOIN employees e ON e.id = u.id
        JOIN qcms qcm ON qcm.departementProprietaire = e.id
        JOIN questions qs ON qs.qcm_id = qcm.id
        JOIN question_options qo ON qo.question_id = qs.id
        WHERE c.id = 3
        ORDER BY qcm.id, qs.id, qo.option_label;

SELECT 
    c.id AS candidat_id,
    CONCAT(u.first_name, ' ', u.last_name) AS candidat_nom,
    qcm.title AS qcm_titre,
    SUM(
        CASE 
            WHEN qa.answer = q.correct_answer THEN q.points
            ELSE 0
        END
    ) AS total_score
FROM qcm_answers qa
JOIN candidates c ON qa.idCandidat = c.id
JOIN users u ON c.id = u.id
JOIN questions q ON qa.question_id = q.id
JOIN qcms qcm ON q.qcm_id = qcm.id
WHERE c.id = 1 -- ⚠️ ici, tu mets l'ID du candidat
GROUP BY c.id, candidat_nom, qcm.title;


UPDATE questions
SET option_a = 'Chaque débit a un crédit',
    option_b = 'Chaque crédit est unique',
    option_c = 'Un débit est supérieur à un crédit',
    option_d = 'Aucune des réponses',
    correct_answer = 'A'
WHERE id = 2;
