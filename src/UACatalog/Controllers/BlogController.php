<?php

namespace UACatalog\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;
use UACatalog\Models\BlogQuery;

/**
 * Class BlogController
 * @package UACatalog\Controllers
 */
class BlogController implements ControllerProviderInterface
{

    /**
     * @param Application $app
     * @return mixed
     */
    public function showAll(Application $app)
    {
        $blogEntries = BlogQuery::create()->find();

        return $app['twig']->render('blog.twig', [
            'blogEntries' => $blogEntries
        ]);
    }

    /**
     * @param Application $app
     * @param $blogId
     * @return mixed
     */
    public function showOne(Application $app, $blogId)
    {
        $blogEntry = BlogQuery::create()->findPk($blogId);

        if ($blogEntry) {
            return $app['twig']->render('blog-entry.twig', [
                'entry' => $blogEntry
            ]);
        } else {
            return new Response('404', 404);
        }
    }

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];

        $factory->get('/', '\\UACatalog\\Controllers\\BlogController::showAll')
            ->bind('blog');

        $factory->get('/{blogId}', '\\UACatalog\\Controllers\\BlogController::showOne')
            ->bind('blog-entry');

        return $factory;
    }
}
