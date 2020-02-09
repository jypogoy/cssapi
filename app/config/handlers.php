<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

// Area handler
$area = new MicroCollection();
$area->setHandler('AreaController', true); // true for lazy loading
$area->setPrefix('/area');
$area->get('', 'all');
$area->get('/{id:[0-9]+}', 'get');
$area->get('/search/{name}', 'search');
$area->post('', 'add');
$area->put('/{id:[0-9]+}', 'update');
$area->delete('/{id:[0-9]+}', 'delete');
$app->mount($area);

// Robots handler
// $robots = new MicroCollection();
// $robots->setHandler('RobotsController', true); // true for lazy loading
// $robots->setPrefix('/robots');
// $robots->get('', 'all');
// $robots->get('/{id:[0-9]+}', 'get');
// $robots->get('/search/{name}', 'search');
// $robots->post('', 'add');
// $robots->put('/{id:[0-9]+}', 'update');
// $robots->delete('/{id:[0-9]+}', 'delete');
// $app->mount($robots);