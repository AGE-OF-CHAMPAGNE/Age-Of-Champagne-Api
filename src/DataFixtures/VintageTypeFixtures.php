<?php

namespace App\DataFixtures;

use App\Factory\VintageTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VintageTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/json/VintageType.json');
        $array = json_decode($file, true);
        VintageTypeFactory::createSequence($array);
    }
}
