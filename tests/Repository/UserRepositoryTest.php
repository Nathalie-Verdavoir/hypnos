<?php

namespace App\Tests\Repository;

use App\DataFixtures\UserFixturesForUserRepositoryTest;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->entityManager = self::getContainer()->get(EntityManagerInterface::class);
    }
    public function testCount()
    {

        $this->databaseTool->loadFixtures([
            UserFixturesForUserRepositoryTest::class
        ]);
        self::bootKernel();
        $container = static::getContainer();
        $users = $container->get(UserRepository::class)->count([]);
        $this->assertEquals(12, $users);
    }
}
