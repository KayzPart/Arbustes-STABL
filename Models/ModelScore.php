<?php
class ModelScore extends Connect{
    public function insertScore($datas){
        if(isset($_GET['submit'])){
            $db = $this->getDb();
            $score = $db->prepare('INSERT INTO `scores`(`score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`) VALUES (:scoreValeur, :scoreOutilId,  :id, :scoreParam1, :scoreParam2, :scoreParam3)');
            $score->bindParam(':scoreValeur', $datas['scoreValeur'], PDO::PARAM_INT);
            $score->bindParam(':scoreOutilId', $datas['scoreOutilId'], PDO::PARAM_INT);
            $score->bindParam(':id', $datas['id'], PDO::PARAM_INT);
            $score->bindParam(':scoreParam1', $datas['scoreParam1'], PDO::PARAM_INT);
            $score->bindParam(':scoreParam2', $datas['scoreParam2'], PDO::PARAM_INT);
            $score->bindParam(':scoreParam3', $datas['scoreParam3'], PDO::PARAM_INT);
        }
    }
}