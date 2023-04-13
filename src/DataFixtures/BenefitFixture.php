<?php

namespace App\DataFixtures;

use App\Factory\BenefitFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BenefitFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        BenefitFactory::createMany(20);

        $manager->flush();
    }
}
