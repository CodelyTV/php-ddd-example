<?php

declare(strict_types=1);

namespace CodelyTv\Test\Infrastructure\PHPUnit;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
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
