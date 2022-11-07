<?php
global $bdd;
 try {
    $bdd = new PDO("mysql:host=localhost;dbname=stage_stabl;charset=UTF8", 'root', '');
} catch (PDOException $e) {
    echo 'Erreur de connection' . '<br>' . $e->getMessage();
}
$datas = $_POST;
    $selectTable = $datas['selectTable'];
    $result = $bdd->query("SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores` WHERE `score_param1` LIKE $selectTable");
    $count = $result->fetchColumn();
    var_dump($count);
    var_dump($_POST['submit']);

    if($count == 0){
        $scoreActif = 1;
        $scoreDate = date('Y-m-d');
        $db = $this->getDb();
        $score = $db->prepare('INSERT INTO `scores`(`score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date`) VALUES (:scoreValeur, :scoreOutilId,  :id, :selectTable, :order, :help, :scoreActif, :scoreDate)');
        $score->bindParam(':scoreValeur', $datas['scoreValeur'], PDO::PARAM_STR);
        $score->bindParam(':scoreOutilId', $datas['scoreOutilId'], PDO::PARAM_INT);
        $score->bindParam(':id', $datas['id'], PDO::PARAM_INT);
        $score->bindParam(':selectTable', $datas['selectTable'], PDO::PARAM_INT);
        $score->bindParam(':order', $datas['order'], PDO::PARAM_INT);
        $score->bindParam(':help', $datas['help'], PDO::PARAM_INT);
        $score->bindParam(':scoreActif', $scoreActif, PDO::PARAM_INT);
        $score->bindParam(':scoreDate', $scoreDate, PDO::PARAM_STR);
        $score->execute();
    } else if ($count === $count){
        $newDate = date('Y-m-d');
        $db = $this->getDb();
        $updateScore = $db->prepare('UPDATE `scores` SET `score_valeur`= :scoreValeur, `score_date` = :newDate WHERE `score_id` = :id');
        $updateScore->bindParam('id', $count, PDO::PARAM_INT);
        $updateScore->bindParam('scoreValeur', $datas['scoreValeur'], PDO::PARAM_STR);
        $updateScore->bindParam('newDate', $newDate, PDO::PARAM_STR);
        $updateScore->execute();
        var_dump($count);
    }
    
    $newScore = [];
    while($sc = $result->fetch(PDO::FETCH_ASSOC)){
        $newScore[] = new Score_stabl($sc);
        var_dump($newScore);
    }
    return $newScore;


$req = $bdd->query('SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores` WHERE `score_id`');

echo json_encode($v = $req->fetchAll(PDO::FETCH_ASSOC));