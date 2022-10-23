<?php

class ControllerScore extends ControllerTwigStabl
{
    public static function insertScoreHumain($datas)
    {
        // session_start();
        $datas = $_GET;
        if (isset($_GET['submit'])) {
            $manager = new ModelScore();
            $manager->insertScore($datas);
            header('Location: ./table');
        }else{
            echo 'Pense à séléctionner toute les options';
        }
        var_dump($datas);
    }

    public static function jeuTable()
    {
        // session_start();
        $twig = ControllerTwigStabl::twigControl();
        $manager = new ModelScore();
        $score = $manager->selectScore();
        // $selectTable = $score->getScore_param1();
        // $orderOrNot = $score->getScore_param2();
        // $aide = $score->getScore_param3();
        echo $twig->render('table.twig', ['score' => $score]);
        var_dump($score);
    }

    public static function updateScore(){
        // session_start();
        if(isset($_GET['submit'])){
            $id = $_GET['score_id'];
            var_dump($id);
            $score_valeur = $_GET['score_valeur'];
            $twig = ControllerTwigStabl::twigControl();
            $manager = new ModelScore();
            $updateScore = $manager->updateScore($id, $score_valeur);
            echo $twig->render('table.twig', ['score' => $updateScore]);
            var_dump($updateScore);
        }
        
    }
}
