<?php
class ControllerTable extends ControllerTwigStabl{
    public static function jeuTable()
    {
        $twig = ControllerTwigStabl::twigControl();
        // $manager = new ModelScore();
        // $score = $manager->selectScore();
        // echo $twig->render('table.twig', ['score' => $score]);
        echo $twig->render('table.twig', ['param1' => $_POST['selectTable'], 'param2' => $_POST['order'], 'param3' => $_POST['help']]);
    }

    
}