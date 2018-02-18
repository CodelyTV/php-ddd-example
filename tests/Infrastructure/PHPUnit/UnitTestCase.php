<?php

namespace CodelyTv\Test\Infrastructure\PHPUnit;

use Mockery;
use Mockery\MockInterface;
use PHPUnit_Framework_TestCase;

abstract class UnitTestCase extends PHPUnit_Framework_TestCase
{
    protected function mock($className) : MockInterface
    {
        return Mockery::mock($className);
    }

    protected function namedMock($name, $className) : MockInterface
    {
        return Mockery::namedMock($name, $className);
    }
}
