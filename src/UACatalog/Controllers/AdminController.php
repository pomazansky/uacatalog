<?php

namespace UACatalog\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminController
 * @package UACatalog\Controllers
 */
class AdminController implements ControllerProviderInterface
{

    /**
     * @param Application $app
     * @return Response
     */
    public function index(Application $app)
    {
        return $app['twig']->render('admin.html.twig');
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

        $factory->get('/', '\\UACatalog\\Controllers\\AdminController::index')
            ->bind('admin');

        $factory->get('/blog', '\\UACatalog\\Controllers\\Admin\\BlogController::listBlogEntries')
            ->bind('admin-blog-list');

        $factory->match('/blog/add', '\\UACatalog\\Controllers\\Admin\\BlogController::addBlogEntry')
            ->bind('admin-blog-add');

        $factory->match('/blog/modify/{blogId}', '\\UACatalog\\Controllers\\Admin\\BlogController::modifyBlogEntry')
            ->bind('admin-blog-modify');

        $factory->match('/blog/delete/{blogId}', '\\UACatalog\\Controllers\\Admin\\BlogController::deleteBlogEntry')
            ->bind('admin-blog-delete');

        $factory->get('/products', '\\UACatalog\\Controllers\\Admin\\ProductController::listProducts')
            ->bind('admin-products');

        $factory->match('/product/add', '\\UACatalog\\Controllers\\Admin\\ProductController::addProduct')
            ->bind('admin-product-add');

        $factory->match('/product/modify/{productId}', '\\UACatalog\\Controllers\\Admin\\ProductController::modifyProduct')
            ->bind('admin-product-modify');

        $factory->match('/product/delete/{productId}', '\\UACatalog\\Controllers\\Admin\\ProductController::deleteProduct')
            ->bind('admin-product-delete');

        $factory->get('/manufacturers', '\\UACatalog\\Controllers\\Admin\\ManufacturerController::listManufacturers')
            ->bind('admin-manufacturers');

        $factory->match('/manufacturer/add', '\\UACatalog\\Controllers\\Admin\\ManufacturerController::addManufacturer')
            ->bind('admin-manufacturer-add');

        $factory->match('/manufacturer/modify/{manufacturerId}', '\\UACatalog\\Controllers\\Admin\\ManufacturerController::modifyManufacturer')
            ->bind('admin-manufacturer-modify');

        $factory->match('/manufacturer/delete/{manufacturerId}', '\\UACatalog\\Controllers\\Admin\\ManufacturerController::deleteManufacturer')
            ->bind('admin-manufacturer-delete');

        $factory->get('/categories', '\\UACatalog\\Controllers\\Admin\\CategoryController::listCategories')
            ->bind('admin-categories');

        $factory->match('/category/add', '\\UACatalog\\Controllers\\Admin\\CategoryController::addCategory')
            ->bind('admin-category-add');

        $factory->match('/category/modify/{categoryId}', '\\UACatalog\\Controllers\\Admin\\CategoryController::modifyCategory')
            ->bind('admin-category-modify');

        $factory->match('/category/delete/{categoryId}', '\\UACatalog\\Controllers\\Admin\\CategoryController::deleteCategory')
            ->bind('admin-category-delete');

        return $factory;
    }
}
