<?php

namespace App\Controller;

use App\Entity\Vintage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetVintageCardController extends AbstractController
{
    public function __invoke(Vintage $data): Response
    {
        $response = new Response(stream_get_contents($data->getCard(), -1, 0));
        $response->headers->set('Content-Type', 'image/png');

        return $response;
    }
}
