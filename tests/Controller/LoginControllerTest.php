<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginControllerTest extends WebTestCase
{
    public function testLoginPage () {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains('h2','Connexion');
    }

    public function testLoginWithBadCredentials () {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Continuer')->form([
            '_username' => 'email@email.fr',
            '_password' => 'fakepassword'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorTextContains('.validator','Invalid credentials.');
    }

    /**
     * @dataProvider provideAccountsToLog
     */
    public function testLoginWithClient (string $username, string $element) {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Continuer')->form([
            '_username' => $username,
            '_password' => '0000'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorTextContains('header',$element);
    }

    public function provideAccountsToLog(): array{
        return [
            ['user0@domain.fr','user0-firstname'], //client
            
            ['admin@domain.fr','Admin'], //admin
            
            ['gerant@domain.fr','Mon Hôtel'], //Gerant
        ];
    }
}