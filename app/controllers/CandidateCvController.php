<?php
namespace app\controllers;

use app\models\CandidateCv;

use Flight;

class CandidateCvController {
    public function __construct() {
     
    }

    // Formulaire de création CV
    public function formPage() {
        $diplomaModel = new \app\models\Diploma(Flight::db());
        $diplomas = $diplomaModel->getAll();

        
        Flight::render("cv/form", [
            "diplomas" => $diplomas,

        ]);
    }

    // Soumission d'un CV
    public function submit() {
        $cvModel = new CandidateCv(Flight::db());

        // Récupération des valeurs du formulaire
        $job_offer_id     = $_POST['job_offer_id'] ?? null;
        $salaire_souhaite = $_POST['salaire_souhaite'] ?? null;
        $diploma_id       = $_POST['diploma_id'] ?? null;
        $level            = $_POST['level'] ?? null;
        $experience_year  = $_POST['experience_year'] ?? null;
        $languages        = $_POST['languages'] ?? '';
        $avantages        = $_POST['avantages'] ?? '';
        $atout            = $_POST['atout'] ?? '';


        $date_depot = date('Y-m-d');
        $candidate_id = $_SESSION['user']['id'] ?? null; // fallback pour test

        // Appel au modèle
        $cvModel->insertCv(
            $candidate_id,
            $job_offer_id,
            $date_depot,
            $diploma_id,
            $level,
            $experience_year,
            $languages,
            $avantages,
            $atout,
            $salaire_souhaite
        );

        // Redirection après enregistrement
        header("Location: /cv/my");
        exit;
    }

    // Voir mes CVs
    public function CV($id) {
        $cvModel = new CandidateCv(Flight::db());

        $cvs = $cvModel->getCvsByJobOffer($id);

        Flight::render("cv/listcv", [
            "cvs" => $cvs,
             "job_offer_id" => $id
        ]);
    }

    // Voir un CV
    public function view($id) {
        $cvModel = new CandidateCv(Flight::db());
        $cv = $cvModel->getById($id);
        Flight::render("cv/view", ["cv" => $cv]);
    }

    // Formulaire de modification d'un CV
    public function editForm($id) {
        $cvModel = new CandidateCv(Flight::db());
        $cv = $cvModel->getById($id);
        
        $diplomaModel = new \app\models\Diploma(Flight::db());
        $diplomas = $diplomaModel->getAll();
        
        $competanceModel = new Competance(Flight::db());
        $competances = $competanceModel->getAll();
        
        Flight::render("cv/edit", [
            "cv" => $cv,
            "diplomas" => $diplomas,
            "competances" => $competances
        ]);
    }

    // Mettre à jour un CV
    public function update($id, $data) {
        $cvModel = new CandidateCv(Flight::db());
        $cvModel->update($id, $data);
        header("Location: /cv/my");
        exit;
    }

    // Supprimer un CV
    public function destroy($id) {
        $cvModel = new CandidateCv(Flight::db());
        $cvModel->delete($id);
        header("Location: /cv/my");
        exit;
    }
    public function trier() {
        try {
            // Récupération du job_offer_id depuis le POST
            $jobOfferId = $_POST['job_offer_id'] ?? null;
            $cvModel = new CandidateCv(Flight::db());
            if (!$jobOfferId) {
                Flight::halt(400, "Aucune offre spécifiée");
                return;
            }

            // Appel du modèle pour trier et notifier
            $cvModel->trierCVs($jobOfferId);

            // Message flash en session
            $_SESSION['success_message'] = "✅ CVs triés avec succès, notifications envoyées.";

            // Redirection vers la liste des CVs
            Flight::redirect("/cv/job/$jobOfferId");

        } catch (Exception $e) {
            error_log("Erreur Controller trierCVs : " . $e->getMessage());
            Flight::halt(500, "Erreur lors du tri des CVs");
        }
    }

}
