<?php

namespace app\controllers;
use app\models\QCMmodel;

use Flight;

class QCMcontroller{

	public function __construct() {

	}
    public function accueil() {

		$QCMmodel=new QCMmodel(Flight::db());
		$QCMmodel = $QCMmodel->GetQCMDepartement(1);


    // Ajout pour le débogage :
    // echo '<pre>';
    // print_r($QCMmodel);
    // echo '</pre>';
    // exit; // Arrête l'exécution pour ne pas afficher la vue
        Flight::render('QCMmodel',['QCMmodel'=>$QCMmodel]);
    
    }

    public function getReponsesCandidat() {
        $idCandidat = 1; // À récupérer depuis la session ou autre
        $reponsesData = $_POST['reponses'] ?? [];
        
        // Transformez les données
        $reponses = [];
        foreach ($reponsesData as $question_id => $options) {
            foreach ($options as $option_label) {
                $reponses[] = [
                    'idCandidat' => $idCandidat,
                    'question_id' => (int)$question_id,
                    'option_id' => $this->convertOptionLabelToId($option_label) // À implémenter
                ];
            }
        }

        $QCMmodel = new QCMmodel(Flight::db());
        $result = $QCMmodel->ReponsesCandidatBatch($reponses);
        // Pour le débogage
        // echo '<pre>';
        // print_r($reponses);
        // echo '</pre>';
        // exit; // Arrête l'exécution pour ne pas afficher la vue
        Flight::redirect('/MessageDeConfirmation'); // Redirige vers une page de confirmation
    }

    private function convertOptionLabelToId($option_label) {
    $mapping = [
        'A' => 1,
        'B' => 2, 
        'C' => 3,
        'D' => 4,
        'E' => 5
    ];
    
    return $mapping[$option_label] ?? 0;
}
public function MessageDeConfirmation() {
    Flight::render('MessageDeConfirmation');
}
    public function showResults($idCandidat = null) {
    try {
        // Récupérer l'ID du candidat (depuis la session ou paramètre)
        // $idCandidat = $idCandidat ?? $_SESSION['idCandidat'] ?? null;
        $idCandidat =1; // Pour le test
        if (!$idCandidat) {
            throw new Exception("Candidat non identifié");
        }
        
        $QCMmodel = new QCMmodel(Flight::db());
        $results = $QCMmodel->VerifierReponse($idCandidat);
        
        if ($results['success']) {
            // Afficher les résultats
            Flight::render('qcm_results', [
                'score' => $results['score'],
                'max_score' => $results['max_score'],
                'percentage' => $results['percentage'],
                'questions' => $results['questions']
            ]);
        } else {
            throw new Exception($results['message']);
        }
        
    } catch(Exception $e) {
        error_log("Erreur affichage résultats: " . $e->getMessage());
        Flight::render('error', ['message' => $e->getMessage()]);
    }
}
}