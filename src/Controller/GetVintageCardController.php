<?php

namespace App\Controller;

use App\Entity\Vintage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetVintageCardController extends AbstractController
{
    public function __invoke(Vintage $data): Response
    {
        $response = new Response(base64_decode($data->getCard()));
        $response->headers->set('Content-Type', 'image/png');

        return $response;
    }
}
