<?php

namespace UACatalog\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ManufacturerChoiceType
 * @package UACatalog\Form
 */
class ManufacturerChoiceType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'manufacturer_choice';
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return 'choice';
    }


    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new ManufacturerTransformer());
    }
}
