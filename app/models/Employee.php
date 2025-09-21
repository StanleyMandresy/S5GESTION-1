<?php
namespace app\models;

use PDO;

class Employee {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // Récupérer le profil complet de l'employé
    public function getProfile(int $id): array|false {
        $stmt = $this->db->prepare("
        SELECT u.id, u.first_name, u.last_name, u.email, e.department_id, e.position
        FROM users u
        JOIN employees e ON u.id = e.id
        WHERE u.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}
