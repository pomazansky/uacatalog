<?php

namespace UACatalog\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use UACatalog\Form\Type\BlogType;
use UACatalog\Models\Blog;
use UACatalog\Models\BlogQuery;

/**
 * Class AdminController
 * @package UACatalog\Controllers
 */
class AdminController implements ControllerProviderInterface
{

    /**
     * @return Response
     */
    public function index()
    {
        return new Response('Admin area');
    }

    /**
     * @param Request $request
     * @param Blog $entry
     */
    protected function saveUploadedFile($files, Blog $entry)
    {
        if ($files['img_file']) {
            $extension = $files['img_file']->guessExtension();
            if (!$extension) {
                $extension = 'bin';
            }
            $fileName = 'blog' . $entry->getId() . '.' . $extension;
            $files['img_file']->move(__DIR__ . '/../../../web/upload/', $fileName);

            return $fileName;
        }

        return false;
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function addBlogEntry(Request $request, Application $app)
    {
        $entry = new Blog();
        $form = $app['form.factory']->create(new BlogType(), $entry);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $entry->save();

                $entry->setImgFile($this->saveUploadedFile($request->files->get($form->getName()), $entry));

                $entry->save();

                return $app->redirect($app['url_generator']->generate('admin-blog-list'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Add new blog entry'
        ];
        return $app['twig']->render('blog-form.twig', $data);
    }

    public function listBlogEntries(Application $app)
    {
        $blogEntries = BlogQuery::create()->find();

        return $app['twig']->render('blog-list.twig', [
            'blogEntries' => $blogEntries
        ]);
    }

    /**
     * @param Application $app
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteBlogEntry(Application $app, $id)
    {
        $entry = BlogQuery::create()->findPk($id);
        $entry->delete();
        return $app->redirect($app['url_generator']->generate('admin-blog-list'));
    }

    public function modifyBlogEntry(Request $request, Application $app, $id)
    {
        $entry = BlogQuery::create()->findPk($id);
        $form = $app['form.factory']->create(new BlogType(), $entry);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $entry->setImgFile($this->saveUploadedFile($request->files->get($form->getName()), $entry));

                $entry->save();
                return $app->redirect($app['url_generator']->generate('admin-blog-list'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Modify blog entry'
        ];
        return $app['twig']->render('blog-form.twig', $data);
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

        $factory->get('/blog', '\\UACatalog\\Controllers\\AdminController::listBlogEntries')
            ->bind('admin-blog-list');

        $factory->match('/blog/add', '\\UACatalog\\Controllers\\AdminController::addBlogEntry')
            ->bind('admin-blog-add');

        $factory->match('/blog/modify/{id}', '\\UACatalog\\Controllers\\AdminController::modifyBlogEntry')
            ->bind('admin-blog-modify');

        $factory->match('/blog/delete/{id}', '\\UACatalog\\Controllers\\AdminController::deleteBlogEntry')
            ->bind('admin-blog-delete');

        return $factory;
    }
}
