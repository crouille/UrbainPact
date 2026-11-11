<?php

use TWIG\Loader\FilesystemLoader;
use TWIG\Environment;

class Controller
{
    private ?PDO $pdo;
    private ?FilesystemLoader $loader;
    private ?Environment $twig;
    private ?array $get = null;
    private ?array $post = null;

    public function __construct(\TWIG\Loader\FilesystemLoader $l, \TWIG\Environment $t)
    {
        $this->pdo = Bd::getInstance()->getConnexion();
        $this->loader = $l;
        $this->twig = $t;

        if (isset($_GET) && !empty($_GET)) {
            $this->get = $_GET;
        }

        if (isset($_POST) && !empty($_GET)) {
            $this->post = $_POST;
        }
    }

    public function call(string $methode): mixed
    {
        if (!method_exists($this, $methode)) {
            throw new Exception("La méthode " . $methode . " n'existe pas dans le controller " . __CLASS__);
        }
        return $this->$methode();
    }

    public function getPdo(): ?PDO
    {
        return $this->pdo;
    }

    public function setPdo(?PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    public function getLoader(): ?\TWIG\Loader\FilesystemLoader
    {
        return $this->loader;
    }

    public function setLoader(?\TWIG\Loader\FilesystemLoader $loader): void
    {
        $this->loader = $loader;
    }

    public function getTwig(): \TWIG\Environment
    {
        return $this->twig;
    }

    public function setTwig(\TWIG\Environment $twig): void
    {
        $this->twig = $twig;
    }

    public function getGet(): ?array
    {
        return $this->get;
    }

    public function setGet(?array $get): void
    {
        $this->get = $get;
    }

    public function getPost(): ?array
    {
        return $this->post;
    }

    public function setPost(?array $post): void
    {
        $this->post = $post;
    }
}
