<?php 

class ControllerHumain extends ControllerTwigStabl{
    //Page d'entrée - Bouton Connexion/Inscription
    // public static function checked(){
    //     $twig = ControllerTwigStabl::twigControl();
    //     echo $twig->render('checked.twig');
    // } 

    // Affichage formulaire connexion
    // public function connexion(){
    //     // session_start();
    //     // if(isset($_SESSION['humainId'])){
    //     //     header('Location: ' . $_SESSION['outil_retour']);
    //     // }
    //     $twig = ControllerTwigStabl::twigControl();
    //     echo $twig->render('connexion.twig');
    // }

    // Récupération des données après inscription / Ajouter la redirection a la page de connexion après isncription 
    // public function formInscription($datas){
    //     $twig = ControllerTwigStabl::twigControl();
    //     $datas = $_POST;
    //     $humain = new ModelHumain();
    //     $datas = $humain->humainInscription($datas); 
    //     echo $twig->render('inscription.twig', ['humain' => $datas]);
    // }

    // Vérification de la connexion
    // public function verifConnexion(){
    //     // session_start();
    //     // if(!isset($_SESSION['humain']['humain_id'])){
    //     //     header('Refresh: 0.01; url= ./connexion');
    //     // }
    //     $humain_login = $_POST['humain_login'];
    //     $humain_mdp_code = $_POST['mdp'];
    //     $manager = new  ModelHumain();
    //     $humain = $manager->sessionHumain($humain_login);
    //     if($humain != "Login ou mot de passe incorrect !"){
    //         $passwordVerif = password_verify($humain_mdp_code, $humain->getMdp());

    //         if($passwordVerif){
    //             $_SESSION['humain']['humain_id'] = $humain->getHumain_id();
    //             echo "Vous êtes connecter avec succès $humain_login !";
    //             header('Location: ./homepage');
    //         }else{
    //             echo "Login ou mot de passe incorrect";
    //             header("Refresh: 2; url= ./connexion");
    //         }
    //     }else{
    //         echo "Login ou mot de passe incorrect";
    //         header("Refresh: 2; url= ./connexion");
    //     }
    //     if(!isset($_SESSION['humain']['humain_id'])){
    //         header("Refresh: 2; url= ./connexion");
    //         echo "Vous devez vous connecter pour accéder à l\'application
    //         <br><br>
    //         La redirection vers la page de connexion est en cours ...";
    //         exit(0);
    //     }
    // }

    // Redirection après connexion
    public static function redirectionEspace(){
        global $globales;
        if(!isset($_SESSION['humain']['humain_id'])){
            header('Refresh: 0.01; url= ./');
        }
        $twig = ControllerTwigStabl::twigControl();
        $viewScore = new ModelScore();
        $prenom = $globales['humain']['humain_login'];
        $scores = $viewScore->tableScores();
        echo $twig->render('homepage.twig', ['humain_id' => $_SESSION['humain']['humain_id'], 'prenom' => $prenom, 'scores' => $scores]);
    }

        public static function majscore(){
        echo 'coucou';exit;
        /*$donnees = json_decode(file_get_contents('php://input'), true);
        $manager = new ModelScore();
        $manager->majScore($donnees);
        echo json_encode($donnees);*/
    }
}