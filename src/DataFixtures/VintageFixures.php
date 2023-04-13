<?php

namespace App\DataFixtures;

use App\Factory\BenefitFactory;
use App\Factory\DistrictFactory;
use App\Factory\VintageFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class VintageFixures extends Fixture implements DependentFixtureInterface
{
    public function createVintage(array $vintage)
    {
        $v = VintageFactory::createOne($vintage);
        $users = ['user1', 'user2', 'user3', 'user4', 'user5'];
        $rand = random_int(0, 4);
        $usersRD = [];
        $i = 0;
        while ($i <= $rand + 1 and sizeof($usersRD) != $rand) {
            $user = $users[random_int(0, $rand)];
            if (!in_array($user, $usersRD)) {
                $arrayRD[] = $user;
                $v->addUser($this->getReference($user));
            }
            ++$i;
        }
    }

    public function load(ObjectManager $manager): void
    {
        $this->createVintage(['name' => 'Aÿ',
            'size' => 10,
            'longitude' => 3.9970886,
            'latitude' => 49.0621668,
            'district' => DistrictFactory::find(['name' => 'Vallé de la marne']),
            'benefits' => BenefitFactory::randomRange(0, 3),
            ]);

        $this->createVintage([
            'name' => 'Barbonne-Fayel',
            'size' => 24,
            'longitude' => 3.6940706,
            'latitude' => 48.6571602,
            'district' => DistrictFactory::find(['name' => 'Côte de Sézanne']),
        ]);
        $this->createVintage([
            'name' => 'Bassuet',
            'size' => 89.6,
            'longitude' => 4.6691036,
            'latitude' => 48.7987163,
            'district' => DistrictFactory::find(['name' => 'Côteaux Vitryats']),
        ]);
        $this->createVintage([
            'name' => 'Baroville',
            'size' => 17,
            'longitude' => 4.7240572,
            'latitude' => 48.1925484,
            'district' => DistrictFactory::find(['name' => 'Côte des Bar']),
        ]);
        $this->createVintage([
            'name' => 'Chamery',
            'size' => 204.8,
            'longitude' => 3.9667,
            'latitude' => 49.1667,
            'district' => DistrictFactory::find(['name' => 'Montagne de Reims']),
        ]);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
