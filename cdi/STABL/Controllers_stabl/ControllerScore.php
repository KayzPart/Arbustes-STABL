<?php

class ControllerScore extends ControllerTwigStabl{

    public static function scoresOfTable($table){
        $twig = ControllerTwigStabl::twigControl();
        $viewScore = new ModelScore();
        $scores = $viewScore->ScoresOfTable($table['score_param1']);
        echo $twig->render('score.twig', ['scores' => $scores, 'table' => $table['score_param1']]);
    }

    public static function misajourscore(){
        $donnees = json_decode(file_get_contents('php://input'), true);
        $manager = new ModelScore();
        $manager->majScore($donnees);
        //echo json_encode($donnees);
    }
}
