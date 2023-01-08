<?php
class ModelScore extends Connect{
    // Insertion après sélection depuis l'homepage
    public function insertScore($donnees){
            $order = $donnees['order'];
            $help = $donnees['help'];
            $selectTable = $donnees['nombreSelectionner'];
            $scoreValeur = $donnees['resultScore'];
            $outil = $donnees['outil'];
            $id = $donnees['id'];

            $db = $this->getDb();
            $result = $db->query("SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores` WHERE (`score_param1` LIKE $selectTable) AND (`score_param2` LIKE $order) AND (`score_param3` LIKE $help)");
            $count = $result->fetchColumn();
            

            if($count == 0){
                $scoreActif = 1;
                $scoreDate = date('Y-m-d');
                $db = $this->getDb();
                $score = $db->prepare('INSERT INTO `scores`(`score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date`) VALUES (:scoreValeur, :scoreOutilId,  :id, :selectTable, :order, :help, :scoreActif, :scoreDate)');
                $score->bindParam(':scoreValeur', $scoreValeur, PDO::PARAM_STR);
                $score->bindParam(':scoreOutilId', $outil, PDO::PARAM_INT);
                $score->bindParam(':id', $id, PDO::PARAM_INT);
                $score->bindParam(':selectTable', $selectTable, PDO::PARAM_INT);
                $score->bindParam(':order', $order, PDO::PARAM_INT);
                $score->bindParam(':help', $help, PDO::PARAM_INT);
                $score->bindParam(':scoreActif', $scoreActif, PDO::PARAM_INT);
                $score->bindParam(':scoreDate', $scoreDate, PDO::PARAM_STR);
                $score->execute();
            } else if ($count === $count){

                $newDate = date('Y-m-d');
                $db = $this->getDb();

                $updateScore = $db->prepare('UPDATE `scores` SET `score_valeur`= :scoreValeur, `score_date` = :newDate WHERE `score_id` = :id');
                $updateScore->bindParam('id', $count, PDO::PARAM_INT);
                $updateScore->bindParam('scoreValeur', $scoreValeur, PDO::PARAM_STR);
                $updateScore->bindParam('newDate', $newDate, PDO::PARAM_STR);
                $updateScore->execute();
                var_dump($scoreValeur);
                var_dump($count);
            }
            
            $newScore = [];
            while($sc = $result->fetch(PDO::FETCH_ASSOC)){
                $newScore[] = new Score_stabl($sc);
                var_dump($newScore);
            }
            return $newScore;
        
    }

    // Récupération de la table séléctionner 
    public function tableScore(){
        $db = $this->getDb();
        $selectTableScore = $db->query('SELECT `score_param1`, `score_valeur` FROM `scores` WHERE `score_id`');
        $score = [];
        while($data = $selectTableScore->fetch(PDO::FETCH_ASSOC)){
            $score[] = new Score_stabl($data);
        }
        return $score;
    }

    public function readScore(){
        
        $db = $this->getDb();
        $selectScore = $db->query("SELECT `score_id`, `score_valeur`,`score_param1` FROM `scores` WHERE `score_param1`");
        // $selectScore->bindParam(':scoreParam1', $scoreParam1, PDO::PARAM_INT);
        // $score = [];
        while($data = $selectScore->fetch(PDO::FETCH_ASSOC)){
            $score[] = new Score_stabl($data);
        }
        return $score;
    }
}