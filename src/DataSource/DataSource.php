<?php declare(strict_types=1);

namespace App\DataSource;

final class DataSource implements DataSourceInterface
{
    const SOURCE_ADDRESS = 'http://212.59.241.119/example.json';

    /**
     * @param int $gameId
     * @return string
     */
    public function getAddress(int $gameId): string
    {
        return self::SOURCE_ADDRESS . $gameId;
    }
}