<?php 

class ModelHumain extends Connect{
    public function humainInscription($datas){
        if(isset($_POST['submit'])){
            $humain_login = $_POST['humain_login'];
            $mdp = $_POST['mdp'];

            $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);

            $db = $this->getDb();
            $reqHumainInscription = $db->prepare('INSERT INTO `si_humain` (`humain_login`, `mdp`) VALUES (:humain_login, :mdp)');
            $reqHumainInscription->bindParam('humain_login', $humain_login, PDO::PARAM_STR);      
            $reqHumainInscription->bindParam('hashed_password', $hashed_password, PDO::PARAM_STR);  
            $reqHumainInscription->execute();
            
            $nouveauHumain = [];
            while ($humain = $reqHumainInscription->fetch(PDO::FETCH_ASSOC)){
                $nouveauHumain[] = new Humain($humain);
            }
            return $nouveauHumain;
            echo 'Votre inscription à bien été prise en comtpe';
        }
    }

    public function selectHumain($id){
        $db = $this->getDb();
        $reqSelect = $db->prepare('SELECT `humain_id`, `mdp` FROM `si_humain` WHERE `humain_id` = :id');
        $reqSelect->bindParam(':id', $id, PDO::PARAM_INT);
        $reqSelect->execute();
        $data = $reqSelect->fetch(PDO::FETCH_ASSOC);
        return new Humain($data);
    }
}