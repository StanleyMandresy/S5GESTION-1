<?php
namespace app\models;
use PDO;
use Exception;

class JobOffer {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer toutes les offres actives
    public function getJobOffers() {
        try {
            $sql = "SELECT j.*, d.name AS department_name,d.id as departement_id
            FROM job_offers j
            JOIN departement d ON j.department_id = d.id
            WHERE j.is_approved=TRUE
            ORDER BY j.deadline DESC";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
    public function getJobOffersNonApproved() {
        try {
            $sql = "SELECT j.*, d.name AS department_name
            FROM job_offers j
            JOIN departement d ON j.department_id = d.id
            WHERE  j.is_approved=0
            ORDER BY j.deadline DESC";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }

    // Récupérer une offre par ID
    public function getById($id) {
        try {
            $sql = "SELECT * FROM job_offers WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    // Récupérer toutes les offres par département
    public function getByDepartment($department_id) {
        try {
            $sql = "SELECT * FROM job_offers WHERE department_id = ? and is_approved=true ORDER BY deadline DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$department_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
    public function insertOffer($department_id, $title, $description, $locations, $deadline, $diploma_id, $level, $experience_year, $benefits, $is_active, $competence_ids = []) {
        try {
            $this->db->beginTransaction();

            // Insérer l'offre principale
            $sql = "INSERT INTO job_offers
            (department_id, title, description, locations, deadline, diploma_id, level, experience_year, benefits, is_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $department_id, $title, $description, $locations, $deadline,
                $diploma_id, $level, $experience_year, $benefits, $is_active
            ]);

            $job_offer_id = $this->db->lastInsertId();




            $this->db->commit();
            return $job_offer_id;

        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log("Erreur insertion offre: " . $e->getMessage());
            return 0;
        }
    }

    // Mettre à jour une offre
    public function updateOffer(
        $id, $department_id, $title, $description, $locations, $deadline, $diploma_id, $benefits, $is_active,$competance_id,$experience_level
    ) {
        try {
            $sql = "UPDATE job_offers SET
            department_id=?, title=?, description=?, locations=?, deadline=?,
            diploma_id=?, benefits=?, is_active=?, competance_id=,experience_level=?
            WHERE id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $department_id, $title, $description, $locations, $deadline,
                $diploma_id, $benefits, $is_active,$competance_id,$experience_level, $id
            ]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return 0;
        }
    }

    // Supprimer une offre
    public function deleteOffer($id) {
        try {
            $sql = "DELETE FROM job_offers WHERE id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return "Offre supprimée avec succès.";
        } catch (Exception $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    // Activer ou désactiver une offre
    public function setApproved($id, $status) {
        try {
            if ($status == 1) {
                $sql = "UPDATE job_offers SET is_approved = TRUE WHERE id = ?";
            } else {
                $sql = "UPDATE job_offers SET is_approved = FALSE WHERE id = ?";
            }

            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return 0;
        }
    }
}
?>
