<?php
class ModelScore extends Connect{
    // Insertion après sélection depuis l'homepage
    public function insertScore($datas){
        if(isset($_POST['submit'])){
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

            $newScore = [];
            while($sc = $score->fetch(PDO::FETCH_ASSOC)){
                $newScore[] = new Score_stabl($sc);
            }
            return $newScore;
        }
    }

    // Récupération de la table séléctionner 
    public function selectScore($id){
        $db = $this->getDb();
        $selectScore = $db->prepare('SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores` WHERE `score_id` = :id');
        $selectScore->bindParam(':id', $id, PDO::PARAM_INT);
        $selectScore->execute();
        $score = [];
        while($data = $selectScore->fetch(PDO::FETCH_ASSOC)){
            $score[] = new Score_stabl($data);
        }
        return $score;
    }

    // Envoie du score une fois compter et valider 
    public function updateScore($id, $resultScore){
        // $id = $_GET['score_id'];
            $resultScore = $_GET['resultScore'];
        $db = $this->getDb();
        $updateScore = $db->prepare('UPDATE `scores` SET `score_valeur`= :resultScore WHERE `score_id` = :id');
        $updateScore->bindParam('id', $id, PDO::PARAM_INT);
        $updateScore->bindParam('score_valeur', $resultScore, PDO::PARAM_STR);
        $updateScore->execute();
        $newScore = [];
        while($score = $updateScore->fetch(PDO::FETCH_ASSOC)){
            $newScore[] = new Score_stabl($score);
        }
        return $newScore;

    }
}