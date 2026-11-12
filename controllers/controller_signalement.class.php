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

    public function listerSansDetails()
    {
        $manager = new SignalementDAO($this->getPdo());
        $signalements = $manager->findAll();

        $template = $this->getTwig()->load('signalements.html.twig');
        echo $template->render(array(
            'signalements' => $signalements
        ));
    }

    public function lister()
    {
        $manager = new SignalementDAO($this->getPdo());
        $signalements = $manager->findAllWithDetail();

        $template = $this->getTwig()->load('signalements.html.twig');
        echo $template->render(array(
            'signalements' => $signalements
        ));
    }
}
