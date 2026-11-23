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
    public function traiterConnexion(): void
    {
        $post = $this->getPost() ?? []; // si _POST est vide ça affecte un tableau vide
        $email = trim($post['email'] ?? ''); // si email est vide ça affecte une chaîne vide
        $motDePasse = $post['mot_de_passe'] ?? ''; // si mot_de_passe est vide ça affecte une chaîne vide

        // valider l'email côté serveur
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $motDePasse === '') {
            $this->afficherConnexion('Saisissez une adresse e-mail valide et votre mot de passe.', $email);
            return;
        }

        $manager = new UtilisateurDao($this->getPdo());
        $utilisateur = $manager->findByEmail($email);

        if ($utilisateur !== null && password_verify($motDePasse, $utilisateur->getMotDePasse())) {
            $_SESSION['utilisateur'] =  [$utilisateur->getId(), $utilisateur->getNom(), $utilisateur->getPrenom(), $utilisateur->getRole()];
            header('Location: index.php?controleur=signalement&methode=lister');
            exit;
        }
        else {
            $this->afficherConnexion('Adresse email ou mot de passe incorrect.', $email);
        }
    }
    public function deconnecter(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
