<?php

namespace app\controllers;
use app\models\QCMmodel;

use Flight;

class QCMcontroller{

	public function __construct() {

	}
    public function accueil($departement_id) {

		$QCMmodel=new QCMmodel(Flight::db());
		$QCMmodel = $QCMmodel->GetQCMDepartement($departement_id);//$_SESSION['idCandidat'] ??


    // Ajout pour le débogage :
    // echo '<pre>';
    // print_r($QCMmodel);
    // echo '</pre>';
    // exit; // Arrête l'exécution pour ne pas afficher la vue
        Flight::render('QCMmodel',['QCMmodel'=>$QCMmodel]);
    
    }

    public function getReponsesCandidat() {
        $idCandidat = 3; //$_SESSION['idCandidat'] ??
        $reponsesData = $_POST['reponses'] ?? [];
        $reponses = [];
        foreach ($reponsesData as $question_id => $options) {
            foreach ($options as $option_id) {
                $reponses[] = [
                    'idCandidat' => $idCandidat,
                    'question_id' => (int)$question_id,
                    'option_id' => (int)$option_id // Assurez-vous que option_label est l'ID correct
                ];
            }
        }
        $QCMmodel = new QCMmodel(Flight::db());
        $result = $QCMmodel->ReponsesCandidatBatch($reponses);
        // Stocker les réponses en session pour calcul du score
        $_SESSION['reponses_candidat'] = $reponses;
        $_SESSION['idCandidat'] = $idCandidat;
        Flight::redirect('/MessageDeConfirmation');
    }

    public function showResults() {
    $idCandidat =  3;//$_SESSION['idCandidat'] ??
    $QCMmodel = new QCMmodel(Flight::db());
    $score = $QCMmodel->MikotyPointCandidatFromDB($idCandidat);
    Flight::render('qcm_results', ['score' => $score, 'idCandidat' => $idCandidat]);
    }

    
public function MessageDeConfirmation() {
    Flight::render('MessageDeConfirmation');
}
    
}
