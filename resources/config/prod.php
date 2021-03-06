<?php

// Local
$app['locale'] = 'ua';
$app['session.default_locale'] = $app['locale'];
$app['translator.messages'] = array(
    'ua' => __DIR__.'/../resources/locales/fr.yml',
);

// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Http cache
$app['http_cache.cache_dir'] = $app['cache.path'] . '/http';

// Twig cache
if (! $app['debug']) {
    $app['twig.options.cache'] = $app['cache.path'] . '/twig';
}

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'uacatalog',
    'user'     => 'root',
    'password' => '',
);

// User
$app['security.users'] = array('username' => array('ROLE_USER', 'password'));
