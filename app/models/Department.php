<?php
namespace app\models;

use PDO;
use Exception;


class Department {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Récupérer tous les départements
    public function getAll() {
        $sql = "SELECT * FROM departement";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function isRh($departement_id) {
        try {
            $stmt = $this->db->prepare("SELECT name FROM departement WHERE id = ?");
            $stmt->execute([$departement_id]);
            $dep = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dep) {
                $name = strtolower($dep['name']);
                return ($name === 'rh' || $name === 'ressources humaines');
            }
        } catch (Exception $e) {
            error_log("Erreur isRh: " . $e->getMessage());
        }

        return false;
    }

    // Récupérer un département par ID
    public function getById($id) {
        $sql = "SELECT * FROM departement WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un département
    public function create($nom) {
        $sql = "INSERT INTO departement (nom) VALUES (:nom)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([":nom" => $nom]);
    }

    // Mettre à jour un département
    public function update($id, $nom) {
        $sql = "UPDATE departemnt SET nom = :nom WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([":id" => $id, ":nom" => $nom]);
    }

    // Supprimer un département
    public function delete($id) {
        $sql = "DELETE FROM departement WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }
}

