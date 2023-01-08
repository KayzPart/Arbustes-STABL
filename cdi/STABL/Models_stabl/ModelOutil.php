<?php
class ModelOutil extends Connect{
    public function selectOutil(){
        $db = $this->getDb();
        $selectOutil = $db->query('SELECT `outil_id`, `outil_est_actif`, `outil_nom`, `outil_type` FROM `arbustes_outil`');
        $outil = [];
        while($data = $selectOutil->fetch(PDO::FETCH_ASSOC)){
            $outil[] = new Outil_stabl($data);
        }
        return $outil;
        // $data = $selectOutil->fetch(PDO::FETCH_ASSOC);
        // return new Outil($data);
    }
}