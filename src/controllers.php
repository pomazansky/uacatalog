<?php

use Symfony\Component\HttpFoundation\Response;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig');
})->bind('homepage');

$app->get('/blog', function () use ($app) {
    return $app['twig']->render('blog.twig');
});

$app->get('/product', function () use ($app) {
    return $app['twig']->render('product.twig');
});


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
