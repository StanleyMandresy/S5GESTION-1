<?php
namespace app\controllers;
require_once(__DIR__ . '/../../../vendor/autoload.php');

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

        // Générer le HTML du CV avec un design inspiré de la vue
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>CV PDF</title>';
        $html .= '<style>
            body { font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif; background: #DCDED6; }
            .container { max-width: 800px; margin: 0 auto; background: #fff; border-radius: 20px; box-shadow: 0 8px 24px rgba(93,114,111,0.15); overflow: hidden; }
            .header { background: #859393; color: #fff; padding: 30px 40px; border-radius: 20px 20px 0 0; }
            .profile-img { width: 120px; height: 120px; border-radius: 50%; border: 5px solid #CED0C3; object-fit: cover; box-shadow: 0 8px 16px rgba(93,114,111,0.3); float: left; margin-right: 30px; }
            .title { font-size: 2em; font-weight: bold; margin-bottom: 10px; }
            .subtitle { font-size: 1.2em; color: #DCDED6; margin-bottom: 10px; }
            .section { margin: 30px 40px; }
            .section-title { font-size: 1.3em; color: #5D726F; font-weight: bold; margin-bottom: 10px; border-bottom: 2px solid #CED0C3; padding-bottom: 5px; }
            .info { margin-bottom: 8px; }
            .footer { background: #B4BAB1; color: #fff; text-align: center; padding: 18px; border-radius: 0 0 20px 20px; font-size: 1em; }
            .label { color: #859393; font-weight: bold; }
        </style></head><body>';
        $html .= '<div class="container">';
        $html .= '<div class="header">';
        if (!empty($cv['photo_path'])) {
            $html .= '<img class="profile-img" src="'.(isset($cv['photo_path']) ? $_SERVER['DOCUMENT_ROOT'].'/'.$cv['photo_path'] : '').'" alt="Photo">';
        }
        $html .= '<div style="margin-left:'.(!empty($cv['photo_path']) ? '160px' : '0').';min-height:120px;">';
        $html .= '<div class="title">'.htmlspecialchars($cv['Prenom'] ?? $cv['prenom'] ?? '').' '.htmlspecialchars($cv['Nom'] ?? $cv['Nom'] ?? '').'</div>';
        $html .= '<div class="subtitle">'.htmlspecialchars($cv['titre_poste'] ?? '').'</div>';
        $html .= '<div class="info">'.htmlspecialchars($cv['description'] ?? '').'</div>';
        $html .= '</div></div>';

        $html .= '<div class="section"><div class="section-title">Contact</div>';
        $html .= '<div class="info"><span class="label">Email:</span> '.htmlspecialchars($cv['Mail'] ?? $cv['email'] ?? '').'</div>';
        $html .= '<div class="info"><span class="label">Téléphone:</span> '.htmlspecialchars($cv['phone'] ?? $cv['telephone'] ?? '').'</div>';
        $html .= '<div class="info"><span class="label">Adresse:</span> '.htmlspecialchars($cv['address'] ?? '').'</div>';
        $html .= '</div>';

        $html .= '<div class="section"><div class="section-title">Formation</div>';
        $html .= '<div class="info"><span class="label">Diplôme:</span> '.htmlspecialchars($cv['diploma_name'] ?? '').'</div>';
        $html .= '<div class="info"><span class="label">Niveau:</span> '.htmlspecialchars($cv['level'] ?? $cv['experience_level'] ?? '').'</div>';
        $html .= '</div>';

        $html .= '<div class="section"><div class="section-title">Expérience Professionnelle</div>';
        $html .= '<div class="info"><span class="label">Expérience:</span> '.htmlspecialchars($cv['experience_year'] ?? '').' années</div>';
        $html .= '<div class="info">'.htmlspecialchars($cv['atout'] ?? '').'</div>';
        $html .= '</div>';

        $html .= '<div class="section"><div class="section-title">Compétences & Langues</div>';
        $html .= '<div class="info"><span class="label">Langues:</span> '.htmlspecialchars($cv['languages'] ?? '').'</div>';
        $html .= '<div class="info"><span class="label">Compétences:</span> '.htmlspecialchars($cv['competance'] ?? 'Conception paysagère, Plantation & Entretien, Gestion de projet').'</div>';
        $html .= '</div>';

        $html .= '<div class="section"><div class="section-title">Avantages</div>';
        $html .= '<div class="info">'.htmlspecialchars($cv['avantages'] ?? '').'</div>';
        $html .= '</div>';

        $html .= '<div class="section"><div class="section-title">Salaire souhaité & Horaires</div>';
        $html .= '<div class="info"><span class="label">Salaire souhaité:</span> '.htmlspecialchars($cv['salaire_souhaite'] ?? '').'</div>';
        $html .= '<div class="info"><span class="label">Horaires:</span> '.htmlspecialchars($cv['horaires'] ?? '').'</div>';
        $html .= '</div>';

        $html .= '<div class="footer">'.htmlspecialchars($cv['Prenom'] ?? $cv['prenom'] ?? '').' '.htmlspecialchars($cv['Nom'] ?? $cv['Nom'] ?? '').' - Paysagiste Passionné</div>';
        $html .= '</div></body></html>';

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('cv.pdf', 'I'); // Affiche dans le navigateur
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
