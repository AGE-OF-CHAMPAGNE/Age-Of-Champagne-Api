<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipientImageController extends AbstractController
{
    #[Route('/recipient/image', name: 'app_recipient_image')]
    public function index(): Response
    {
        return $this->render('recipient_image/index.html.twig', [
            'controller_name' => 'RecipientImageController',
        ]);
    }
}
