<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

// Robots handler
$robots = new MicroCollection();
$robots->setHandler('RobotsController', true); // true for lazy loading
$robots->setPrefix('/robots');
$robots->get('', 'all');
$robots->get('/{id:[0-9]+}', 'get');
$robots->get('/search/{name}', 'search');
$robots->post('', 'add');
$robots->put('{id:[0-9]+}', 'update');
$robots->delete('{id:[0-9]+}', 'delete');
$app->mount($robots);