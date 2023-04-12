<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use App\Factory\VintageFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VintageFixures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        VintageFactory::createOne([
            'name' => 'Aÿ',
            'size' => 10,
            'longitude' => 3.9970886,
            'latitude' => 49.0621668,
        ]);
        VintageFactory::createOne([
            'name' => 'Barbonne-Fayel',
            'size' => 24,
            'longitude' => 3.6940706,
            'latitude' => 48.6571602,
        ]);
        VintageFactory::createOne([
            'name' => 'Baroville',
            'size' => 17,
            'longitude' => 4.7240572,
            'latitude' => 48.1925484,
        ]);
        VintageFactory::createOne([
            'name' => 'Bassuet',
            'size' => 8,
            'longitude' => 4.6691036,
            'latitude' => 48.7987163,
        ]);
        VintageFactory::createOne([
            'name' => 'Bethon',
            'size' => 15,
            'longitude' => 3.6746538,
            'latitude' => 48.5554691,
        ]);
    }
}
