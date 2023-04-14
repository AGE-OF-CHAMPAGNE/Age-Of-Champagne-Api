<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

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
