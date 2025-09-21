<?php
namespace app\controllers;

use Flight;
use app\models\Employee;
use app\models\JobOffer;
use app\models\Department;
class EmployeeController {


    public function __construct() {

    }

    // Dashboard principal
    public function dashboard() {
        $employeeModel = new Employee(Flight::db());
        $jobOfferModel = new JobOffer(Flight::db()); // modèle pour job_offers
         $departementModel = new Department(Flight::db());
        $userId = $_SESSION['user']['id'];

        // Profil de l'employé
        $profile = $employeeModel->getProfile($userId);

        // Vérifier que le profil existe
        if ($profile) {
            // Récupérer les offres du même département
            $jobOffers = $jobOfferModel->getByDepartment($profile['department_id']);
            $Rh=$departementModel->isRh($profile['department_id']);


        } else {
            $jobOffers = [];
        }

        // Rendu de la vue
        Flight::render('dashboard_employee', [
            'profile'   => $profile,
            'jobOffers' => $jobOffers,
            'Rh'=> $Rh
        ]);
    }



}
