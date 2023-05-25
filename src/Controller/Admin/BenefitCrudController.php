<?php

namespace App\Controller\Admin;

use App\Entity\Benefit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BenefitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Benefit::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Avantages')
            ->setEntityLabelInSingular('un Avantage');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant')->onlyOnIndex(),
            TextField::new('title', 'Titre')->setHelp("Titre de l'avantage (max 255 caratères)"),
            TextField::new('description', 'Description')->setHelp("Description de l'avantage (Pas de limite)"),
            AssociationField::new('vintages', 'Cru'),
            AssociationField::new('recipient', 'Partenaire'),
            DateField::new('startDate', 'Date de début'),
            DateField::new('endDate', 'Date de fin'),
        ];
    }
}
