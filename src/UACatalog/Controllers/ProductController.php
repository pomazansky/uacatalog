<?php

namespace UACatalog\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use UACatalog\Models\Base\Product;
use UACatalog\Models\CategoryQuery;
use UACatalog\Models\ProductQuery;

/**
 * Class ProductController
 * @package UACatalog\Controllers
 */
class ProductController implements ControllerProviderInterface
{
    /**
     * @param Application $app
     * @param $productId
     * @return mixed
     */
    public function showProduct(Application $app, $productId)
    {
        $product = ProductQuery::create()->findPk($productId);

        if ($product) {
            $parentCategory = CategoryQuery::create()->findOneById($product->getCategory()->getParentId());
            $sameManufacturer = ProductQuery::create()->findByManufacturerId($product->getManufacturer()->getId());
            $sameCategory = ProductQuery::create()->findByCategoryId($product->getCategory()->getId());

            return $app['twig']->render('product.twig', [
                'product' => $product,
                'category' => $product->getCategory(),
                'parentCategory' => $parentCategory,
                'sameManufacturer' => $sameManufacturer,
                'sameCategory' => $sameCategory
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

        $factory->get('/{productId}', '\\UACatalog\\Controllers\\ProductController::showProduct')
            ->bind('product');

        return $factory;
    }
}
