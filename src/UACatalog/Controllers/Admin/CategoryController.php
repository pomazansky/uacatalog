<?php

namespace UACatalog\Controllers\Admin;

use Silex\Application;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use UACatalog\Form\CategoryType;
use UACatalog\Models\Category;
use UACatalog\Models\CategoryQuery;

/**
 * Class CategoryController
 * @package UACatalog\Controllers\Admin
 */
class CategoryController
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function listCategories(Application $app)
    {
        $categories = CategoryQuery::create()->find();

        return $app['twig']->render('admin-categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function addCategory(Request $request, Application $app)
    {
        $category = new Category();
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new CategoryType(), $category);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $category->save();

                return $app->redirect($app['url_generator']->generate('admin-categories'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Add new category'
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $categoryId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function modifyCategory(Request $request, Application $app, $categoryId)
    {
        $category = CategoryQuery::create()->findPk($categoryId);
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new CategoryType($category), $category);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $category->save();

                return $app->redirect($app['url_generator']->generate('admin-categories'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Modify category'
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }
}
