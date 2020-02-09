<?php

use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Crypt;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * Sets the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    return $view;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

/**
 * Crypt service
 */
$di->set('crypt', function () {

    $crypt = new Crypt();

    // Set a global encryption key
    $crypt->setKey(
        '%31.1e$i86e$f!8jz'
    );

    // Set the applicable cipher method. Default is AES-256-CFB. 
    // See http://php.net/manual/en/function.openssl-get-cipher-methods.php for more.
    //$crypt->setCipher('AES-256-CBC');

    return $crypt;
},
true
);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();
    $crypt = $this->getCrypt();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'port'     => $config->database->port,
        'username' => $config->database->username,
        'password' => $crypt->decryptBase64($config->database->password, $crypt->getKey()),
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);
    
    return $connection;
});