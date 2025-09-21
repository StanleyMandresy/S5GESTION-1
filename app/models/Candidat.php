<?php
namespace app\models;

use PDO;
use Exception;

class Candidat {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Récupère tous les candidats
     * @return array
     */
    public function findAllCandidats() {
        $sql = "SELECT * FROM Candidat";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProfile(int $id): array|false {
        $stmt = $this->db->prepare("
        SELECT u.*, c.phone, c.address, c.resume_path,c.id
        FROM users u
        JOIN candidates c ON u.id = c.user_id
        WHERE u.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getStadeCandidat($idCandidat, $jobOfferId) {
        try {
            $sql = "SELECT stade
            FROM candidat_avance
            WHERE idcandidat = ? AND job_offer_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$idCandidat, $jobOfferId]);
            $stade = $stmt->fetchColumn();

            if ($stade === false) {
                return null; // pas encore dans candidat_avance
            }
            return (int)$stade;

        } catch (Exception $e) {
            error_log("Erreur getStadeCandidat : " . $e->getMessage());
            return null;
        }
    }
    public function hasApplied($candidateId, $jobOfferId): bool {
        $sql = "SELECT COUNT(*)
        FROM candidate_cv_data
        WHERE candidate_id = ? AND job_offer_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$candidateId, $jobOfferId]);
        return $stmt->fetchColumn() > 0;
    }


}
