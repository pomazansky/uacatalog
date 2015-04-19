<?php

namespace UACatalog\Controllers\Admin;

use Silex\Application;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use UACatalog\Form\BlogType;
use UACatalog\Models\Blog;
use UACatalog\Models\BlogQuery;

/**
 * Class BlogController
 * @package UACatalog\Controllers\Admin
 */
class BlogController
{
    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function addBlogEntry(Request $request, Application $app)
    {
        $entry = new Blog();
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new BlogType(), $entry);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entry->save();

                return $app->redirect($app['url_generator']->generate('admin-blog-list'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Add new blog entry'
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }

    /**
     * @param Application $app
     * @return mixed
     */
    public function listBlogEntries(Application $app)
    {
        $blogEntries = BlogQuery::create()->find();

        return $app['twig']->render('admin-blog.html.twig', [
            'blogEntries' => $blogEntries
        ]);
    }

    /**
     * @param Application $app
     * @param $blogId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteBlogEntry(Application $app, $blogId)
    {
        $entry = BlogQuery::create()->findPk($blogId);
        $entry->delete();
        return $app->redirect($app['url_generator']->generate('admin-blog-list'));
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $blogId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function modifyBlogEntry(Request $request, Application $app, $blogId)
    {
        $entry = BlogQuery::create()->findPk($blogId);
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new BlogType($entry), $entry);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entry->save();

                return $app->redirect($app['url_generator']->generate('admin-blog-list'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Modify blog entry',
            'image' => $entry->getImage()
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }
}
