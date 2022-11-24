<?php

namespace ByTIC\PersistentData\Tests\Engines;

use ByTIC\PersistentData\Engines\CookiesEngine;
use ByTIC\PersistentData\Engines\EngineCollection;
use ByTIC\PersistentData\Tests\AbstractTest;
use ByTIC\PersistentData\Tests\Fixtures\Users\Engines\CustomCookieEngine;
use ByTIC\PersistentData\Tests\Fixtures\Users\Users;

/**
 * Class HasEnginesTraitTest
 * @package ByTIC\PersistentData\Tests\Engines
 */
class HasEnginesTraitTest extends AbstractTest
{
    public function testGetPersistentDataEngines()
    {
        $users = new Users();
        $collection = $users->getPersistentDataEngines();

        self::assertInstanceOf(EngineCollection::class, $collection);
        self::assertCount(3, $collection);
        self::assertInstanceOf(CookiesEngine::class, $collection->get('cookies'));
    }

    public function testGetPersistentDataEnginesTypesCustom()
    {
        /** @var Users $users */
        $users = \Mockery::mock(Users::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $users->shouldReceive('getPersistentDataEnginesTypes')->andReturn(['session', CustomCookieEngine::class]);

        $collection = $users->getPersistentDataEngines();

        self::assertInstanceOf(EngineCollection::class, $collection);
        self::assertCount(2, $collection);
        self::assertInstanceOf(CustomCookieEngine::class, $collection->get('cookies'));
    }
}
