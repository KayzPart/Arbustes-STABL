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

$router->map('GET', '/inscription', 'ControllerHumain#inscription');





$match = $router->match();

if($match){
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller; 
   
    if(is_callable(array($obj, $action))){
         call_user_func_array(array($obj, $action), array($match['params']));
    }
} 