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
      $jobOfferModel  = new JobOffer(Flight::db());
      $userId         = $_SESSION['user']['id'];

      $profile   = $candidateModel->getProfile($userId);
      $jobOffers = $jobOfferModel->getJobOffers();


      // Vérifier si le candidat a postulé à chaque offre et récupérer le stade
      foreach ($jobOffers as &$offer) {
          $offer['applied'] = $candidateModel->hasApplied($profile['id'], $offer['id']);
          $offer['stade']   = $candidateModel->getStadeCandidat($profile['id'], $offer['id']);
      }
      unset($offer); // bonne pratique après référence

      Flight::render('dashboard_candidate', [
          'profile'   => $profile,
          'jobOffers' => $jobOffers,
      ]);
  }

}

