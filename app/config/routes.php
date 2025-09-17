<?php
use flight\Engine;
use flight\net\Router;
use app\controllers\QCMcontroller;
//use Flight;

/** 
 * @var Router $router 
 * @var Engine $app
 */
// $router->get('/', function() use ($app) {
// 	$Welcome_Controller = new WelcomeController($app);
// 	$app->render('welcome', [ 'message' => 'It works!!' ]);

// });

$QCMcontroller = new QCMcontroller();
$router->get('/qcm', [$QCMcontroller, 'accueil']);
$router->post('/EnregistrerReponse',[$QCMcontroller,'getReponsesCandidat']);
$router->get('/showResults', [$QCMcontroller, 'showResults']);
$router->get('/MessageDeConfirmation',[$QCMcontroller,'MessageDeConfirmation']);


$router->get('/hello-world/@name', function($name) {
	echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
});
