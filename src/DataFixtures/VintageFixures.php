<?php

namespace App\DataFixtures;

use App\Factory\BenefitFactory;
use App\Factory\DistrictFactory;
use App\Factory\RecipientFactory;
use App\Factory\VintageFactory;
use App\Factory\VintageTypeFactory;
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
        $recip = [];
        $i = 0;
        while ($i <= $rand + 1 and sizeof($usersRD) != $rand) {
            $user = $users[random_int(0, $rand)];
            if (!in_array($user, $usersRD)) {
                $arrayRD[] = $user;
                $v->addUser($this->getReference($user));
            }
            $reci = RecipientFactory::random()->object();
            if (!in_array($reci, $recip)) {
                $recip[] = $reci;
                $v->addRecipient($reci);
            }

            ++$i;
        }

        return $v;
    }

    public function load(ObjectManager $manager): void
    {
        $this->createVintage(['name' => 'Aÿ',
            'size' => 10,
            'longitude' => 3.9970886,
            'latitude' => 49.0621668,
            'chardonnay' => 8.3,
            'meunier' => 2.8,
            'pinot_noir' => 88.8,
            'district' => DistrictFactory::find(['name' => 'Vallé de la marne']),
            'benefits' => BenefitFactory::randomRange(1, 3),
            'vintage_type' => VintageTypeFactory::random(),
            ]);

        $this->createVintage([
            'name' => 'Barbonne-Fayel',
            'size' => 24,
            'longitude' => 3.6940706,
            'latitude' => 48.6571602,
            'chardonnay' => 71.0,
            'meunier' => 1.8,
            'pinot_noir' => 27.9,
            'district' => DistrictFactory::find(['name' => 'Côte de Sézanne']),
            'vintage_type' => VintageTypeFactory::random(),
            'benefits' => BenefitFactory::randomRange(1, 3),
        ]);
        $this->createVintage([
            'name' => 'Bassuet',
            'size' => 89.6,
            'longitude' => 4.6691036,
            'latitude' => 48.7987163,
            'chardonnay' => 95.9,
            'meunier' => 3.3,
            'pinot_noir' => 0.8,
            'district' => DistrictFactory::find(['name' => 'Côteaux Vitryats']),
            'vintage_type' => VintageTypeFactory::random(),
            'benefits' => BenefitFactory::randomRange(1, 3),
        ]);
        $this->createVintage([
            'name' => 'Baroville',
            'size' => 17,
            'longitude' => 4.7240572,
            'latitude' => 48.1925484,
            'chardonnay' => 10.9,
            'meunier' => 1.0,
            'pinot_noir' => 86.5,
            'district' => DistrictFactory::find(['name' => 'Côte des Bar']),
            'vintage_type' => VintageTypeFactory::random(),
            'benefits' => BenefitFactory::randomRange(1, 3),
        ]);
        $this->createVintage([
            'name' => 'Chamery',
            'size' => 204.8,
            'longitude' => 3.9667,
            'latitude' => 49.1667,
            'chardonnay' => 30.2,
            'meunier' => 40.6,
            'pinot_noir' => 28.9,
            'district' => DistrictFactory::find(['name' => 'Montagne de Reims']),
            'vintage_type' => VintageTypeFactory::random(),
            'benefits' => BenefitFactory::randomRange(1, 3),
        ]);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            DistrictFixtures::class,
            RecipientFixtures::class,
        ];
    }
}
