<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(['email' => 'test@test.com', 'roles' => ['ROLE_ADMIN']]);
        UserFactory::createMany(5, ['roles' => ['ROLE_USER']]);
        UserFactory::createMany(5);
    }
}
