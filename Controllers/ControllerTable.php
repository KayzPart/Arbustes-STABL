<?php

class ControllerTable extends ControllerTwig {
    public static function testTables(){
        $twig = ControllerTwig::twigControl();

        echo $twig->render('homepage.twig');
    }
}