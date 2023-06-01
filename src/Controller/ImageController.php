<?php

namespace App\Controller;

use App\Entity\Vintage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/image/{id}', name: 'app_image', requirements: ['id' => '\d+'])]
    public function show(Vintage $vintage): Response
    {
        if (null == $vintage->getCard()) {
            $image = null;
            $title = null;
        } else {
            $image = $vintage->getCard();
            $title = $vintage->getName();
        }

        return $this->render('image/index.html.twig', [
            'image' => $image, 'title' => $title, 'vintage' => $vintage, 'id' => $vintage->getId(),
        ]);
    }
}
