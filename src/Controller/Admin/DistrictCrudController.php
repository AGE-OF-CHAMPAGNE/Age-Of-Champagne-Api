<?php

namespace App\Controller\Admin;

use App\Entity\District;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DistrictCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Régions')
            ->setEntityLabelInSingular('une Région');
    }
    public static function getEntityFqcn(): string
    {
        return District::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id','Identifiant')->onlyOnIndex(),
            TextField::new('name','Nom'),
            NumberField::new('size','Taille (en HA)'),
            ColorField::new('color_code','Code couleur'),
            AssociationField::new('vintages', 'Crus')
                ->setFormTypeOption('choice_label', 'name'),
        ];
    }

}
