<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Utilisateurs')
            ->setEntityLabelInSingular('un Utilisateur');
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addCssFile('https://fonts.googleapis.com/icon?family=Material+Icons');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant')->onlyOnIndex(),
            EmailField::new('email', 'Adresse eMail'),
            ArrayField::new('roles', 'Roles'),
            FormField::addPanel('User'),
            TextField::new('firstName', 'Prénom'),
            TextField::new('lastName', 'Nom de famille'),
            BooleanField::new('wantSeeDYK', 'Affichage des pop-up'),
            AssociationField::new('Vintages', 'Cru(s) déjà scanné(s)')
                ->setFormTypeOption('choice_label', 'name'),
            AssociationField::new('used_benefit', 'Avantages utilisés')
            ->setFormTypeOption('choice_label', 'id'),
        ];
    }
}
