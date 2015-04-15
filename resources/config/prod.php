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
$app['twig.options.cache'] = $app['cache.path'] . '/twig';

// Assetic
$app['assetic.enabled']              = true;
$app['assetic.path_to_cache']        = $app['cache.path'] . '/assetic' ;
$app['assetic.path_to_web']          = __DIR__ . '/../../web/assets';
$app['assetic.input.path_to_assets'] = __DIR__ . '/../assets';

$app['assetic.input.path_to_css']       = $app['assetic.input.path_to_assets'] . '/css/main.css';
$app['assetic.output.path_to_css']      = 'css/main.css';
$app['assetic.input.path_to_js']        = array(
    $app['assetic.input.path_to_assets'] . '/js/script.js',
);
$app['assetic.output.path_to_js']       = 'js/scripts.js';

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
