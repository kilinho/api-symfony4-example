<?php declare(strict_types=1);

namespace App\Repository;

use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Doctrine\ODM\MongoDB\MongoDBException;

final class ResultGameRepository extends DocumentRepository
{
    /**
     * @param int $gameId
     * @param array $sort
     * @return array|null
     */
    public function findByGameId(int $gameId, array $sort): ?array
    {
        return $this->findBy(['gameId' => $gameId], $sort);
    }

    /**
     * @param int $gameId
     * @throws MongoDBException
     */
    public function removeByGameId(int $gameId): void
    {
        $this->createQueryBuilder()
            ->field('gameId')->equals($gameId)
            ->remove()
            ->getQuery()
            ->execute();
    }
}