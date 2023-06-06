<?php

namespace App\Controller\Admin;

use App\Entity\Recipient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminRecipientController extends AbstractController
{
    #[Route('/admin/recipient', name: 'app_admin_recipient')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin_recipient/index.html.twig', ['recipients' => $entityManager->getRepository(Recipient::class)->findAll()]);
    }
}
