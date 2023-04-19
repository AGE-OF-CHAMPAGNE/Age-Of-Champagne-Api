<?php

namespace App\DataFixtures;

use App\Factory\DidYouKnowFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DidYouKnowFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DidYouKnowFactory::createMany(20);
    }
}
