<?php

namespace ByTIC\PersistentData\Tests\Engines;

use ByTIC\PersistentData\Engines\CookiesEngine;
use ByTIC\PersistentData\Tests\AbstractTest;

/**
 * Class CookiesEngineTest
 * @package ByTIC\PersistentData\Tests\Engines
 */
class CookiesEngineTest extends AbstractTest
{
    public function testGetCurrentModelWithEmptyData()
    {
        $engine = new CookiesEngine();

        $model = $engine->getCurrentModel();
        self::assertFalse($model);
    }

    public function testGetData()
    {
        $_COOKIE['administrator'] = '9';

        $engine = new CookiesEngine();
        $engine->setVarName('administrator');

        self::assertEquals(9, $engine->getData());
    }
}
