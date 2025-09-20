<?php
namespace app\models;

use PDO;
use Exception;

class ContractModel {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

   public function listeCandidats() {
    try {
        $stmt = $this->db->query("
            SELECT cr.id, cr.idCandidat, u.first_name, u.last_name 
            FROM candidates_recus cr
            JOIN candidates c ON cr.idCandidat = c.id
            JOIN users u ON c.id = u.id
            ORDER BY u.last_name, u.first_name
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        throw new Exception("Erreur récupération candidats : " . $e->getMessage());
    }
}
  
    
    public function listeTypesContrat() {
        try {
            $stmt = $this->db->query("SELECT id, type_name FROM contract_types");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Erreur récupération types de contrat : " . $e->getMessage());
        }
    }
    public function ContractSaisieParRH($data) {
        try {
            $sql = "INSERT INTO contracts (
                        idCandidatRecu, idEmploye, contract_type, start_date, end_date,
                        probation_duration, probation_renewable, remuneration, remuneration_hourly,
                        work_hours_per_week, idStatut, idType
                    ) VALUES (
                        :idCandidatRecu, :idEmploye, :contract_type, :start_date, :end_date,
                        :probation_duration, :probation_renewable, :remuneration, :remuneration_hourly,
                        :work_hours_per_week, :idStatut, :idType
                    )";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':idCandidatRecu' => $data['idCandidatRecu'],
                ':idEmploye' => $data['idEmploye'] ?? null,
                ':contract_type' => $data['contract_type'],
                ':start_date' => $data['start_date'],
                ':end_date' => $data['end_date'],
                ':probation_duration' => $data['probation_duration'],
                ':probation_renewable' => $data['probation_renewable'],
                ':remuneration' => $data['remuneration'],
                ':remuneration_hourly' => $data['remuneration_hourly'],
                ':work_hours_per_week' => $data['work_hours_per_week'],
                ':idStatut' => $data['idStatut'],
                ':idType' => $data['idType']
            ]);

            return $this->db->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Erreur insertion contrat : " . $e->getMessage());
        }
    }

    // ======================
    // Ajout Mission
    // ======================
    public function AjouterMission($idContract, $description) {
        try {
            $stmt = $this->db->prepare("INSERT INTO missions (idContract, description) VALUES (:idContract, :description)");
            $stmt->execute([
                ':idContract' => $idContract,
                ':description' => $description
            ]);
        } catch (Exception $e) {
            throw new Exception("Erreur insertion mission : " . $e->getMessage());
        }
    }

    // ======================
    // Ajout Clause
    // ======================
    public function AjouterClause($clause_title, $clause_text) {
        try {
            $stmt = $this->db->prepare("INSERT INTO contract_clauses (clause_title, clause_text) VALUES (:title, :text)");
            $stmt->execute([
                ':title' => $clause_title,
                ':text' => $clause_text
            ]);
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Erreur insertion clause : " . $e->getMessage());
        }
    }

    // ======================
    // Associer Clause au Contrat
    // ======================
    public function AssocierClauseAuContrat($idContract, $idClause) {
        try {
            $stmt = $this->db->prepare("INSERT INTO contract_clause_assignments (idContract, idClause) VALUES (:idContract, :idClause)");
            $stmt->execute([
                ':idContract' => $idContract,
                ':idClause' => $idClause
            ]);
        } catch (Exception $e) {
            throw new Exception("Erreur association clause au contrat : " . $e->getMessage());
        }
    }

    // ======================
    // Ajout Type de Contrat
    // ======================
    public function AjouterTypeContrat($type_name) {
        try {
            $stmt = $this->db->prepare("INSERT INTO contract_types (type_name) VALUES (:type)");
            $stmt->execute([ ':type' => $type_name ]);
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Erreur insertion type contrat : " . $e->getMessage());
        }
    }
    // Dans app/models/ContractModel.php
public function getContractDetailsByCandidat($idCandidat) {
    try {
        // Récupération des informations de base du contrat
        $stmt = $this->db->prepare("
            SELECT 
                c.*,
                cr.idCandidat,
                u.first_name, 
                u.last_name,
        
                comp.company_name as company_name,
                comp.capital,
                comp.rcs_number,
                comp.rcs_city,
                comp.headquarters_address,
                ct.type_name
            FROM contracts c
            JOIN candidates_recus cr ON c.idCandidatRecu = cr.id
            JOIN candidates cand ON cr.idCandidat = cand.id
            JOIN users u ON cand.id = u.id
            LEFT JOIN company_info comp ON 1=1 -- Supposons une table avec les infos société
            LEFT JOIN contract_types ct ON c.idType = ct.id
            WHERE cr.idCandidat = :idCandidat
            ORDER BY c.start_date DESC
            LIMIT 1
        ");
        
        $stmt->execute([':idCandidat' => $idCandidat]);
        $contract = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$contract) {
            return null;
        }
        
        // Récupération des missions
        $stmtMissions = $this->db->prepare("
            SELECT description 
            FROM missions 
            WHERE idContract = :idContract
        ");
        $stmtMissions->execute([':idContract' => $contract['id']]);
        $contract['missions'] = $stmtMissions->fetchAll(PDO::FETCH_COLUMN);
        
        // Récupération des clauses
        $stmtClauses = $this->db->prepare("
            SELECT cc.clause_title, cc.clause_text
            FROM contract_clauses cc
            JOIN contract_clause_assignments cca ON cc.id = cca.idClause
            WHERE cca.idContract = :idContract
        ");
        $stmtClauses->execute([':idContract' => $contract['id']]);
        $contract['clauses'] = $stmtClauses->fetchAll(PDO::FETCH_ASSOC);
        
        return $contract;
        
    } catch (Exception $e) {
        throw new Exception("Erreur récupération contrat : " . $e->getMessage());
    }
}

}
?>
