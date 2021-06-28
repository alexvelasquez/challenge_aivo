<?php

namespace App\Service;

use App\Service\ApiService;
use App\Entity\Response\Video;
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
    
    /**
     * Returns the search matches
     * @return Array
     */
    public function search($value,$maxResults)
    {
        $endpoint='search';
        $params = ['key'=>$this->apiKey,'q'=>$value,'type'=>'video','part'=>'id','regionCode'=>'AR','maxResults'=>$maxResults];
        $searchResponse = $this->getJson($endpoint,$params);
        $searchResponse = $searchResponse->toArray()['items'];
        // processing response data;
        $response = [];
        foreach ($searchResponse as $value) {
            $video = $this->getVideo($value['id']['videoId']);
            $response[]=$video;
        }
        return $response;
    }

    /**
     * Returns the video given the id
     * @return Video
     */
    public function getVideo($videoId)
    {
        $endpoint='videos';
        $params = ['key'=>$this->apiKey,'id'=>$videoId,'part'=>'statistics,snippet'];
        $searchResponse = $this->getJson($endpoint,$params);
        $searchResponse = $searchResponse->toArray()['items'][0];
        $response = new Video($searchResponse);
        return $response;
    }
}