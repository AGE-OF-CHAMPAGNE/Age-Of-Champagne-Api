<?php

namespace App\Controller\Admin;

use App\Entity\DidYouKnow;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DidYouKnowCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Le saviez vous ?')
            ->setEntityLabelInSingular('Le saviez vous ?');
    }

    public static function getEntityFqcn(): string
    {
        return DidYouKnow::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant')->onlyOnIndex(),
            TextField::new('description', 'Description'),
        ];
    }
}
