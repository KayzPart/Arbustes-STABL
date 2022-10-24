<?php 
class Humain_stabl extends Hydrate_stabl{
    private $_humain_id;
    private $_humain_login;
    private $_mdp;

    public function getHumain_id(){
        return $this->_humain_id;
    }

    public function getHumain_login(){
        return $this->_humain_login;
    }

    public function getMdp(){
        return $this->_mdp;
    }

    public function setHumain_id($humain_id){
        $this->_humain_id = $humain_id;
    }

    public function setHumain_login($humain_login){
        $this->_humain_login = $humain_login;
    }

    public function setMdp($mdp){
        $this->_mdp = $mdp;
    }

}