<?php
namespace app\models;

use PDO;
use Exception;

class Diploma {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // === CREATE ===
    public function insert($name) {
        $stmt = $this->db->prepare("INSERT INTO diploma (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    // === READ ALL ===
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM diploma ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // === READ ONE ===
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM diploma WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // === UPDATE ===
    public function update($id, $name) {
        $stmt = $this->db->prepare("UPDATE diploma SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    // === DELETE ===
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM diploma WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
