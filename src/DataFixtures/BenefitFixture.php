<?php

namespace App\DataFixtures;

use App\Factory\BenefitFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BenefitFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        BenefitFactory::createMany(20);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            RecipientFixtures::class,
        ];
    }
}
