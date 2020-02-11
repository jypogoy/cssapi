<?php

use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Crypt;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Logger\Formatter\Line as FormatterLine;

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
        $this->getConfig()->encrypt_key
    );

    // Set the applicable cipher method. Default is AES-256-CFB. 
    // See http://php.net/manual/en/function.openssl-get-cipher-methods.php for more.
    //$crypt->setCipher('AES-256-CBC');

    return $crypt;
},
true
);

/**
 * Database connection is created based on the parameters defined in the configuration file
 */
$di->setShared('db_css', function () {
    $config = $this->getConfig();
    $crypt = $this->getCrypt();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->db_css->adapter;
    $params = [
        'host'     => $config->db_css->host,
        'port'     => $config->db_css->port,
        'username' => $config->db_css->username,
        'password' => $crypt->decryptBase64($config->db_css->password, $crypt->getKey()),
        'dbname'   => $config->db_css->dbname,
        'charset'  => $config->db_css->charset
    ];

    if ($config->db_css->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);
    
    return $connection;
});

$di->setShared('db_beis', function () {
    $config = $this->getConfig();
    $crypt = $this->getCrypt();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->db_beis->adapter;
    $params = [
        'host'     => $config->db_beis->host,
        'port'     => $config->db_beis->port,
        'username' => $config->db_beis->username,
        'password' => $crypt->decryptBase64($config->db_beis->password, $crypt->getKey()),
        'dbname'   => $config->db_beis->dbname,
        'charset'  => $config->db_beis->charset
    ];

    if ($config->db_beis->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);
    
    return $connection;
});

/**
 * Logger service
 */
$di->set('logger', function ($filename = null) {
    $config = $this->getConfig();
    $format   = $config->get('log_settings')->format;
    $path     = rtrim($config->get('log_settings')->path, '\\/') . DIRECTORY_SEPARATOR;
    $formatter = new FormatterLine($format, $config->get('log_settings')->date);    
    $logger    = new FileAdapter($path . $filename);
    $logger->setFormatter($formatter);
    $logger->setLogLevel($config->get('log_settings')->logLevel);
    return $logger;
});

$di->set('sessionLogger', function () {
    $config = $this->getConfig();
    $filename = trim($config->get('log_filenames')->session, '\\/');
    return $this->get('logger', array($filename));
});

$di->set('commonLogger', function () {
    $config = $this->getConfig();
    $filename = trim($config->get('log_filenames')->common, '\\/');
    return $this->get('logger', array($filename));
});

$di->set('errorLogger', function () {
    $config = $this->getConfig();
    $filename = trim($config->get('log_filenames')->error, '\\/');
    return $this->get('logger', array($filename));
});