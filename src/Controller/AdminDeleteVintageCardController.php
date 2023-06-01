<?php

namespace App\Controller;

use App\Entity\Vintage;
use App\Repository\VintageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDeleteVintageCardController extends AbstractController
{
    #[Route('/admin/vintage/deleteCard/{id}/', name: 'app_admin_delete_vintage_card')]
    public function index(Vintage $vintage, VintageRepository $vintageRepository): Response
    {
        if (null == $vintage->getCard()) {
            return $this->redirectToRoute('app_admin_vintage');
        }
        $vintage->setCard(null);
        $vintageRepository->save($vintage, true);

        return $this->render('admin_delete_vintage_card/index.html.twig', ['id' => $vintage->getId()]);
    }
}
