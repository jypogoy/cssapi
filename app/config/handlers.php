<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * -------------------------------------- 
 * CSS Handlers
 * --------------------------------------
 */
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

// Indicator handler
$indicator = new MicroCollection();
$indicator->setHandler('IndicatorController', true); // true for lazy loading
$indicator->setPrefix('/indicator');
$indicator->get('', 'all');
$indicator->get('/{id:[0-9]+}', 'get');
$indicator->get('/search/{name}', 'search');
$indicator->post('', 'add');
$indicator->put('/{id:[0-9]+}', 'update');
$indicator->delete('/{id:[0-9]+}', 'delete');
$app->mount($indicator);

// Mov handler
$mov = new MicroCollection();
$mov->setHandler('MovController', true); // true for lazy loading
$mov->setPrefix('/mov');
$mov->get('', 'all');
$mov->get('/{id:[0-9]+}', 'get');
$mov->get('/search/{name}', 'search');
$mov->post('', 'add');
$mov->put('/{id:[0-9]+}', 'update');
$mov->delete('/{id:[0-9]+}', 'delete');
$app->mount($mov);

/**
 * -------------------------------------- 
 * BEIS Handlers
 * --------------------------------------
 */
// Region handler
$region = new MicroCollection();
$region->setHandler('RegionController', true); // true for lazy loading
$region->setPrefix('/region');
$region->get('', 'all');
$region->get('/{id:[0-9]+}', 'get');
$region->get('/search/{name}', 'search');
$region->post('', 'add');
$region->put('/{id:[0-9]+}', 'update');
$region->delete('/{id:[0-9]+}', 'delete');
$app->mount($region);

// Province handler
$province = new MicroCollection();
$province->setHandler('ProvinceController', true); // true for lazy loading
$province->setPrefix('/province');
$province->get('', 'all');
$province->get('/{id:[0-9]+}', 'get');
$province->get('/search/{name}', 'search');
$province->post('', 'add');
$province->put('/{id:[0-9]+}', 'update');
$province->delete('/{id:[0-9]+}', 'delete');
$app->mount($province);

// Municipality handler
$municipality = new MicroCollection();
$municipality->setHandler('MunicipalityController', true); // true for lazy loading
$municipality->setPrefix('/municipality');
$municipality->get('', 'all');
$municipality->get('/{id:[0-9]+}', 'get');
$municipality->get('/search/{name}', 'search');
$municipality->post('', 'add');
$municipality->put('/{id:[0-9]+}', 'update');
$municipality->delete('/{id:[0-9]+}', 'delete');
$app->mount($municipality);

// Barangay handler
$barangay = new MicroCollection();
$barangay->setHandler('BarangayController', true); // true for lazy loading
$barangay->setPrefix('/barangay');
$barangay->get('', 'all');
$barangay->get('/{id:[0-9]+}', 'get');
$barangay->get('/search/{name}', 'search');
$barangay->post('', 'add');
$barangay->put('/{id:[0-9]+}', 'update');
$barangay->delete('/{id:[0-9]+}', 'delete');
$app->mount($barangay);

// Division handler
$division = new MicroCollection();
$division->setHandler('DivisionController', true); // true for lazy loading
$division->setPrefix('/division');
$division->get('', 'all');
$division->get('/{id:[0-9]+}', 'get');
$division->get('/search/{name}', 'search');
$division->post('', 'add');
$division->put('/{id:[0-9]+}', 'update');
$division->delete('/{id:[0-9]+}', 'delete');
$app->mount($division);

// School handler
$school = new MicroCollection();
$school->setHandler('SchoolController', true); // true for lazy loading
$school->setPrefix('/school');
$school->get('', 'all');
$school->get('/{id:[0-9]+}', 'get');
$school->get('/search/{name}', 'search');
$school->post('', 'add');
$school->put('/{id:[0-9]+}', 'update');
$school->delete('/{id:[0-9]+}', 'delete');
$app->mount($school);
