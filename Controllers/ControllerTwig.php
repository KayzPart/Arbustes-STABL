<?php

    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;

    abstract class ControllerTwig{

        public static function twigControl(){
            $loader = new FilesystemLoader('./Views');
            
            $twig = new Environment($loader, ['cache' => false, 'debug' => true, 'auto_reload' => true]);
            $twig->addExtension(new \Twig\Extension\DebugExtension());

            return $twig;
        }
    }