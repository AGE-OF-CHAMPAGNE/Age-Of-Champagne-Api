<?php

namespace App\DataFixtures;

use App\Factory\RecipientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        RecipientFactory::createMany(20);

        $manager->flush();
    }
}
