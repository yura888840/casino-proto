<?php

namespace App\Controller\Admin;

use App\Entity\CasinoRating;
use App\Form\RatingRateType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
            SlugField::new('slug', 'URL slug (after /ratings/...)')->setTargetFieldName('slug'),
            BooleanField::new('active', 'Is rating visible ?'),
            (CollectionField::new('ratingsCasinosRates', 'Casions in this rating'))
                ->setEntryIsComplex(true)
                ->setEntryType(RatingRateType::class)
                ->setFormTypeOptions([
                    'by_reference' => 'false',
                ]),
            TextField::new('title'),
            TextField::new('description'),
            TextField::new('keywords'),
            CodeEditorField::new('addition')->hideOnIndex()
                ->setNumOfRows(15)->setLanguage('markdown')
                ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.'),
            CodeEditorField::new('content1')->hideOnIndex()
                ->setNumOfRows(15)->setLanguage('markdown')
                ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.'),
            CodeEditorField::new('content2')->hideOnIndex()
                ->setNumOfRows(15)->setLanguage('markdown')
                ->setHelp('Use Markdown to format the blog post contents. HTML is allowed too.'),
        ];
    }
}
