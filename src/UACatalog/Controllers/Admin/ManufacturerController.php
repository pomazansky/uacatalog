<?php

namespace UACatalog\Controllers\Admin;

use Silex\Application;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use UACatalog\Form\ManufacturerType;
use UACatalog\Models\Manufacturer;
use UACatalog\Models\ManufacturerQuery;

/**
 * Class ManufacturerController
 * @package UACatalog\Controllers\Admin
 */
class ManufacturerController
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function listManufacturers(Application $app)
    {
        $manufacturers = ManufacturerQuery::create()->find();

        return $app['twig']->render('admin-manufacturers.html.twig', [
            'manufacturers' => $manufacturers
        ]);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function addManufacturer(Request $request, Application $app)
    {
        $manufacturer = new Manufacturer();
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new ManufacturerType(), $manufacturer);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $manufacturer->save();

                return $app->redirect($app['url_generator']->generate('admin-manufacturers'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Add new manufacturer'
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @param $manufacturerId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function modifyManufacturer(Request $request, Application $app, $manufacturerId)
    {
        $manufacturer = ManufacturerQuery::create()->findPk($manufacturerId);
        /**
         * @var Form $form
         */
        $form = $app['form.factory']->create(new ManufacturerType($manufacturer), $manufacturer);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $manufacturer->save();
                return $app->redirect($app['url_generator']->generate('admin-manufacturers'));
            }
        }

        $data = [
            'form' => $form->createView(),
            'title' => 'Modify manufacturer'
        ];
        return $app['twig']->render('admin-form.html.twig', $data);
    }
}
