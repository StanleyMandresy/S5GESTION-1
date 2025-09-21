<?php

namespace app\controllers;

use Flight;
use app\models\Candidat;
use app\models\JobOffer;

class CandidateController {


    public function __construct() {

    }

    // Dashboard principal du candidat
    public function dashboard() {
        $candidateModel = new Candidat(Flight::db());
        $jobOfferModel = new JobOffer(Flight::db());
        $userId = $_SESSION['user']['id'];

        $profile       = $candidateModel->getProfile($userId);
        $jobOffers     = $jobOfferModel->getJobOffers();
        $applications  = 0;
        $assignedQCMs  = 0;
        $interviews    = 0;


        Flight::render('dashboard_candidate', [
            'profile'       => $profile,

            'jobOffers'     => $jobOffers,
            'applications'  => $applications,
            'assignedQCMs'  => $assignedQCMs,
            'interviews'    => $interviews,

        ]);
    }


}
