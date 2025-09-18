<?php

namespace app\controllers;

use app\models\Entretien;
use app\models\Candidat;
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
		$candidats = $candidats->findAllCandidats();


		Flight::render('FormulaireEntretien', [
        'candidats' => $candidats
    ]);
     
    }
public function createEntretien() {
    // Récupérer les données POST classiques
    $idCandidat = $_POST['idCandidat'] ?? null;
    $date_heure_debut = $_POST['date_heure_debut'] ?? null;

    if (!$idCandidat || !$date_heure_debut) {
        echo "<p style='color:red;'>Candidat ou date manquante</p>";
        return;
    }
  $entretienModel = new Entretien(Flight::db());
    // Appeler PlanifierEntretien
    $result = $entretienModel->PlanifierEntretien($idCandidat, $date_heure_debut);

    // Afficher un message
    if ($result['success']) {
        echo "<p style='color:green;'>{$result['message']}</p>";
    } else {
        echo "<p style='color:red;'>{$result['message']}</p>";
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

   
}




