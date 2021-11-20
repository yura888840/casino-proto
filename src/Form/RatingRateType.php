<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Casino;
use App\Entity\CasinoRating;
use App\Entity\RatingsRate;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RatingRateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('casino', EntityType::class, [
            'class' => Casino::class,
            'required' => true,
        ]);
        $builder->add('rate', IntegerType::class, [
            'required' => false,
            'empty_data' => 1,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => false,
            'data_class' => RatingsRate::class,
            'empty_data' => function (FormInterface $form) {
                $ratingRate = new RatingsRate();
                $ratingRate->setRate(1);
                /** @var  CasinoRating $casinoRating */
                $casinoRating = $form->getRoot()->getData();

                $ratingRate->setCasinoRating($casinoRating);

                return $ratingRate;
            },
        ]);
    }
}
