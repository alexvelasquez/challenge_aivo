<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class YouTubeTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $token = $this->getTokenAuthenticator($client);

        $this->testSearchVideosWithoutToken($client);
        $this->testSearchWithoutParameters($client,$token);
        $this->testSearchNotFound($client,$token);
        $this->testSearchSuccessful($client,$token);
    }

    /**
     * Test unauthorized video search
     * 
    */   
    private function testSearchVideosWithoutToken($client)
    {
        $client->request('GET','/api/youtube?search=""');
        $this->assertEquals(401,$client->getResponse()->getStatusCode());
        $this->assertEquals("JWT Token not found",json_decode($client->getResponse()->getContent())->message);
    }

    /**
     * Test without parameters video search
    */  
    private function testSearchWithoutParameters($client,$token)
    {
        $client->request('GET','/api/youtube',[],[],['HTTP_AUTHORIZATION'=>"Bearer {$token}"]);
        $this->assertEquals(400,$client->getResponse()->getStatusCode());
    }

    /**
     * Test not found videos
    */  
    private function testSearchNotFound($client,$token)
    {
        $client->request('GET','/api/youtube?search=fsakjdhfjkasdhfjksahdfkjhsadk',[],[],['HTTP_AUTHORIZATION'=>"Bearer {$token}"]);
        $this->assertEquals(404,$client->getResponse()->getStatusCode());
        $this->assertEquals('Video not found.',json_decode($client->getResponse()->getContent())->message);
    }

    /**
     * Test search successful
    */  
    private function testSearchSuccessful($client,$token)
    {
        $client->request('GET','/api/youtube?search=john lennon',[],[],['HTTP_AUTHORIZATION'=>"Bearer {$token}"]);
        $this->assertResponseIsSuccessful();
    }
    
    /**
     * Get token authenticator
     */
    private function getTokenAuthenticator($client){
        $client->request('POST','/api/login_check',["username"=>"ws_aivo","password"=>"ws_aivo_pass"]);
        $this->assertResponseIsSuccessful();
        $token = json_decode($client->getResponse()->getContent())->token;
        return $token;
    }
}
