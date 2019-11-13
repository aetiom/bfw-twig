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
    ]
];
