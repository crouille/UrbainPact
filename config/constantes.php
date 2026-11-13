<?php

// définir le fuseau horaire à celui de Paris
date_default_timezone_set('Europe/Paris');

// constantes pour PDO
define('DB_HOST', 'localhost');
define('DB_NAME', 'urbainpact');
define('DB_USER', 'root');
define('DB_PASS', '');

// constante pour qu'on n'ait pas à réécrire le début de chaque table
define('PREFIXE', 'up_');

// nom du site
define('WEBSITE_TITLE', 'UrbainPact');