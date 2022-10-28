<?php
class ModelScore extends Connect{
    // Insertion après sélection depuis l'homepage
    public function insertScore($datas){
        if(isset($_GET['submit'])){
            $scoreActif = 1;
            $scoreDate = date('Y-m-d');
            $db = $this->getDb();
            $score = $db->prepare('INSERT INTO `scores`(`score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date`) VALUES (:scoreValeur, :scoreOutilId,  :id, :scoreParam1, :scoreParam2, :scoreParam3, :scoreActif, :scoreDate)');
            $score->bindParam(':scoreValeur', $datas['scoreValeur'], PDO::PARAM_STR);
            $score->bindParam(':scoreOutilId', $datas['scoreOutilId'], PDO::PARAM_INT);
            $score->bindParam(':id', $datas['id'], PDO::PARAM_INT);
            $score->bindParam(':scoreParam1', $datas['scoreParam1'], PDO::PARAM_INT);
            $score->bindParam(':scoreParam2', $datas['scoreParam2'], PDO::PARAM_INT);
            $score->bindParam(':scoreParam3', $datas['scoreParam3'], PDO::PARAM_INT);
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
    public function selectScore(){
        $db = $this->getDb();
        $selectScore = $db->query('SELECT `score_id`, `score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date` FROM `scores` ORDER  BY `score_id` DESC LIMIT 0,1');
        $data = $selectScore->fetch(PDO::FETCH_ASSOC);
        $score = new Score_stabl($data);
        return $score;

        // echo json_encode($selectScore->fetchAll(PDO::FETCH_ASSOC));
    }

    // Envoie du score une fois compter et valider 
    public function updateScore($id, $score_valeur){
        $id = $_GET['score_id'];
            $scoreValeur = $_GET['score_valeur'];
        $db = $this->getDb();
        $updateScore = $db->prepare('UPDATE `scores` SET `score_valeur`= :score_valeur WHERE `score_id` = :id');
        $updateScore->bindParam('id', $id, PDO::PARAM_INT);
        $updateScore->bindParam('score_valeur', $score_valeur, PDO::PARAM_STR);
        $updateScore->execute();
        // $data = $updateScore->fetch(PDO::FETCH_ASSOC);
        // $newScore = new Score_stabl($data);
        $newScore = [];
        while($score = $updateScore->fetch(PDO::FETCH_ASSOC)){
            $newScore[] = new Score_stabl($score);
        }
        return $newScore;

    }
}