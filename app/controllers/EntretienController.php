<?php

namespace app\controllers;

use app\models\Entretien;
use app\models\Candidat;
use app\models\Notification;
use app\models\JobOffer;
use Flight;

class EntretienController{

	public function __construct() {

	}
  public function getEntretiens() {
    $entretienModel = new Entretien(Flight::db());
    $entretiens = $entretienModel->getEntretiens(); // récupère tout

    $events = [];
    foreach ($entretiens as $e) {
        $events[] = [
            'id'    => $e['id'],
            'title' => "Candidat #" . $e['Nom'],
            'start' => $e['start'],
            'end'   => $e['end'],
            'extendedProps' => [
                'note'      => $e['note']
             
            ]
        ];
    }


    header('Content-Type: application/json');
    echo json_encode($events);
}
public function EntretienForm() {
    // Récupérer le département depuis la session
    $department_id =  $_SESSION['idDepartement'] ?? null;

    if (!$department_id) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Département non défini. Veuillez vous reconnecter.'
        ];
        Flight::redirect('/dashboard');
        return;
    }

    $offreModel = new JobOffer(Flight::db());
    $candidatModel = new Candidat(Flight::db());

    // Récupérer les offres actives du département

    // Récupérer TOUS les candidats stade 3 avec leurs job_offer_id
    $allCandidats = $candidatModel->findAllCandidatsStade3();
    // Récupérer les offres actives du département
    $offres = $offreModel->getByDepartment($department_id);

    Flight::render('FormulaireEntretien', [
        'candidats' => $allCandidats , // Pas de candidats au début
        'offres' => $offres,
        'department_id' => $department_id
    ]);
}
public function updateEntretien() {
    // Récupérer le JSON envoyé par fetch()
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode(['success' => false, 'message' => 'ID manquant']);
        return;
    }

    $id = $data['id'];
    $note = $data['note'] ?? null;
    $remarques = $data['remarques'] ?? null;
    $presence = $data['presence'] ?? null;

    $entretienModel = new Entretien(Flight::db());
    $result = $entretienModel->updateEntretien($id, $note, $remarques, $presence);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Entretien mis à jour']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour']);
    }
}
public function createEntretien() {
    // Récupérer les données POST
    $idCandidat = $_POST['idCandidat'] ?? null;
    $job_offer_id = $_POST['job_offer_id'] ?? null;
    $date_heure_debut = $_POST['date_heure_debut'] ?? null;
    $duree = $_POST['duree'] ?? 45;
    $type_entretien = $_POST['type_entretien'] ?? 'presentiel';

    // Validation des données
    if (!$idCandidat || !$job_offer_id || !$date_heure_debut) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Données manquantes: candidat, offre ou date'
        ];
        Flight::redirect('/entretien/form');
        return;
    }

    $entretienModel = new Entretien(Flight::db());
    $planification = $entretienModel->PlanifierEntretien(
        $idCandidat,
        $date_heure_debut,
        $job_offer_id,
        $duree,
        $type_entretien
    );

    if ($planification['success']) {
        // Envoyer la notification seulement si l'entretien est planifié avec succès
        $notification = new Notification(Flight::db());

        // Formater la date pour l'affichage
        $dateFormatee = date('d/m/Y à H:i', strtotime($date_heure_debut));
        $notificationSent = $notification->sendNotification($idCandidat, "entretien", $dateFormatee);



        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => $planification['message'] . ($notificationSent ? ' et notification envoyée' : ' mais notification échouée')
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => $planification['message']
        ];
    }

    Flight::redirect('/entretien/calendrier');
}
public function ListeCandidatsStade3() {
    $candidats = new Candidat(Flight::db());
    $candidats = $candidats->findAllCandidatsStade3AvecEntretien();

    Flight::render('ListeCandidatsStade3', [
        'candidats' => $candidats
    ]);
}
public function updateNoteRh() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $idEntretien = $_POST['save']; // vient du bouton
        $noteRH = $_POST['notes'][$idEntretien] ?? null;

        if ($noteRH !== null) {
            $entretienModel = new Entretien(Flight::db());
            $success = $entretienModel->updateNotesRH($idEntretien, $noteRH);

            if ($success) {
                echo "<p style='color:green;'>Note mise à jour avec succès.</p>";
            } else {
                echo "<p style='color:red;'>Erreur lors de la mise à jour.</p>";
            }
        } else {
            echo "<p style='color:red;'>Note manquante.</p>";
        }
    }
}

   
}




