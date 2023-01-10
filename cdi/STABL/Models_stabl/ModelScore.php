<?php
class ModelScore extends Connect{
  public function majScore($donnees){
    $order = $donnees['order'];
    $help = $donnees['help'];
    $table = $donnees['nombreSelectionner'];
    $valeur= $donnees['resultScore'];

    $db = $this->getDb();
    $req = $db->prepare("SELECT score_id FROM `scores` WHERE score_outil_id=:outil_id AND score_param1=:table AND score_param2=:order AND score_param3=:help AND score_humain_id=:humain_id AND score_est_actif=:actif");
    $req->bindvalue('outil_id', $_SESSION['outil_id'], PDO::PARAM_STR);
    $req->bindvalue('table', $table, PDO::PARAM_INT);
    $req->bindvalue('order', $order, PDO::PARAM_INT);
    $req->bindvalue('help', $help, PDO::PARAM_INT);
    $req->bindvalue('humain_id', $_SESSION['humain']['humain_id'], PDO::PARAM_INT);        
    $req->bindvalue('actif', 1, PDO::PARAM_INT);
    $req->execute();
    $score_id = $req->fetch();
    if ($score_id) $score_id=$score_id[0];

    if($score_id){
        $newDate = date('Y-m-d');
        $db = $this->getDb();
        $req = $db->prepare('UPDATE `scores` SET `score_valeur`= :valeur, `score_date` = :newDate WHERE `score_id` = :score_id');
        $req->bindvalue('score_id', $score_id, PDO::PARAM_INT);
        $req->bindvalue('valeur', $valeur, PDO::PARAM_STR);
        $req->bindvalue('newDate', $newDate, PDO::PARAM_STR);
        $req->execute();
    } else {
        $scoreDate = date('Y-m-d');
        $db = $this->getDb();
        $score = $db->prepare('INSERT INTO `scores`(`score_valeur`, `score_outil_id`, `score_humain_id`, `score_param1`, `score_param2`, `score_param3`, `score_est_actif`, `score_date`) VALUES (:valeur, :outil_id,  :humain_id, :table, :order, :help, :actif, :scoreDate)');
        $score->bindvalue('outil_id', $_SESSION['outil_id'], PDO::PARAM_STR);
        $score->bindvalue('valeur', $valeur, PDO::PARAM_STR);
        $score->bindvalue('humain_id', $_SESSION['humain']['humain_id'], PDO::PARAM_INT);
        $score->bindvalue('table', $table, PDO::PARAM_INT);
        $score->bindvalue('order', $order, PDO::PARAM_INT);
        $score->bindvalue('help', $help, PDO::PARAM_INT);
        $score->bindvalue('actif', 1, PDO::PARAM_INT);
        $score->bindvalue('scoreDate', $scoreDate, PDO::PARAM_STR);
        $score->execute();
    }
    /*$newScore = [];
    while($sc = $result->fetch(PDO::FETCH_ASSOC)){
        $newScore[] = new Score_stabl($sc);
        var_dump($newScore);
    }
    return $newScore;*/
  }

  // Récupération de la table séléctionner 
  public function tableScores(){
      $db = $this->getDb();
      $req = $db->prepare('SELECT `score_param1`, `score_valeur` FROM `scores` WHERE score_outil_id=:outil_id');
      $req->bindvalue('outil_id', $_SESSION['outil_id'], PDO::PARAM_STR);
      $req->execute();
      $score = [];
      while($data = $req->fetch(PDO::FETCH_ASSOC)) $score[] = new Score_stabl($data);
      return $score;
  }

  public function ScoresOfTable($table){
      $db = $this->getDb();
      $req = $db->prepare("SELECT score_id, score_valeur, score_param2, score_param3 FROM scores WHERE score_outil_id=:outil_id AND score_param1=:table");
      $req->bindvalue('table', $table, PDO::PARAM_INT);
      $req->bindvalue('outil_id', $_SESSION['outil_id'], PDO::PARAM_STR);
      $req->execute();      
      $scores = array();
      while($score = $req->fetch()) $scores[]=$score;
      $req->closeCursor();
      return $scores;
  }
}