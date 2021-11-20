<?php

namespace App\Controller\Admin;

use App\Entity\RatingsRate;
use App\Form\DataTransformer\RatingsDataTransformer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RatingsRateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RatingsRate::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IntegerField::new('rate'),
            AssociationField::new('casino')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
            AssociationField::new('casinoRating')
                ->setFormTypeOptions([
                    'by_reference' => true,
                ]),
        ];
    }
}
