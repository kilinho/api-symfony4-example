<?php declare(strict_types=1);

namespace App\Tests\DataSource;

use PHPUnit\Framework\TestCase;
use App\DataSource\DataSource;

class DataSourceTest extends TestCase
{
    public function testAdd()
    {
        $gameId = 1;
        $dataSource = new DataSource();
        $this->assertEquals(
            'https://private-b5236a-jacek10.apiary-mock.com/results/games/1',
            $dataSource->getAddress($gameId)
        );
    }
}