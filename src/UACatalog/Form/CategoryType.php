<?php

namespace UACatalog\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints as Assert;
use UACatalog\Models\Category;
use UACatalog\Models\CategoryQuery;

/**
 * Class BlogType
 * @package UACatalog\Form\Type
 */
class CategoryType extends AbstractType
{
    private $category;

    /**
     * @param Category $category
     */
    public function __construct(Category $category = null)
    {
        $this->category = $category;
    }

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
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();

            $categories = CategoryQuery::create()->find();

            $form->add('parent_id', 'choice', [
                'constraints' => new Assert\NotBlank(),
                'placeholder' => 'Choose product category',
                'choices' => $this->objectToChoices($categories),
                'data' => $this->category ? $this->category->getParentId() : null
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

        /**
         * @var Category[] $object
         */
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
        return 'category';
    }
}
