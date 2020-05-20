<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\ResultGameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Swagger\Annotations as SWG;

final class ResultGameController extends AbstractController
{

    private $resultGameService;
    private $serializer;

    public function __construct(ResultGameService $resultGameService, SerializerInterface $serializer)
    {
        $this->resultGameService = $resultGameService;
        $this->serializer = $serializer;
    }

    /**
     * List the result games by gameId. Only 1 game :(. gameId = 1
     *
     * @Route("/api/v1/result/game/{gameId}", name="all_result_game", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns list the result games by gameId"
     * )
     * @SWG\Parameter(
     *     name="sort",
     *     in="query",
     *     type="string",
     *     description="The field used to sort result, ex: score OR finishedAt"
     * )
     * @SWG\Parameter(
     *     name="order",
     *     in="query",
     *     type="string",
     *     description="The field used to desc result, ex: ASC or DESC"
     * )
     *
     * @param int $gameId
     * @param Request $request
     * @return Response
     */
    public function getAction(int $gameId, Request $request): Response
    {
        try {
            $resultCollection = $this->resultGameService->findAllResultsGamesByGameId($gameId, $request->query->all());
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
}