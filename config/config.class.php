<?php

class Config
{
    private static ?Config $instance = null;
    private static ?array $config = null;

    private function __construct()
    {
        try {
            $fichier = __DIR__ . '/config.json';
            if (!file_exists($fichier)) {
                throw new Exception("Le fichier de configuration $fichier est introuvable (copier config_template.json en config.json).");
            }
            self::$config = json_decode(file_get_contents($fichier), true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            die('La récupération de la configuration a échoué : ' . $e->getMessage());
        }
    }

    public static function getConfig(): array
    {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$config;
    }

    public static function get(string $cle): mixed
    {
        return self::getConfig()[$cle] ?? null;
    }

    private function __clone() {}

    public function __wakeup()
    {
        throw new Exception("Un singleton ne doit pas être deserialisé");
    }
}
