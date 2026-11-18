<?php

use TWIG\Loader\FilesystemLoader;
use TWIG\Environment;

class ControllerUtilisateur extends Controller
{
    // Constructeur
    public function __construct(FilesystemLoader $l, Environment $t)
    {
        parent::__construct($l, $t);
    }

    // Méthodes spécifiques
    public function afficherConnexion(?string $erreur = null, string $email = ''): void
    {
        $template = $this->getTwig()->load('connexion.html.twig');
        echo $template->render([
            'erreur' => $erreur,
            'email' => $email,
            'menu' => 'connexion'
        ]);
    }
    public function traiterConnexion(string $email, string $mdp): void
    {
        $post = $this->getPost() ?? []; // si _POST est vide ça affecte un tableau vide

        // A FINIR

    }
}
