<?php 

class ControllerHumain extends ControllerTwig{
    //Page d'entrée - Bouton Connexion/Inscription
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

    // Récupération des données après inscription / Ajouter la redirection a la page de connexion après isncription 
    public function formInscription($datas){
        $twig = ControllerTwig::twigControl();
        $datas = $_POST;
        $humain = new ModelHumain();
        $datas = $humain->humainInscription($datas); 
        echo $twig->render('inscription.twig', ['humain' => $datas, 'root' => ROOT]);
    }

    // Vérification de la connexion
    public function verifConnexion(){
        session_start();
        if(!isset($_SESSION['humainId'])){
            header('Refresh: 0.01; url= ./connexion');
        }
        $humain_login = $_POST['humain_login'];
        $mdp = $_POST['mdp'];
        $manager = new  ModelHumain();
        $humain = $manager->sessionHumain($humain_login);
        if($humain != "Login ou mot de passe incorrect !"){
            $passwordVerif = password_verify($mdp, $humain->getMdp());

            if($passwordVerif){
                $_SESSION['humainId'] = $humain->getHumain_id();
                echo "Vous êtes connecter avec succès $humain_login !";
                header('Location: ./homepage');
            }else{
                echo "Login ou mot de passe incorrect";
                header("Refresh: 2; url= ./connexion");
            }
        }else{
            echo "Login ou mot de passe incorrect";
            header("Refresh: 2; url= ./connexion");
        }
        if(!isset($_SESSION['humainId'])){
            header("Refresh: 2; url= ./connexion");
            echo "Vous devez vous connecter pour accéder à l\'application
            <br><br>
            La redirection vers la page de connexion est en cours ...";
            exit(0);
        }
    }

    // Redirection après connexion
    public static function redirectionEspace(){
        session_start();
        if(!isset($_SESSION['humainId'])){
            header('Refresh: 0.01; url= ./connexion');
        }
        $id = $_SESSION['humainId'];
        $twig = ControllerTwig::twigControl();
        $datas = new ModelHumain();
        $outil = new ModelOutil();
        $datasOutil = $outil->selectOutil();
        $humain = $datas->selectHumain($id);
        echo $twig->render('homepage.twig', ['root' => ROOT, 'humain_id' => $_SESSION['humainId'], 'humain' => $humain, 'outils' => $datasOutil[0]]);
        // var_dump($datasOutil);
    }


    

}