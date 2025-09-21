<?php
namespace app\models;

use PDO;

class User {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // Vérifie si l'email existe
    public function emailExists(string $email): bool {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() !== false;
    }

    // Crée un utilisateur (base users)
    public function create(array $data): int {
        // 1️⃣ Créer l'utilisateur
        $stmt = $this->db->prepare("
        INSERT INTO users (first_name, last_name, email, password, role)
        VALUES (:first_name, :last_name, :email, :password, :role)
        ");
        $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => password_hash($data['password'], PASSWORD_BCRYPT),
                       'role'       => $data['role']
        ]);
        $userId = (int)$this->db->lastInsertId();

        // 2️⃣ Création du profil selon le rôle
        if ($data['role'] === 'candidate') {
            $this->db->prepare("
            INSERT INTO candidates (user_id, Nom, Prenom, Mail)
            VALUES (:user_id, :Nom, :Prenom, :Mail)
            ")->execute([
                'user_id' => $userId,
                'Nom'     => $data['first_name'] ?? '',
                'Prenom'  => $data['last_name'] ?? '',
                'Mail'    => $data['email']   // ✅ Obligatoire pour UNIQUE NOT NULL
            ]);
        } elseif ($data['role'] === 'employee') {
            $departmentId = $data['idDepartement'] ?? 1;
            $this->db->prepare("
            INSERT INTO employees (id, department_id, position)
            VALUES (:id, :department_id, :position)
            ")->execute([
                'id'            => $userId,
                'department_id' => $departmentId,
                'position'      => $data['position'] ?? 'Non défini'
            ]);
        }

        return $userId;
    }


    // Authentifier utilisateur
    public function authenticate(string $email, string $password): array|false {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Récupérer un utilisateur par id
    public function getById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
