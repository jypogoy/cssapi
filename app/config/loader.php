<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->pluginsDir,
        $config->application->libraryDir
    ]
)->register();


$loader->registerNamespaces(
    [
        'Models'    =>  __DIR__ . '/../models/'
    ]
);
$loader->register();