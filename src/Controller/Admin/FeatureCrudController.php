<?php

namespace App\Controller\Admin;

use App\Entity\Feature;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FeatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Feature::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('type'),
            TextEditorField::new('description'),
            AssociationField::new('casinoLimitations')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
            AssociationField::new('casinoBenefits')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
}
