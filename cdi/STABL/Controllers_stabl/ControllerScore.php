<?php

class ControllerScore extends ControllerTwigStabl
{
    public static function scoreSelect($id)
    {
        $twig = ControllerTwigStabl::twigControl();
        $viewScore = new ModelScore();
        $score = $viewScore->readScore($id);
        echo $twig->render('score.twig', ['score' => $score]);
    }

    public static function misajourscore(){
        $donnees = json_decode(file_get_contents('php://input'), true);
        // var_dump($donnees);
        
        // $datas = [];
        // $datas['msg'] = "Le 12 septembre 2021, tu avais réussi l'activité en 13 clics.";
        $manager = new ModelScore();
        $manager->insertScore($donnees);
        echo json_encode($datas);
        
    }
}
