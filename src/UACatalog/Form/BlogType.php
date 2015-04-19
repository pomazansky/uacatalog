<?php

namespace UACatalog\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use UACatalog\Models\Blog;

/**
 * Class BlogType
 * @package UACatalog\Form\Type
 */
class BlogType extends AbstractType
{
    /**
     * @var Blog
     */
    private $entry;

    /**
     * @param Blog $entry
     */
    public function __construct(Blog $entry = null)
    {
        $this->entry = $entry;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $image = is_a($this->entry, 'UACatalog\Models\Blog') ? $this->entry->getImage() : '';
        $builder
            ->add('title', 'text', [
                'constraints' => new Assert\NotBlank(),
                'attr' => [
                    'class' => 'u-full-width'
                ]
            ])
            ->add('text', 'textarea', [
                'attr' => [
                    'rows' => '7',
                    'class' => 'u-full-width ckeditor'
                ]
            ])
            ->add($builder->create('image', 'file', [
//                'constraints' => new Assert\Image(),
                'required' => false,
                'label' => 'Image',
                'data_class' => null,
                'attr' => [
                    'accept' => 'image/*'
                ]
            ])->addModelTransformer(new UploadedImageTransformer($image)))
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
        return 'blog';
    }
}
