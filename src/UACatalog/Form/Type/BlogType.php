<?php

namespace UACatalog\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class BlogType
 * @package UACatalog\Form\Type
 */
class BlogType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', [
                'constraints' => new Assert\NotBlank()
            ])
            ->add('text', 'textarea', [
                'attr' => [
                    'rows' => '7'
                ]
            ])
            ->add('img_file', 'file', [
                'required' => false,
                'label' => 'Image'
            ])
            ->add('save', 'submit');
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'BlogForm';
    }
}
