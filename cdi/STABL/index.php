<?php 
$dir_rel="../../";
$dir_cdi="../";
$fichier="index.php";
include($dir_rel.'_init.php');

if (isset($_SESSION['outil_retour'])) $retour=$_SESSION['outil_retour']; else if (isset($_SESSION['retour_page'])) $retour=$_SESSION['retour_page']; else $retour='outil.php';
$_SESSION['outil_id'] = trouve_outil_id($_SERVER["PHP_SELF"]);


require_once __DIR__ . '/../vendor/autoload.php';
require_once  __DIR__ .'/../vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath($dossier_server_path.'/cdi/'.$_SESSION['outil_id']);

if(!isset($_SESSION['humain']['humain_id'])){
    // Routes
$router->map('GET', '/', 'ControllerHumain#checked', '/');

$router->map('GET', '/connexion', 'ControllerHumain#connexion');

// $router->map('POST', '/returnConnect', 'ControllerHumain#inscription');

$router->map('GET|POST', '/inscription', 'ControllerHumain#formInscription', 'newUse');

// Vérification de la connexion
$router->map('POST', '/verifConnect', 'ControllerHumain#verifConnexion');

$router->map('GET', '/choice', 'ControllerScore#insertScoreHumain');
$router->map('GET', '/table', 'ControllerScore#jeuTable');
} else {
    // Redirection après connexion
    $router->map('GET', '/homepage', 'ControllerHumain#redirectionEspace');
}






$match = $router->match();

if($match){
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller; 
   
    if(is_callable(array($obj, $action))){
         call_user_func_array(array($obj, $action), array($match['params']));
    }
} 