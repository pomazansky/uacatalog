<?php

namespace UACatalog\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BlogType
 * @package UACatalog\Form\Type
 */
class ManufacturerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'constraints' => new Assert\NotBlank(),
                'attr' => [
                    'class' => 'u-full-width'
                ]
            ])
            ->add('url', 'url', [
                'constraints' => new Assert\Url(),
                'attr' => [
                    'class' => 'u-full-width'
                ]
            ])
            ->add($builder
                ->create(
                    'shops',
                    'textarea',
                    [
                        'attr' => [
                            'rows' => '7',
                            'class' => 'u-full-width'
                        ],
                        'label' => 'Shops (one per line)'
                    ]
                )->addModelTransformer(new ShopsTransformer())
            )
            ->add('save', 'submit', [
                'attr' => [
                    'class' => 'button-primary u-pull-right'
                ]
            ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'manufacturer';
    }
}
