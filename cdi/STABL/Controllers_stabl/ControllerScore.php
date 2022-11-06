<?php

class ControllerScore extends ControllerTwigStabl
{
    public static function insertScoreHumain($datas)
    {
        // session_start();
        $datas = $_POST;
        if (isset($_POST['submit'])) {
            $manager = new ModelScore();
            $manager->insertScore($datas);
        }
        header('Location: ./');
    }
    public static function scoreSelect($id){
        $twig = ControllerTwigStabl::twigControl();
        $viewScore = new ModelScore();
        $score = $viewScore->readScore($id);
        echo $twig->render('score.twig', ['score' => $score]);
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
        header('Location: ./');
        
    }
}
