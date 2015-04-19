<?php

namespace UACatalog\Controllers\Admin;

use Silex\Application;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use UACatalog\Form\ProductType;
use UACatalog\Models\Product;
use UACatalog\Models\ProductQuery;

/**
 * Class ProductController
 * @package UACatalog\Controllers\Admin
 */
class ProductController
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function listProducts(Application $app)
    {
        $products = ProductQuery::create()->find();

        return $app['twig']->render('admin-products.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function addProduct(Request $request, Application $app)
    {
        $product = new Product();
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new ProductType($product), $product);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $product->save();
                return $app->redirect($app['url_generator']->generate('admin-products'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Add new product'
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $productId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function modifyProduct(Request $request, Application $app, $productId)
    {
        $product = ProductQuery::create()->findPk($productId);
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new ProductType($product), $product);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $product->save();
                return $app->redirect($app['url_generator']->generate('admin-products'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Modify Product'
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }
}
