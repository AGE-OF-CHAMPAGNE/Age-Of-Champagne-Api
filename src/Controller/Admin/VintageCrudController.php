<?php

namespace App\Controller\Admin;

use App\Entity\Vintage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VintageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vintage::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant')->onlyOnIndex(),
            TextField::new('name', 'Nom'),
            NumberField::new('longitude', 'Longitude'),
            NumberField::new('latitude', 'Latitude'),
            NumberField::new('size', 'Taille (en HA)'),
            AssociationField::new('benefits', 'Avantages')
                ->setFormTypeOption('choice_label', 'title'),
            AssociationField::new('recipient', 'Partenaires')
                ->setFormTypeOption('choice_label', 'name'),
            FormField::addPanel('Sépages'),
            NumberField::new('chardonnay', 'Chardonnay')->setHelp('en %'),
            NumberField::new('meunier', 'Meunier')->setHelp('en %'),
            NumberField::new('pinot_noir', 'Pinot noir')->setHelp('en %'),
        ];
    }
}
