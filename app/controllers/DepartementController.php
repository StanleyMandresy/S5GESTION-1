<?php
namespace app\controllers;

use app\models\Departement;
use Flight;

class DepartementController {
    public function __construct() {
        // Constructeur vide (comme demandé)
    }

    // Liste des départements
    public function index() {
        $departementModel = new Departement(Flight::db());
        $departements = $departementModel->getAll();
        require "views/departement/index.php";
    }

    // Afficher un département
    public function show($id) {
        $departementModel = new Departement(Flight::db());
        $departement = $departementModel->getById($id);
        require "views/departement/show.php";
    }

    // Formulaire création
    public function createForm() {
        require "views/departement/create.php";
    }

    // Enregistrer nouveau département
    public function store($data) {
        $departementModel = new Departement(Flight::db());
        $departementModel->create($data["nom"]);
        header("Location: /departement");
        exit;
    }

    // Formulaire édition
    public function editForm($id) {
        $departementModel = new Departement(Flight::db());
        $departement = $departementModel->getById($id);
        require "views/departement/edit.php";
    }

    // Mettre à jour
    public function update($id, $data) {
        $departementModel = new Departement(Flight::db());
        $departementModel->update($id, $data["nom"]);
        header("Location: /departement");
        exit;
    }

    // Supprimer
    public function destroy($id) {
        $departementModel = new Departement(Flight::db());
        $departementModel->delete($id);
        header("Location: /departement");
        exit;
    }
}
