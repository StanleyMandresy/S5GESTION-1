<?php

namespace app\controllers;

use app\models\Notification;
use app\models\Candidat;

use Flight;

class NotificationController{

	public function __construct() {

		

	}

  public function getAllCandidats() {

		$candidats =new Candidat(Flight::db());
		$candidats = $candidats->findAllCandidats();


		Flight::render('PageCandidat', [
        'candidats' => $candidats
    ]);
     
    }

public function sendNotification() {
    if (isset($_POST['idCandidat']) && isset($_POST['idType'])) {
        $notification = new Notification(Flight::db());
        $result = $notification->sendNotification($_POST['idCandidat'], $_POST['idType']);

        if ($result) {
            echo "✅ Mail envoyé et notification enregistrée";
        } else {
            echo "❌ Erreur lors de l'envoi du mail";
        }
    }
}

}




