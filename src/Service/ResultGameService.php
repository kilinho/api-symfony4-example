<?php declare(strict_types=1);

namespace App\Service;

use App\Document\ResultGame;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ResultGameService
{
    private $resultGameRepository;
    private $dm;

    public function __construct(
        DocumentRepository $resultGameRepository,
        DocumentManager $dm
    )
    {
        $this->resultGameRepository = $resultGameRepository;
        $this->dm = $dm;
    }

    /**
     * @param int $gameId
     * @param array $sortParams
     * @return array
     */
    public function findAllResultsGamesByGameId(int $gameId, array $sortParams): array
    {
        $sort = $this->prepareSortParams($sortParams);

        $gameResult = $this->resultGameRepository->findByGameId($gameId, $sort);
        if (empty($gameResult)) {
            throw new NotFoundHttpException(
                sprintf('Results Games with GameId [%s] cannot be found.', $gameId)
            );
        }

        return $gameResult;
    }

    /**
     * @TODO: refactor
     *
     * @param array $sortParams
     * @return array
     */
    private function prepareSortParams(array $sortParams)
    {
        if (empty($sortParams['sort']) || empty($sortParams['order'])) {
            return ['score' => 'ASC'];
        }
        $availableSortColumns = ['score', 'finishedAt'];
        $availableOrderAttribute = ['ASC', 'DESC'];
        if (!in_array($sortParams['sort'], $availableSortColumns)
            || !in_array($sortParams['order'], $availableOrderAttribute)) {
            throw new NotFoundHttpException('Bad sort params.');
        }

        return [$sortParams['sort'] => $sortParams['order']];
    }

    /**
     * @param int $gameId
     * @param array $resultGameCollection
     * @return bool
     * @throws Exception
     */
    public function addResultGame(int $gameId, array $resultGameCollection): bool
    {
        foreach ($resultGameCollection as $result) {
            $user = new User();
            $user->setUserId($result['user']['id']);
            $user->setName($result['user']['name']);

            $resultGame = new ResultGame();
            $resultGame->setGameId($gameId);
            $resultGame->setResultGameId($result['id']);
            $resultGame->setUser($user);
            $resultGame->setScore($result['score']);
            $resultGame->setFinishedAt(new \DateTime($result['finished_at']));

            $this->dm->persist($user);
            $this->dm->persist($resultGame);

            $this->dm->flush();
        }

        return true;
    }

    /**
     * @param int $gameId
     */
    public function removeGame(int $gameId): void
    {
        $this->resultGameRepository->removeByGameId($gameId);
    }
}