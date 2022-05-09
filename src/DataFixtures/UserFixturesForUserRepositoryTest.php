<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixturesForUserRepositoryTest extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //ADD 10 CLIENTS
        for($i = 0; $i < 10; $i++){
            $user = (new User())
                ->setNom("user$i-name")
                ->setPrenom("user$i-firstname")
                ->setEmail("user$i@domain.fr")
                ->setPassword("\$2y\$10\$m27uH2xu3MIpWTzBBWd11ubb9jXWmRWzhbMEU88wp5pm81XKkQvia") //0000
                ->setRoles(["ROLE_CLIENT"]);
            $manager->persist($user);
        }

        //ADD 1 ADMIN
        $user = (new User())
            ->setNom("admin-name")
            ->setPrenom("admin-firstname")
            ->setEmail("admin@domain.fr")
            ->setPassword("\$2y\$10\$m27uH2xu3MIpWTzBBWd11ubb9jXWmRWzhbMEU88wp5pm81XKkQvia") //0000
            ->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);
        
        //ADD 1 HOTEL WITH 1 GERANT
        
        $user = (new User())
            ->setNom("gerant-name")
            ->setPrenom("gerant-firstname")
            ->setEmail("gerant@domain.fr")
            ->setPassword("\$2y\$10\$m27uH2xu3MIpWTzBBWd11ubb9jXWmRWzhbMEU88wp5pm81XKkQvia") //0000
            ->setRoles(["ROLE_GERANT"]);
        $hotel = (new Hotel())
            ->setNom('test-nom')
            ->setVille('test-ville')
            ->setAdresse('test-adresse')
            ->setDescription('test-description')
            ->setGerant($user);

        $manager->persist($user);
        $manager->persist($hotel);
        $manager->flush();
    }
}