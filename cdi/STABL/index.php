<?php
$dir_rel = "../../";
$dir_cdi = "../";
$fichier = "index.php";
include($dir_rel . '_init.php');

if (isset($_SESSION['outil_retour'])) $retour = $_SESSION['outil_retour'];
else if (isset($_SESSION['retour_page'])) $retour = $_SESSION['retour_page'];
else $retour = 'outil.php';
$_SESSION['outil_id'] = trouve_outil_id($_SERVER["PHP_SELF"]);


require_once __DIR__ . '/../vendor/autoload.php';
require_once  __DIR__ . '/../vendor/altorouter/altorouter/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath($dossier_server_path . '/cdi/' . $_SESSION['outil_id']);

// Routes
// if (!isset($_SESSION['humain']['humain_id'])) {
//     $router->map('GET', '/', 'ControllerHumain#checked', '/');
//     $router->map('GET', '/connexion', 'ControllerHumain#connexion');
//     // $router->map('POST', '/returnConnect', 'ControllerHumain#inscription');
//     $router->map('GET|POST', '/inscription', 'ControllerHumain#formInscription', 'newUse');
//     // Vérification de la connexion
//     $router->map('POST', '/verifConnect', 'ControllerHumain#verifConnexion');
// }
// else{
//     $router->map('GET', '/', 'ControllerHumain#redirectionEspace', '/');
// }
$router->map('GET|POST', '/', 'ControllerHumain#redirectionEspace');
$router->map('GET|POST', '/table', 'ControllerTable#jeuTable');
$router->map('POST', '/insert', 'ControllerScore#insertScoreHumain');
$router->map('GET', '/score/[i:score_id]','ControllerScore#scoreSelect', 'score');
$router->map('GET|POST', '/update/[i:score_id]', 'ControllerScore#updateScore');
$router->map('GET|POST', '/update', 'ControllerScore#redirectionAfterUpdate');

$match = $router->match();

if ($match) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller;

    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), array($match['params']));
    }
}
