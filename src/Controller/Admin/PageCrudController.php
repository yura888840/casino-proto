<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\BenefitsType;
use App\Form\LimitationsType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (
            Crud::PAGE_EDIT === $pageName
            || Crud::PAGE_NEW === $pageName
            || Crud::PAGE_DETAIL === $pageName
        ) {

            yield TextField::new('title')
                ->setRequired(true);

            yield TextField::new('description')
                ->setRequired(true);

            yield TextField::new('keywords');

            yield BooleanField::new('main');

            yield AssociationField::new('casino')
                ->autocomplete()
                ->setRequired(false);

            yield TextAreaField::new('addition');

            yield TextAreaField::new('content1');

            yield TextAreaField::new('content2');

            yield TextAreaField::new('contentTable');
        }

        if (Crud::PAGE_INDEX === $pageName)
        {
            yield TextareaField::new('title')
                ->setRequired(true);

            yield AssociationField::new('casino')
                ->autocomplete()
                ->setRequired(false);

            yield BooleanField::new('main')
                ->setRequired(true);

        }
    }

}
