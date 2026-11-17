<?php

class Bd
{
    private static ?Bd $instance = null;

    private ?PDO $pdo;

    private function __construct()
    {
        try {
            $db = Config::get('database');
            $this->pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['name'], $db['user'], $db['pass']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connexion à la BD échouée : " . $e->getMessage());
        }
    }

    public static function getInstance(): ?Bd
    {
        if (self::$instance == null) {
            self::$instance = new Bd();
        }
        return self::$instance;
    }

    public function getConnexion(): ?PDO
    {
        return $this->pdo;
    }

    private function __clone() {}

    public function __wakeup()
    {
        throw new Exception("Un singleton ne doit pas être deserialisé");
    }
}
