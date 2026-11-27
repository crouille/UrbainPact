<?php
// Fichiers de config
require_once "vendor/autoload.php";
require_once "config/config.class.php";
date_default_timezone_set(Config::get('localization')['timezone']);
require_once "config/twig.php";

// Contrôleurs
require_once "controllers/controller.class.php";
require_once "controllers/controller_factory.class.php";
require_once "controllers/controller_probleme.class.php";

// Modèles
require_once "modeles/bd.class.php";
require_once "modeles/categorie.class.php";
require_once "modeles/media.class.php";
require_once "modeles/probleme.class.php";
require_once "modeles/probleme.dao.php";
