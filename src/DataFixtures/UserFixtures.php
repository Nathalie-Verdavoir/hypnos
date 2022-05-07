<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $user = (new User())
                ->setNom("user$i-name")
                ->setPrenom("user$i-firstname")
                ->setEmail("user$i@domain.fr")
                ->setPassword("0000")
                ->setRoles(["ROLE_CLIENT"]);
            $manager->persist($user);
        }
        $user = (new User())
                ->setNom("userAdmin-name")
                ->setPrenom("userAdmin-firstname")
                ->setEmail("userAdmin@domain.fr")
                ->setPassword("0000")
                ->setRoles(["ROLE_ADMIN"]);
            $manager->persist($user);
        $manager->flush();
    }
}