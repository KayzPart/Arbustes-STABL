<?php
class ModelScore extends Connect{
    // Insertion après sélection depuis l'homepage
    public function insertScore($datas){
        if(isset($_POST['submit'])){
            $selectTable = $datas['selectTable'];
            $order = $datas['order'];
            $help = $datas['help'];
            $db = $this->getDb();
            $result = $db->query("SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores` WHERE (`score_param1` LIKE $selectTable) AND (`score_param2` LIKE $order) AND (`score_param3` LIKE $help)");
            // $result->bindParam('score_param1', $selectTable, PDO::PARAM_INT);
            // $result->bindParam('score_param2', $order, PDO::PARAM_INT);
            // $result->bindParam('score_param3', $help, PDO::PARAM_INT);
            // $result->execute();
            // var_dump($result);
            $count = $result->fetchColumn();
            var_dump($count);
            // var_dump($order);
            // var_dump($help);
            // var_dump($selectTable);
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
        }
    }

    // Récupération de la table séléctionner 
    public function selectAllScore(){
        $db = $this->getDb();
        $selectScore = $db->query("SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores`");
        $score = [];
        while($data = $selectScore->fetch(PDO::FETCH_ASSOC)){
            $score[] = new Score_stabl($data);
        }
        return $score;
    }

    public function readScore($id){
        $db = $this->getDb();
        $readScore = $db->prepare('SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores` WHERE `score_id` = :id');
        $readScore->bindParam(':id', $id['score_id'], PDO::PARAM_INT);
        $readScore->execute();
        $datasScore = $readScore->fetch(PDO::FETCH_ASSOC);
        $score = new Score_stabl($datasScore);
        return $score;
    }
}