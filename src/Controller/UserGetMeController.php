<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserGetMeController extends AbstractController
{
    public function __invoke(): User
    {
        $data = $this->getUser();
        if (!$data) {
            throw $this->createNotFoundException('User not logged');
        }

        return $data;
    }
}
