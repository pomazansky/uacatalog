<?php

namespace UACatalog\Controllers;

use Silex\Application;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use UACatalog\Form\RegisterType;
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
}
