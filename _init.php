<?php
session_start();
$dossier_server_path = '/Arbustes-STABL';
$bdd = new PDO("mysql:host=localhost;dbname=stage_stabl;charset=UTF8", 'admin','root');
$_SESSION['humain']['humain_id'] = 9;
$globales['humain']['humain_login']='Cédric';
// unset($_SESSION['humain']['humain_id']);
$_SESSION['outil_retour'] = $dossier_server_path. '/cdi/STABL';
function trouve_outil_id($dossier) {
    $position1=strpos($dossier,"/cdi/"); 
    $position2=strrpos($dossier,'/');
    $outil_id=substr($dossier,$position1+5,$position2-$position1-5);
    return $outil_id;
}
