<?php

namespace App\Controller\Admin;

use App\Entity\Vintage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

class VintageCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Crus')
            ->setEntityLabelInSingular('un cru');
    }

    public static function getEntityFqcn(): string
    {
        return Vintage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'Identifiant')->onlyOnIndex(),
            TextField::new('name', 'Nom'),
            NumberField::new('longitude', 'Longitude'),
            NumberField::new('latitude', 'Latitude'),
            NumberField::new('size', 'Taille (en HA)'),
            AssociationField::new('district','Région'),
            AssociationField::new('benefits', 'Avantages')
                ->setFormTypeOption('choice_label', 'title'),
            AssociationField::new('recipient', 'Partenaires')
                ->setFormTypeOption('choice_label', 'name'),
            FormField::addPanel('Sépages'),
            NumberField::new('chardonnay', 'Chardonnay')->setHelp('en %'),
            NumberField::new('meunier', 'Meunier')->setHelp('en %'),
            NumberField::new('pinot_noir', 'Pinot noir')->setHelp('en %'),
            TextField::new('cardShow', 'Carte')->setFormType(VichFileType::class)->onlyWhenCreating(),
            ImageField::new('cardName')->setBasePath('images/card')->onlyOnIndex(),

        ];
    }
}
