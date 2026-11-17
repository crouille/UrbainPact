<?php

use Twig\Extra\Intl\IntlExtension;

$loader = new Twig\Loader\FilesystemLoader('templates');

$twig = new Twig\Environment($loader, [
    'debug' => true
]);

$twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone(Config::get('localization')['timezone']);

// Ajouter la config dans tous les templates, sauf la partie database (mot de passe affichable via dump() en debug)
$twig->addGlobal('config', array_diff_key(Config::getConfig(), ['database' => null]));

$twig->addExtension(new \Twig\Extension\DebugExtension());

$twig->addExtension(new IntlExtension());
