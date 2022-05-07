<?php

namespace App\Tests\Repository;

use App\DataFixtures\UserFixtures;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class UserRepositoryTest extends KernelTestCase 
{
    
    protected AbstractDatabaseTool $databaseTool;
    protected EntityManagerInterface $entityManager;

    public function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class);
        $this->entityManager = self::getContainer()->get(EntityManagerInterface::class);
    }
    public function testCount() {
        $this->databaseTool->loadFixtures([
            UserFixtures::class
        ]);

        $category = $this->entityManager->getRepository(User::class);
        self::bootKernel();
        $container = static::getContainer();
        $users = $container->get(UserRepository::class)->count([]); 
        $this->assertEquals(11, $users);
    }
}