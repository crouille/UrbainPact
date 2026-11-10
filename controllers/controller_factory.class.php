<?php

use TWIG\Loader\FilesystemLoader;
use TWIG\Environment;

class ControllerFactory {
    public static function getController($controller, ?FilesystemLoader $loader, ?Environment $twig){
        $controllerName = "Controller" . ucfirst($controller);
        if(!class_exists($controllerName)){
            throw new Exception("Le controleur n'existe pas");
        }
        return new $controllerName($loader, $twig);
    }
}