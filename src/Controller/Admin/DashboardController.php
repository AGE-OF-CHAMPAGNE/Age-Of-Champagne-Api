<?php

namespace App\Controller\Admin;

use App\Entity\Benefit;
use App\Entity\DidYouKnow;
use App\Entity\District;
use App\Entity\Manager;
use App\Entity\Recipient;
use App\Entity\User;
use App\Entity\Vintage;
use App\Entity\VintageType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    // Permet d'avoit acces au fonction de getRepository
    // public function __construct(private EntityManagerInterface $entityManager){}

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // compte le nombre de user dans le site
        // $user = count($this->entityManager->getRepository(User::class)->findAll());
        return $this->render('admin/index.html.twig'/* ,['user' => $user] */);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Panneau d'administration");
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard("Page d'acceuil", 'fa fa-home');

        yield MenuItem::section('Crus', 'fa fa-wine-bottle');
        yield MenuItem::linkToCrud('Liste des Crus', 'fa fa-list', Vintage::class);
        yield MenuItem::linkToCrud('Ajouter un Type de Cru', 'fa fa-plus', Vintage::class)
            ->setAction('new');
        yield MenuItem::linkToUrl('Ajouter un image au Crus', 'fa fa-image', '/admin/vintage');

        yield MenuItem::section('Types de Cru', 'fa-solid fa-droplet');
        yield MenuItem::linkToCrud('Liste des Types de Cru', 'fa fa-list', VintageType::class);
        yield MenuItem::linkToCrud('Ajouter un Type de Cru', 'fa fa-plus', VintageType::class)
            ->setAction('new');

        yield MenuItem::section('Le saviez vous ?', 'fa-solid fa-question');
        yield MenuItem::linkToCrud('Liste des Le saviez vous', 'fa fa-list', DidYouKnow::class);
        yield MenuItem::linkToCrud('Ajouter un Le saviez vous', 'fa fa-plus', DidYouKnow::class)
            ->setAction('new');

        yield MenuItem::section('Partenaires', 'fa-solid fa-handshake');
        yield MenuItem::linkToCrud('Liste des Partenaires', 'fa fa-list', Recipient::class);
        yield MenuItem::linkToCrud('Ajouter un Partenaire', 'fa fa-plus', Recipient::class)
            ->setAction('new');

        yield MenuItem::section('Responsables', 'fa-solid fa-people-roof');
        yield MenuItem::linkToCrud('Liste des Responsables', 'fa fa-list', Manager::class);
        yield MenuItem::linkToCrud('Ajouter un Responsable', 'fa fa-plus', Manager::class)
            ->setAction('new');

        yield MenuItem::section('Régions', 'fa-sharp fa-solid fa-location-dot');
        yield MenuItem::linkToCrud('Liste des Régionss', 'fa fa-list', District::class);
        yield MenuItem::linkToCrud('Ajouter une Région', 'fa fa-plus', District::class)
            ->setAction('new');

        yield MenuItem::section('Utilisateurs', 'fa fa-user');
        yield MenuItem::linkToCrud('Liste des Utilisateurs', 'fa fa-list', User::class);
        yield MenuItem::linkToCrud('Ajouter un Utilisateur', 'fa fa-plus', User::class)
            ->setAction('new');

        yield MenuItem::section('Avantages', 'fa fa-tags');
        yield MenuItem::linkToCrud('Liste des Avantages', 'fa fa-list', Benefit::class);
        yield MenuItem::linkToCrud('Ajouter un Avantage', 'fa fa-plus', Benefit::class)
            ->setAction('new');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName("{$user->getFirstName()} {$user->getLastName()}");
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDefaultSort(['id' => 'ASC'])
        ;
    }
}
