<?php

namespace UACatalog\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints as Assert;
use UACatalog\Models\CategoryQuery;
use UACatalog\Models\ManufacturerQuery;
use UACatalog\Models\Product;

/**
 * Class ProductType
 * @package UACatalog\Form
 */
class ProductType extends AbstractType
{
    private $product;

    /**
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $image = is_a($this->product, 'UACatalog\Models\Blog') ? $this->product->getImage() : '';
        $builder
            ->add('name', 'text', [
                'constraints' => new Assert\NotBlank(),
                'attr' => [
                    'class' => 'u-full-width'
                ]

            ])
            ->add('price', 'money', [
                'constraints' => new Assert\NotBlank(),
                'currency' => 'UAH'
            ])
            ->add('description', 'textarea', [
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
        ])->addModelTransformer(new UploadedImageTransformer($image)));

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();

            $manufacturers = ManufacturerQuery::create()->find();

            $form->add('manufacturer', new ManufacturerChoiceType(), [
                'constraints' => new Assert\NotBlank(),
                'placeholder' => 'Choose product manufacturer',
                'choices' => $this->objectToChoices($manufacturers),
                'data' => $this->product ? $this->product->getManufacturerId() : null
            ]);

            $categories = CategoryQuery::create()->find();

            $form->add('category', new CategoryChoiceType(), [
                'constraints' => new Assert\NotBlank(),
                'placeholder' => 'Choose product category',
                'choices' => $this->objectToChoices($categories),
                'data' => $this->product ? $this->product->getCategoryId() : null
            ]);

            $form->add('save', 'submit', [
                'attr' => [
                    'class' => 'button-primary u-pull-right'
                ]
            ]);

        });

    }

    /**
     * @param \Traversable $object
     * @return array
     */
    protected function objectToChoices(\Traversable $object)
    {
        $choices = [];

        foreach ($object as $item) {
            $choices[$item->getId()] = $item->getName();
        }

        return $choices;
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'product';
    }
}
