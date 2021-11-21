<?php

namespace App\Controller\Admin;

use App\Entity\Casino;
use App\Entity\Feature;
use App\Form\LimitationsType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use SebastianBergmann\CodeCoverage\Report\Text;
use App\Form\BenefitsType;

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

            yield TextField::new('imgRating')
                ->setRequired(true);

            yield TextField::new('img300')
                ->setRequired(true);

            yield TextField::new('name')
                ->setRequired(true);

            yield CodeEditorField::new('shortDescription')->hideOnIndex()
                ->setNumOfRows(15)->setLanguage('markdown')->setRequired(true)
                ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.');

            yield TextField::new('linkToPartner')
                ->setRequired(true);

            yield IntegerField::new('rating')
                ->setRequired(true);

            yield TextField::new('method');

            yield TextField::new('soft');

            yield TextField::new('bonus');

            yield TextField::new('license');

            yield TextField::new('year');

            yield TextField::new('support');

            yield CollectionField::new('benefits')
                ->setFormTypeOptions([
                    'delete_empty' => true,
                    'by_reference' => false,
                ])
                ->setEntryIsComplex(false)
                ->setCustomOptions([
                    'allowAdd' => true,
                    'allowDelete' => true,
                    'entryType' => BenefitsType::class,
                    'showEntryLabel' => false,
                ]);

            yield CollectionField::new('limitations')
                ->setFormTypeOptions([
                    'delete_empty' => true,
                    'by_reference' => false,
                ])
                ->setEntryIsComplex(false)
                ->setCustomOptions([
                    'allowAdd' => true,
                    'allowDelete' => true,
                    'entryType' => LimitationsType::class,
                    'showEntryLabel' => false,
                ]);
        }

        if (Crud::PAGE_INDEX === $pageName)
        {
            yield AssociationField::new('page')
                ->autocomplete()
                ->renderAsNativeWidget(true)
                ->setRequired(true);

            yield ImageField::new('logo')
                ->setRequired(true);

            yield TextField::new('name')
                ->setRequired(true);

            yield IntegerField::new('rating')
                ->setRequired(true);
        }
    }

}
