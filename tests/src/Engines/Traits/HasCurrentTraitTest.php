<?php

namespace ByTIC\PersistentData\Tests\Engines\Traits;

use ByTIC\PersistentData\Engines\CookiesEngine;
use ByTIC\PersistentData\Tests\AbstractTest;

/**
 * Class HasCurrentTraitTest
 * @package ByTIC\PersistentData\Tests\Engines\Traits
 */
class HasCurrentTraitTest extends AbstractTest
{
    public function testGetCurrentCallGenerate()
    {
        /** @var CookiesEngine $engine */
        $engine = \Mockery::mock(CookiesEngine::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $engine->shouldReceive('findModelFromData')->once()->andReturn(false);

        $model = $engine->getCurrentModel();
        self::assertFalse($model);
    }
}
