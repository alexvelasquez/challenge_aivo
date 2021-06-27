<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTest extends WebTestCase
{
    public function testSomething(): void
    {
        // authentication without parameters
        $client = static::createClient();
        $this->testAuthenticationWithoutParameters($client);
        $this->testAuthenticationWithWrongParameters($client);
        $this->testAuthenticationSuccessful($client);
    }

    /**
     * Test authentication without parameters
     */
    private function testAuthenticationWithoutParameters($client)
    {
        $client->request('POST','/api/login_check');
        $this->assertEquals(400,$client->getResponse()->getStatusCode());
    }

    /**
     * Test authentication with wrong parameters
     */
    private function testAuthenticationWithWrongParameters($client)
    {
        // wrong user
        $client->request('POST','/api/login_check',["username"=>"aivo","password"=>"ws_aivo_pass"]);
        $this->assertEquals(401,$client->getResponse()->getStatusCode());
        $this->assertEquals('Invalid credentials.',json_decode($client->getResponse()->getContent())->message);

        // wrong password
        $client->request('POST','/api/login_check',["username"=>"ws_aivo","password"=>"aivo_pass"]);
        $this->assertEquals(401,$client->getResponse()->getStatusCode());
        $this->assertEquals('Invalid credentials.',json_decode($client->getResponse()->getContent())->message);
    }

    /**
     * Test authentication successful
    */  
    private function testAuthenticationSuccessful($client)
    {
        $client->request('POST','/api/login_check',["username"=>"ws_aivo","password"=>"ws_aivo_pass"]);
        $this->assertResponseIsSuccessful();
    }
}
