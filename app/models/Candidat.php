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
        $sql = "SELECT * FROM candidates";
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
                return 1; // pas encore dans candidat_avance
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
    public function findAllCandidatsStade3($job_offer_id = null) {
        if ($job_offer_id) {
            // Avec filtre par offre d'emploi
            $sql = "
            SELECT c.*, ca.job_offer_id
            FROM candidates c
            INNER JOIN candidat_avance ca ON ca.idcandidat = c.id
            WHERE ca.stade = 3 AND ca.job_offer_id = :job_offer_id
            ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':job_offer_id' => $job_offer_id]);
        } else {
            // Sans filtre - tous les candidats stade 3
            $sql = "
            SELECT c.*, ca.job_offer_id
            FROM candidates c
            INNER JOIN candidat_avance ca ON ca.idcandidat = c.id
            WHERE ca.stade = 3
            ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findAllCandidatsStade3AvecEntretien() {
        $sql = "
        SELECT c.*, e.id AS entretien_id, e.Date_heure_debut, e.NotesRH
        FROM candidates c
        INNER JOIN candidat_avance ca ON ca.idcandidat = c.id
        INNER JOIN Entretien e ON e.idCandidat = c.id
        WHERE ca.stade = 3
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCandidatsStade4AvecScores() {
        $sql = "
        SELECT
        c.id,
        c.Nom,
        c.Prenom,
        s.totalPoints,
        e.Notes,
        e.NotesRH,
        ROUND((
            COALESCE(s.totalPoints, 0) +
            COALESCE(e.Notes, 0) +
            COALESCE(e.NotesRH, 0)
            ) / 3, 2) AS moyenne
            FROM candidates c
            INNER JOIN candidat_avance ca ON ca.idcandidat = c.id
            LEFT JOIN scoreTotalCandidat s ON s.idCandidat = c.id
            LEFT JOIN Entretien e ON e.idCandidat = c.id
            WHERE ca.stade = 4
            ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function trierEtAvancerCandidatsStade4() {
        try {
            // 1️⃣ Récupérer tous les candidats de stade 4 avec leurs moyennes
            $sql = "
            SELECT
            c.id,
            c.Nom,
            c.Prenom,
            c.Mail,
            COALESCE(s.totalPoints,0) AS totalPoints,
            COALESCE(e.Notes,0) AS Notes,
            COALESCE(e.NotesRH,0) AS NotesRH,
            (
                COALESCE(s.totalPoints,0) +
                COALESCE(e.Notes,0) +
                COALESCE(e.NotesRH,0)
                ) / 3 AS moyenne
                FROM candidates c
                INNER JOIN candidat_avance ca ON ca.idcandidat = c.id
                LEFT JOIN scoreTotalCandidat s ON s.idCandidat = c.id
                LEFT JOIN Entretien e ON e.idCandidat = c.id
                WHERE ca.stade = 4
                ORDER BY moyenne DESC
                ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $candidats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($candidats)) {
            return "Aucun candidat en stade 4.";
        }

        // 2️⃣ Le meilleur candidat passe, les autres sont rejetés
        $gagnant = $candidats[0]; // le premier candidat après tri
        $perdants = array_slice($candidats, 1);

        // 3️⃣ Mise à jour des stades
        $updateSql = "UPDATE candidat_avance SET stade = :stade WHERE idcandidat = :idcandidat";
        $updateStmt = $this->db->prepare($updateSql);

        $notification = new Notification($this->db);

        // ✅ Meilleur candidat passe
        $updateStmt->execute([':stade' => 5, ':idcandidat' => $gagnant['id']]);
        $notification->sendNotification($gagnant['id'], "acceptation");

        // ❌ Les autres sont rejetés
        foreach ($perdants as $p) {
            $updateStmt->execute([':stade' => 0, ':idcandidat' => $p['id']]);
            $notification->sendNotification($p['id'], "rejet");
        }

        return "1 candidat avancé au stade 5 et " . count($perdants) . " rejetés.";

        } catch (\Throwable $th) {
            error_log("Erreur dans trierEtAvancerCandidatsStade4: " . $th->getMessage());
            return "Erreur : " . $th->getMessage();
        }
    }
    public function embaucherCandidat($idCandidat, $jobOfferId) {
        try {
            $this->db->beginTransaction();

            // 1️⃣ Vérifier que le candidat existe et récupérer son user_id
            $sqlCandidat = "SELECT c.user_id, c.Mail, u.role
            FROM candidates c
            LEFT JOIN users u ON u.id = c.user_id
            INNER JOIN candidat_avance ca ON ca.idcandidat = c.id
            WHERE c.id = :idCandidat AND ca.job_offer_id = :jobOfferId";

            $stmt = $this->db->prepare($sqlCandidat);
            $stmt->execute([
                ':idCandidat' => $idCandidat,
                ':jobOfferId' => $jobOfferId
            ]);
            $candidat = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$candidat) {
                throw new Exception("Candidat non trouvé ou non associé à cette offre");
            }

            // 2️⃣ Vérifier si le candidat a un user_id
            if (!$candidat['user_id']) {
                throw new Exception("Ce candidat n'a pas de compte utilisateur associé");
            }

            // 3️⃣ Changer le rôle à 'employee'
            $sqlUpdateRole = "UPDATE users SET role = 'employee' WHERE id = :user_id";
            $stmtUpdate = $this->db->prepare($sqlUpdateRole);
            $stmtUpdate->execute([':user_id' => $candidat['user_id']]);

            // 4️⃣ Vérifier si l'employé existe déjà, sinon le créer
            $sqlCheckEmployee = "SELECT id FROM employees WHERE id = :user_id";
            $stmtCheck = $this->db->prepare($sqlCheckEmployee);
            $stmtCheck->execute([':user_id' => $candidat['user_id']]);

            if (!$stmtCheck->fetch()) {
                // Récupérer le département depuis l'offre d'emploi
                $sqlJobOffer = "SELECT department_id, title FROM job_offers WHERE id = :jobOfferId";
                $stmtJob = $this->db->prepare($sqlJobOffer);
                $stmtJob->execute([':jobOfferId' => $jobOfferId]);
                $job = $stmtJob->fetch(PDO::FETCH_ASSOC);

                // Créer l'entrée dans employees
                $sqlInsertEmployee = "INSERT INTO employees (id, department_id, position)
                VALUES (:id, :department_id, :position)";

                $stmtEmployee = $this->db->prepare($sqlInsertEmployee);
                $stmtEmployee->execute([
                    ':id' => $candidat['user_id'],
                    ':department_id' => $job['department_id'] ?? null,
                    ':position' => $job['title'] ?? 'Nouvel employé'
                ]);
            }

            // 5️⃣ Mettre à jour le stade à 10 (embauché)
            $sqlUpdateStade = "UPDATE candidat_avance SET stade = 10
            WHERE idcandidat = :idCandidat AND job_offer_id = :jobOfferId";

            $stmtStade = $this->db->prepare($sqlUpdateStade);
            $stmtStade->execute([
                ':idCandidat' => $idCandidat,
                ':jobOfferId' => $jobOfferId
            ]);

            // 6️⃣ Mettre l'offre d'emploi inactive
            $sqlUpdateJobOffer = "UPDATE job_offers SET is_active = FALSE WHERE id = :jobOfferId";
            $stmtJobOffer = $this->db->prepare($sqlUpdateJobOffer);
            $stmtJobOffer->execute([':jobOfferId' => $jobOfferId]);

            $this->db->commit();

            return [
                'success' => true,
                'message' => "Candidat embauché avec succès ! Rôle changé en 'employee' et offre d'emploi désactivée",
                'user_id' => $candidat['user_id'],
                'new_role' => 'employee',
                'stade' => 10,
                'job_offer_active' => false
            ];

        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Erreur embauche candidat: " . $e->getMessage());

            return [
                'success' => false,
                'message' => "Erreur lors de l'embauche: " . $e->getMessage()
            ];
        }
    }

}
