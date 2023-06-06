<?php

namespace App\Controller;

use App\Entity\Vintage;
use App\Form\VintageTypeFormType;
use App\Repository\VintageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminVintageController extends AbstractController
{
    #[Route('/admin/vintage', name: 'app_admin_vintage')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin_vintage/index.html.twig', ['vintages' => $entityManager->getRepository(Vintage::class)->findAll()]);
    }

    #[Route('/admin/vintage/{id}/addCard', name: 'app_admin_vintage_addCard')]
    public function addCard(VintageRepository $vintageRepository, Request $request, Vintage $vintage): Response
    {
        $form = $this->createForm(VintageTypeFormType::class, $vintage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vintage->setCard(base64_encode(file_get_contents($form->getData()->getCard())));

            $vintageRepository->save($vintage, true);

            return $this->redirectToRoute('app_admin_vintage');
        }

        return $this->render('admin_vintage/addCard.html.twig', ['form' => $form, 'name' => $vintage->getName()]);
    }

        #[Route('/admin/vintage/test', name: 'app_admin_vintage_test')]
        public function test(): Response
        {
            return $this->render('admin_vintage/test.html.twig', ['image' => 'insh']);
        }
}
