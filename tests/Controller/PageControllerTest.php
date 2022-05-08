<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PageControllerTest extends WebTestCase
{
    public function testAccueilPage () {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testNavbarAccueilPage () {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertSelectorTextContains('nav','Hypnos');
    }

    public function testReservationPageIsRestricted () {
        $client = static::createClient();
        $client->request('GET', '/reservation');
        $this->assertResponseRedirects();
    }

    public function testAdminPageIsRestricted () {
        $client = static::createClient();
        $client->request('ANY', '/admin');
        $this->assertResponseRedirects();
    }

    public function testVisitingWhileLoggedIn()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        // retrieve the test user
        $testUser = $userRepository->findOneByEmail('user0@domain.fr');

        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // test e.g. the accueil page
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('header', 'user0-firstname');
    }

}