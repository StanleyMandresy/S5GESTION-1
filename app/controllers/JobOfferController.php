<?php
namespace app\controllers;

use app\models\JobOffer;
use app\models\Department;
use app\models\Employee;
use app\models\Diploma;
use app\models\Competance;
use app\models\Candidat;
use Flight;

class JobOfferController {
    public function __construct() {
        // Constructeur vide (même logique que les autres)
    }

    // Liste des offres actives pour candidats
    public function index() {
        $department_id = isset($_GET['department_id']) ? (int)$_GET['department_id'] : 0;
        $departmentModel = new Department(Flight::db());
        $departments = $departmentModel->getAll();
        $competanceModel = new Competance(Flight::db());
        $competances = $competanceModel->getAll();
        $jobOfferModel = new JobOffer(Flight::db());

        if ($department_id > 0) {
            $offers = $jobOfferModel->getByDepartment($department_id);
        } else {
            $offers = $jobOfferModel->getByDepartment(0); // ou une méthode getAll() si elle existe
        }

        Flight::render("joboffer/index", [
            "offers" => $offers,
            "departments" => $departments,
            "selected_department" => $department_id,
            "competances" => $competances
        ]);
    }

    // Liste par département (côté employé ou RH)
    public function listByDept($department_id) {
        $jobOfferModel = new JobOffer(Flight::db());
        $offers = $jobOfferModel->getByDepartment($department_id);
        Flight::render("joboffer/listByDept", ["offers" => $offers]);
    }

    // Formulaire création
    public function createForm() {
        $departmentModel = new Department(Flight::db());
        $departments = $departmentModel->getAll();
        $diplomaModel = new Diploma(Flight::db());
        $diplomas = $diplomaModel->getAll();

        Flight::render("joboffer/create", [
            "departments" => $departments,
            "diplomas" => $diplomas
        ]);
    }

    // Enregistrement nouvelle offre
    public function store() {
        $department_id = (int)$_POST['department_id'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $locations = trim($_POST['locations']);
        $deadline = $_POST['deadline'];
        $diploma_id = (int)$_POST['diploma_id'];
        $level = (int)($_POST['level'] ?? 0);               // Bac+3, Bac+5, etc.
        $experience_year = (int)($_POST['experience_year'] ?? 0); // années d’expérience
        $benefits = trim($_POST['benefits'] ?? '');
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        $jobOfferModel = new JobOffer(Flight::db());
        $jobOfferModel->insertOffer(
            $department_id, $title, $description, $locations, $deadline,
            $diploma_id, $level, $experience_year, $benefits, $is_active
        );

        header("Location: /dashboard/employee");
        exit;
    }


    // Formulaire édition
    public function editForm($id) {
        $jobOfferModel = new JobOffer(Flight::db());
        $offer = $jobOfferModel->getById($id);

        $departmentModel = new Department(Flight::db());
        $departments = $departmentModel->getAll();
        $diplomaModel = new Diploma(Flight::db());
        $diplomas = $diplomaModel->getAll();

        Flight::render("joboffer/edit", [
            "offer" => $offer,
            "departments" => $departments,
            "diplomas" => $diplomas
        ]);
    }

    // Mise à jour
    public function update($id) {
        $data = [
            'department_id' => (int)$_POST['department_id'],
            'title' => trim($_POST['title']),
            'description' => trim($_POST['description']),
            'locations' => trim($_POST['locations']),
            'deadline' => $_POST['deadline'],
            'diploma_id' => (int)$_POST['diploma_id'],
            'experience_level' => trim($_POST['experience_level'] ?? ''),
            'benefits' => trim($_POST['benefits'] ?? ''),
            'is_active' => isset($_POST['is_active']) ? 1 : 0
        ];

        $jobOfferModel = new JobOffer(Flight::db());
        $jobOfferModel->update($id, $data);

        header("Location: /offers");
        exit;
    }

    // Supprimer
    public function destroy($id) {
        $jobOfferModel = new JobOffer(Flight::db());
        $jobOfferModel->delete($id);
        header("Location: /offers");
        exit;
    }

    // Liste des offres à valider (côté RH)
    public function validateList() {
        $jobOfferModel = new JobOffer(Flight::db());
        $offers = $jobOfferModel->getJobOffersNonApproved();

        $userId = $_SESSION['user']['id'];

        // Instancier le modèle Employee ou Department selon ton architecture
        $employeeModel = new Employee(Flight::db());
        $profile = $employeeModel->getProfile($userId);

        // Vérifier si le département de l'employé est RH
        $departmentModel = new Department(Flight::db());
        if ($departmentModel->isRh($profile['department_id'])) {
            // L'utilisateur est RH : on peut continuer
            Flight::render("joboffer/validate", [
                "offers" => $offers
            ]);
        } else {
            // L'utilisateur n'est pas RH : accès interdit
            Flight::redirect("/access-denied"); // ou afficher un message
        }
    }

    public function validate() {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $status = isset($_POST['status']) ? (int)$_POST['status'] : 0;

        if ($id > 0) {
            $jobOfferModel = new JobOffer(Flight::db());
            $result = $jobOfferModel->setApproved($id, $status);

            if ($result > 0) {
                header("Location: /dashboard/employee");
            } else {
                header("Location: /offers?validation=error");
            }
        } else {
            header("Location: /offers?validation=error");
        }
        exit;
    }
    public function result() {
        $candidatModel = new Candidat(Flight::db());
        $candidats = $candidatModel->getCandidatsStade4AvecScores();

        Flight::render('ListeCandidatsStade4', ['candidats' => $candidats]);
    }

    public function triFinal() {

        try {
             $candidatModel = new Candidat(Flight::db());
            $message = $candidatModel->trierEtAvancerCandidatsStade4();

            // ⚡ soit tu affiches un message brut
            // echo $message;

            // ⚡ soit tu rediriges vers la liste avec un flash message
            $_SESSION['flash'] = $message;
            $_SESSION['tri_done'] = true;
            Flight::redirect('/offers/result');
        } catch (\Throwable $th) {
            error_log("Erreur avancerStade4 Controller : " . $th->getMessage());
            Flight::halt(500, "Erreur interne");
        }
    }
    public function embaucherCandidat() {
        try {
            // Récupérer les données POST
            $idCandidat = $_GET['idCandidat'] ?? null;
            $jobOfferId = $_GET['job_offer_id'] ?? null;

            // Validation des données
            if (!$idCandidat || !$jobOfferId) {
                Flight::json([
                    'success' => false,
                    'message' => 'ID candidat et ID offre requis'
                ], 400);
                return;
            }

            // Appeler la méthode du modèle
            $candidatModel = new Candidat(Flight::db());
            $result = $candidatModel->embaucherCandidat($idCandidat, $jobOfferId);

            if ($result['success']) {
                // Succès - redirection ou message JSON
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => $result['message']
                ];

                Flight::json([
                    'success' => true,
                    'message' => $result['message'],
                    'redirect' => '/candidats/list' // ou autre page
                ]);
            } else {
                // Erreur
                Flight::json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }

        } catch (\Exception $e) {
            error_log("Erreur contrôleur embauche: " . $e->getMessage());
            Flight::json([
                'success' => false,
                'message' => 'Erreur interne du serveur'
            ], 500);
        }
    }
}
