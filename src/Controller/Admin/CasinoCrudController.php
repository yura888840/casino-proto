<?php

namespace App\Controller\Admin;

use App\Entity\Casino;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use SebastianBergmann\CodeCoverage\Report\Text;

class CasinoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Casino::class;
    }


    public function configureFields(string $pageName): iterable
    {
        if (
            Crud::PAGE_EDIT === $pageName
            || Crud::PAGE_NEW === $pageName
            || Crud::PAGE_DETAIL === $pageName
        ) {

            yield AssociationField::new('page')
                ->autocomplete()
                ->setRequired(true);

            yield TextField::new('logo')
                ->setRequired(true);

            yield TextField::new('name')
                ->setRequired(true);

            yield TextField::new('method');

            yield TextField::new('soft');

            yield TextField::new('bonus');

            yield TextField::new('license');

            yield TextField::new('year');

            yield TextField::new('support');
        }

        if (Crud::PAGE_INDEX === $pageName)
        {
            yield AssociationField::new('page')
                ->autocomplete()
                ->setRequired(true);

            yield TextareaField::new('logo')
                ->setRequired(true);

            yield TextField::new('name')
                ->setRequired(true);

        }
    }

}
