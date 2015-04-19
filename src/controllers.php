<?php

use Symfony\Component\HttpFoundation\Response;
use UACatalog\Controllers\AdminController;
use UACatalog\Controllers\BlogController;
use UACatalog\Controllers\ProductController;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig');
})->bind('homepage');

$app->mount('/blog', new BlogController());

$app->mount('/product', new ProductController());

$app->mount('/admin', new AdminController());


$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message, $code);
});

return $app;
