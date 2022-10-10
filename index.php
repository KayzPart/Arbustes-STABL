<?php 
require_once __DIR__ . '/vendor/autoload.php';
require_once  __DIR__ .'/AltoRouter.php';

// var_dump($_GET);
// On sépare les paramètres
// $params = explode('/', $_GET['p']);
// var_dump($params);



define('ROOT', '/Arbustes-appli');

// Création d'une instance de AltoRouter
$router = new AltoRouter();

$router->setBasePath(ROOT);

// Routes
$router->map('GET', '/', 'ControllerHumain#checked', '/');

$router->map('GET', '/connexion', 'ControllerHumain#connexion');

// $router->map('POST', '/returnConnect', 'ControllerHumain#inscription');

$router->map('GET|POST', '/inscription', 'ControllerHumain#formInscription', 'newUse');

// Vérification de la connexion
$router->map('POST', '/verifConnect', 'ControllerHumain#verifConnexion');

// Redirection après connexion
$router->map('GET', '/homepage', 'ControllerHumain#redirectionEspace');

$router->map('GET', '/choice', 'ControllerScore#insertScoreHumain');





$match = $router->match();

if($match){
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller; 
   
    if(is_callable(array($obj, $action))){
         call_user_func_array(array($obj, $action), array($match['params']));
    }
} 