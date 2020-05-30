<?php

$config = $this->getConfig();

$loader = new \Twig\Loader\FilesystemLoader($config->getValue('twigTemplates'));

$this->twig = new \Twig\Environment($loader, $config->getValue('twigOptions'));

if ($config->getValue('twigOptions')['debug'] === true) {
    $this->twig->addExtension(new \Twig\Extension\DebugExtension());
}

$customHttpErrors = $config->getValue('customHttpErrors');

if ($customHttpErrors['enable'] === true) {
    $observer = new \BfwTwig\Observer($this->twig, $customHttpErrors);

    $app = \BFW\Application::getInstance();
    $appSubject = $app->getSubjectList()->getSubjectByName('ctrlRouterLink');
    
    // attaching observer on BFW app ctrlRouterLink hook
    $appSubject->attach($observer);
}
