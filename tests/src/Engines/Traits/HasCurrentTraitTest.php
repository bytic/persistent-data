<?php
declare(strict_types=1);

namespace ByTIC\PersistentData\Tests\Engines\Traits;

use ByTIC\PersistentData\Engines\CookiesEngine;
use ByTIC\PersistentData\Tests\AbstractTest;
use Mockery\Mock;

/**
 * Class HasCurrentTraitTest
 * @package ByTIC\PersistentData\Tests\Engines\Traits
 */
class HasCurrentTraitTest extends AbstractTest
{
    public function testGetCurrentCallGenerate()
    {
        /** @var CookiesEngine|Mock $engine */
        $engine = \Mockery::mock(CookiesEngine::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $engine->shouldReceive('findModelFromData')->once()->andReturn(false);

        $model = $engine->getCurrentModel();
        self::assertNull($model);
    }
}
