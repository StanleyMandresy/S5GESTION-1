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
        SELECT u.*, c.phone, c.address, c.resume_path
        FROM users u
        JOIN candidates c ON u.id=c.id
        WHERE u.id=:id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
