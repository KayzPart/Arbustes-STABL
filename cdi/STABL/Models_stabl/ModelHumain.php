<?php 

class ModelHumain extends Connect{
    // inscription
    public function humainInscription($datas){
        if(isset($_POST['submit'])){
            $humain_login = $_POST['humain_login'];
            $humain_mdp_code = $_POST['mdp'];

            $hashed_password = password_hash($humain_mdp_code, PASSWORD_DEFAULT);

            $db = $this->getDb();
            $reqHumainInscription = $db->prepare('INSERT INTO `si_humain` (`humain_login`, `mdp`) VALUES (:humain_login, :hashed_password)');
            $reqHumainInscription->bindParam('humain_login', $humain_login, PDO::PARAM_STR);      
            $reqHumainInscription->bindParam('hashed_password', $hashed_password, PDO::PARAM_STR);  
            $reqHumainInscription->execute();
            
            $nouveauHumain = [];
            while ($humain = $reqHumainInscription->fetch(PDO::FETCH_ASSOC)){
                $nouveauHumain[] = new Humain_stabl($humain);
            }

            echo "$humain_login votre inscription à bien été prise en compte";
            return $nouveauHumain;
        }
    }
    // Verif connexion
    public function sessionHumain($humain_login){
        $db = $this->getDb();
        $reqConnect = $db->prepare('SELECT `humain_id`, `humain_login`, `mdp` FROM `si_humain` WHERE `humain_login` = :hLog');
        $reqConnect->bindParam('hLog', $humain_login, PDO::PARAM_STR);
        $reqConnect->execute();
        $log = $reqConnect->fetch(PDO::FETCH_ASSOC);
            if($reqConnect->rowCount() > 0){
                return new Humain_stabl($log);
            }else{
                return "Login ou mot de passe incorrect";
            }
    }

    public function selectHumain($id){
        $db = $this->getDb();
        $reqSelect = $db->prepare('SELECT `humain_id`, `humain_login`, `mdp` FROM `si_humain` WHERE `humain_id` = :id');
        $reqSelect->bindParam(':id', $id, PDO::PARAM_INT);
        $reqSelect->execute();
        $data = $reqSelect->fetch(PDO::FETCH_ASSOC);
        return new Humain_stabl($data);
        // $humain = [];
        // while($data = $reqSelect->fetch(PDO::FETCH_ASSOC)){
        //     $humain[] = new Humain($data);
        // }
        // return $humain;
    }
}