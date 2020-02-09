<?php

use Phalcon\Logger;

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => '10.0.14.23',
        'port'        => '3336',
        'username'    => 'root',
        // 'password'    => 'D3vP@ssw0rd', // For CLI use only and for removal upon deployment
        // 'password'    => 'puSmXlr8MbmACBkMxBER6A==', // Blank password
        'password'    => 'decqvw/Nx3GeZIq5kUqIMSkjOD11LJfDJ4Vz', // D3vP@ssw0rd
        'dbname'      => 'css',
        'charset'     => 'utf8'
    ],
    'application' => [
        'appDir'         => __DIR__ . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'formsDir'       => APP_PATH . '/forms/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
        
        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),
    ],
    'log_enabled'   => true,
    'log_settings'  => [
        'path'      => 'logs',
        'format'    => '%date% [%type%] %message%',
        'date'      => 'D j H:i:s',
        'logLevel'  => Logger::DEBUG
    ],
    'log_filenames' =>  [
        'session'   =>  'session.log',        
        'common'    =>  'common.log',
        'de'        =>  'data_entry.log',
        'sql'       =>  'runtime_sql.log',
        'error'     =>  'error.log',        
    ],
    'AES_Key'       =>  'bM6xyt`8P!Ubkw:Lf*',
    'policy_url'    =>  'https://policy/',
    'session_lifetime'  =>  900,
    'until_timeout' =>  60,
    'version'       => 'v0.0.1'
]);
