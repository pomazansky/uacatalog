<?php

namespace UACatalog\Controllers;

use Silex\Application;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use UACatalog\Form\RegisterType;
use UACatalog\Models\Base\ProductQuery;
use UACatalog\Models\User;

/**
 * Class UserController
 * @package UACatalog\Controllers
 */
class UserController
{
    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function register(Request $request, Application $app)
    {
        $user = new User();
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new RegisterType(), $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $encoded= $app['security.encoder.digest']->encodePassword($user->getPassword(), null);
                $user->setPassword($encoded);

                $user->setRoles(['ROLE_USER']);

                $user->save();

                return $app->redirect($app['url_generator']->generate('homepage'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Register new user'
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }

    /**
     * @param Application $app
     * @return mixed
     */
    public function showCollection(Application $app)
    {
        /**
         * @var TokenInterface $token
         */
        $token = $app['security']->getToken();

        $user = $token->getUser();

        $favourites = ProductQuery::create()
            ->filterByUser($user)
            ->find();

        return $app['twig']->render('collection.html.twig', ['favourites' => $favourites]);
    }

    /**
     * @param Application $app
     * @param $productId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addFavourite(Application $app, $productId)
    {
        /**
         * @var TokenInterface $token
         */
        $token = $app['security']->getToken();

        /**
         * @var User $user
         */
        $user = $token->getUser();

        $product = ProductQuery::create()->findPk($productId);

        if ($product) {
            $user->addProduct($product);
            $user->save();
        }

        return $app->redirect($app['url_generator']->generate('collection'));
    }

    /**
     * @param Application $app
     * @param $productId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeFavourite(Application $app, $productId)
    {
        /**
         * @var TokenInterface $token
         */
        $token = $app['security']->getToken();

        /**
         * @var User $user
         */
        $user = $token->getUser();

        $product = ProductQuery::create()->findPk($productId);

        if ($product) {
            $user->removeProduct($product);
            $user->save();
        }

        return $app->redirect($app['url_generator']->generate('collection'));
    }
}
