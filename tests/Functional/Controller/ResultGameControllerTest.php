<?php declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResultGameControllerTest extends WebTestCase
{
    public function testShowPostResultGame()
    {
        $client = static::createClient();
        //http://localhost:8080/api/v1/result/game/1
        $client->request('GET', '/api/v1/result/game/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}