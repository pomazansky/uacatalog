<?php

namespace UACatalog\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use UACatalog\Models\ProductQuery;

/**
 * Class ProductController
 * @package UACatalog\Controllers
 */
class ProductController implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function showProduct(Application $app, $id)
    {
        $product = ProductQuery::create()->findPk($id);

        if ($product) {
            return $app['twig']->render('product.twig', [
                'product' => $product
            ]);
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

        $factory->get('/{id}', '\\UACatalog\\Controllers\\ProductController::showProduct')
            ->bind('product');

        return $factory;
    }
}
