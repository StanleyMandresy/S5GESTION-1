<?php

namespace app\controllers;

use app\models\Entretien;
use app\models\Candidat;
use app\models\Notification;
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

		$candidats =new Candidat(Flight::db());
		  $candidats = $candidats->findAllCandidatsStade3();


		Flight::render('FormulaireEntretien', [
        'candidats' => $candidats
    ]);
     
    }
public function createEntretien() {
    // Récupérer les données POST
    var_dump($_POST);

    $idCandidat = $_POST['idCandidat'] ?? null;
    $date_heure_debut = $_POST['date_heure_debut'] ?? null;

    if (!$idCandidat || !$date_heure_debut) {
        echo "<p style='color:red;'>Candidat ou date manquante</p>";
        return;
    }

    $entretienModel = new Entretien(Flight::db());
    $planification = $entretienModel->PlanifierEntretien($idCandidat, $date_heure_debut);

    $notification = new Notification(Flight::db());
    $notificationSent = $notification->sendNotification($idCandidat, "entretien", $date_heure_debut);

    // Afficher un message
    if ($planification && $notificationSent) {
        echo "<p style='color:green;'>Entretien planifié et notification envoyée avec succès.</p>";
    } elseif ($planification) {
        echo "<p style='color:orange;'>Entretien planifié mais la notification a échoué.</p>";
    } else {
        echo "<p style='color:red;'>Erreur lors de la planification de l'entretien.</p>";
    }
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




