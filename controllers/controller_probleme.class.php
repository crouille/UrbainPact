<?php

use TWIG\Loader\FilesystemLoader;
use TWIG\Environment;

class ControllerProbleme extends Controller
{
    public function __construct(FilesystemLoader $l, Environment $t)
    {
        return parent::__construct($l, $t);
    }

    public function afficher(): void
    {
        $dao = new ProblemeDAO($this->getPdo());
        $problemes = $dao->findAllWithDetail();

        $template = $this->getTwig()->load('problemes.html.twig');
        echo $template->render(['problemes' => $problemes]);
    }

    public function listerSansDetails()
    {
        $manager = new ProblemeDAO($this->getPdo());
        $problemes = $manager->findAll();

        $template = $this->getTwig()->load('problemes.html.twig');
        echo $template->render(array(
            'problemes' => $problemes
        ));
    }

    public function lister()
    {
        $manager = new ProblemeDAO($this->getPdo());
        $problemes = $manager->findAllWithDetail();

        $template = $this->getTwig()->load('problemes.html.twig');
        echo $template->render(array(
            'problemes' => $problemes
        ));
    }
}
