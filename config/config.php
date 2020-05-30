<?php
/**
 * Config file for module bfw-Twig
 * @author Alexandre Moittié <aetiom@protonmail.com>
 * @package bfw-Twig
 * @version 1.0
 */



/**
 * @var string twigTemplates : template files storage directory (from root
 * project directory).
 * 
 * @suggest: SRC_DIR.'view/templates/src',
 */
$twigTemplates = '';

/**
 * @var string twigCache : cache directory for the twig compiled templates
 * (path from root project directory).
 * 
 * Twig default value is false
 * You can disabled compiled templates with false value.
 * 
 * @suggest: SRC_DIR.'view/templates/cache',
 */
$twigCache = '';



$debugStatus = \BFW\Application::getInstance()
    ->getConfig()
    ->getValue('debug', 'global.php')
;



/**
 * Return config
 */
return [
    /**
     * @var string twigTemplates :template files storage directory (from root
     * project directory).
     */
    'twigTemplates' => $twigTemplates,
    
    /**
     * @var array TwigOptions : All options passed to Twig
     */
    'twigOptions' => [
        'debug'            => $debugStatus,
        'auto_reload'      => $debugStatus,
        'strict_variables' => $debugStatus,
        'cache'            => $debugStatus == true ? false : $twigCache
    ],

    'customHttpErrors' => [
        /**
         * @var bool enable : enable custom HTTP errors
         */
        'enable'   => true,
        
        /**
         * @var string $template : error twig template
         */
        'template' => 'httpError.html.twig',

        /**
         * @var array $map : error map with http error status code as key 
         * and http error status text as data
         */
        'map' => [
            400 => 'Échec de l\'analyse HTTP.',
            401 => 'Le pseudo ou le mot de passe n\'est pas correct !',
            403 => 'Requête interdite !',
            404 => 'La page n\'existe pas ou plus !',
            405 => 'Méthode non autorisée.',
            406 => 'Mauvais format de requête.',
            408 => 'Temps d\'attente écoulé.',
            409 => 'La requête ne peut être traitée actuellement.',
            410 => 'La ressource n\'est plus disponible',
            500 => 'Erreur interne au serveur ou serveur saturé.',
            501 => 'Le serveur ne supporte pas le service demandé.',
            503 => 'Service indisponible.',
            505 => 'Version HTTP non supportée.'
        ]
    ]
];
