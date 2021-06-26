<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiService
{
    private $url;
    private $client;

    public function __construct(HttpClientInterface $client,$url)
    {
        $this->client = $client;
        $this->url = $url;
    }
    public function getJson(string $endpoint, array $params)
    {
        $url="{$this->url}/{$endpoint}";
        $response = $this->client->request('GET',$url,['query'=> $params]);
        $response = $this->verifyStatusResponse($endpoint,$response,'GET');
        return $response;
    }

    public function verifyStatusResponse($endpoint,$response,$httpMethod){
        if ($response->getStatusCode() != Response::HTTP_OK) {
            $message = "{Endpoint: {$httpMethod} {$endpoint}} {Status Code: {$response->getStatusCode()}}";
            throw new HttpException($response->getStatusCode(), static::class . ' > '. $message);
        }
        return $response;
    }
}