<?php

$config = $this->getConfig();

$loader = new \Twig\Loader\FilesystemLoader($config->getValue('twigTemplates'));

$this->twig = new \Twig\Environment($loader, $config->getValue('twigOptions'));

if ($config->getValue('twigOptions')['debug'] === true) {
    $this->twig->addExtension(new \Twig\Extension\DebugExtension());
}
