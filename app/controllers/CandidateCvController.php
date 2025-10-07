<?php
namespace app\controllers;
require_once __DIR__ . '/../pdf/fpdf.php';

use app\models\CandidateCv;

use Flight;

class CandidateCvController {
    // Exporter le CV en PDF
    public function exportPdf() {
        $id = $_GET['id'] ?? null;
        if ($id === null) {
            echo 'ID du CV manquant.';
            return;
        }

        $cvModel = new CandidateCv(Flight::db());
        $cv = $cvModel->getById($id);
        if (!$cv) {
            echo 'CV introuvable.';
            return;
        }

        // Créer le PDF directement
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);

        // Fonctions utilitaires
        $sectionTitle = function($title) use ($pdf) {
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetFillColor(133, 147, 147);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(0, 10, $title, 0, 1, 'L', true);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Ln(5);
        };

        $infoLine = function($label, $value) use ($pdf) {
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(45, 7, $label . ' :', 0, 0);
            $pdf->SetFont('Arial', '', 11);
            $pdf->MultiCell(0, 7, $value, 0, 'L');
            $pdf->Ln(3);
        };

        $infoParagraph = function($text) use ($pdf) {
            $pdf->SetFont('Arial', '', 11);
            $pdf->MultiCell(0, 6, $text, 0, 'J');
            $pdf->Ln(4);
        };

        // En-tête personnalisé
        if (!empty($cv['photo_path']) && file_exists($cv['photo_path'])) {
            $pdf->Image($cv['photo_path'], 160, 10, 30, 30);
        }

        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(0, 15, 'CURRICULUM VITAE', 0, 1, 'C');
        $pdf->Ln(10);

        // Informations personnelles
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, htmlspecialchars($cv['Prenom'] ?? $cv['prenom'] ?? '') . ' ' . htmlspecialchars($cv['Nom'] ?? $cv['Nom'] ?? ''), 0, 1);

        $pdf->SetFont('Arial', 'I', 14);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->Cell(0, 8, htmlspecialchars($cv['titre_poste'] ?? ''), 0, 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(8);

        // Description
        if (!empty($cv['description'])) {
            $infoParagraph(htmlspecialchars($cv['description'] ?? ''));
            $pdf->Ln(5);
        }

        // Sections du CV
        $sectionTitle('INFORMATIONS DE CONTACT');
        $infoLine('Email', htmlspecialchars($cv['Mail'] ?? $cv['email'] ?? ''));
        $infoLine('Téléphone', htmlspecialchars($cv['phone'] ?? $cv['telephone'] ?? ''));
        $infoLine('Adresse', htmlspecialchars($cv['address'] ?? ''));
        $pdf->Ln(3);

        $sectionTitle('FORMATION');
        $infoLine('Diplôme', htmlspecialchars($cv['diploma_name'] ?? ''));
        $infoLine('Niveau', htmlspecialchars($cv['level'] ?? $cv['experience_level'] ?? ''));
        $pdf->Ln(3);

        $sectionTitle('EXPÉRIENCE PROFESSIONNELLE');
        $infoLine('Années d\'expérience', htmlspecialchars($cv['experience_year'] ?? '') . ' années');

        if (!empty($cv['atout'])) {
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(0, 6, 'Atouts:', 0, 1);
            $pdf->SetFont('Arial', '', 11);
            $pdf->MultiCell(0, 6, htmlspecialchars($cv['atout'] ?? ''), 0, 'L');
            $pdf->Ln(2);
        }
        $pdf->Ln(3);

        $sectionTitle('COMPÉTENCES & LANGUES');
        $infoLine('Langues', htmlspecialchars($cv['languages'] ?? ''));
        $infoLine('Compétences', htmlspecialchars($cv['competance'] ?? 'Conception paysagère, Plantation & Entretien, Gestion de projet'));
        $pdf->Ln(3);

        // Section Avantages
        if (!empty($cv['avantages'])) {
            $sectionTitle('AVANTAGES');
            $infoParagraph(htmlspecialchars($cv['avantages'] ?? ''));
            $pdf->Ln(3);
        }

        $sectionTitle('PRÉTENTIONS SALARIALES & HORAIRES');
        $infoLine('Salaire souhaité', htmlspecialchars($cv['salaire_souhaite'] ?? ''));
        $infoLine('Horaires', htmlspecialchars($cv['horaires'] ?? ''));
        $pdf->Ln(5);

        // Pied de page
        $pdf->SetY(-30);
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->Cell(0, 8, 'Fait le ' . date('d/m/Y'), 0, 1, 'R');
        $pdf->Cell(0, 8, 'Signature', 0, 1, 'R');

        // Numéro de page
        $pdf->SetY(-15);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->SetTextColor(128, 128, 128);
        $pdf->Cell(0, 10, 'Page ' . $pdf->PageNo(), 0, 0, 'C');

        // Générer le PDF
        $filename = 'CV_' . preg_replace('/[^a-zA-Z0-9]/', '_', $cv['Prenom'] ?? $cv['prenom'] ?? '') . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $cv['Nom'] ?? $cv['Nom'] ?? '') . '.pdf';
        $pdf->Output('I', $filename);
        exit;
    }
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

        // Gestion de l'upload de photo
        $photo_path = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/assets/photos/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = uniqid('photo_') . '_' . basename($_FILES['photo']['name']);
            $targetPath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
                $photo_path = 'assets/photos/' . $filename;
            }
        }

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
            $salaire_souhaite,
            $photo_path
        );

        // Redirection après enregistrement
        header("Location: /dashboard/candidate");
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
    public function view() {
        $id = $_GET['id'] ?? null;
        if ($id === null) {
            Flight::render("errors/404");
            return;
        }
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
