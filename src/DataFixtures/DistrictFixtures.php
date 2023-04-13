<?php

namespace App\DataFixtures;

use App\Factory\DistrictFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DistrictFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        DistrictFactory::createOne([
            'name' => 'Vallé de la marne',
            'color_code' => 'D79897',
        ]);
        DistrictFactory::createOne([
            'name' => 'Côte de Sézanne',
            'color_code' => 'FDEB6E',
        ]);
        DistrictFactory::createOne([
            'name' => 'Côte des Bar',
            'color_code' => 'BOC858',
        ]);
        DistrictFactory::createOne([
            'name' => 'Côteaux Vitryats',
        ]);
        DistrictFactory::createOne([
            'name' => 'Montagne de Reims',
            'color_code' => 'FABD62',
        ]);

    }
}
