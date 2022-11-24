<?php
declare(strict_types=1);

namespace ByTIC\PersistentData\Tests\Engines;

use ByTIC\PersistentData\Engines\CookiesEngine;
use ByTIC\PersistentData\Engines\EngineCollection;
use ByTIC\PersistentData\Engines\RequestEngine;
use ByTIC\PersistentData\Tests\AbstractTest;

/**
 * Class EngineCollectionTest
 * @package ByTIC\PersistentData\Tests\Engines
 */
class EngineCollectionTest extends AbstractTest
{
    public function testGetCurrentModelOnEmpty()
    {
        $collection = new EngineCollection();
        $model = $collection->getCurrentModel();
        self::assertFalse($model);
    }

    public function testGetCurrentModel()
    {
        $collection = new EngineCollection();

        $session = \Mockery::mock(RequestEngine::class)->makePartial();
        $session->shouldReceive('getCurrentModel')->once();
        $collection->addEngine($session);

        $cookies = \Mockery::mock(CookiesEngine::class)->makePartial();
        $cookies->shouldReceive('getCurrentModel')->once();
        $collection->addEngine($cookies);

        $model = $collection->getCurrentModel();
        self::assertFalse($model);

        \Mockery::close();
    }
}
