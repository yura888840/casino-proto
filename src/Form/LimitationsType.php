<?php

namespace App\Form;

use App\Entity\Feature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LimitationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
        ;

        $builder->addViewTransformer(new CallbackTransformer(
            fn ($data) => $data,
            fn ($data) => $data->setType('limitation'),
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label'      => false,
            'data_class' => Feature::class,
        ]);
    }
}
