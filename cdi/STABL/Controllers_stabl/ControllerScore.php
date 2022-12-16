<?php

class ControllerScore extends ControllerTwigStabl
{
    public static function insertScoreHumain($datas)
    {
        // session_start();
        $datas = $_POST;
        if (isset($_POST['submit'])) {
            $manager = new ModelScore();
            // Verifier si la colonne existe deja si elle est null => INSERT sinon UPDATE
            $manager->insertScore($datas);
        }
        
        // header('Location: ./');
    }
    public static function scoreSelect($id)
    {
        $twig = ControllerTwigStabl::twigControl();
        $viewScore = new ModelScore();
        $score = $viewScore->readScore($id);
        echo $twig->render('score.twig', ['score' => $score]);
    }

    public static function misajourscore(){
        //$donnees = $_POST;
        $donnees = json_decode(file_get_contents('php://input'), true);
        $datas = [];
        //******
        //******
        $datas['msg'] = "Le 12 septembre 2021, tu avais réussi l'activité en 13 clics.";
        //var_dump($donnees,$donnees,$datas);
       echo json_encode($datas);
        
    }
}
