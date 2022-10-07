<?php 

class ControllerHumain extends ControllerTwig{
    //Page d'entrée
    public static function checked(){
        $twig = ControllerTwig::twigControl();
        echo $twig->render('checked.twig');
    } 
    // Affichage formulaire connexion
    public function connexion(){
        session_start();
        if(isset($_SESSION['humainId'])){
            header('Location: ' . ROOT . '/homepage');
        }
        $twig = ControllerTwig::twigControl();
        echo $twig->render('connexion.twig', ['root' => ROOT]);
    }
    // Affichage formualire inscription
    public function inscription(){
        $twig = ControllerTwig::twigControl();
        echo $twig->render('inscription.twig', ['root' => ROOT]);
    }
    // Déconnection 
    public static function deconnexion(){
        session_start();
        unset($_SESSSION['humainId']);
        session_destroy();
        header('Location: ./');
    }

    // Formulaire inscription 
    public static function inscriptionHumain($datas){
        $twig = ControllerTwig::twigControl();
        $datas = $_POST;
        $humain = new ModelHumain();
        $datas = $humain->humainInscription($datas);
        echo $twig->render('inscription.twig', ['humain' =>$datas, 'root' => ROOT]);
    } 
    // Direction homepage après ouverture session 
    public static function homepage(){
        session_start();
        if(!isset($_SESSION['humainId'])){
            header('Refresh: 0.01; url = ./connexion');
        }
        $id = $_SESSION['humainId'];
        $twig = ControllerTwig::twigControl();
        $datas = new ModelHumain();
        // $dataScore = new ModelScore();
        $humain = $datas->selectHumain($id);
        echo $twig->render('homepage.twig', ['root' => ROOT, 'humain_id' => $_SESSION['humainId'], 'humain' => $humain]);
    }

}