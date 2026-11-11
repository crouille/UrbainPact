<?php

use TWIG\Loader\FilesystemLoader;
use TWIG\Environment;

class ControllerSignalement extends Controller
{
    public function __construct(FilesystemLoader $l, Environment $t)
    {
        return parent::__construct($l, $t);
    }

    public function afficher(): void
    {
        $dao = new SignalementDAO($this->getPdo());
        $signalements = $dao->findAllWithDetail();

        $template = $this->getTwig()->load('signalements.html.twig');
        echo $template->render(['signalements' => $signalements]);
    }

    /* 
    oublie pas que pour tester les 2 méthodes avec ta template tu va devoir juste changer ce qui a à côté de 'methode=' dans l'url de la page
    et oublie pas aussi que ta page tu l'accède en écrivant ça à côté de l'url entier (localhost/UrbainPact ou autre chose par rapport à ton serveur) : '?controleur=signalement&methode=lister' par exemple
    */

    public function listerSansDetails()
    {
        // lister les signalements sans les photos et la catégorie, seulement si tu veux pas les utiliser
        $manager = new SignalementDAO($this->getPdo());
        $signalements = $manager->findAll();

        $template = $this->getTwig()->load('signalements.html.twig');
        echo $template->render(array(
            'signalements' => $signalements
        ));
    }

    public function lister()
    {
        // lister les signalements avec les photos et la catégorie
        $manager = new SignalementDAO($this->getPdo());
        $signalements = $manager->findAllWithDetail();

        $template = $this->getTwig()->load('signalements.html.twig');
        echo $template->render(array(
            'signalements' => $signalements
        ));
    }
}
