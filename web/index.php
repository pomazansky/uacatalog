<?php

namespace UACatalog;

use Silex\Application;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;

require_once __DIR__. '/../vendor/autoload.php';

$app = new Application();

$app['debug'] = true;

$app->register(new SessionServiceProvider());
$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__.'/../template'
]);

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig');
});

$app->get('/blog', function () use ($app) {
    return $app['twig']->render('blog.twig');
});

$app->get('/product', function () use ($app) {
    return $app['twig']->render('product.twig');
});

$app->run();
