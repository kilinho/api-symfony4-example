<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\ApiService;
use App\Service\ResultGameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

final class ResultGameRefreshController extends AbstractController
{
    private $resultGameService;
    private $apiService;
    private $serializer;

    public function __construct(
        ResultGameService $resultGameService,
        ApiService $apiService,
        SerializerInterface $serializer
    )
    {
        $this->resultGameService = $resultGameService;
        $this->apiService = $apiService;
        $this->serializer = $serializer;
    }

    /**
     * Refresh the result games by gameId. Only 1 game :(. gameId = 1
     *
     * @Route("/api/v1/result/game/refresh/{gameId}", name="refresh_result_game", methods={"POST"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns refresh result"
     * )
     *
     * @param int $gameId
     * @return Response
     */
    public function refreshAction(int $gameId): Response
    {
        try {
            $response = $this->apiService->makeApiRequest($gameId);
            $this->resultGameService->removeGame($gameId);
            $this->resultGameService->addResultGame($gameId, $response);
            $resultCollection = [
                'message' => sprintf('Results of Game number %s refreshed', $gameId)
            ];
        } catch (\Exception $e) {
            $resultCollection = [
                'errorMessage' => sprintf('Error: %s', $e->getMessage())
            ];
        }
        //TODO: refactor, DRY
        $data = $this->serializer->serialize($resultCollection, 'json');
        $response = new Response($data, Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    //@TODO - list games to view score
    public function listAction()
    {

    }
}