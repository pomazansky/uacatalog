<?php

namespace UACatalog\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use UACatalog\Models\CategoryQuery;
use UACatalog\Models\ProductQuery;

/**
 * Class FrontController
 * @package UACatalog\Controllers
 */
class FrontController implements ControllerProviderInterface
{
    public function index(Application $app)
    {
        $category = CategoryQuery::create()->findOneByName('Жіночий одяг');
        $parentCategory = CategoryQuery::create()->findOneById($category->getParentId());
        $sameCategory = ProductQuery::create()->findByCategoryId($category->getId());

        return $app['twig']->render('index.twig', [
            'category' => $category,
            'sameCategory' => $sameCategory,
            'parentCategory' => $parentCategory
        ]);
    }

    /**
     * Returns routes to connect to the given application.
     *
     * @param \Silex\Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];

        $factory->match('/', '\\UACatalog\\Controllers\\FrontController::index')
            ->bind('homepage');


        return $factory;
    }
}
