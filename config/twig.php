<?php

use Twig\Extra\Intl\IntlExtension;

$loader = new Twig\Loader\FilesystemLoader('templates');

$twig = new Twig\Environment($loader, [
    'debug' => true
]);

$twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Europe/Paris');

$twig->addExtension(new \Twig\Extension\DebugExtension());

$twig->addExtension(new IntlExtension());
