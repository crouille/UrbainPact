<?php
require_once "include.php";

try {
    if(isset($_GET['controleur'])){
        $controleurName = $_GET['controleur'];
    }
    else {
        $controleurName = "";
    }

    if(isset($_GET['methode'])){
        $methode = $_GET['methode'];
    }
    else {
        $methode = "";
    }

    if($controleurName == "" && $methode == ""){
        $controleurName="categorie";
        $methode="lister";
    }

    if($controleurName == ""){
        throw new Exception("Le controleur n'est pas défini");        
    }

    if($methode == ""){
        throw new Exception("La méthode n'est pas définie");        
    }
    
    $controleur = ControllerFactory::getController($controleurName, $loader, $twig);
    $controleur->call($methode);
}
catch(Exception $e){
    die("Erreur : " . $e->getMessage());
}

