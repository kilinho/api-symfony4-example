<?php declare(strict_types=1);

namespace App\HttpClientProvider;

interface HttpClientProviderInterface
{
    public function makeRequest(string $url): array;
}