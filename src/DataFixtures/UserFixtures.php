<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Service\User\Creator;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private Creator $creator;

    public function __construct(Creator $creator)
    {
        $this->creator = $creator;    
    }

    public function load(ObjectManager $manager)
    {
        /** @var [] $userData */
        foreach($this->getUsers() as $userData) {
            $this->creator->create($this->createUser($userData));
        }
    }

    private function createUser(array $data): User
    {
        $user = new User();
        $user->setUsername($data[0]);
        $user->setPlainPassword($data[1]);
        $user->setEnabled($data[2]);

        return $user;
    }

    private function getUsers()
    {
        for ($i = 1; $i < 16; $i++) {
            yield ['user_'.$i, 'testTest!', true];
        }
    }

}