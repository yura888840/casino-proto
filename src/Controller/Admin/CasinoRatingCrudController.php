<?php

namespace App\Controller\Admin;

use App\Entity\CasinoRating;
use App\Form\RatingRateType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CasinoRatingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CasinoRating::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('slug'),
            (CollectionField::new('ratingsCasinosRates'))
                ->setEntryIsComplex(true)
                ->setEntryType(RatingRateType::class)
                ->setFormTypeOptions([
                    'by_reference' => 'false',
                ])
        ];
    }
}
