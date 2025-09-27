<?php
namespace app\models;
use PDO;
use Exception;
use Flight;
use app\models\Notification;

class CandidateCv {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function insertCv(
        $candidate_id, $job_offer_id,
        $date_depot, $diploma_id, $level, $experience_year,
        $languages, $avantages, $atout, $salaire_souhaite, $photo_path = null
    ) {

        $stmt = $this->db->prepare("SELECT id FROM candidates WHERE user_id = ?");
        $stmt->execute([ $candidate_id]);
        $candidate_id = $stmt->fetchColumn();

        $sql = "INSERT INTO candidate_cv_data (
            candidate_id, job_offer_id, date_depot,
            diploma_id, level, experience_year,
            languages, avantages, atout, salaire_souhaite, photo_path
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $candidate_id, $job_offer_id, $date_depot,
            $diploma_id, $level, $experience_year,
            $languages, $avantages, $atout, $salaire_souhaite, $photo_path
        ]);
    }

    // Récupérer le CV d'un candidat
    public function getByCandidate($candidate_id) {
        $sql = "SELECT * FROM candidate_cv_data WHERE candidate_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $candidate_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function trierCVs($jobOfferId) {
        try {
            $notification = new Notification(Flight::db());

            // 0. Initialiser les candidats (si pas déjà en avance)
            $sql = "
            INSERT INTO candidat_avance (idcandidat, job_offer_id, stade)
            SELECT ccd.candidate_id, ccd.job_offer_id, 1
            FROM candidate_cv_data ccd
            WHERE ccd.job_offer_id = ?
            AND NOT EXISTS (
                SELECT 1 FROM candidat_avance ca
                WHERE ca.idcandidat = ccd.candidate_id
                AND ca.job_offer_id = ccd.job_offer_id
                )";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$jobOfferId]);

        // 1. Réinitialiser tous les candidats de l'offre à stade = 0 (rejet)
        $sql = "UPDATE candidat_avance
        SET stade = 0
        WHERE job_offer_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$jobOfferId]);

        // 2. Récupérer le diplôme exigé par l’offre
        $stmt = $this->db->prepare("SELECT diploma_id FROM job_offers WHERE id = ?");
        $stmt->execute([$jobOfferId]);
        $jobDiplomaId = $stmt->fetchColumn();

        // 3. Sélectionner les candidats valides (diplôme correspondant)
        $stmt = $this->db->prepare("
        SELECT ccd.candidate_id
        FROM candidate_cv_data ccd
        WHERE ccd.job_offer_id = ?
        AND (ccd.diploma_id = ? OR ? IS NULL) -- match strict ou offre sans exigence
        ORDER BY ccd.experience_year DESC, ccd.level DESC
        ");
        $stmt->execute([$jobOfferId, $jobDiplomaId, $jobDiplomaId]);
        $validCandidates = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (empty($validCandidates)) {
            return; // Aucun candidat valide
        }

        // 4. Ne garder que la moitié des meilleurs candidats
        $limit = max(1, floor(count($validCandidates) / 2));
        $winners = array_slice($validCandidates, 0, $limit);

        // 5. Mettre à jour leur stade à 2 (retenus)
        if (!empty($winners)) {
            $in  = str_repeat('?,', count($winners) - 1) . '?';
            $sql = "UPDATE candidat_avance
            SET stade = 2
            WHERE job_offer_id = ? AND idcandidat IN ($in)";
            $stmt = $this->db->prepare($sql);
            $params = array_merge([$jobOfferId], $winners);
            $stmt->execute($params);

            // 6. Notifications gagnants
            foreach ($winners as $idCandidat) {
                $notification->sendNotification($idCandidat, "acceptation");
            }

            // 7. Notifications perdants (même si diplôme match, mais hors top)
            $stmt = $this->db->prepare("
            SELECT idcandidat
            FROM candidat_avance
            WHERE job_offer_id = ? AND stade = 0
            ");
            $stmt->execute([$jobOfferId]);
            $losers = $stmt->fetchAll(PDO::FETCH_COLUMN);

            foreach ($losers as $idCandidat) {
                $notification->sendNotification($idCandidat, "rejet");
            }
        }

        } catch (Exception $e) {
            error_log("Erreur tri des CVs : " . $e->getMessage());
        }
    }


    // Récupérer un CV par ID avec infos candidat et diplôme
    public function getById($id) {
        $sql = "
            SELECT
                cv.*, 
                c.Nom, c.Prenom, c.Mail, c.phone, c.address, c.resume_path,
                d.name AS diploma_name
            FROM candidate_cv_data cv
            JOIN candidates c ON cv.candidate_id = c.id
            LEFT JOIN diploma d ON cv.diploma_id = d.id
            WHERE cv.id = :id
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un CV - À CORRIGER selon votre table
    public function update($id, $data) {
        $sql = "UPDATE candidate_cv_data SET 
                    nom=:nom, prenom=:prenom, email=:email, telephone=:telephone, 
                    titre_poste=:titre_poste, description=:description, competance_id=:competance_id, 
                    location=:location, salaire_souhaite=:salaire_souhaite, diploma_id=:diploma_id, 
                    experience_level=:experience_level, languages=:languages, 
                    disponibilite=:disponibilite, avantages=:avantages, horaires=:horaires
                WHERE id=:id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ":nom" => $data["nom"],
            ":prenom" => $data["prenom"],
            ":email" => $data["email"],
            ":telephone" => $data["telephone"],
            ":titre_poste" => $data["titre_poste"],
            ":description" => $data["description"],
            ":competance_id" => $data["competance_id"],
            ":location" => $data["location"],
            ":salaire_souhaite" => $data["salaire_souhaite"],
            ":diploma_id" => $data["diploma_id"],
            ":experience_level" => $data["experience_level"],
            ":languages" => $data["languages"],
            ":disponibilite" => $data["disponibilite"],
            ":avantages" => $data["avantages"],
            ":horaires" => $data["horaires"],
            ":id" => $id
        ]);
    }

    // Supprimer un CV
    public function delete($id) {
        $sql = "DELETE FROM candidate_cv_data WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }

   public function getCvsByJobOffer(int $job_offer_id): array {
       try {
           $sql = "
           SELECT
           cv.id AS cv_id,
           cv.date_depot,
           cv.level,
           cv.experience_year,
           cv.languages,
           cv.avantages,
           cv.atout,
           cv.salaire_souhaite,
           cv.horaires,
           c.id AS candidate_id,
           c.Nom,
           c.Prenom,
           c.Mail,
           c.phone,
           c.address,
           c.resume_path,
           ca.stade
           FROM candidate_cv_data cv
           JOIN candidates c ON cv.candidate_id = c.id
           LEFT JOIN candidat_avance ca
           ON ca.idcandidat = c.id
           AND ca.job_offer_id = cv.job_offer_id
           WHERE cv.job_offer_id = :job_offer_id
           AND (ca.stade IS NULL OR ca.stade <> 0) -- inclut ceux non encore évalués
           ORDER BY cv.date_depot DESC
           ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['job_offer_id' => $job_offer_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

       } catch (Exception $e) {
           error_log("Erreur récupération CVs : " . $e->getMessage());
           return [];
       }
   }
//
}






?>
