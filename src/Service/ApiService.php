<?php declare(strict_types=1);

namespace App\Service;

use App\DataSource\DataSourceInterface;
use App\HttpClientProvider\HttpClientProviderInterface;

final class ApiService
{
    private $httpClient;
    private $dataSource;

    public function __construct(
        HttpClientProviderInterface $httpClient,
        DataSourceInterface $dataSource
    )
    {
        $this->httpClient = $httpClient;
        $this->dataSource = $dataSource;
    }

    /**
     * @param int $gameId
     * @return mixed
     */
    public function makeApiRequest(int $gameId): array
    {
        $url = $this->dataSource->getAddress($gameId);
        return $this->httpClient->makeRequest($url);
    }
}