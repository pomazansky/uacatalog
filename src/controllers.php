<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UACatalog\Controllers\AdminController;
use UACatalog\Controllers\BlogController;
use UACatalog\Controllers\ProductController;

/**
 * @var Application $app
 */
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig');
})->bind('homepage');

$app->mount('/blog', new BlogController());

$app->mount('/product', new ProductController());

$app->mount('/admin', new AdminController());

$app
    ->match('/register', '\\UACatalog\\Controllers\\UserController::register')
    ->bind('register');

$app
    ->match('/collection', '\\UACatalog\\Controllers\\UserController::showCollection')
    ->bind('collection');

$app
    ->match('/collection/add/{productId}', '\\UACatalog\\Controllers\\UserController::addFavourite')
    ->bind('collection-add');

$app
    ->match('/collection/remove/{productId}', '\\UACatalog\\Controllers\\UserController::removeFavourite')
    ->bind('collection-remove');

$app
    ->get('/login', function (Request $request) use ($app) {
        return $app['twig']->render('login.html.twig', [
            'error' => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ]);
    })
    ->bind('login');

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
