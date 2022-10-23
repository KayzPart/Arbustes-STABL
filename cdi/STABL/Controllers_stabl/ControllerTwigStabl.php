<?php

    use Twig\Loader\FilesystemLoader;
    use Twig\Environment;

    abstract class ControllerTwigStabl{

        public static function twigControl(){
            $loader = new FilesystemLoader('./Views_stabl');
            
            $twig = new Environment($loader, ['cache' => false, 'debug' => true, 'auto_reload' => true]);
            $twig->addExtension(new \Twig\Extension\DebugExtension());

            return $twig;
        }
    }