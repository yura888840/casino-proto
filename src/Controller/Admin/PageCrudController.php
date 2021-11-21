<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\BenefitsType;
use App\Form\LimitationsType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
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

            yield CodeEditorField::new('addition')->hideOnIndex()
                ->setNumOfRows(15)->setLanguage('markdown')
                ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.');

            yield CodeEditorField::new('content1')->hideOnIndex()
                ->setNumOfRows(15)->setLanguage('markdown')
                ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.');

            yield CodeEditorField::new('content2')->hideOnIndex()
                ->setNumOfRows(15)->setLanguage('markdown')
                ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.');

            yield CodeEditorField::new('contentTable')->hideOnIndex()
                ->setNumOfRows(15)->setLanguage('markdown')
                ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.');

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
