<?php
namespace app\models;

use PDO;
use Exception;

class QCMmodel {

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
            qo.option_label,
            qo.option_text,
            qo.is_correct
        FROM departement d
        JOIN users u ON d.id = u.idDepartement
        JOIN employees e ON e.id = u.id
        JOIN qcms qcm ON qcm.departementProprietaire = e.id
        JOIN questions qs ON qs.qcm_id = qcm.id
        JOIN question_options qo ON qo.question_id = qs.id
        WHERE d.id = '$departementCorrespondant'
        ORDER BY qcm.id, qs.id, qo.option_label; ";  
        $stmt = $this->db->prepare($sql);
       $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
  public function ReponsesCandidatBatch($reponses) {
    try {
        $this->db->beginTransaction();
        
        foreach ($reponses as $reponse) {
            $idCandidat = 3; // Utilisez la valeur du tableau
            $questionId = (int)$reponse['question_id'];
            $optionId = (int)$reponse['option_id'];
            
            // Vérifier si cette réponse spécifique existe déjà
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
                // La réponse existe déjà, on peut skip ou update si nécessaire
                continue;
            } else {
                // Insérer la nouvelle réponse
                $sql = "INSERT INTO qcm_answers (idCandidat, question_id, option_id) 
                        VALUES (:idCandidat, :questionId, :optionId)";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':idCandidat' => $idCandidat,
                    ':questionId' => $questionId,
                    ':optionId' => $optionId
                ]);
            }
        }
        
        $this->db->commit();
        
        return [
            'success' => true, 
            'message' => count($reponses) . ' réponses enregistrées avec succès'
        ];
        
    } catch(Exception $e) {
        $this->db->rollBack();
        error_log("Erreur lors de l'enregistrement des réponses: " . $e->getMessage());
        return [
            'success' => false, 
            'message' => 'Erreur lors de l\'enregistrement: ' . $e->getMessage()
        ];
    }
}
    public function MikotyPointCandidat($idCandidat, $reponses): int {
        try {
            $sql="COUNT(*)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

   
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}


  



    

?>