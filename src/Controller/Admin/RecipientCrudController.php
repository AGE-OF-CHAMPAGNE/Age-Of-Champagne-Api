<?php

namespace App\Controller\Admin;

use App\Entity\Recipient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecipientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipient::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Partenaires')
            ->setEntityLabelInSingular('un Partenaire');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant')->onlyOnIndex(),
            TextField::new('name', 'Nom'),
            TextField::new('address', 'Rue'),
            TextField::new('city', 'Ville'),
            TextField::new('postalCode', 'Code Postal'),
            TelephoneField::new('phoneNumber', 'Numéro de téléphone'),
            TextField::new('website', 'Site web'),
            TextField::new('description', 'Description'),
            AssociationField::new('benefits', 'Reduction')
            ->setFormTypeOption('choice_label', 'title'),
            AssociationField::new('vintages', 'Crus')
            ->setFormTypeOption('choice_label', 'name'),
        ];
    }
}
