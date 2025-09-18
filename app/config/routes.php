<?php
use app\controllers\NotificationController;
use app\controllers\EntretienController;


use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */
/*$router->get('/', function() use ($app) {
	$Welcome_Controller = new WelcomeController($app);
	$app->render('welcome', [ 'message' => 'It works!!' ]);

});*/

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


$router->get('/hello-world/@name', function($name) {
	echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
});
