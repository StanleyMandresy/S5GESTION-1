<?php
namespace app\models;

use PDO;
use Exception;

class QCMmodel {

    /**
     * Calcule le score du candidat à partir des réponses stockées en base
     */


    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function FindDepartement($idUser){
        try{
            $sql = "SELECT idDepartement FROM users WHERE id = '$idUser';";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); 
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
            return [];
        }
    }   
    
    public function GetQCMDepartement($departementCorrespondant) {
    try {
        $sql = "SELECT 
    d.id AS departement_id,
    qcm.title AS qcm_title,
    qs.id AS question_id,
    qs.question_text,
    qs.points,
    qo.id AS option_id,
    qo.option_label,
    qo.option_text,
    qo.is_correct
FROM departement d
JOIN employees e ON e.department_id = d.id
JOIN users u ON u.id = e.id
JOIN qcms qcm ON qcm.departementProprietaire = e.id
JOIN questions qs ON qs.qcm_id = qcm.id
JOIN question_options qo ON qo.question_id = qs.id
WHERE d.id = '$departementCorrespondant'
ORDER BY qcm.id, qs.id, qo.option_label;
";  
        $stmt = $this->db->prepare($sql);
       $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
 
 public function MikotyPointCandidatFromDB($idCandidat){
     try {
         $totalPoints = 0;
         $sql = "SELECT qa.question_id, qa.option_id, qo.is_correct, qo.points
         FROM qcm_answers qa
         JOIN question_options qo ON qa.option_id = qo.id AND qa.question_id = qo.question_id
         WHERE qa.idCandidat = :idCandidat";
         $stmt = $this->db->prepare($sql);
         $stmt->execute([':idCandidat' => $idCandidat]);
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

         foreach ($rows as $row) {
             if ($row['is_correct']) {
                 $totalPoints += (int)$row['points'];
             }
         }

         // Vérifier si un score existe déjà
         $checkSql = "SELECT id FROM scoreTotalCandidat WHERE idCandidat = :idCandidat";
         $checkStmt = $this->db->prepare($checkSql);
         $checkStmt->execute([':idCandidat' => $idCandidat]);

         if ($checkStmt->rowCount() > 0) {
             // Mise à jour
             $sqlScore = "UPDATE scoreTotalCandidat SET totalPoints = :totalPoints WHERE idCandidat = :idCandidat";
         } else {
             // Insertion
             $sqlScore = "INSERT INTO scoreTotalCandidat (idCandidat, totalPoints) VALUES (:idCandidat, :totalPoints)";
         }

         $stmtScore = $this->db->prepare($sqlScore);
         $stmtScore->execute([
             ':idCandidat' => $idCandidat,
             ':totalPoints' => $totalPoints
         ]);

         // 🚀 Avancer le candidat au stade 3
         $sqlAvance = "UPDATE candidat_avance SET stade = 3 WHERE idCandidat = :idCandidat";
         $stmtAvance = $this->db->prepare($sqlAvance);
         $stmtAvance->execute([':idCandidat' => $idCandidat]);

         return $totalPoints;
     } catch (\Throwable $th) {
         error_log("Erreur dans MikotyPointCandidatFromDB: " . $th->getMessage());
         return 0;
     }
 }

public function ReponsesCandidatBatch($reponses) {
        try {
            $this->db->beginTransaction();
            $count = 0;
            $idCandidat = null;
            foreach ($reponses as $reponse) {
                // Validation simple
                if (!isset($reponse['idCandidat']) || !isset($reponse['question_id']) || !isset($reponse['option_id'])) {
                    error_log("Données manquantes: " . print_r($reponse, true));
                    continue;
                }
                $idCandidat = (int)$reponse['idCandidat'];
                $questionId = (int)$reponse['question_id'];
                $optionId = (int)$reponse['option_id'];
                // Vérifier l'existence
                $checkSql = "SELECT id FROM qcm_answers 
                             WHERE idCandidat = :idCandidat 
                             AND question_id = :questionId
                             AND option_id = :optionId";
                $stmt = $this->db->prepare($checkSql);
                $stmt->execute([
                    ':idCandidat' => $idCandidat,
                    ':questionId' => $questionId,
                    ':optionId' => $optionId
                ]);
                if ($stmt->fetch()) {
                    continue; // Existe déjà
                }
                // Insertion
                $sql = "INSERT INTO qcm_answers (idCandidat, question_id, option_id) 
                        VALUES (:idCandidat, :questionId, :optionId)";
                $stmt = $this->db->prepare($sql);
                $success = $stmt->execute([
                    ':idCandidat' => $idCandidat,
                    ':questionId' => $questionId,
                    ':optionId' => $optionId
                ]);
                if ($success) {
                    $count++;
                }
            }
            $this->db->commit();
            // Calculer et enregistrer le score du candidat après l'insertion des réponses
            if ($idCandidat !== null) {
                $this->MikotyPointCandidatFromDB($idCandidat);
            }
            return [
                'success' => true, 
                'message' => "$count réponses enregistrées avec succès",
                'count' => $count
            ];
        } catch(Exception $e) {
            $this->db->rollBack();
            error_log("Erreur lors de l'enregistrement: " . $e->getMessage());
            return [
                'success' => false, 
                'message' => 'Erreur: ' . $e->getMessage()
            ];
        }
    
}


  
    
}


    

?>
