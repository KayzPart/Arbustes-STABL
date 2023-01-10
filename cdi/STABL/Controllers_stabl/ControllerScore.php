<?php

class ControllerScore extends ControllerTwigStabl
{
    public static function scoreSelect()
    {
        $twig = ControllerTwigStabl::twigControl();
        $viewScore = new ModelScore();
        $score = $viewScore->readScore();
        echo $twig->render('score.twig', ['score' => $score, 'param1' => $_GET['score_param1']]);
    }

    public static function misajourscore(){
        $donnees = json_decode(file_get_contents('php://input'), true);
        $manager = new ModelScore();
        $manager->insertScore($donnees);
        echo json_encode($datas);

    }
}
