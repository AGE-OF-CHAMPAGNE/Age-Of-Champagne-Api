<?php

namespace App\DataFixtures;

use App\Factory\DidYouKnowFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(['email' => 'test@test.com', 'wantSeeDYK' => true, 'roles' => ['ROLE_ADMIN', 'ROLE_USER']]);

        UserFactory::createMany(5, ['wantSeeDYK' => true, 'DYKs' => DidYouKnowFactory::randomRange(1, 3)]);

        $this->addUser(5, ['ROLE_USER']);

        $manager->flush();
    }

    private function addUser(int $num, array $roles = []): void
    {
        for ($i = 1; $i < $num + 1; ++$i) {
            $this->addReference('user'.(string) $i, UserFactory::createOne(['roles' => $roles, 'wantSeeDYK' => true])->object());
        }
    }
}
