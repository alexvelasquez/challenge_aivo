<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;

use App\Service\ApiYouTubeService;

/**
 * @Rest\Route("/api/youtube")
 */
class YouTubeController extends AbstractFOSRestController
{
	  /**
     * @Rest\Get("")
     * Returns up to 10 results from a search on youtube given a keyword.
     * @Rest\QueryParam(name="search")
     * @Rest\QueryParam(name="max_result")
     * @OA\Response(response=200,description="Returns the videos of a specific search")
     * @OA\Response(response=400,description="Parameter search: This value should not be null.")
     * @OA\Response(response=404,description="Video not found.")
     * @OA\Parameter(name="search",in="query",description="search keyword",@OA\Schema(type="string"))
     * @OA\Parameter(name="max_result",in="query",description="maximum number of results by default returns 10",@OA\Schema(type="string"))
     * @OA\Tag(name="YouTube")
     * @Security(name="Bearer")
     * @param ParamFetcherInterface $paramFetcher
     * @return Response
     *
    */
    public function search(ParamFetcherInterface $paramFetcher, ApiYouTubeService $apiService): Response
    {
        $search = !empty($paramFetcher->get('search')) ? $paramFetcher->get('search') : null;
        $maxResult =  !empty($paramFetcher->get('max_result')) ? $paramFetcher->get('max_result') : 10;
        if(!$search) {
            throw new HttpException(400, "Parameter search: This value should not be null.");
        }
        $response = $apiService->search($search,$maxResult);
        if(empty($response)){
            throw new HttpException(404, "Video not found.");
        }
        return $this->handleView($this->view($response));
    }
}
