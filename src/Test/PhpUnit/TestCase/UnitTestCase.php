<?php

namespace CodelyTv\Test\PhpUnit\TestCase;

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
