<?php


use flight\Engine;
use flight\net\Router;

use app\controllers\QCMcontroller;
use app\controllers\NotificationController;
use app\controllers\EntretienController;
use app\controllers\AuthController;
use app\controllers\CandidateController;
use app\controllers\EmployeeController;
use app\controllers\JobOfferController;
use app\controllers\CandidateCvController;


$Auth_Controller = new AuthController();

$Employee_Controller = new EmployeeController();


/** 
 * @var Router $router 
 * @var Engine $app
 */
// $router->get('/', function() use ($app) {
// 	$Welcome_Controller = new WelcomeController($app);
// 	$app->render('welcome', [ 'message' => 'It works!!' ]);

// });

$Candidate_Controller = new CandidateController();


Flight::route('GET /login', [$Auth_Controller, 'loginPage']);

// Traitement du login (form POST)
Flight::route('POST /login', [$Auth_Controller, 'login']);

// Page d’accueil redirige vers /login
Flight::route('GET /', function() {
    Flight::redirect('/login');
});

// Page d’inscription (affichage du formulaire)
Flight::route('GET /register', [$Auth_Controller, 'registerPage']);

// Traitement de l’inscription (form POST)
Flight::route('POST /register', [$Auth_Controller, 'register']);

// Déconnexion
Flight::route('GET /logout', [$Auth_Controller, 'logout']);



// Dashboard candidat
Flight::route('GET /dashboard/candidate', [$Candidate_Controller, 'dashboard']);

// Postuler à une offre d'emploi
Flight::route('POST /candidate/apply', [$Candidate_Controller, 'applyJob']);

// Télécharger un document ou CV
Flight::route('GET /candidate/download/@docId', [$Candidate_Controller, 'downloadDocument']);

Flight::route('GET /dashboard/employee', [$Employee_Controller, 'dashboard']);


$jobOffer_Controller = new JobOfferController();
$router->get('/offers', [$jobOffer_Controller, 'index']);               // liste offres actives (candidat)
$router->get('/offers/dept', [$jobOffer_Controller, 'listByDept']);    // liste par département (RH / employé)

$router->get('/offers/create', [$jobOffer_Controller, 'createForm']);  // formulaire création
$router->post('/offers/create', [$jobOffer_Controller, 'store']);       // enregistrer nouvelle offre

$router->get('/offers/validate', [$jobOffer_Controller, 'validateList']);
$router->post('/offers/validate', [$jobOffer_Controller, 'validate']);


$candidateCv_Controller = new CandidateCvController();
$router->post('/cv/form', [$candidateCv_Controller, 'formPage']);        //
$router->post('/cv/submit', [$candidateCv_Controller, 'submit']);       // soumission CV
$router->get('/cv/job/@id', [$candidateCv_Controller, 'CV']);              // voir mes CVs
$router->get('/cv/view', [$candidateCv_Controller, 'view']);              // voir un CV
$router->get('/cv/edit', [$candidateCv_Controller, 'editForm']);          // modifier CV
$router->post('/cv/update', [$candidateCv_Controller, 'update']);        //
$router->get('/cv/delete', [$candidateCv_Controller, 'destroy']);
$router->post('/cv/trier', [$candidateCv_Controller, 'trier']);
$router->get('/cv/exportpdf', [$candidateCv_Controller, 'exportPdf']); // export PDF CV


$QCMcontroller = new QCMcontroller();
$router->get('/qcm/@id', [$QCMcontroller, 'accueil']);
$router->post('/EnregistrerReponse',[$QCMcontroller,'getReponsesCandidat']);
$router->get('/showResults', [$QCMcontroller, 'showResults']);
$router->get('/MessageDeConfirmation',[$QCMcontroller,'MessageDeConfirmation']);

$NotificationController = new NotificationController();
$router->get('/Notification', [$NotificationController, 'getAllCandidats']); 
$router->post('/Notification', [$NotificationController, 'sendNotification']); 

Flight::route('/entretien/calendrier', function() {
    Flight::render('CalendrierEntretien'); // page x.php
});

 $EntretienController = new EntretienController();
 $router->get('/entretien/getEntretiens', [$EntretienController, 'getEntretiens']); 
$router->get('/entretien/formulaire', [$EntretienController, 'EntretienForm']); 
$router->post('/entretien/create', [$EntretienController, 'createEntretien']); 
$router->post('/entretien/update', [$EntretienController, 'updateEntretien']);
$router->get('/entretien/listeEntretien', [$EntretienController, 'ListeCandidatsStade3']);

$router->post('/entretien/updateNoteRH', function() {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'] ?? null;
    $note = $data['noteRH'] ?? null;

    if ($id && $note !== null) {
        $entretien = new Entretien(Flight::db());
        $ok = $entretien->updateNotesRH($id, $note);
        echo json_encode([
            'success' => $ok,
            'message' => $ok ? "Note mise à jour ✅" : "Erreur lors de la mise à jour ❌"
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
    }
});


$router->get('/hello-world/@name', function($name) {
	echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
});
