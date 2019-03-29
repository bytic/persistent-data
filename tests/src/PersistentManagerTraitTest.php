<?php

namespace ByTIC\PersistentData\Tests;

use ByTIC\PersistentData\Tests\Fixtures\Users\Users;

/**
 * Class PersistentManagerTraitTest
 * @package ByTIC\PersistentData\Tests
 */
class PersistentManagerTraitTest extends AbstractTest
{

    public function testSetCurrent()
    {
        $users = new Users();

        $current = new \stdClass();
        $current->id = 9;

        $users->setCurrent($current);

        self::assertSame($current, $users->getCurrent());
    }
}
