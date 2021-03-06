<?php

namespace ByTIC\PersistentData\Tests;

/**
 * Class AbstractTest
 * @package ByTIC\PersistentData\Tests
 */
abstract class AbstractTest extends \PHPUnit\Framework\TestCase
{

    protected function tearDown()
    {
        parent::tearDown();
        \Mockery::close();
    }
}
