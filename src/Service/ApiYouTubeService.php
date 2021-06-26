<?php

namespace App\Service;

use App\Service\ApiService;
use App\Entity\Response\SearchYouTube;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiYouTubeService extends ApiService
{
    private $apiKey;

    public function __construct(string $apiKey,string $apiUrl,HttpClientInterface $client)
    {
        $this->apiKey = $apiKey;
        parent::__construct($client,$apiUrl);
    }
    
    public function search($value,$maxResults)
    {
        $endpoint='search';
        $params = ['key'=>$this->apiKey,'q'=>$value,'type'=>'video','part'=>'id,snippet','regionCode'=>'AR','maxResults'=>$maxResults];
        $searchResponse = $this->getJson($endpoint,$params);
        $searchResponse = $searchResponse->toArray()['items'];
        // processing response data;
        $response = [];
        foreach ($searchResponse as $value) {
            $response[]=new SearchYouTube($value);
        }
        return $response;
    }
}