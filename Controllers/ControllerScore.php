<?php 

class ControllerScore extends ControllerTwig{
    public static function insertScoreHumain(){
        $twig = ControllerTwig::twigControl();
        $datas = $_GET;
        $manager = new ModelScore();
        $datas = $manager->insertScore($datas);
        echo $twig->render('table.twig', ['root' => ROOT, 'score' => $datas]);
        var_dump($datas);
    }

}