<?php

namespace App\Controller\Admin;

use App\Entity\VintageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VintageTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VintageType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Types de Cru')
            ->setEntityLabelInSingular('un Type de Cru');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant')->onlyOnIndex(),
            TextField::new('name'),
            AssociationField::new('vintages')
            ->setFormTypeOption('choice_label', 'name'),
        ];
    }
}
