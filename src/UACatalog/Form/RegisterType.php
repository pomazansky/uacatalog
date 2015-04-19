<?php

namespace UACatalog\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RegisterType
 * @package UACatalog\Form
 */
class RegisterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', [
                'constraints' => new Assert\NotBlank(),
                'attr' => [
                    'class' => 'u-full-width'
                ]
            ])
            ->add('password', 'repeated', [
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'u-full-width']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password']
            ])
//            ->add('roles', 'choice', [
//                'choices' => [
//                    'ROLE_ADMIN' => 'Administrator',
//                    'ROLE_USER' => 'User'
//                ],
//                'multiple' => true
//            ])
            ->add('register', 'submit', [
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
        return 'register';
    }
}