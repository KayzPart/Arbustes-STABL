<?php 

class ControllerScore extends ControllerTwig{
    public static function insertScoreHumain($datas){
        session_start();
        $datas = $_GET;
        $manager = new ModelScore();
        $manager->insertScore($datas);
        header('Location: ./table');
        var_dump($datas);
    }

    public static function jeuTable(){
        session_start();
        $twig = ControllerTwig::twigControl();
        $manager = new ModelScore();
        $score = $manager->selectScore();
        // $selectTable = $score->getScore_param1();
        // $orderOrNot = $score->getScore_param2();
        // $aide = $score->getScore_param3();
        echo $twig->render('table.twig', ['root' => ROOT, 'score' => $score]);
        // var_dump($score);
    }
}