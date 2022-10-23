<?php
global $bdd;
 try {
    $bdd = new PDO("mysql:host=localhost;dbname=stage_stabl;charset=UTF8", 'root', '');
} catch (PDOException $e) {
    echo 'Erreur de connection' . '<br>' . $e->getMessage();
}

$req = $bdd->query('SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores` ORDER BY `score_id` DESC LIMIT 0,1');

echo json_encode($v = $req->fetchAll(PDO::FETCH_ASSOC));