<?php

use Silex\Application;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Translator;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use UACatalog\Provider\UserProvider;

/**
 * @var Application $app
 */
$app->register(new HttpCacheServiceProvider());

$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());

$app->register(new SecurityServiceProvider(), [
    'security.firewalls' => [
        'default' => [
            'anonymous' => true,
            'pattern' => '^.*$',
            'form' => [
                'login_path' => '/login',
                'check_path' => '/login_check'
            ],
            'logout' => [
                'logout_path' => '/logout'
            ],
            'users' => $app->share(function () use ($app) {
                return new UserProvider();
            })
        ]
    ],
    'security.access_rules' => [
        ['^/admin', 'ROLE_ADMIN'],
        ['^/collection', 'ROLE_USER'],
    ],
    'security.encoder.digest' => $app->share(function () {
        return new BCryptPasswordEncoder(4);
    }),
    'security.role_hierarchy' => [
        'ROLE_ADMIN' => ['ROLE_USER']
    ]
]);

$app->register(new TranslationServiceProvider());

$app['translator'] = $app->share($app->extend('translator', function ($translator) {
    /**
     * @var Translator $translator
     */
    $translator->addLoader('yaml', new YamlFileLoader());

    $translator->addResource('yaml', __DIR__.'/../resources/locales/fr.yml', 'fr');

    return $translator;
}));

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => __DIR__.'/../resources/log/app.log',
    'monolog.name'    => 'app',
    'monolog.level'   => 300 // = Logger::WARNING
]);

$app->register(new TwigServiceProvider(), [
    'twig.options'        => [
        'cache'            => isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
        'strict_variables' => true
    ],
    'twig.form.templates' => ['form_div_layout.html.twig', 'common/form_div_layout.html.twig'],
    'twig.path'           => [__DIR__ . '/../resources/views']
]);

if ($app['debug'] && isset($app['cache.path'])) {
    $app->register(new ServiceControllerServiceProvider());
}

$app->register(new Propel\Silex\PropelServiceProvider(), [
    'propel.config_file' => __DIR__.'/../resources/db/generated-conf/config.php'
]);

return $app;
