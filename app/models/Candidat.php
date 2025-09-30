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
    public function findAllCandidatsStade3() {
        $sql = "
        SELECT c.*
        FROM candidates c
        INNER JOIN candidat_avance ca ON ca.idcandidat = c.id
        WHERE ca.stade = 3
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
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

        // 2️⃣ Découper en deux : la moitié supérieure passe, l’autre rejetée
        $total = count($candidats);
        $moitie = ceil($total / 2);

        $gagnants = array_slice($candidats, 0, $moitie);
        $perdants = array_slice($candidats, $moitie);

        // 3️⃣ Mise à jour des stades
        $updateSql = "UPDATE candidat_avance SET stade = :stade WHERE idcandidat = :idcandidat";
        $updateStmt = $this->db->prepare($updateSql);

        $notification = new Notification($this->db);

        foreach ($gagnants as $g) {
            $updateStmt->execute([':stade' => 5, ':idcandidat' => $g['id']]);
            $notification->sendNotification(
                $g['id'],
                "acceptation"
            );
        }

        foreach ($perdants as $p) {
            $updateStmt->execute([':stade' => 0, ':idcandidat' => $p['id']]);
            $notification->sendNotification(
                $p['id'],
                "rejet"
            );
        }

        return count($gagnants) . " candidats avancés au stade 5 et " . count($perdants) . " rejetés.";
        } catch (\Throwable $th) {
            error_log("Erreur dans trierEtAvancerCandidatsStade4: " . $th->getMessage());
            return "Erreur : " . $th->getMessage();
        }
    }

}
