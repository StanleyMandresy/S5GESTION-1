<?php
namespace app\models;

use PDO;
use Exception;

class QCMmodel {

    private $db;

    public function __construct($db) {
        $this->db = $db;
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
        ORDER BY qcm.id, qs.id, qo.option_label;";  
        $stmt = $this->db->prepare($sql);
       $stmt->execute();
        
  
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
    public function ReponseCandidat($reponseCandidat){
        try{
            $sql = "";
        }catch(Exception $e){

        }
    }
    public function VerifierReponse($reponseQuestion){
        try{
            $sql = "SELECT ";
        }catch(Exception $e){

        }
    }
  



    }

?>