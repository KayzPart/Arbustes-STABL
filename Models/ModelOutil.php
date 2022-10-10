<?php
class ModelOutil extends Connect{
    public function selectOutil($id){
        $db = $this->getDb();
        $selectOutil = $db->prepare('SELECT `outil_id`, `outil_est_actif`, `outil_nom`, `outil_type` FROM `arbustes_outil` WHERE `outil_id` = :id');
        $selectOutil->bindParam(':id', $id, PDO::PARAM_INT);
        $selectOutil->execute();
        $data = $selectOutil->fetch(PDO::FETCH_ASSOC);
        return new Outil($data);
    }
}