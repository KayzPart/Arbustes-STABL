<?php
// session_start();
// unset($_SESSION['humain']['humain_id']);
$dossier_server_path = '/Arbustes-appli';
$bdd = new PDO("mysql:host=localhost;dbname=stage_stabl;charset=UTF8", 'root', '');
$_SESSION['outil_retour'] = $dossier_server_path. '/cdi/STABL';
function trouve_outil_id($dossier) {
    $position1=strpos($dossier,"/cdi/"); 
    $position2=strrpos($dossier,'/');
    $outil_id=substr($dossier,$position1+5,$position2-$position1-5);
    return $outil_id;
}

