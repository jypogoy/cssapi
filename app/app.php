<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

include APP_PATH . '/config/handlers.php';

/**
 * Error handler
 */
$app->error(function () use($app) {
    $app->response->setStatusCode(500, "Error")->sendHeaders();
    echo $app['view']->render('500');
});

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});
