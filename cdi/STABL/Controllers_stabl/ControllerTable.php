<?php
class ControllerTable extends ControllerTwigStabl{
    public static function jeuTable()
    {
        $twig = ControllerTwigStabl::twigControl();
        echo $twig->render('table.twig', ['param1' => $_POST['selectTable'], 'param2' => $_POST['order'], 'param3' => $_POST['help'], 'outil' => $_POST['scoreOutilId'], 'id' => $_POST['id'], 'value' => $_POST['scoreValeur']]);
    }
}