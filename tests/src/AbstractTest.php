<?php
declare(strict_types=1);

namespace ByTIC\PersistentData\Tests;

/**
 * Class AbstractTest
 * @package ByTIC\PersistentData\Tests
 */
abstract class AbstractTest extends \PHPUnit\Framework\TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}
