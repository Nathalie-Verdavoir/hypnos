<?php

namespace App\Tests\Controller;

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
}